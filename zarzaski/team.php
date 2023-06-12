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
    <link rel="stylesheet" href="./css/team.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>La Team</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/ski.ico">
    <META NAME="Robots" CONTENT="index, follow">
    <META NAME="Author" CONTENT="COUTELLIER HOUANGKEO">
    <META NAME="Keywords" CONTENT="COUTELLIER HOUANGKEO Zarza-Ski">
</head>

<body>
    <?php
    include("header.inc.html");
    ?>

    <section class="contact" id="contact">
        <h1>La Team</h1>
        <div class="team">
            <div class="team_block">
                COUTELLIER Loélia
            </div>
            <div class="team_block">
                <a href="https://github.com/widfleer"><img src="./assets/github.png" alt="Github Loélia" /></a>
            </div>
            <div class="team_block">
                <a href="mailto:loelia.coutellier@edu.univ-eiffel.fr"><img src="./assets/mail.png" alt="Mail Loélia" /></a>
            </div>
            <div class="team_block">
                <a href="https://www.linkedin.com/in/lo%C3%A9lia-coutellier-a13a89257/"><img src="./assets/linkedin.png" alt="LinkedIn Loélia" /></a>
            </div>
        </div>
        <div class="team">
            <div class="team_block">
                HOUANGKEO Emeline
            </div>
            <div class="team_block">
                <a href="https://github.com/Hyprra"><img src="./assets/github.png" alt="Github Emeline" /></a>
            </div>
            <div class="team_block">
                <a href="mailto:dieu-tien.houangkeo@edu.univ-eiffel.fr"><img src="./assets/mail.png" alt="Mail Emeline" /></a>
            </div>
            <div class="team_block">
                <a href="https://www.linkedin.com/in/emeline-houangkeo-5b8879266/"><img src="./assets/linkedin.png" alt="LinkedIn Emeline" /></a>
            </div>
        </div>
    </section>

    <?php
    include("footer.inc.html");
    ?>
</body>
</html>