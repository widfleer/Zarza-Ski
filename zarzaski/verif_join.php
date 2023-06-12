<?php
session_start (); 
if (!isset($_POST['nom'])) {
    header('Location: ./join_groupe.php');
}else if (!isset($_SESSION['id'])) {
    header('Location: ./form.php');
}else if (isset($_SESSION['nom_groupe'])) {
    header('Location: ./choix_compte.php');
}
else {
$nom=$_POST['nom'];

include("connexion.inc.php");

$requete = 'UPDATE sae_client SET nom_groupe=\''.$nom.'\' WHERE num_client='.$_SESSION['id'].';';
$resultat = $cnx->exec($requete);
$_SESSION["nom_groupe"] = $nom;

header('Location: ./choix_compte.php');
}
?>