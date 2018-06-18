<?php
//Erreurs masquées
ini_set("display_errors",0);error_reporting(0); 

session_start();
try {
    $bddParent = new PDO('mysql:host=localhost;dbname=parent;charset=utf8', 'root', 'root');
    $bddNounou = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');
    if($_SESSION['cle'] !== 0 && isset($_SESSION['cle']) && $_SESSION['statut'] === 'parent' && isset($_SESSION['statut'])) {
        $recuperation = "SELECT * FROM planning WHERE client='" . $_SESSION['cle'] . "' AND statut='reserve'";
        $resultatReservation = $bddNounou->query($recuperation)->fetchAll();
        $note = array(0, 1, 2, 3, 4, 5);
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Réservation</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
        <link rel="stylesheet" href="../assets/tether/tether.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="../assets/dropdown/css/style.css">
        <link rel="stylesheet" href="../assets/socicon/css/styles.css">
        <link rel="stylesheet" href="../assets/theme/css/style.css">
        <link rel="icon" href="../images/enfant-excite.jpg" />
        <link rel="stylesheet" href="../assets/mobirise/css/mbr-additional.css" type="text/css">
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
                    <a class="navbar-caption text-white display-4" href="../index.html">
                        SuperNounou
                    </a>
                </span>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                        <li class="nav-item">
                            <a class="nav-link link text-white display-4" href="profil.php">
                        <span class="mbr-iconfont mbr-iconfont-btn"></span>
                        Profil
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white display-4" href="recherche-nounou.php">
                        <span class="mbr-iconfont mbr-iconfont-btn"></span>
                        Rechercher nourrice
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white display-4" href="apres-reservation.php">
                        <span class="mbr-iconfont mbr-iconfont-btn"></span>
                        Valider réservation
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white display-4" href="../generique-file/deconnexion.php">
                        <span class="mbr-iconfont mbr-iconfont-btn"></span>
                        Déconnexion
                    </a>
                        </li>
                    </ul>

                </div>
            </nav>
        </section>




        <!-- Contenu page -->
        <div style="padding-top: 100px; min-height: 470px" class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Mes reservations</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
        $jour = date ("d");
        $mois = date ("n");
        $annee = date ("Y");
        $dateDuJour = date_create($jour . '-' . $mois . '-' . $annee);
        $dateDuJour = date_format($dateDuJour, 'm/d/Y');
            foreach ($resultatReservation as $elt) {
                $arrayElt = explode('/', $elt['date']);
                $dateElt = date_create($arrayElt[0] . '/' . $arrayElt[1] . '/' . $arrayElt[2]);
                $dateElt = date_format($dateDuJour, 'm/d/Y');
                if ($dateElt < $dateDuJour) {
                    $recuperation = "SELECT * FROM info WHERE ID='" . $elt['ID'] . "'";
                    $resultatNounou = $bddNounou->query($recuperation)->fetch(PDO::FETCH_ASSOC);
                    echo '<form method="post" action="validation.php">';
                    echo '<div class="row element-nounou">';
                    echo '<input type="hidden" name="heure[]" value="' . $elt['heure'] . '">';
                    echo '<input type="hidden" name="date[]" value="' . $elt['date'] . '">';
                    echo '<input type="hidden" name="nomnounou[]" value="' . $elt['ID'] . '">';
                    echo '<input type="hidden" name="prix[]" value="' . $elt['prix'] . '">';
                    echo '<div class="col-12 text-center">';
                    echo '<p>Réservation du ' . $elt['date'] . ' à ' . $elt['heure'] . ' avec ' . $resultatNounou['prenom'] . ' ' . $resultatNounou['nom'];
                    echo '</div>';
                    echo '<div class="col-8 offset-2">';
                    echo '<label>Attribuer une note</label>';
                    echo '<select name="note[]" class="form-control">';
                    foreach ($note as $value) {
                        echo '<option value="' . $value . '">';
                        echo $value;
                        echo '</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="col-8 offset-2">';
                    echo '<label>Un commentaire ?</label>';
                    echo '<textarea name="avis[]" class="form-control"></textarea>';
                    echo '</div>';
                    echo '<div class="col-8 offset-2 text-center" style="margin-top: 15px;">';
                    echo '<input type="submit" class="btn btn-primary" value="Valider paiement">';
                    echo '</div>';
                    echo '</div>';
                    echo '<form>';
                }
            }
        ?>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <section once="" class="cid-qUi8DWmj62" id="footer7-9" style="margin-top: 20px;">
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
    </body>


    </html>
    <?php
    }
} catch (Exception $e) {
die('Erreur : ' . $e->getMessage());
}
?>
