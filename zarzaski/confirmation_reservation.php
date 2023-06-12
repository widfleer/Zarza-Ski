<?php
session_start();
if ((!isset($_SESSION['dateDepart'])) or (!isset($_SESSION['dateFin'])) or (!isset($_SESSION['nom_groupe']))) {
    echo '<body onLoad="alert(\'Non défini...\')">';
    header('Location: erreur_reservation.php');
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
    <link rel="stylesheet" href="./css/confirmation_reservation.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Réservation</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/ski.ico">
    <META NAME="Robots" CONTENT="index, follow">
    <META NAME="Author" CONTENT="COUTELLIER HOUANGKEO">
    <META NAME="Keywords" CONTENT="COUTELLIER HOUANGKEO Zarza-Ski">
</head>

<body>
    <?php
    include("header.inc.html");
    include("connexion.inc.php");
    ?>
    <section class="confirmation">
        <h1>Réservation confirmée !</h1>
        <div class="facture">
        <div class="recap">
            <p>En tant que chef de groupe, <?php echo $_SESSION['nom'].' '.$_SESSION['prenom']; ?>,</p>
            <p>Vous avez réservé pour le groupe <?php echo $_SESSION['nom_groupe']; ?> du <?php echo $_SESSION['dateDepart']; ?> au <?php echo $_SESSION['dateFin']; ?>.</p>
            <p>Le montant total de la facture pour le groupe est de : 
                <?php
                    echo $_SESSION['facture'];
                    $requete = 'SELECT nom_groupe, facture_chambre_semaine.dateDebut_res, SUM(facture) AS "facture" FROM facture_chambre_semaine LEFT JOIN Occupants_chambre_semaine ON Occupants_chambre_semaine.dateDebut_res=facture_chambre_semaine.dateDebut_res AND Occupants_chambre_semaine.num_chambre=facture_chambre_semaine.num_chambre WHERE nom_groupe='.$_SESSION['nom_groupe'].' GROUP BY nom_groupe, facture_chambre_semaine.dateDebut_res;';
                    //$resultat = $cnx->query($requete);
                    //$ligne = $resultat->fetch(PDO::FETCH_OBJ);
                    //echo $ligne->facture;
                ?> €</p>
        </div>
        <div class="choix">
            <a href="./index.php"><div class="lien" id="home">
                <img src="./assets/accueil.png" alt="icone_maison"><p>Revenir à l'accueil</p>
            </div></a>
            <a href="./choix_compte.php"><div class="lien" id="compte">
                <img src="./assets/compte.png" alt="icone_compte"><p>Accéder à mon compte</p>
            </div></a>
            <a href="./reservation.php"><div class="lien">
                <img id="modif" src="./assets/modifier.png" alt="icone_modifier"><p>Modifier les chambres/formules<br>(en réservant pour les mêmes dates)</p>
            </div></a>
        </div>
        </div>
        <button>
            <a href="index.php">Terminer</a>
        </button>
    </section>
    <?php
    include("footer.inc.html");
    ?>
</body>
</html>