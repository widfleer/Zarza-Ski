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
    <link rel="stylesheet" href="./css/contact.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Contact</title>
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
        <?php
        echo '<h1>Contactez nous ;)</h1>';
        ?>
        <div class="form">
        <form action="https://formspree.io/f/xlekzzjr" method="POST">
            <div class="form_group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" pattern="[a-zA-ZÀ-ÿ\-]+" placeholder="PHAM" required />
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" pattern="[a-zA-ZÀ-ÿ\-]+" placeholder="Khanh-Linh" required />
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="exemple@gmail.com" required />
            <label for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Bonjour, ..." required></textarea>
            </div>
            </div>
            <input type="submit" value="Envoyer" />
        </form>
        
    </section>

    <?php
    include("footer.inc.html");
    ?>
</body>
</html>