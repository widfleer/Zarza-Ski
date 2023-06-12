<?php
session_start (); 
if (!isset($_POST['nouveau'])) {
    header('Location: ./modifier_infos_perso.php');
}else if (!isset($_SESSION['id'])) {
    header('Location: ./form.php');
}
$nouveau=$_POST['nouveau'];
$type=$_POST['type'];
include("connexion.inc.php");
if ($type=="nom_client" || $type=="prenom_client" || $type=="adresse_client") {
    if (strlen($nouveau)>0) {
        $requete="UPDATE sae_client SET ".$type."='".$nouveau."' WHERE num_client=".$_SESSION['id'].";";
        $resultat=$cnx->exec($requete);
        if ($type=="nom_client") {
            $_SESSION['nom']=$nouveau;
        }
        else if ($type=="prenom_client") {
            $_SESSION['prenom']=$nouveau;
        }
        else if ($type=="adresse_client") {
            $_SESSION['adresse']=$nouveau;
        }
    }
    else {
        header('Location: ./modifier_infos_perso.php');
    }
}else if ($type=="tel_client") {
    if ((preg_match("/^0[1-9]([-. ]?[0-9]{2}){4}$/", $nouveau)) && (strlen($nouveau)==10)) {
        $_SESSION['tel']=$nouveau;
        $requete="UPDATE sae_client SET ".$type."='".$nouveau."' WHERE num_client=".$_SESSION['id'].";";
        $resultat=$cnx->exec($requete);
    } else {
        header('Location: ./modifier_infos_perso.php');
    }
} else if ($type=="date_naissance_client") {
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $nouveau)) {
        $_SESSION['datenaissance']=$nouveau;
        $requete="UPDATE sae_client SET ".$type."='".$nouveau."' WHERE num_client=".$_SESSION['id'].";";
        $resultat=$cnx->exec($requete);
    } else {
        header('Location: ./modifier_infos_perso.php');
    }
} else if ($type=="niveau_client") {
    if($nouveau=="débutant" || $nouveau=="moyen" || $nouveau=="confirmé") {
        $_SESSION['niveau']=$nouveau;
        $requete="UPDATE sae_client SET ".$type."='".$nouveau."' WHERE num_client=".$_SESSION['id'].";";
        $resultat=$cnx->exec($requete);
    } else {
        header('Location: ./modifier_infos_perso.php');
    }
} else if ($type=="taille_client") {
    $nouveau=intval($nouveau);
    if($nouveau>=60 && $nouveau<=210) {
        $_SESSION['taille']=$nouveau;
        $requete="UPDATE sae_client SET ".$type."=".$nouveau." WHERE num_client=".$_SESSION['id'].";";
        $resultat=$cnx->exec($requete);
    } else {
        header('Location: ./modifier_infos_perso.php');
    }
}else if ($type=="poids_client") {
    $nouveau=intval($nouveau);
    if($nouveau>=3 && $nouveau<=150) {
        $_SESSION['poids']=$nouveau;
        $requete="UPDATE sae_client SET ".$type."=".$nouveau." WHERE num_client=".$_SESSION['id'].";";
        $resultat=$cnx->exec($requete);
    } else {
        header('Location: ./modifier_infos_perso.php');
    }
}else if ($type=="pointure_client") {
    $nouveau=intval($nouveau);
    if($nouveau>=16 && $nouveau<=52) {
        $_SESSION['pointure']=$nouveau;
        $requete="UPDATE sae_client SET ".$type."=".$nouveau." WHERE num_client=".$_SESSION['id'].";";
        $resultat=$cnx->exec($requete);
    } else {
        header('Location: ./modifier_infos_perso.php');
    }
}

header('Location: ./resume.php');
?>