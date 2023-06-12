<?php
session_start (); 
if (!isset($_POST['num'])) {
    header('Location: ./gerer_groupe.php');
}else if (!isset($_SESSION['id'])) {
    header('Location: ./form.php');
}
else {
$num=$_POST['num'];

include("connexion.inc.php");

$requete = 'SELECT * FROM sae_achete WHERE num_client='.$num.';';
$resultat = $cnx->query($requete);
$result = $resultat->fetch(PDO::FETCH_ASSOC);
if ($resultat->rowCount() > 0) {
    header('Location: ./gerer_groupe.php');
}
else {
    $requete='UPDATE sae_client SET nom_groupe=NULL WHERE num_client='.$num.';';
}
$resultat = $cnx->exec($requete);
header('Location: ./gerer_groupe.php');
}
?>