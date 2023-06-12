<?php
    session_start ();
    if (!isset($_SESSION["id"])){
        header('Location: ./form.php');
    }else{
        if(!isset($_SESSION["titre"])){
            header('Location: ./form.php');
        }
        else if ($_SESSION["titre"]=="gerant"){
            header('Location: ./reservation_gerant.php');
        }
        else if ($_SESSION["titre"]=="client"){
            header('Location: ./form.php');
        }
        else {
            header('Location: ./reservation.php');
        }
    }
?>