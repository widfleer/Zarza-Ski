<?php
session_start();
if (isset($_SESSION['dateDepart']) and isset($_SESSION['dateFin'])) {
    $dateDepart = $_SESSION['dateDepart'];
    $dateFin = $_SESSION['dateFin'];

    include("connexion.inc.php");


    $personnes = $cnx->query("SELECT * FROM sae_client WHERE nom_groupe='" . $_SESSION['nom_groupe'] . "';");
    $requete = $cnx->exec("begin;");
    $dateFin1 = date('Y-m-d', strtotime('-1 day', strtotime($dateFin)));
    echo $dateFin1;
    $dateDepart1 = date('Y-m-d', strtotime('+1 day', strtotime($dateDepart)));
    echo $dateDepart1;

    $sires = $cnx->query("SELECT num_res FROM sae_reservation WHERE nom_groupe='" . $_SESSION['nom_groupe'] . "' AND (datedebut_res BETWEEN '" . $dateDepart . "' AND '" . $dateFin1 . "') OR (datefin_res BETWEEN '" . $dateDepart1 . "' AND '" . $dateFin . "') OR (datedebut_res < '" . $dateDepart . "' AND datefin_res > '" . $dateFin . "');");
    $sires_res = $sires->fetchColumn();
    if (($sires->rowCount()) == 0) {
        //calcul du num de reservation
        $resultat = $cnx->query("SELECT MAX(num_res) FROM sae_reservation;");
        $num_reservation_max = $resultat->fetchColumn();
        $num_reservation = $num_reservation_max + 1;

        $reservation = $cnx->exec("INSERT INTO sae_reservation values (" . $num_reservation . ",'" . $dateDepart . " 11:00:00','" . $dateFin . " 10:00:00','" . $_SESSION['nom_groupe'] . "');");
    } else {
        $num_reservation = $sires_res;
        $requete = "UPDATE sae_reservation SET datedebut_res='" . $dateDepart . " 11:00:00', datefin_res='" . $dateFin . " 10:00:00' WHERE num_res=" . $num_reservation . ";";
        $cnx->exec($requete);
    }
    // dictionnaire des chambres et du nombre de personnes dedans
    $dico_chambres = array();

    $_SESSION['facture'] = 0; // on initialise la facture à 0

    $annee_depart = date('Y', strtotime($dateDepart));
    $nonskieur = $cnx->query("SELECT tarif_formule FROM sae_tarif_formule WHERE nom_formule ='non skieur' AND annee ='" . $annee_depart . "';");
    $tarif_nonskieur = $nonskieur->fetchColumn();
    $toutcompris = $cnx->query("SELECT tarif_formule FROM sae_tarif_formule WHERE nom_formule ='tout compris' AND annee ='" . $annee_depart . "';");
    $tarif_toutcompris = $toutcompris->fetchColumn();

    while ($ligne = $personnes->fetch(PDO::FETCH_ASSOC)) {
        $num = $ligne['num_client'];
        $diff = date_diff(date_create($dateDepart), date_create($ligne['date_naissance_client']));
        $age = intval($diff->format('%Y'));
        if ($age >= 12) {
            if ($_POST[$num . "_formule"] == "non skieur") {
                $_SESSION['facture'] += $tarif_nonskieur;
            } else if ($_POST[$num . "_formule"] == "tout compris") {
                $_SESSION['facture'] += $tarif_toutcompris;
            }
        } else if ($age >= 2) {
            if ($_POST[$num . "_formule"] == "non skieur") {
                $_SESSION['facture'] += $tarif_nonskieur * 0.8;
            } else if ($_POST[$num . "_formule"] == "tout compris") {
                $_SESSION['facture'] += $tarif_toutcompris * 0.8;
            }
        }

        $requete = 'SELECT * FROM sae_heberger WHERE num_client =' . $num . ' AND num_res =' . $num_reservation . 'FOR UPDATE;';
        $resultat = $cnx->query($requete);
        $requete1 = 'SELECT * FROM sae_achete WHERE num_client =' . $num . ' AND num_res =' . $num_reservation . 'FOR UPDATE;';
        $resultat1 = $cnx->query($requete1);

        if (!array_key_exists($_POST[$num . "_chambre"], $dico_chambres)) {
            // Ajout de la clé-valeur si elle n'existe pas
            if ($age < 2) {
                $dico_chambres[$_POST[$num . "_chambre"]] = 0;
            } else {
                $dico_chambres[$_POST[$num . "_chambre"]] = 1;
            }
        } else {
            // Incrémentation de la valeur si elle existe
            if ($age >= 2) {
                $dico_chambres[$_POST[$num . "_chambre"]] += 1;
            }
        }
        if (isset($_POST[$num . "_formule"]) and isset($_POST[$num . "_chambre"])) {
            if (($resultat->rowCount() > 0) && ($resultat1->rowCount() > 0)) {
                $update_formule = "UPDATE sae_heberger SET num_chambre=" . $_POST[$num . "_chambre"] . " WHERE num_client=" . $num . " AND num_res=" . $num_reservation . ";";
                $requete = $cnx->exec($update_formule);
                $update_chambre = "UPDATE sae_achete SET nom_formule='" . $_POST[$num . "_formule"] . "' WHERE num_client=" . $num . " AND num_res=" . $num_reservation . ";";
                $requete = $cnx->exec($update_chambre);
            } else {
                $insert_formule = "INSERT INTO sae_heberger VALUES(" . $num . ", " . $_POST[$num . "_chambre"] . ", " . $num_reservation . ");";
                $requete = $cnx->exec($insert_formule);
                $insert_chambre = "INSERT INTO sae_achete VALUES(" . $num . ", '" . $_POST[$num . "_formule"] . "', " . $num_reservation . ");";
                $requete = $cnx->exec($insert_chambre);
            }
        } else {
            $requete = $cnx->exec("rollback;");
            echo '<body onLoad="alert(\'Choisissez une chambre pour tous les membres du groupe !\')">';
            header('Location ./configuration_chambre.php');
        }
    }

    //verifier que chaque chambre n'a pas trop de personnes
    foreach ($dico_chambres as $chambre => $nb_personnes) {

        $resultat = $cnx->query("SELECT nb_lits_chambre FROM sae_chambre WHERE num_chambre=" . $chambre . ";");
        $lits_dispos = $resultat->fetchColumn();
        if ($lits_dispos < $nb_personnes) {
            $requete = $cnx->exec("rollback;");
            //echo '<body onLoad="alert(\'Trop de personnes dans la chambre ' . $chambre . ' !\')">';
            unset($_SESSION['dateDepart']);
            unset($_SESSION['dateFin']);
            header('Location: erreur_reservation.php');
        }
        $_SESSION['facture'] += ($lits_dispos - $nb_personnes) * 150;
    }

    $requete = "SELECT * FROM sae_heberger WHERE num_res=" . $num_reservation . ";";
    $del_chambres = $cnx->query($requete);

    while ($del_chambre = $del_chambres->fetch(PDO::FETCH_ASSOC)) {
        if (!array_key_exists($del_chambre['num_chambre'], $dico_chambres)) {
            $requete = "DELETE FROM sae_heberger WHERE num_res=" . $num_reservation . " AND num_chambre=" . $del_chambre['num_chambre'] . ";";
            $resultat = $cnx->exec($requete);
        }
    }

    $_SESSION['facture'] = $_SESSION['facture'] * $_SESSION['duree'];
    $requete = $cnx->exec("commit;");
    header('Location: confirmation_reservation.php');
} else {
    header('Location: ./reservation.php');
}
