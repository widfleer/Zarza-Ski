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
    <link rel="stylesheet" href="./css/form.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Connectez-vous</title>
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
        <h1>Connectez-vous</h1>

        <form action="auth.php" method="post">
            <table>
                <tr>
                    <td><label for="pseudo">Identifiant : </label></td>
                    <td><input type="text" name="pseudo" placeholder="100" required /></td>
                </tr>
                <tr>
                    <td><label for="mdp">Mot de passe : </label></td>
                    <td><input type="password" name="mdp" placeholder="admin123" required /></td>
                </tr>
            </table>
            <br />
            <div class="valid">
                <input type="reset" name="reset" value="Effacer" />
                <input type="submit" name="submit" value="Valider" />
            </div>
        </form>
        <hr />
        <div class="inscription">
            <p>Pas encore de compte ?</p>
            <button>
                <a href="forminscription.php">Créer mon compte</a>
            </button>
        </div>
    </section>
    <?php
    include("footer.inc.html");
    ?>

</body>

</html>