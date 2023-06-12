<?php
session_start (); 
if (!isset($_POST['num'])) {
    header('Location: ./modifier_pref.php');
}else if (!isset($_SESSION['id'])) {
    header('Location: ./form.php');
}
else {
$num=$_POST['num'];
$type=$_POST['code'];

include("connexion.inc.php");

$requete = 'SELECT code_niveau_pref FROM sae_preference WHERE num_client2='.$num.' AND num_client='.$_SESSION['id'].';';
$resultat = $cnx->query($requete);
$result = $resultat->fetch(PDO::FETCH_ASSOC);
if ($resultat->rowCount() > 0) {
    $requete='UPDATE sae_preference SET code_niveau_pref=\''.$type.'\' WHERE num_client='.$_SESSION['id'].' AND num_client2='.$num.';';
}
else {
    $requete='INSERT INTO sae_preference VALUES ('.$_SESSION['id'].', '.$num.', \''.$type.'\');';
}
$resultat = $cnx->exec($requete);
header('Location: ./compte_clients.php');
}
?>