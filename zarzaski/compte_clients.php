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
    <link rel="stylesheet" href="./css/compte.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Compte Client</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/ski.ico">
    <META NAME="Robots" CONTENT="index, follow">
    <META NAME="Author" CONTENT="COUTELLIER HOUANGKEO">
    <META NAME="Keywords" CONTENT="COUTELLIER HOUANGKEO Zarza-Ski">
</head>

<body>
    <?php
    session_start();
    include("header.inc.html");
    ?>

    <section class="acc" id="acc">
        <div class="profil">
            <h3>Votre profil</h3>
            <div class="in">
                <div class="wimg">
                    <h4>Votre profil</h4>
                    <div class="profil_block">
                        <a href="deco.php"><img src="./assets/deco.png"></a>
                    </div>
                </div>
                <div class="profil_group">
                    <div class="profil_block">
                    <button>
                        <a href="./resume.php">Vos informations</a>
                    </button>
                    </div>
                </div>
                <div class="profil_group">
                    <div class="profil_block">
                    <button>
                        <a href="./modifier_infos_perso.php">Modifier</a>
                    </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="groupe">
            <h3>Votre groupe</h3>
            <div class="in">
                <div class="wimg">
                    <h4>Votre groupe</h4>
                    <?php
                    include('connexion.inc.php');
                    $id = $_SESSION["id"];
                    if ($_SESSION["titre"] == "chef") {
                        echo '<div class="group_block">';
                        echo '<img src="./assets/crown.png">';
                        echo '</div>';
                    }
                    echo '</div>';

                    $requete = 'SELECT * FROM sae_client WHERE num_client='.$id.' AND nom_groupe IS NULL;';
                    $result = $cnx->query($requete);
                    
                    if (($result->rowCount()) == 0) {
                        echo '<div class="contain_group">';
                        echo '<div class="group_block">';
                        
                        echo '<h3>';
                        echo $_SESSION["nom_groupe"];
                        echo '<h3>';
                        echo '</div>';
                        echo '<div class="group_block">';
                        if ($_SESSION["titre"] == "chef") {
                            echo '<button>';
                            echo '<a href="./gerer_groupe.php">Gérer</a>';
                            echo '</button>';
                        }

                        echo '</div>';
                        echo '</div>';
                        echo '<h4>Vos réservations</h4>';
                        echo '<div class="contain_res">';
                        $requete = 'SELECT DISTINCT datedebut_res, datefin_res, nom_formule, num_chambre FROM sae_achete JOIN sae_heberger ON sae_achete.num_res=sae_heberger.num_res AND sae_achete.num_client = sae_heberger.num_client JOIN sae_reservation ON sae_heberger.num_res=sae_reservation.num_res WHERE sae_achete.num_client='.$_SESSION["id"].';';
                        $resultat = $cnx->query($requete);
                        if ($resultat->rowCount() > 0) {
                            echo '<table>';
                            echo '<tr>';
                            echo '<th>Date d\'arrivée</th>';
                            echo '<th>Date de départ</th>';
                            echo '<th>Chambre</th>';
                            echo '<th>Formule</th>';
                            echo '</tr>';
                            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>'.$ligne['datedebut_res'].'</td>';
                                echo '<td>'.$ligne['datefin_res'].'</td>';
                                echo '<td>'.$ligne['num_chambre'].'</td>';
                                echo '<td>'.$ligne['nom_formule'].'</td>';
                                echo '</tr>';
                            }
                            echo '</table>';
                        }
                        else {
                            echo "Vous n'avez encore fait aucune réservation...";
                        }
                        echo '</div>';
                        
                    } else {
                        echo '<div class="contain_group">';
                        echo '<h3> Vous n\'avez rejoint aucun groupe....</h3>';
                        echo '</div>';
                        echo '<div class="contain_group">';
                        echo '<button>';
                        echo '<a href="./join_groupe.php">Rejoindre un groupe</a>';
                        echo '</button>';
                        echo '<button>';
                        echo '<a href="./creer_groupe.php">Créer un groupe</a>';
                        echo '</button>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="pref">
                <h3>Vos préférences</h3>
                <div class="in">
                    <h4>Décidez de votre niveau de préférence</h4>
                    <div class="contain_pref">
                        <?php
                        include('connexion.inc.php');
                        $id = $_SESSION["id"];
                        $requete = 'SELECT * FROM sae_preference WHERE num_client='.$id.';';
                        $resultat = $cnx->query($requete);
                        if ($resultat->rowCount() > 0) {
                            echo '<table>';
                            echo '<tr>';
                            echo '<th>Numéro du client</th>';
                            echo '<th>Code de préférence</th>';
                            echo '</tr>';
                            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>'.$ligne['num_client2'].'</td>';
                                echo '<td>'.$ligne['code_niveau_pref'].'</td>';
                                echo '</tr>';
                            }
                            echo '</table>';
                        }
                        else {
                            echo "Vous n'avez encore défini aucun code de préférence...";
                        }
                        ?>
                    </div>
                    <button>
                        <a href="./modifier_pref.php">Modifier</a>
                    </button>
                </div>
            </div>
    </section>

    <?php
    include("footer.inc.html");
    ?>
</body>

</html>