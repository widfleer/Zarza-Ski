<!DOCTYPE html>
<!-- Doctype pour rester comforme aux standards -->
<!-- lang pour accent pour synthèse vocale-->
<html lang="fr">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" data-tag="font" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" data-tag="font" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" data-tag="font" />

<head>
    <!-- charset = encodage des caractères -->
    <meta charset="UTF-8" />
    <!-- viewport pour la mise en page mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link pour relier la feuille css -->
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/compte_gerant.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Compte Gérant</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/ski.ico">
    <META NAME="Robots" CONTENT="index, follow">
    <META NAME="Author" CONTENT="COUTELLIER HOUANGKEO">
    <META NAME="Keywords" CONTENT="COUTELLIER HOUANGKEO Zarza-Ski">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: ./form.php");
    }
    include("header.inc.html");
    ?>

    <section class="acc" id="acc">
        <h2>Votre profil</h2>
        <div class="container">
            <div class="wimg">
                <h3>Votre profil</h3>
                <div class="profil_block">
                    <a href="deco.php"><img src="./assets/deco.png"></a>
                </div>
            </div>
            <div class="profil_group">
                <div class="profil_block">
                    <button>
                        <a href="./resume.php">Vos informations</a>
                    </button>
                </div>
                <div class="profil_block">
                    <button>
                        <a href="./modifier_infos_perso.php">Modifier</a>
                    </button>
                </div>
            </div>
        </div>
        <h2>Zarza-Ski</h2>
        <div class="container">
            <div class="statistic_group">
                <div class="statistic_block">
                    <h3>Statistiques</h3>
                    <table>
                        <tr>
                            <th>Nombre de skieurs</th>
                            <th>Nombre de non skieurs</th>
                            <th>Ratio Skieurs/Non skieurs</th>
                            <th>Chiffre d'affaires (<?php echo date('Y') ?>)</th>
                        </tr>
                        <?php
                        include('connexion.inc.php');
                        //calcul du chiffre d'affaires
                        $ca = 0;
                        $annee = date('Y');
                        $requete = "SELECT * FROM sae_reservation WHERE EXTRACT(YEAR FROM datedebut_res)=" . $annee . ";";
                        $reservations_ca = $cnx->query($requete);
                        $nonskieur = $cnx->query("SELECT tarif_formule FROM sae_tarif_formule WHERE nom_formule ='non skieur' AND annee =" . $annee . ";");
                        $tarif_nonskieur = $nonskieur->fetchColumn();
                        $toutcompris = $cnx->query("SELECT tarif_formule FROM sae_tarif_formule WHERE nom_formule ='tout compris' AND annee =" . $annee . ";");
                        $tarif_toutcompris = $toutcompris->fetchColumn();
                        while ($res = $reservations_ca->fetch(PDO::FETCH_ASSOC)) {
                            $facture = 0; // on initialise la facture à 0

                            $requete = "SELECT * FROM sae_client WHERE nom_groupe='" . $res['nom_groupe'] . "';";
                            $personnes = $cnx->query($requete);

                            $dico_chambres = array();

                            while ($ligne = $personnes->fetch(PDO::FETCH_ASSOC)) {
                                $num = $ligne['num_client'];
                                $diff = date_diff(date_create($res['datedebut_res']), date_create($ligne['date_naissance_client']));
                                $age = intval($diff->format('%Y'));
                                $requete = "SELECT nom_formule FROM sae_achete WHERE num_client =" . $num . " AND num_res =" . $res['num_res'] . ";";
                                $form = $cnx->query($requete);
                                if ($form->rowCount() > 0) {
                                    $formule = $form->fetchColumn();

                                    if ($age >= 12) {
                                        if ($formule == "non skieur") {
                                            $facture += $tarif_nonskieur;
                                        } else if ($formule == "tout compris") {
                                            $facture += $tarif_toutcompris;
                                        }
                                    } else if ($age >= 2) {
                                        if ($formule == "non skieur") {
                                            $facture += $tarif_nonskieur * 0.8;
                                        } else if ($formule == "tout compris") {
                                            $facture += $tarif_toutcompris * 0.8;
                                        }
                                    }

                                    $requete = "SELECT num_chambre FROM sae_heberger WHERE num_client =" . $num . " AND num_res =" . $res['num_res'] . ";";
                                    $chambre = $cnx->query($requete);
                                    $num_chambre = $chambre->fetchColumn();

                                    if (!array_key_exists($num_chambre, $dico_chambres)) {
                                        // Ajout de la clé-valeur si elle n'existe pas
                                        if ($age < 2) {
                                            $dico_chambres[$num_chambre] = 0;
                                        } else {
                                            $dico_chambres[$num_chambre] = 1;
                                        }
                                    } else {
                                        // Incrémentation de la valeur si elle existe
                                        if ($age >= 2) {
                                            $dico_chambres[$num_chambre] += 1;
                                        }
                                    }
                                }
                            }
                            foreach ($dico_chambres as $chambre => $nb_personnes) {
                                $resultat = $cnx->query("SELECT nb_lits_chambre FROM sae_chambre WHERE num_chambre=" . $chambre . ";");
                                $lits_dispos = $resultat->fetchColumn();
                                $facture += ($lits_dispos - $nb_personnes) * 150;
                            }
                            $datefin = date_create($res['datefin_res']);
                            $interval = new DateInterval('P2D');
                            $datefin->add($interval);
                            $diff = date_diff(date_create($res['datedebut_res']), $datefin);
                            $diff_weeks = floor($diff->days / 7);
                            $ca += $facture * $diff_weeks;
                        }


                        $requete = 'SELECT skieurs, non_skieurs, ROUND((skieurs/non_skieurs),2) AS "Ratio Skieurs/Non skieurs" FROM nb_skieurs, nb_non_skieurs;';
                        $result = $cnx->query($requete);
                        $resultat = $result->fetch(PDO::FETCH_ASSOC);
                        echo '<tr>';
                        echo '<td>' . $resultat['skieurs'] . '</td>';
                        echo '<td>' . $resultat['non_skieurs'] . '</td>';
                        echo '<td>' . $resultat['Ratio Skieurs/Non skieurs'] . '</td>';
                        echo '<td>' . $ca . ' €</td>';
                        echo '</tr>';
                        ?>
                    </table>
                </div>
                <div class="statistic_block">
                    <h3>Chambres disponibles</h3>
                    <table>
                        <tr>
                            <th>Numéro de chambre</th>
                            <th>Etage</th>
                            <th>Batiment</th>
                            <th>Lits</th>
                            <th>Superficie</th>
                            <th>Balcon</th>
                            <th>Vue</th>
                        </tr>
                        <?php
                        include('connexion.inc.php');
                        $date = date('Y-m-d');
                        $requete = 'SELECT * FROM sae_chambre WHERE NOT EXISTS (SELECT * FROM sae_reservation WHERE EXISTS (SELECT * FROM sae_heberger WHERE sae_chambre.num_chambre=sae_heberger.num_chambre AND sae_heberger.num_res=sae_reservation.num_res AND datedebut_res<=\'' . $date . '\' AND datefin_res>=\'' . $date . '\'));';
                        $result = $cnx->query($requete);
                        while ($resultat = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $resultat['num_chambre'] . '</td>';
                            echo '<td>' . $resultat['etage_chambre'] . '</td>';
                            echo '<td>' . $resultat['batiment_chambre'] . '</td>';
                            echo '<td>' . $resultat['nb_lits_chambre'] . '</td>';
                            echo '<td>' . $resultat['superficie_chambre'] . '</td>';
                            $bool = ($resultat['balcon_chambre'] == 1) ? 'Oui' : 'Non';
                            echo '<td>' . $bool . '</td>';
                            echo '<td>' . $resultat['vue_chambre'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
                <div class="statistic_block">
                    <h3>Chambres qui n'ont jamais été réservées</h3>
                    <table>
                        <tr>
                            <th>Numéro de chambre</th>
                            <th>Etage</th>
                            <th>Batiment</th>
                        </tr>
                        <?php
                        include('connexion.inc.php');
                        $requete = 'SELECT * FROM sae_chambre WHERE NOT EXISTS (SELECT * FROM sae_client WHERE EXISTS (SELECT * FROM sae_heberger WHERE sae_heberger.num_chambre = sae_chambre.num_chambre AND sae_heberger.num_client = sae_client.num_client ) );';
                        $result = $cnx->query($requete);
                        if ($result->rowCount() > 0) {
                            while ($resultat = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>' . $resultat['num_chambre'] . '</td>';
                                echo '<td>' . $resultat['etage_chambre'] . '</td>';
                                echo '<td>' . $resultat['batiment_chambre'] . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr>';
                            echo '<td colspan="3">Toutes les chambres ont été réservées au moins une fois</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <h2>Liste des clients</h2>
        <div class="container" id="clients">
            <div class="clients_group">
                <div class="clients_block">
                    <?php
                    include('connexion.inc.php');
                    $id = $_SESSION["id"];
                    $requete = 'SELECT * FROM sae_client ORDER by nom_groupe, num_client;';
                    $resultat = $cnx->query($requete);
                    if ($resultat->rowCount() > 0) {
                        echo '<table>';
                        echo '<tr>';
                        echo '<th>Numéro</th>';
                        echo '<th>Nom</th>';
                        echo '<th>Prénom</th>';
                        echo '<th>Date de naissance</th>';
                        echo '<th>Adresse</th>';
                        echo '<th>Téléphone</th>';
                        echo '<th>Niveau</th>';
                        echo '<th>Taille</th>';
                        echo '<th>Poids</th>';
                        echo '<th>Pointure</th>';
                        echo '<th>Groupe</th>';
                        echo '</tr>';
                        while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $ligne['num_client'] . '</td>';
                            echo '<td>' . $ligne['nom_client'] . '</td>';
                            echo '<td>' . $ligne['prenom_client'] . '</td>';
                            echo '<td>' . $ligne['date_naissance_client'] . '</td>';
                            echo '<td>' . $ligne['adresse_client'] . '</td>';
                            echo '<td>' . $ligne['tel_client'] . '</td>';
                            echo '<td>' . $ligne['niveau_client'] . '</td>';
                            echo '<td>' . $ligne['taille_client'] . '</td>';
                            echo '<td>' . $ligne['poids_client'] . '</td>';
                            echo '<td>' . $ligne['pointure_client'] . '</td>';
                            echo '<td>' . $ligne['nom_groupe'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo "Il n'y a pas encore de clients :( ...";
                    }
                    ?>
                </div>
            </div>
        </div>
        <h2>Tarifs de l'année prochaine</h2>
        <div class="container">
            <h3>Définir/Modifier les tarifs de l'année prochaine</h3>
            <div class="tarif_group">
                <div class="tarif_block">
                    <form action="./changer_tarifs.php" method="post">
                        <table>
                            <tr>
                                <th>Formule</th>
                                <th>Tarif</th>
                            </tr>
                            <tr>
                                <?php
                                include('connexion.inc.php');
                                $annee_prochaine = date('Y', strtotime('+1 year'));
                                $requete1 = 'SELECT tarif_formule FROM sae_tarif_formule WHERE annee=' . $annee_prochaine . ' AND nom_formule=\'tout compris\';';
                                $resultat1 = $cnx->query($requete1);
                                $result1 = $resultat1->fetch(PDO::FETCH_ASSOC);
                                $result1 = $result1['tarif_formule'];
                                if ($resultat1->rowCount() == 0) {
                                    $result1 = 'Pas encore défini';
                                } else {
                                    $result1 = strval($result1) . ' €';
                                }
                                echo '<td>Tout compris (' . $result1 . ')</td>';
                                echo '<td><input type="number" name="tout_compris" id="tout_compris" step="10" min="0"></td>';
                                ?>
                            </tr>
                            <tr>
                                <?php
                                include('connexion.inc.php');
                                $annee_prochaine = date('Y', strtotime('+1 year'));
                                $requete1 = 'SELECT tarif_formule FROM sae_tarif_formule WHERE annee=' . $annee_prochaine . ' AND nom_formule=\'non skieur\';';
                                $resultat1 = $cnx->query($requete1);
                                $result1 = $resultat1->fetch(PDO::FETCH_ASSOC);
                                $result1 = $result1['tarif_formule'];
                                if ($resultat1->rowCount() == 0) {
                                    $result1 = 'Pas encore défini';
                                } else {
                                    $result1 = strval($result1) . ' €';
                                }
                                echo '<td>Non Skieur (' . $result1 . ')</td>';
                                echo '<td><input type="number" name="non_skieur" id="non_skieur" step="10" min="0"></td>';
                                ?>
                            </tr>
                        </table>
                        <input type="submit" value="Valider">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
    include("footer.inc.html");
    ?>
</body>

</html>