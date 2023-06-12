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
    <title>Réservation</title>
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
        <h1>Réservation</h1>
        <div class="rese">
            <?php
            if ($_SESSION["titre"]!="chef") {
                echo '<body onLoad="alert(\'Vous n\'êtes pas chef, vous ne pouvez pas réserver...\')">';
                header('Location: ./index.php');
            }
            ?>
            <p>Réservez dans notre station dès maintenant !</p>
            <form action="configuration_chambre.php" method="POST">
                <br>
                <label for="arrivee">Date d'arrivée</label>
                <select name="arrivee" id="arrivee">
                    <option value="">--Quand ?--</option>
                    <?php
                    $today = date('Y-m-d'); // Date du jour
                    $december = date('Y-m-d', strtotime('first Sunday of December')); // Premier dimanche de décembre
                    $april = date('Y-m-d', strtotime('last Sunday of April next year')); // Dernier dimanche d'avril
                    $date = $december;
                    while ($date <= $april) {
                        if ($date >= $today) { // Si la date est supérieure ou égale à la date du jour
                            echo '<option value="' . $date . '">' . $date . '</option>';
                        }
                        $date = date('Y-m-d', strtotime('+1 week', strtotime($date))); // On passe au dimanche suivant
                    }
                    ?>
                </select>
                <br>
                <br>
                <label for="duree">Durée du séjour</label>
                <select name="duree" id="duree">
                    <option value="">--Combien ?--</option>
                    <?php
                    for ($i = 1; $i<9;$i++ ){
                        echo '<option value="'.$i.'">'.$i.' semaine(s)</option>'; 
                    }
                    ?>
                </select>
                <br>
                <p>Groupe avec lequel vous partez : </p>
                <h3>
                <?php
                    echo $_SESSION["nom_groupe"];
                ?>    
                <h3>
                <div class="but">
                    <input class="button" type="submit" value="Réserver">
                </div>
            </form>
        </div>
    </section>

    <?php
    include("footer.inc.html");
    ?>
</body>

</html>