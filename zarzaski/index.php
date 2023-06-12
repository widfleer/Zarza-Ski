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
    <link rel="stylesheet" href="./css/accueil.css" />
    <!-- Title pour le titre de l'onglet -->
    <title>Accueil</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/ski.ico">
    <META NAME="Robots" CONTENT="index, follow">
    <META NAME="Author" CONTENT="COUTELLIER HOUANGKEO">
    <META NAME="Keywords" CONTENT="COUTELLIER HOUANGKEO Zarza-Ski">
</head>

<body>
    <?php
    include("header.inc.html");
    ?>

    <section class="home" id="home">
        <div>
            <p>
                Des sommets de sensation pour une glisse inoubliable !
            </p>
            <h1>ZARZA-SKI</h1>
        </div>

        <button>
            <a href="reservation_gerant.php">Réserver</a>
        </button>
    </section>

    <section class="pres">
        <div class="container">
            <div class="block">
                <img src="./assets/image225218412413-ujl-200h.png">
                <h3>Séjour de rêve</h3>
                <p>96% de Staisfaction Client</p>
            </div>
            <div class="block">
                <img src="./assets/fluent_wallet-credit-card-16-regular.svg">
                <h3>Le Ski pour Tous</h3>
                <p>De la Qualité à bas Prix !</p>
            </div>
            <div class="block">
                <img src="./assets/ricustomerservice2line2413-z68.svg">
                <h3>Disponible 24/7</h3>
                <p>Assistance technique</p>
            </div>
        </div>
        <div class="container2">
            <div class="container22">
                <div class="container2ss">
                    <h2>Notre Galerie</h2>
                    <img src="./assets/unsplashsuzb9ioo3wg2413-ad26-500w.png">
                </div>
                <div class="container2ss">
                    <img src="./assets/unsplashxz9v9qswrds2413-bzag-600w.png">
                    <img src="./assets/unsplash8h7trklnhq2413-gepi-400h.png">
                </div>
            </div>
        </div>
    </section>

    <section class="avis" id="avis">
        <div class="liste_partenaires">
            <div class="partenaire p1"><img src="./assets/image412413-36kki-200h.png"></div>
            <div class="partenaire p2"><img src="./assets/image452413-bc-200h.png"></div>
            <div class="partenaire p3"><img src="./assets/image462413-176j-200w.png"></div>
            <div class="partenaire p4"><img src="./assets/image442413-ifs-200h.png"></div>
            <div class="partenaire p5"><img src="./assets/image432413-wer-200h.png"></div>
            <div class="partenaire p6"><img src="./assets/image422413-knqj-200h.png"></div>
        </div>
        <div class="pourquoi">
            <img src="./assets/unsplash1hhlebzy2kk2413-80sl-500w.png">
            <div>
            <h2>Pourquoi choisir Zarza-Ski ?</h2>
                <p>
                    C'est la Station préférée des français avec un taux de 96% de satisfaction sur plus de 25 millions de skieurs chaque année.
                </p>
            </div>
        </div>
        <div class="users">
            <table>
                <tr>
                    <th>Aristide DAVID</th>
                    <th>Ambre DUPONT</th>
                    <th>Célestin CHUPIN</th>
                </tr>
                <tr>
                    <td>Super découverte, moi et mes collègues avons adoré ! On y retourne l'année prochaine.</td>
                    <td>Première fois au ski pour les enfants, ils ont adoré la station, l'hébergement et les pistes. Mention honorable aux gérantes de l'hôtel : Loélia et Émeline !</td>
                    <td>Très bonne station, même pour skier seul. La chambre avec vue sur les pistes est sublime. On retrouve de la qualité malgré le faible prix !</td>
                </tr>
            </table>
        </div>
    </section>

    <section class="autres" id="autres">
        <div class="video">
            <div class="container3">
                <div class="container3ss">
                    <h2>Vidéo de la Station</h2>
                </div>
                <div class="container3ss">
                    <p>Parce qu'en images, c'est toujours mieux ! <br>
                    Découvrez les magnifiques paysages des Alpes avec Zarza-Ski.</p>
                </div>
            </div>

            <div class="extrait">
                <div class="rouge"><div class="triangle"></div></div>
            </div>
        </div>

        <div class="map">
            <div class="rond"></div>
            <div class="rond"></div>
            <div class="rond"></div>
            <div class="loca">
                <div class="ele">
                    <h3>Localisation de notre Station</h3>
                    <p>Avec Zarza-Ski, profitez des Alpes à 2 300 mètre d'altitude !</p>
                </div>
                <div class="ele">
                    <div class="eless">
                        <div class="interet">Intéressé ? N'attendez plus</div>
                        <a href="./choix_reser.php" ><div class="button">Réserver</div></a>
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