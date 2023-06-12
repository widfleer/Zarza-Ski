<?php
session_start();
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
    <link rel="stylesheet" href="./css/inscription.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Inscrivez-vous</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/ski.ico">
    <META NAME="Robots" CONTENT="index, follow">
    <META NAME="Author" CONTENT="COUTELLIER HOUANGKEO">
    <META NAME="Keywords" CONTENT="COUTELLIER HOUANGKEO Zarza-Ski">
</head>

<body>
    <?php
    include("header.inc.html");
    ?>

    <section class="connexion">
        <h1>Inscription</h1>

        <form action="inscription_details.php" method="post">
            <table>
                <tr>
                    <td><label for="niveau">Niveau en ski : </label></td>
                    <td>
                        <select name="niveau" id="niveau" required>
                            <option value="débutant">Débutant</option>
                            <option value="moyen">Moyen</option>
                            <option value="confirmé">Confirmé</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="taille">Taille (cm) : </label></td>
                    <td><input type="number" name="taille" placeholder="185" min="60" max="210" required /></td>
                </tr>
                <tr>
                    <td><label for="poids">Poids (kg) : </label></td>
                    <td><input type="number" name="poids" placeholder="80" min="3" max="150" required /></td>
                </tr>
                <tr>
                    <td><label for="pointure">Pointure : </label></td>
                    <td><input type="number" name="pointure" placeholder="43" min="16" max="52" required /></td>
                </tr>
            </table>
            <br />
            <div class="valid">
                <input type="reset" name="reset" value="Effacer" />
                <input type="submit" name="submit" value="Suivant" />
            </div>
        </form>
    </section>
    <?php
    include("footer.inc.html");
    ?>

</body>

</html>