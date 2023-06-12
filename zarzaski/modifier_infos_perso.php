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
    <link rel="stylesheet" href="./css/modifier_infos_perso.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Modifications de vos informations</title>
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
        <h1>Modifier vos informations</h1>
        <div class="champs">
            <div class="champ">
                <form action="./verif_modif_infos_perso.php" method="post">
                <label for="type">Champ à modifier</label><br>
                <select name="type" id="type">
                    <option value="nom_client">Nom</option>
                    <option value="prenom_client">Prénom</option>
                    <option value="date_naissance_client">Date de naissance (aaaa-mm-jj)</option>
                    <option value="adresse_client">Adresse</option>
                    <option value="tel_client">Téléphone</option>
                    <option value="niveau_client">Niveau ('débutant','moyen','confirmé')</option>
                    <option value="taille_client">Taille (de 60 à 210)</option>
                    <option value="poids_client">Poids (de 3 à 150)</option>
                    <option value="pointure_client">Pointure (de 16 à 52)</option>
                </select>
            </div>
            <div class="champ">
                <label for="nouveau">Nouvelle valeur</label>
                <input type="text" id="nouveau" name="nouveau" placeholder="Écrivez ici..." required />
            </div>
        </div>
        <input type="submit" name="submit" value="Modifier" />
        </form>
    </section>

    <?php
    include("footer.inc.html");
    ?>
</body>
</html>