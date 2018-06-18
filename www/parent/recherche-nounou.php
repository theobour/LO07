<?php
//Erreurs masquées

    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');
    if (isset($_SESSION['cle'])) {
        // Récupération des langues et implémentation dynamique
        $langueArray = array();
        $recuperation = "SELECT * FROM langue";
        $resultat = $bdd->query($recuperation)->fetchAll();
        foreach ($resultat as $eltArray) {
            if(!in_array($eltArray['langue'], $langueArray)) {
                array_push($langueArray, $eltArray['langue']);
            }
        }
        $date = $_GET['date'];
        //$heure = $_GET['heure'];
        $langue = $_GET['langue'];
        if (isset($date) && $date !== '' && isset($langue) && $langue !== '') {
            // Si français
            if ($langue === 'français') {
                $recuperation = "SELECT * FROM planning WHERE date='" . $date . "' AND statut='libre'";
                $resultat = $bdd->query($recuperation)->fetchAll();
                $listeNounouFrancais = $resultat;
            } else {
                // On récupère les gens qui sont dispo
                // On récupère les ID des mecs qui parlent la langue qu'on stock dans un tableau
                // Dans foreach on requête pour chaque élément
                // on imbrique un foreach qui va prendre l'élément et traiter son nombre d'occurence
                $recuperation = "SELECT * FROM planning WHERE date='" . $date . "' AND statut='libre'";
                $resultatNounou = $bdd->query($recuperation)->fetchAll();

                $ensembleNounou = array('ID' => array(), 'heure' => array());
                foreach ($resultatNounou as $elt) {
                    $recuperation = "SELECT * FROM langue WHERE langue='" . $_GET['langue'] . "' AND ID='" .  $elt['ID'] ."'";
                    $resultat = $bdd->query($recuperation)->fetch(PDO::FETCH_ASSOC);
                    if (!empty($resultat)) {
                        array_push($ensembleNounou['ID'], $elt['ID']);
                        array_push($ensembleNounou['heure'], $elt['heure']);
                    }
                }
            }
        }

    }
?>
    <!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Recherche nourrice</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../style/style.css">
        <link rel="icon" href="../images/enfant-excite.jpg" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
        <link rel="stylesheet" href="../assets/tether/tether.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="../assets/dropdown/css/style.css">
        <link rel="stylesheet" href="../assets/socicon/css/styles.css">
        <link rel="stylesheet" href="../assets/theme/css/style.css">
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
        <div class="container" style="padding-top:100px">
            <h1 class="text-center">Recherche nourrices</h1>
            <div class="row">
                <div style="padding-top: 50px; padding-bottom: 50px" class="col-12">
                    <form method="get" action="">
                        <div class="row">
                            <div class="col-4">
                                <label>La date : (ex 23/6/2018)</label>
                                <input type="text" name="date" value="<?php echo $_GET['date'] ?>">
                            </div>
                            <div class="col-4">
                                <label>La langue parlé</label><br>
                                <select name="langue">
                            <option value="français">Français</option>
                            <?php
                            foreach ($langueArray as $elt) {
                                echo '<option value="' . $elt . '">';
                                echo $elt;
                                echo '</option>';
                            }
                            ?>
                        </select>
                            </div>
                            <div class="col-4">
                                <input type="submit" value="Envoyer" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <h2>La liste des nounou correspondant à votre recherche</h2>
            </div>
            <div style="min-height: 200px">
                <?php
               foreach ($listeNounouFrancais as $elt) {
                   $recuperation = "SELECT nom,prenom,sexe,age FROM info WHERE ID='" . $elt['ID'] . "'";
                   $resultat = $bdd->query($recuperation)->fetch(PDO::FETCH_ASSOC);
                   $output .= '<a href="profil-nounou.php?nounou=' . $elt['ID'] . '&date=' . $date . '&langue=' . $_GET['langue'] . '">';
                   $output .= '<div class="row element-nounou">';
                   $output .= '<div class="col-8">';
                   $output .= $resultat['nom'] . ' ' . $resultat['prenom'];
                   $output .= '<br>' . $resultat['sexe'] . '<br>' . $elt['heure'];
                   $output .= '</div><div class="col-2 offset-2">';
                   $output .= $resultat['age'] . ' ans';
                   $output .= '</div>';
                   $output .= '</div>';
                   $output .= '</a>';
               }
            foreach ($ensembleNounou['ID'] as $key => $elt) {
                $recuperation = "SELECT nom,prenom,sexe,age FROM info WHERE ID='" . $elt . "'";
                $resultat = $bdd->query($recuperation)->fetch(PDO::FETCH_ASSOC);
                $output .= '<a href="profil-nounou.php?nounou=' . $elt . '&date=' . $date . '&langue=' . $_GET['langue'] . '">';
                $output .= '<div class="row element-nounou">';
                $output .= '<div class="col-8">';
                $output .= $resultat['nom'] . ' ' . $resultat['prenom'];
                $output .= '<br>' . $resultat['sexe'] . '<br>' . $ensembleNounou['heure'][$key];
                $output .= '</div><div class="col-2 offset-2">';
                $output .= $resultat['age'] . ' ans';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</a>';
            }
               echo $output;
            ?>
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
    </body>

    </html>
