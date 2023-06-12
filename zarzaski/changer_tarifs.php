<?php
session_start (); 

if (!isset($_SESSION['id'])){
    header('Location:./form.php');
}
else if ((!isset($_POST['tout_compris'])) && (!isset($_POST['non_skieur']))) {
    header('Location:./compte_gerant.php');
}
else{
    include ('connexion.inc.php');
    $annee_prochaine = date('Y', strtotime('+1 year'));
    if (isset($_POST['tout_compris'])) {
        $tout_compris = $_POST['tout_compris'];
        $requete = 'SELECT tarif_formule FROM sae_tarif_formule WHERE annee='.$annee_prochaine.' AND nom_formule=\'tout compris\';';
        $resultat = $cnx->query($requete);
        $result = $resultat->fetch(PDO::FETCH_ASSOC);
        if ($resultat->rowCount() > 0) {
            $requete='UPDATE sae_tarif_formule SET tarif_formule='.$tout_compris.' WHERE annee='.$annee_prochaine.' AND nom_formule=\'tout compris\';';
        }
        else {
            $requete='INSERT INTO sae_tarif_formule VALUES (\'tout compris\', '.$annee_prochaine.', '.$tout_compris.');';
        }
        $resultat = $cnx->exec($requete);
    }
    if (isset($_POST['non_skieur'])) {
        $non_skieur = $_POST['non_skieur'];
        $requete = 'SELECT tarif_formule FROM sae_tarif_formule WHERE annee='.$annee_prochaine.' AND nom_formule=\'non skieur\';';
        $resultat = $cnx->query($requete);
        $result = $resultat->fetch(PDO::FETCH_ASSOC);
        if ($resultat->rowCount() > 0) {
            $requete='UPDATE sae_tarif_formule SET tarif_formule='.$non_skieur.' WHERE annee='.$annee_prochaine.' AND nom_formule=\'non skieur\';';
        }
        else {
            $requete='INSERT INTO sae_tarif_formule VALUES (\'non skieur\', '.$annee_prochaine.', '.$non_skieur.');';
        }
        $resultat = $cnx->exec($requete);
    }
    header('Location:./compte_gerant.php');

}
