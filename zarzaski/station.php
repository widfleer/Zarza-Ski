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
    <link rel="stylesheet" href="./css/station.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>La Station</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/ski.ico">
    <META NAME="Robots" CONTENT="index, follow">
    <META NAME="Author" CONTENT="COUTELLIER HOUANGKEO">
    <META NAME="Keywords" CONTENT="COUTELLIER HOUANGKEO Zarza-Ski">
</head>

<body>
    <?php
    include("header.inc.html");
    ?>

    <section class="description" id="description">
        <h1>La station Zarza-Ski</h1>
        <div class="container">
            <div class="box fond">
                
            </div>
            <div class="box overlay">
                <h2>Description</h2>
                <p>
                    Envie de glisser sur des pistes enneigées comme un pingouin sur la banquise ? 
                    Venez découvrir Zarza-Ski, la station de ski où l'ennui n'a pas sa place ! 
                    Vous pourrez vous éclater sur nos pistes, dévaler les montagnes comme un vrai champion, ou encore vous détendre dans nos chalets chaleureux. 
                    Bref, Zarza-Ski, c'est la station de ski qu'il vous faut, alors ne restez pas sur la touche et rejoignez-nous pour des vacances inoubliables !
                </p>
                <button>
                    <a href="choix_reser.php">Réserver</a>
                </button>
            </div>
        </div>
    </section>

    <section class="formules" id="formules">
    <div class="container_formules">
            <h2>Découvrez nos meilleures chambres</h2>
            <div class="les_formules">
                <div class="formule">
                    <div class="image avalanche"></div>
                    <div class="contenu">
                        <h3>Chambre Avalanche</h3>
                        <div class="prices">
                            <?php 
                            include("connexion.inc.php");
                            $requete = "SELECT * FROM sae_chambre WHERE num_chambre = 2;";
                            $resultat = $cnx->query($requete);
                            $ligne = $resultat->fetch(PDO::FETCH_OBJ);
                            echo "<div class='details'>".$ligne->nb_lits_chambre." Pers.</div>";
                            echo "<div class='details'>·</div>";
                            echo "<div class='details'>".$ligne->superficie_chambre." m²</div>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="formule">
                    <div class="image pingouin"></div>
                    <div class="contenu">
                        <h3>Chambre Pingouin</h3>
                        <div class="prices">
                            <?php 
                            include("connexion.inc.php");
                            $requete = "SELECT * FROM sae_chambre WHERE num_chambre = 1;";
                            $resultat = $cnx->query($requete);
                            $ligne = $resultat->fetch(PDO::FETCH_OBJ);
                            echo "<div class='details'>".$ligne->nb_lits_chambre." Pers.</div>";
                            echo "<div class='details'>·</div>";
                            echo "<div class='details'>".$ligne->superficie_chambre." m²</div>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="formule">
                    <div class="image sapin"></div>
                    <div class="contenu">
                        <h3>Chambre Sapin</h3>
                        <div class="prices">
                            <?php 
                            include("connexion.inc.php");
                            $requete = "SELECT * FROM sae_chambre WHERE num_chambre = 3;";
                            $resultat = $cnx->query($requete);
                            $ligne = $resultat->fetch(PDO::FETCH_OBJ);
                            echo "<div class='details'>".$ligne->nb_lits_chambre." Pers.</div>";
                            echo "<div class='details'>·</div>";
                            echo "<div class='details'>".$ligne->superficie_chambre." m²</div>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <button>
                <a href="choix_reser.php">Réserver</a>
            </button>
        </div>
    </section>

    <section class="formules" id="formules">
        <div class="container_formules">
            <h2>Découvrez nos formules</h2>
            <div class="les_formules">
                <div class="formule">
                    <div class="image tout_compris"></div>
                    <div class="contenu">
                        <h3>Tout Compris</h3>
                        <?php
                        include("connexion.inc.php");
                        $requete = "SELECT * FROM sae_formule WHERE nom_formule = 'tout compris';";
                        $resultat = $cnx->query($requete);
                        $ligne = $resultat->fetch(PDO::FETCH_OBJ);
                        echo "<table>";
                        echo "<tr>";
                        echo "<td>Hébergement</td>";
                        $bool = ($ligne->hebergement == 't') ? 'Oui' : 'Non';
                        echo "<td>".$bool."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Restauration</td>";
                        $bool = ($ligne->restauration == 't') ? 'Oui' : 'Non';
                        echo "<td>".$bool."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Prêt Matériel</td>";
                        $bool = ($ligne->pret_materiel == 't') ? 'Oui' : 'Non';
                        echo "<td>".$bool."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Remontées Mécaniques</td>";
                        $bool = ($ligne->remontees_meca == 't') ? 'Oui' : 'Non';
                        echo "<td>".$bool."</td>";
                        echo "</tr>";
                        echo "</table>";
                        ?>
                        <div class="prices">
                            <?php
                            include("connexion.inc.php");
                            $annee = date('Y');
                            $requete = "SELECT tarif_formule FROM sae_tarif_formule WHERE nom_formule = 'tout compris' AND annee=".$annee.";";
                            $resultat = $cnx->query($requete);
                            $ligne = $resultat->fetch(PDO::FETCH_OBJ);
                            echo '<div class="ancien">';
                            echo ($ligne->tarif_formule)*1.05."€";
                            echo '</div>';
                            echo '<div class="nouveau">';
                            echo $ligne->tarif_formule."€";
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="formule">
                    <div class="image non_skieur"></div>
                    <div class="contenu">
                        <h3>Non skieur</h3>
                        <?php
                        include("connexion.inc.php");
                        $requete = "SELECT * FROM sae_formule WHERE nom_formule = 'non skieur';";
                        $resultat = $cnx->query($requete);
                        $ligne = $resultat->fetch(PDO::FETCH_OBJ);
                        echo "<table>";
                        echo "<tr>";
                        echo "<td>Hébergement</td>";
                        $bool = ($ligne->hebergement == 't') ? 'Oui' : 'Non';
                        echo "<td>".$bool."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Restauration</td>";
                        $bool = ($ligne->restauration == 't') ? 'Oui' : 'Non';
                        echo "<td>".$bool."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Prêt Matériel</td>";
                        $bool = ($ligne->pret_materiel == 't') ? 'Oui' : 'Non';
                        echo "<td>".$bool."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Remontées Mécaniques</td>";
                        $bool = ($ligne->remontees_meca == 't') ? 'Oui' : 'Non';
                        echo "<td>".$bool."</td>";
                        echo "</tr>";
                        echo "</table>";
                        ?>
                        <div class="prices">
                            <?php
                            include("connexion.inc.php");
                            $annee = date('Y');
                            $requete = "SELECT tarif_formule FROM sae_tarif_formule WHERE nom_formule = 'non skieur' AND annee=".$annee.";";
                            $resultat = $cnx->query($requete);
                            $ligne = $resultat->fetch(PDO::FETCH_OBJ);
                            echo '<div class="ancien">';
                            echo ($ligne->tarif_formule)*1.05."€";
                            echo '</div>';
                            echo '<div class="nouveau">';
                            echo $ligne->tarif_formule."€";
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include("footer.inc.html");
    ?>
</body>

</html>