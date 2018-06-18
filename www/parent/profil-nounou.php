<?php
//Erreurs masquées
ini_set("display_errors",0);error_reporting(0);

session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');
    $bddParent = new PDO('mysql:host=localhost;dbname=parent;charset=utf8', 'root', 'root');
    $bddGenerique = new PDO('mysql:host=localhost;dbname=generique;charset=utf8', 'root', 'root');
    if (isset($_GET['nounou']) && $_GET['nounou'] !== '' && isset($_SESSION['cle']) && $_SESSION['cle'] !== '' && isset($_SESSION['statut']) && $_SESSION['statut'] === 'parent') {
        $recuperation = "SELECT * FROM info WHERE ID='" . $_GET['nounou'] . "'";
        $resultat = $bdd->query($recuperation)->fetch(PDO::FETCH_ASSOC);

        $recuperation = "SELECT * FROM planning WHERE ID='" . $_GET['nounou'] . "' AND statut='libre' AND date='" . $_GET['date'] . "'";
        $resultatPlanning = $bdd->query($recuperation)->fetchAll();

        $recuperation = "SELECT enfant FROM info WHERE ID='" . $_SESSION['cle'] . "'";
        $nbEnfant = $bddParent->query($recuperation)->fetch(PDO::FETCH_ASSOC);

        $recuperation = "SELECT * FROM avis WHERE ID ='" . $_GET['nounou'] ."'";
        $resultatAvis = $bdd->query($recuperation)->fetchAll();

?>
    <html lang="fr">

    <head>
        <title>Profil de la nourrice</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
        <link rel="stylesheet" href="../assets/tether/tether.min.css">
        <link rel="icon" href="../images/enfant-excite.jpg" />
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="../assets/dropdown/css/style.css">
        <link rel="stylesheet" href="../assets/socicon/css/styles.css">
        <link rel="stylesheet" href="../assets/theme/css/style.css">
        <link rel="stylesheet" href="../assets/mobirise/css/mbr-additional.css" type="text/css">
        <style>
            table,
            th,
            td {
                border: 1px solid black;
                border-collapse: collapse;
            }

        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../style/style.css">
    </head>

    <body>
        <!-- Nav -->
        <section class="menu cid-qTkzRZLJNu" once="menu" id="menu1-0">
            <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
                <div class="menu-logo">
                    <div class="navbar-brand">
                        <span class="navbar-logo">
                    <a href="../index.html">
                         <img src="../images/logo3.png" alt="logo" style="height: 3.8rem;">
                    </a>
                    </span>
                        <span class="navbar-caption-wrap">
                    <a style="font-size: 16px" class="navbar-caption text-white display-4" href="../index.html">
                        SuperNounou
                    </a>
                </span>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                        <li class="nav-item">
                            <a style="font-size: 16px" class="nav-link link text-white display-4" href="profil.php">
                        <span class="mbr-iconfont mbr-iconfont-btn"></span>
                        Profil
                    </a>
                        </li>
                        <li class="nav-item">
                            <a style="font-size: 16px" class="nav-link link text-white display-4" href="recherche-nounou.php">
                        <span class="mbr-iconfont mbr-iconfont-btn"></span>
                        Rechercher nourrice
                    </a>
                        </li>
                        <li class="nav-item">
                            <a style="font-size: 16px" class="nav-link link text-white display-4" href="apres-reservation.php">
                        <span class="mbr-iconfont mbr-iconfont-btn"></span>
                        Valider réservation
                    </a>
                        </li>
                        <li class="nav-item">
                            <a style="font-size: 16px" class="nav-link link text-white display-4" href="../generique-file/deconnexion.php">
                        <span class="mbr-iconfont mbr-iconfont-btn"></span>
                        Déconnexion
                    </a>
                        </li>
                    </ul>

                </div>
            </nav>
        </section>



        <!-- Contenu page -->
        <div style="padding-top: 100px; padding-bottom: 20px" class="col-12 text-center">
            <h1>
                <?php echo $resultat['nom'] . ' ' . $resultat['prenom'] ;  ?>
            </h1>
        </div>
        <div class="container">
            <div class="col-sm-4 offset-sm-4">
                <?php
                echo '<img src="data:image/jpeg;base64,' . base64_encode($resultat['photo'] ) . '" height="200" width="200" class="img-thumnail" />';
                echo '<table>';
                    foreach ($resultat as $key => $value) {
                        if ($key !== "ID" && $key !== "photo") {
                            echo '<tr><td>';
                            echo $key;
                            echo '</td><td>';
                            echo $value;
                            echo '</td></tr>';
                        }
                    }
                    echo '</table>';
                ?>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Ses avis</h2>
                </div>
                <div style="min-height: 100px" class="col-12 text-center">
                    <p>
                    <?php
                    if(!empty($resultatAvis)) {
                        foreach ($resultatAvis as $elt) {
                            echo 'Avis de : ' . $elt['parent'] . '<br>';
                            echo 'Note : ' . $elt['note'] . '<br>';
                            echo 'Avis : ' . $elt['avis'] . '<br>';
                            echo '-----------<br>';
                        }
                    } else {
                        echo 'La personne n\'a pas encore d\'avis';
                    }
                ?>
                    </p>
                </div>
            </div>
            <div style="padding-top: 20px" class="row">
                <div class="col-12 text-center">
                    <h2>Ses créneaux de disponibilité</h2>
                </div>
                <div class="col-sm-4 offset-sm-4">
                    <?php
                    $dia = date ("d");
                    $mes = date ("n");
                    $ano = date ("Y");
                    $date = $dia . '/' . $mes . '/' . $ano;
                    foreach ($resultatPlanning as $elt) {
                        if ($elt['heure'] < $date){
                            $output .= $elt['heure'] . ' et ' . $elt['date'] . '<br>';
                            $output .= '------------------------<br>';
                        }
                    }
                    echo $output;
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Réserver un créneau</h2>
                </div>
            </div>
            <div class="col-sm-4 offset-sm-4 text-center">

                <form method="post" action="../generique-file/ajout-horaire.php">

                    <label>Date de départ : (ex : 8/6/2018)</label>
                    <input type="text" name="date" class="form-control">

                    <label>Heure : (ex: 11:00)</label>
                    <input type="text" name="heure" class="form-control">

                    <label style="padding-top: 5px">Nombre d'enfants : </label>
                    <select name="nbenfant">
                                <?php
                                for ($i = 0; $i <= $nbEnfant['enfant']; $i++) {

                                    echo '<option value="' . $i . '">';
                                    echo $i;
                                    echo '</option>';

                                }
                                ?>
                            </select>

                    <input type="hidden" name="IDnounou" value="<?php echo $_GET['nounou']?>">
                    <input type="hidden" name="langue" value="<?php echo $_GET['langue'] ?>">
                    <div class="col-12 text-center" style="margin-bottom: 20px;">
                        <input type="submit" name="envoi" class="btn btn-primary" value="Envoyer">
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <section once="" class="cid-qUi8DWmj62" id="footer7-9">
            <div class="container">
                <div class="media-container-row align-center mbr-white">
                    <div class="row row-links">
                        <ul class="foot-menu">
                            <li class="foot-menu-item mbr-fonts-style display-7">
                                <a class="text-white mbr-bold" href="#" target="_blank">About us</a>
                            </li>
                            <li class="foot-menu-item mbr-fonts-style display-7">
                                <a class="text-white mbr-bold" href="#" target="_blank">Services</a>
                            </li>
                            <li class="foot-menu-item mbr-fonts-style display-7">
                                <a class="text-white mbr-bold" href="#" target="_blank">Get In Touch</a>
                            </li>
                            <li class="foot-menu-item mbr-fonts-style display-7">
                                <a class="text-white mbr-bold" href="#" target="_blank">Careers</a>
                            </li>
                            <li class="foot-menu-item mbr-fonts-style display-7">
                                <a class="text-white mbr-bold" href="#" target="_blank">Work</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row social-row">
                        <div class="social-list align-right pb-2">
                            <div class="soc-item">
                                <a href="../index.html" target="_blank">
                            <span class="socicon-twitter socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                            </div>
                            <div class="soc-item">
                                <a href="../index.html" target="_blank">
                            <span class="socicon-facebook socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                            </div>
                            <div class="soc-item">
                                <a href="../index.html" target="_blank">
                            <span class="socicon-youtube socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                            </div>
                            <div class="soc-item">
                                <a href="../index.html" target="_blank">
                            <span class="socicon-instagram socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                            </div>
                            <div class="soc-item">
                                <a href="../index.html" target="_blank">
                            <span class="socicon-googleplus socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                            </div>
                            <div class="soc-item">
                                <a href="../index.html" target="_blank">
                            <span class="socicon-behance socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                            </div>
                        </div>
                    </div>
                    <div class="row row-copirayt">
                        <p class="mbr-text mb-0 mbr-fonts-style mbr-white align-center display-7">
                            © Copyright 2018 LMTB - All Rights Reserved
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Scripts -->
        <script src="assets/web/assets/jquery/jquery.min.js"></script>
        <script src="assets/popper/popper.min.js"></script>
        <script src="assets/tether/tether.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/smoothscroll/smooth-scroll.js"></script>
        <script src="assets/dropdown/js/script.min.js"></script>
        <script src="assets/parallax/jarallax.min.js"></script>
        <script src="assets/bootstrapcarouselswipe/bootstrap-carousel-swipe.js"></script>
        <script src="assets/mbr-testimonials-slider/mbr-testimonials-slider.js"></script>
        <script src="assets/mbr-clients-slider/mbr-clients-slider.js"></script>
        <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
        <script src="assets/theme/js/script.js"></script>
        <script src="../js/script.js" type="text/javascript"></script>
        <script src="../js/script.js" type="text/javascript"></script>
    </body>

    </html>
<?php
    }

}  catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>