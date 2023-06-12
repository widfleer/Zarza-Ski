<?php
session_start ();
if (isset($_SESSION['nom_groupe']) || !isset($_SESSION['id'])) {
    header('Location: ./choix_compte.php');
}
?>
<!DOCTYPE html>
<!-- Doctype pour rester comforme aux standards -->
<!-- lang pour accent pour synthèse vocale-->
<html lang="fr">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" data-tag="font" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" data-tag="font" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" data-tag="font" />

<head>
    <!-- charset = encodage des caractères -->
    <meta charset="UTF-8" />
    <!-- viewport pour la mise en page mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link pour relier la feuille css -->
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/modifier_infos_perso.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Rejoindre un groupe</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/ski.ico">
    <META NAME="Robots" CONTENT="index, follow">
    <META NAME="Author" CONTENT="COUTELLIER HOUANGKEO">
    <META NAME="Keywords" CONTENT="COUTELLIER HOUANGKEO Zarza-Ski">
</head>

<body>
    <?php
    include("header.inc.html");
    ?>

    <section class="modifier" id="modifier">
        <h1>Rejoindre un groupe</h1>
        <div class="champs">
            <div class="champ">
                <h2>Liste des groupes</h2>
                    <?php 
                        include("connexion.inc.php");
                        $requete="SELECT nom_groupe FROM sae_groupe;";
                        $resultat = $cnx->query($requete);
                        if ($resultat->rowCount() > 0) {
                            echo '<table style="border-collapse: collapse;">';
                            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr><td style="border: 1px solid black">'.$ligne['nom_groupe'].'</td></tr>';
                            }
                            echo '</table>';
                        }
                        else {
                            echo '<body onLoad="alert(\'Aucun groupe disponible !\')">';
                        }
                    ?>
            </div>
            <div class="champ">
                    <?php 
                        include("connexion.inc.php");
                        $date_du_jour = date('Y-m-d');
                        $requete="SELECT nom_groupe FROM sae_groupe WHERE NOT EXISTS (SELECT num_res FROM sae_reservation WHERE sae_groupe.nom_groupe=sae_reservation.nom_groupe AND ((DATE(datedebut_res)>='".$date_du_jour."') OR (DATE(datefin_res))>='".$date_du_jour."'));";
                        $resultat = $cnx->query($requete);
                        if ($resultat->rowCount() > 0) {
                            echo '<form action="./verif_join.php" method="post">';
                            echo '<label for="nom">Rejoindre un groupe (qui n\'a de réservation en cours/à venir) : </label>';
                            echo '<select name="nom" id="nom">';
                            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                                echo $ligne['nom_groupe'];
                                echo '<option value="'.$ligne['nom_groupe'].'">'.$ligne['nom_groupe'].'</option>';
                            }
                            echo '</select>';
                            echo '<input type="submit" name="submit" value="Valider" style="margin: 20px"/>';
                            echo '</form>';
                        }
                        else {
                            echo 'Aucun groupe disponible !';
                        }
                    ?>
            </div>
        </div>
        
    </section>

    <?php
    include("footer.inc.html");
    ?>
</body>
</html>