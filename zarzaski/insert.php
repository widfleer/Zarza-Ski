<?php
    session_start ();

    include('connexion.inc.php');

    //calcul de l'id
    $requete = 'SELECT MAX(num_client) FROM sae_client;';
    $resultat=$cnx->query($requete);
    $res = $resultat->fetchColumn();
    $id = $res + 1;

    $_SESSION["id"] = $id;

    if (isset($_SESSION["tel"])) {
        if (isset($_SESSION["niveau"])) {
            $requete = 'INSERT INTO sae_client VALUES ('.$id.', \''.$_SESSION["nom"].'\', \''.$_SESSION["prenom"].'\', \''.$_SESSION["datenaissance"].'\', \''.$_SESSION["adresse"].'\', \''.$_SESSION["tel"].'\', \''.$_SESSION["niveau"].'\', '.$_SESSION["taille"].', '.$_SESSION["poids"].', '.$_SESSION["pointure"].', NULL);';
        }
        else {
            $requete = 'INSERT INTO sae_client VALUES ('.$id.', \''.$_SESSION["nom"].'\', \''.$_SESSION["prenom"].'\', \''.$_SESSION["datenaissance"].'\', \''.$_SESSION["adresse"].'\', \''.$_SESSION["tel"].'\', NULL, NULL, NULL, NULL, NULL);';
        }
    }
    else {
        if (isset($_SESSION["niveau"])) {
            $requete = 'INSERT INTO sae_client VALUES ('.$id.', \''.$_SESSION["nom"].'\', \''.$_SESSION["prenom"].'\', \''.$_SESSION["datenaissance"].'\', \''.$_SESSION["adresse"].'\', NULL, \''.$_SESSION["niveau"].'\', '.$_SESSION["taille"].', '.$_SESSION["poids"].', '.$_SESSION["pointure"].', NULL);';
        }
        else {
            $requete = 'INSERT INTO sae_client VALUES ('.$id.', \''.$_SESSION["nom"].'\', \''.$_SESSION["prenom"].'\', \''.$_SESSION["datenaissance"].'\', \''.$_SESSION["adresse"].'\', NULL, NULL, NULL, NULL, NULL, NULL);';
        }
    }

    $result=$cnx->exec($requete);

    $_SESSION["titre"] = "client";
    $requete= 'INSERT INTO sae_correspondance VALUES('.$id.',\''.$_SESSION["titre"].'\', MD5(\''.$_SESSION["mdp"].'\'));';
    $result=$cnx->exec($requete);

    header('Location: ./resume.php');
    
?>