<?php
    session_start ();
    if (!isset($_SESSION["id"])){
        header('Location: ./form.php');
    }else{
        if(!isset($_SESSION["titre"])){
            header('Location: ./form.php');
        }
        else if ($_SESSION["titre"]=="gerant"){
            header('Location: ./compte_gerant.php');
        }
        else{
            header('Location: ./compte_clients.php');
        }
    }
?>