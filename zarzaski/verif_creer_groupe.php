<?php
session_start (); 
if (!isset($_POST['nom'])) {
    header('Location: ./creer_groupe.php');
}else if (!isset($_SESSION['id'])) {
    header('Location: ./form.php');
}else if (isset($_SESSION['groupe'])) {
    header('Location: ./choix_compte.php');
}
else {
$nom=$_POST['nom'];

include("connexion.inc.php");

$requete = 'SELECT nom_groupe FROM sae_groupe WHERE nom_groupe=\''.$nom.'\';';
$resultat = $cnx->query($requete);
$result = $resultat->fetch(PDO::FETCH_ASSOC);
if ($resultat->rowCount() > 0) {
    echo '<body onLoad="alert(\'Ce nom est déjà pris...\')">';
}
else {
    $requete='INSERT INTO sae_groupe VALUES (\''.$nom.'\');';
    $resultat = $cnx->exec($requete);
    $requete='UPDATE sae_client SET nom_groupe=\''.$nom.'\' WHERE num_client='.$_SESSION['id'].';';
    $resultat = $cnx->exec($requete);
    $requete='UPDATE sae_correspondance SET titre=\'chef\' WHERE num_client='.$_SESSION['id'].';';
    $resultat = $cnx->exec($requete);
    $_SESSION['nom_groupe']=$nom;
    $_SESSION['titre']='chef';
    header('Location: ./compte_clients.php');
}
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
    <link rel="stylesheet" href="./css/modifier_infos_perso.css" />
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

    <section class="modifier" id="modifier">
        <h1>Erreur dans la création de votre groupe</h1>
        <div class="champs" style="margin: 0">
            <div class="champ">
                <p>Le nom de groupe est déjà pris.</p>
            </div>
        </div>
        <button>
            <a href="./creer_groupe.php">Choisir un autre nom</a>
        </button>
    </section>

    <?php
    include("footer.inc.html");
    ?>
</body>
</html>