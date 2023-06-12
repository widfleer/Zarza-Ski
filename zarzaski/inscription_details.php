<?php
    session_start (); 

    $_SESSION["niveau"] = $_POST['niveau'];
    $_SESSION["taille"] = $_POST['taille'];
    $_SESSION["poids"] = $_POST['poids'];
    $_SESSION["pointure"] = $_POST['pointure'];

    header('Location: ./insert.php');
?>