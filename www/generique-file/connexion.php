<?php
//Erreurs masquées
ini_set("display_errors",0);error_reporting(0);

session_start();
//Le pseudo vérifier qu'il n'a pas été utilisé
//Le mail vérifier qu'il est correct
//Le mdp et l'email sont similaire


try {
    function secure_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $bdd = new PDO('mysql:host=localhost;dbname=generique;charset=utf8', 'root', '');
    if (isset($_SESSION['cle']) && $_SESSION['cle'] !== '' && isset($_SESSION['statut']) && $_SESSION['statut'] !== '') {
        if ($_SESSION['statut'] === 'nounou') { // nounou -> planning.html
            header('Location: ../nounou/planning.php');
        } else if($_SESSION['statut'] === 'bloque'){ // bloque -> page bloque
            header('Location: ../nounou/redirection-erreur.php');
        } else if($_SESSION['statut'] === 'candidate'){ // page candidate
            header('Location: ../nounou/redirection-erreur.php');
        } else if($_SESSION['statut'] === 'parent'){ // recherche candidate
            header('Location: ../parent/recherche-nounou.php');
        } else if($_SESSION['statut'] === 'adminsys'){ // Page de modération
            header('Location: ../adminsys/gestion-nounou.php');
        }
    }
    if (isset($_POST['submit']) && $_POST['submit'] !== '' && isset($_POST['pseudo']) && $_POST['pseudo'] !== '' && isset($_POST['mdp']) && $_POST['mdp'] !== '') {
        $erreur = [];
        $pseudo = secure_data($_POST['pseudo']);
        $mdp = secure_data($_POST['mdp']);
        $recuperation = "SELECT ID, mdp, nomdecompte, statut FROM connexion WHERE nomdecompte='" . $pseudo . "'";
        $resultat = $bdd->query($recuperation);
        $resultat = $resultat->fetch(PDO::FETCH_ASSOC);
        if ($resultat !== false) {
            if (password_verify($mdp, $resultat['mdp'])) { // On attribu clé ndc et statut
                if ($resultat['statut'] === 'nounou') { // nounou -> planning.html
                    $_SESSION['statut'] = $resultat['statut'];
                    $_SESSION['cle'] = $resultat['nomdecompte'];
                    header('Location: ../nounou/planning.php');
                } else if($resultat['statut'] === 'bloque'){ // bloque -> page bloque
                    $_SESSION['statut'] = $resultat['statut'];
                    $_SESSION['cle'] = $resultat['nomdecompte'];
                    header('Location: ../nounou/redirection-erreur.php');
                } else if($resultat['statut'] === 'candidate'){ // page candidate
                    $_SESSION['statut'] = $resultat['statut'];
                    $_SESSION['cle'] = $resultat['nomdecompte'];
                    header('Location: ../nounou/redirection-erreur.php');
                } else if($resultat['statut'] === 'parent'){ // recherche candidate
                    $_SESSION['statut'] = $resultat['statut'];
                    $_SESSION['cle'] = $resultat['nomdecompte'];
                    header('Location: ../parent/recherche-nounou.php');
                } else if($resultat['statut'] === 'adminsys'){ // Page de modération
                    $_SESSION['statut'] = $resultat['statut'];
                    $_SESSION['cle'] = $resultat['nomdecompte'];
                    header('Location: ../adminsys/gestion-nounou.php');
                }
            } else {
                array_push($erreur, 'Identifiant ou mot de passe incorrect');
            }
        } else {
            array_push($erreur, 'Identifiant ou mot de passe incorrect');
        }
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Connexion</title>
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
        <div style="padding-top: 100px;" class="container">
            <div class="col-12">
                <h1 class="text-center">Connexion</h1>
            </div>
            <form style="padding-top: 50px" method="post" action="">
                <div class="col-sm-6 offset-sm-3">
                    <label for="pseudo">Votre pseudo :</label>
                    <input type="text" placeholder="Votre pseudo" name="pseudo" id="pseudo" class="form-control">
                    <label style="padding-top: 20px" for="mdp">Votre mot de passe :</label>
                    <input type="password" name="mdp" id="mdp" class="form-control">
                </div>
                <div style="padding-top: 20px" class="col-12 text-center">
                    <input type="submit" name="submit" value="Je me connecte" class="btn btn-primary">
                </div>
            </form>
            <?php
                foreach ($erreur as $elt) {
                    echo $elt;
                }
            ?>
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
