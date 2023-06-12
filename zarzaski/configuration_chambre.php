<?php
session_start();
include("connexion.inc.php");
if ((isset($_POST['arrivee']) and isset($_POST['duree'])) or (isset($_SESSION['dateDepart']) and isset($_SESSION['duree']))){
    
    if (isset($_POST['arrivee']) and isset($_POST['duree'])){
    $dateDepart = $_POST['arrivee'];
    $duree = $_POST['duree'];

    $dateFin = date('Y-m-d', strtotime('+' . $duree . ' week', strtotime($dateDepart)));

    $_SESSION['dateDepart'] = $dateDepart;
    $_SESSION['dateFin'] = $dateFin;
    $_SESSION['duree'] = $duree;
    }else{
        $dateDepart =$_SESSION['dateDepart'];
        $dateFin = $_SESSION['dateFin'];
    }
    if (strtotime($dateDepart) < time() or strtotime($dateFin) < time()){
        echo '<body onLoad="alert(\'Impossible de réserver pour une date antérieure !\')">';
        header('Location: ./reservation.php');
    }
    $requete = "SELECT * FROM sae_chambre WHERE num_chambre NOT IN (SELECT num_chambre FROM sae_heberger WHERE num_res IN (SELECT num_res FROM sae_reservation WHERE ((datedebut_res BETWEEN '" . $dateDepart . "' AND '" . $dateFin . "') OR (datefin_res BETWEEN '" . $dateDepart . "' AND '" . $dateFin . "') OR (datedebut_res < '" . $dateDepart . "' AND datefin_res > '" . $dateFin . "')) AND nom_groupe !='".$_SESSION["nom_groupe"]."'));";
    $chambres = $cnx->query($requete);
    $nb_lits_dispos = 0;
    while ($ligne = $chambres->fetch(PDO::FETCH_ASSOC)) {
        $nb_lits_dispos += $ligne['nb_lits_chambre'];
    }

    $requete = "SELECT COUNT(*) FROM sae_client WHERE nom_groupe='" . $_SESSION['nom_groupe'] . "';";
    $nbpersonnes = $cnx->query($requete);
    if ($nb_lits_dispos < $nbpersonnes) {
        echo '<body onLoad="alert(\'Nombre de lits disponibles insuffisants pour la période sélectionnée...\')">';
        header('Location: ./reservation.php');
    }
} else {
    header('Location: ./reservation.php');
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
    <link rel="stylesheet" href="./css/configuration_chambre.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Réservation</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/ski.ico">
    <META NAME="Robots" CONTENT="index, follow">
    <META NAME="Author" CONTENT="COUTELLIER HOUANGKEO">
    <META NAME="Keywords" CONTENT="COUTELLIER HOUANGKEO Zarza-Ski">
</head>

<body>
    <?php
    include("header.inc.html");
    ?>
    <section class="attribution">
        <h1>Attribution des chambres</h1>

        <form action="./insertion_reservation.php" method="post">
            <div class="groupe">
            <?php
            include("connexion.inc.php");
            
            $personnes = $cnx->query("SELECT * FROM sae_client WHERE nom_groupe='" . $_SESSION['nom_groupe'] . "';");
            $formules = $cnx->query("SELECT * FROM sae_formule;");

            while ($ligne = $personnes->fetch(PDO::FETCH_ASSOC)) {
                $nom = $ligne['nom_client'];
                $prenom = $ligne['prenom_client'];
                $num = $ligne['num_client'];

                echo '<div class="personne">';
                $chambres->execute();
                echo '<fieldset>';
                echo '<legend>' . $nom . ' ' . $prenom . ' ' . $num . '</legend>';
                echo '<select name="'.$num.'_chambre" id="chambre">';
                while ($chambre = $chambres->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="'.$chambre['num_chambre'].'"> Chambre'.$chambre['num_chambre'].'( '.$chambre['nb_lits_chambre'].' personnes ) </option>'; 
                }
                echo '</select>';
                $i = 0;
                $formules->execute();
                while ($formule = $formules->fetch(PDO::FETCH_ASSOC)) {
                echo '<div>';
                $nom_form = $formule['nom_formule'];
                if ($i!=0){
                    echo '<input type="radio" id="'.$nom_form.'" name="'.$num.'_formule" value="'.$nom_form.'">';
                }else{
                echo '<input type="radio" id="'.$nom_form.'" name="'.$num.'_formule" value="'.$nom_form.'" checked>';
                }
                echo '<label for="'.$nom_form.'">'.$nom_form.'</label>';
                echo '</div>';
                $i++;
                }
                echo '</fieldset>';
                echo '</div>';
            }
            
            ?>
            
        </div>
        <div class="center">
            <input type="submit" name="submit" value="Valider" />
        </div>
        </form>
    </section>
    <?php
    include("footer.inc.html");
    ?>
</body>

</html>