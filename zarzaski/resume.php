<?php
    session_start ();
    if (!isset($_SESSION['id'])) {
        header('Location: form.php');
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
    <link rel="stylesheet" href="./css/accueil.css" />
    <link rel="stylesheet" href="./css/resume.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Résumé de vos informations</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/ski.ico">
    <META NAME="Robots" CONTENT="index, follow">
    <META NAME="Author" CONTENT="COUTELLIER HOUANGKEO">
    <META NAME="Keywords" CONTENT="COUTELLIER HOUANGKEO Zarza-Ski">
</head>

<body>
    <?php
    include("header.inc.html");
    ?>

    <section class="secinfos" id="secinfos">
        <h1>Résumé de vos informations personnelles</h1>
        <div class="contain_contain">
        <div class="container_infos">
            <div class="infos">
                <h3>IDENTIFIANT : </h3>
                <?php
                echo $_SESSION['id'];
                ?>
            </div>
            <div class="infos">
                <span> | </span>
            </div>
            <div class="infos">
                <h3>MOT DE PASSE : </h3>
                <?php
                //echo $_SESSION['mdp'];
                $password_safe = htmlspecialchars($_SESSION['mdp'], ENT_QUOTES, 'UTF-8');
                echo $password_safe;
                ?>
            </div>
        </div>
        <div class="container_infos">
            <div class="infos">
                <h3>NOM : </h3>
                <?php
                echo $_SESSION['nom'];
                ?>
            </div>
            <div class="infos">
                <span> | </span>
            </div>
            <div class="infos">
                <h3>PRENOM : </h3>
                <?php
                echo $_SESSION['prenom'];
                ?>
            </div>
        </div>
        <div class="container_infos">
            <div class="infos">
                <h3>ADRESSE : </h3>
                <?php
                echo $_SESSION['adresse'];
                ?>
            </div>
        </div>
        <div class="container_infos">
            <div class="infos">
                <h3>DATE DE NAISSANCE : </h3>
                <?php
                echo $_SESSION['datenaissance'];
                ?>
            </div>
            <div class="infos">
                <span> | </span>
            </div>
            <div class="infos">
                <h3>TELEPHONE : </h3>
                <?php
                if(isset($_SESSION['tel'])) {
                    echo $_SESSION['tel'];
                }
                else {
                    echo "Non renseigné";
                }
                ?>
            </div>
        </div>
        <div class="container_infos">
            <div class="infos">
                <h3>NIVEAU : </h3>
                <?php
                if(isset($_SESSION['niveau'])) {
                    echo $_SESSION['niveau'];
                }
                else {
                    echo "Non renseigné";
                }
                ?>
            </div>
            <div class="infos">
                <span> | </span>
            </div>
            <div class="infos">
                <h3>TAILLE : </h3>
                <?php
                if(isset($_SESSION['taille'])) {
                    echo $_SESSION['taille'];
                }
                else {
                    echo "Non renseignée";
                }
                ?>
            </div>
        </div>
        <div class="container_infos">
            <div class="infos">
                <h3>POIDS : </h3>
                <?php
                if(isset($_SESSION['poids'])) {
                    echo $_SESSION['poids'];
                }
                else {
                    echo "Non renseigné";
                }
                ?>
            </div>
            <div class="infos">
                <span> | </span>
            </div>
            <div class="infos">
                <h3>POINTURE : </h3>
                <?php
                if(isset($_SESSION['pointure'])) {
                    echo $_SESSION['pointure'];
                }
                else {
                    echo "Non renseignée";
                }
                ?>
            </div>
        </div>
        </div>
    </section>

    <?php
    include("footer.inc.html");
    ?>
</body>

</html>