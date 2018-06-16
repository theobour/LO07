<?php
//Erreurs masquées
ini_set("display_errors",0);error_reporting(0);

session_start();
try {
    function secure_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $bdd = new PDO('mysql:host=localhost;dbname=generique;charset=utf8', 'root', '');

    if($_SESSION['cle'] !== 0 && isset($_SESSION['cle'])) {
        if (isset($_POST['submitcandidat']) && $_POST['submitcandidat'] !== '') {
            $action = secure_data($_POST['submitcandidat']);
            $ndc = secure_data($_POST['nomdecompte']);
            if ($action === 'NO') {
                $suppression = "DELETE FROM connexion WHERE nomdecompte='" . $ndc . "'";
                $suppression2 = "DELETE FROM info WHERE ID='" . $ndc . "'";
                $bdd->exec($suppression);
                $bdd->exec($suppression2);

            } else if ($action === 'OK') {
                $update = "UPDATE connexion SET statut='nounou' WHERE nomdecompte='" . $ndc . "'";
                $stmt = $bdd->prepare($update);
                $stmt->execute();
                //envoi mail si exec et si suppression
            }
        }

        if (isset($_POST['submitbloquer']) && $_POST['submitbloquer'] !== '') {
 $action = secure_data($_POST['submitbloquer']);
            $ndc = secure_data($_POST['nomdecompte']);
            if ($action === 'supprimer') {
                $suppression = "DELETE FROM connexion WHERE nomdecompte='" . $ndc . "'";
                $suppression2 = "DELETE FROM info WHERE ID='" . $ndc . "'";
                $bdd->exec($suppression);
                $bdd->exec($suppression2);

            } else if ($action === 'debloquer') {
                $update = "UPDATE connexion SET statut='nounou' WHERE nomdecompte='" . $ndc . "'";
                $stmt = $bdd->prepare($update);
                $stmt->execute();
                //envoi mail si exec et si suppression
            }
        }

        if (isset($_POST['submitnounou']) && $_POST['submitnounou'] !== '') {
            $action = secure_data($_POST['submitnounou']);
            $ndc = secure_data($_POST['nomdecompte']);
            if ($action === 'bloquer') {
                $update = "UPDATE connexion SET statut='bloque' WHERE nomdecompte='" . $ndc . "'";
                $stmt = $bdd->prepare($update);
                $stmt->execute();
                //envoi mail si exec et si suppression
            }
        }

        $recuperation = "SELECT nomdecompte FROM connexion WHERE statut='candidate'";
        $resultat = $bdd->query($recuperation);
        $resultatCandidate = $resultat->fetchAll();

        $recuperation = "SELECT nomdecompte FROM connexion WHERE statut='bloque'";
        $resultat = $bdd->query($recuperation);
        $resultatBloque = $resultat->fetchAll();

        $recuperation = "SELECT nomdecompte FROM connexion WHERE statut='nounou'";
        $resultat = $bdd->query($recuperation);
        $resultatNounou = $resultat->fetchAll();
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
    <!doctype html>
    <html>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <title>Gestion des nourrices</title>
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
                            <a class="nav-link link text-white display-4" href="gestion-nounou.php">
                        <span class=" mbr-iconfont mbr-iconfont-btn"></span>
                        Gestion des nourrices
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white display-4" href="gestion-salaire.php">
                        <span class="mbr-iconfont mbr-iconfont-btn"></span>
                        Gestion des salaires
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
        <div style="padding-top: 100px" class="container">
            <div style="padding-bottom: 50px" class="text-center col-12">
                <h1>Gestion des nourrices</h1>
            </div>
            <div class="row">
                <div class="text-center col-4">
                    <h5>Nourrices en attente de validation</h5>
                    <div style="min-height: 300px" class="row">
                        <form method="post" action="">
                            <?php
                            foreach ($resultatCandidate as $elt) {
                                echo '<div class="row">';
                                echo '<div class="col-12">';
                                echo '<p>' . $elt['nomdecompte'] . '</p>';
                                echo '</div>';
                                echo '<div class="col-6">';
                                echo '<input type="submit" class="btn btn-primary" name="submitcandidat" value="OK">';
                                echo '</div>';
                                echo '<div class="col-6">';
                                echo '<input type="submit" class="btn btn-secondary" name="submitcandidat" value="NO">';
                                echo '</div>';
                                echo '</div>';
                                echo '<input type="hidden" name="nomdecompte" value="' . $elt['nomdecompte'] . '">';
                            }
                            ?>
                        </form>
                    </div>
                </div>
                <div class="text-center col-4">
                    <div class="row">
                        <div class="col-12">
                            <h5>Nourrices bloquées</h5>
                        </div>
                    </div>
                    <div class="row">
                        <form method="post" action="">
                            <?php
                            foreach ($resultatBloque as $elt) {
                                echo '<div class="row">';
                                echo '<div class="col-12">';
                                echo '<p>' . $elt['nomdecompte'] . '</p>';
                                echo '</div>';
                                echo '<div class="col-6">';
                                echo '<input style="padding-left:20px; padding-right: 20px" type="submit" class="btn btn-secondary" name="submitbloquer" value="supprimer">';
                                echo '</div>';
                                echo '<div class="col-6">';
                                echo '<input style="padding-left:20px; padding-right: 20px" type="submit" class="btn btn-primary" name="submitbloquer" value="debloquer">';
                                echo '</div>';
                                echo '</div>';
                                echo '<input type="hidden" name="nomdecompte" value="' . $elt['nomdecompte'] . '">';
                            }
                            ?>
                        </form>
                    </div>
                </div>
                <div class="text-center col-4">

                    <h5>Nourrices en activité</h5>
                    <div class="col-12 text-center">
                        <form method="post" action="">
                            <?php
                            foreach ($resultatNounou as $elt) {
                                echo '<div class="row">';
                                echo '<div class="col-12">';
                                echo '<p>' . $elt['nomdecompte'] . '</p>';
                                echo '</div>';
                                echo '<div class="col-12">';
                                echo '<input type="submit" class="btn btn-secondary" name="submitnounou" value="bloquer">';
                                echo '</div>';
                                echo '</div>';
                                echo '<input type="hidden" name="nomdecompte" value="' . $elt['nomdecompte'] . '">';
                            }
                            ?>
                        </form>
                    </div>
                </div>
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
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    </body>

    </html>
