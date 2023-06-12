<?php
    session_start ();
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
    <link rel="stylesheet" href="./css/reservation.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Erreur.</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/ski.ico">
    <META NAME="Robots" CONTENT="index, follow">
    <META NAME="Author" CONTENT="COUTELLIER HOUANGKEO">
    <META NAME="Keywords" CONTENT="COUTELLIER HOUANGKEO Zarza-Ski">
</head>

<body>
    <?php
    include("header.inc.html");
    ?>

    <section class="res" id="res">
        <h1>Erreur dans la réservation</h1>
        <div class="rese">
            <div class="rese">
                <h2>Une erreur s'est produite.</h2>
                <p>Votre réservation n'est pas valide.</p>
                <p>Vérifiez qu'il n'y a pas trop de personnes par chambre.</p>
                <p>Veuillez réeffectuer votre réservation.</p>
                <p>Si vous ne parvenez pas à réserver correctement, veuillez contacter le service client.</p>
            </div>
            <div class="but">
            <button>
                <a href="reservation.php">Réserver à nouveau</a>
            </button>
            </div>
        </div>
    </section>

    <?php
    include("footer.inc.html");
    ?>
</body>

</html>