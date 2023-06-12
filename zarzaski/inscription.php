<?php
    session_start ();
    unset($_SESSION['tel']);
    unset($_SESSION['niveau']);
    $_SESSION["nom"] = $_POST['nom'];
    $_SESSION["prenom"] = $_POST['prenom'];
    $_SESSION["datenaissance"] = $_POST['datenaissance'];
    $_SESSION["adresse"] = $_POST['adresse'];
    $_SESSION["mdp"] = $_POST['mdp'];
    if (strlen($_POST['tel'])==10) {
        $_SESSION["tel"] = $_POST['tel'];
    }

    if ($_POST['mnt'] == "oui") {
        header('Location: ./inscription_2.php');
    }

    else {
        header('Location: ./insert.php');
    }

?>