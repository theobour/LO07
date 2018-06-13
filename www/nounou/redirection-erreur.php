<?php
//Erreurs masquées
ini_set("display_errors",0);error_reporting(0);

    session_start();
?>

    <html>

    <head>
        <title>Connexion impossible</title>
        <meta charset="utf-8">
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
                            <a class="nav-link link text-white display-4" href="../index.html#nos_services">
                        <span class="mbr-iconfont mbr-iconfont-btn"><img width="32px;" src="../images/home.png" /></span>
                        Nos Services
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white display-4" href="../index.html#parents">
                        <span class=" mbr-iconfont mbr-iconfont-btn"><img width="40px;" src="../images/parents.png" /></span>
                        Parents
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white display-4" href="../index.html#nourrices">
                        <span class="mbr-iconfont mbr-iconfont-btn"><img width="35px;" src="../images/baby-sitter.png" /></span>
                        Nourrices
                    </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </section>



        <!-- Contenu page -->
        <div class="container">
            <?php 
    if ($_SESSION['statut'] === 'bloque') {
    ?>

            <div style="margin-top: 100px; background-color: #F7D7DA; color: #A2787E; border-radius: 20px;" class="alert alert-danger" role="alert">
                <strong>Connexion impossible !</strong> Votre avez été bloqué(e) et allez donc être redirigé(e) vers la page d'accueil.
            </div>

            <?php
    } else if ($_SESSION['statut'] === 'candidate') { 
    ?>

                <div style="margin-top: 100px; background-color: #F7D7DA; color: #A2787E; border-radius: 20px;" class="alert alert-danger" role="alert">
                    <strong>Connexion impossible !</strong> Votre demande de création de compte n'a pas encore été étudiée. Nous procèderons à son étude le plus tôt possible.<br /> Vous allez être redirigé(e) vers la page d'accueil.
                </div>
                <?php
        } 
            echo '</div>';
        unset($_SESSION['statut']);
        ?>

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
