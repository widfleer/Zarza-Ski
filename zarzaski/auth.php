<?php
session_start (); 


if (!isset($_POST['mdp']) || !isset($_POST['pseudo'])){
    echo "<p> Manque d'informations</p>";
    header('Location:./form.php');
}

else{

    $pseudo = $_POST['pseudo']; 
    $mdp = $_POST['mdp'];

    include ('connexion.inc.php');

    $requete = "SELECT * FROM sae_correspondance WHERE num_client = '".$pseudo."' AND mdp = md5('$mdp');" ;
    $resultat = $cnx->query($requete);

    $corres = $resultat->fetch(PDO::FETCH_ASSOC);
    $pseudo_res = $corres['num_client'];
    $titre = $corres['titre'];

    if ($pseudo_res == $pseudo){
        $_SESSION["id"] = $pseudo;
        $_SESSION["mdp"] = $mdp;
        $_SESSION["titre"] = $titre;

        $requete = "SELECT * FROM sae_client WHERE num_client = '".$pseudo."';";
        $resultat = $cnx->query($requete);
        $ligne = $resultat->fetch(PDO::FETCH_ASSOC);

        $_SESSION["nom"] = $ligne['nom_client'];
        $_SESSION["prenom"] = $ligne['prenom_client'];
        $_SESSION["datenaissance"] = $ligne['date_naissance_client'];
        $_SESSION["adresse"] = $ligne['adresse_client'];
        $_SESSION["tel"] = $ligne['tel_client'];
        $_SESSION["niveau"] = $ligne['niveau_client'];
        $_SESSION["taille"] = $ligne['taille_client'];
        $_SESSION["poids"] = $ligne['poids_client'];
        $_SESSION["pointure"] = $ligne['pointure_client'];
        $_SESSION["nom_groupe"] = $ligne['nom_groupe'];

        header('Location: ./resume.php');
        
    }
    else{
        include('./form.php');
        echo '<body onLoad="alert(\'Membre non reconnu...\')">';
    }

}
