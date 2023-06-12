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

        <form action="inscription.php" method="post">
            <table>
                <tr>
                    <td><label for="nom">NOM : </label></td>
                    <td><input type="text" name="nom" placeholder="COURTELLIER" pattern="[a-zA-ZÀ-ÿ\-]+" required /></td>
                </tr>
                <tr>
                    <td><label for="prenom">Prenom : </label></td>
                    <td><input type="text" name="prenom" placeholder="Lolo" pattern="[a-zA-ZÀ-ÿ\-]+" required /></td>
                </tr>
                <tr>
                    <td><label for="datenaissance">Date de naissance : </label></td>
                    <td><input type="date" name="datenaissance" required /></td>
                </tr>
                <tr>
                    <td><label for="adresse">Adresse : </label></td>
                    <td><input type="text" name="adresse" placeholder="3 rue des potiers, 86000 Poitiers" pattern="[a-zA-ZÀ-ÿ0-9\-,\s]+" required /></td>
                </tr>
                <tr>
                    <td><label for="tel">Téléphone : </label></td>
                    <td><input type="tel" name="tel" placeholder="0612345678" pattern="0[1-9][0-9]{8}" /></td>
                </tr>
                <tr>
                    <td><label for="mdp">Choisissez un mot de passe : </label></td>
                    <td><input type="text" name="mdp" placeholder="Mot de passe" required /></td>
                </tr>
                <tr>
                    <td id="supp">Souhaitez-vous donner vos informations de skieur maintenant ?</td>
                    <td id="radio">
                        <input type="radio" id="mnt" name="mnt" value="oui" required>
                        <label for="mnt">Oui</label>
                        <input type="radio" id="mnt" name="mnt" value="non">
                        <label for="mnt">Non</label>
                    </td>
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