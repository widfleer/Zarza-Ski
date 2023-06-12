<?php

/*
 * création d'objet PDO de la connexion qui sera représenté par la variable $cnx
 */
$user = 'loelia.coutellier';
$pass = 'REDACTED';
try {
    $cnx = new PDO('pgsql:host=sqletud.u-pem.fr;dbname=loelia.coutellier_db',
    $user,
    $pass);

    // A COMPLETER  
}
catch (PDOException $e) {
    echo "ERREUR : La connexion a échouée";

 /* Utiliser l'instruction suivante pour afficher le détail de erreur sur la
 * page html. Attention c'est utile pour débugger mais cela affiche des
 * informations potentiellement confidentielles donc éviter de le faire pour un
 * site en production.*/
//    echo "Error: " . $e;

}

    $requete = 'SET search_path TO projet;';
    $result = $cnx -> exec($requete);

?>

