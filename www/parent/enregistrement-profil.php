<?php
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
    $erreur = [];
    echo $_SESSION['cle'];
    $bdd = new PDO('mysql:host=localhost;dbname=parent;charset=utf8', 'root', '');
    if (isset($_SESSION['cle']) && $_SESSION['cle'] !== '') {
        if (isset($_POST['nom']) && $_POST['nom'] !== '') {
            $nom = secure_data($_POST['nom']);
            $ville = secure_data($_POST['ville']);
            $telephone = secure_data($_POST['telephone']);
            $info = secure_data($_POST['info']);
            $nbenfant = secure_data($_POST['nbenfant']);
            echo $telephone;
            $update = "UPDATE info SET nom='" . $nom . "', telephone='" . $telephone . "', ville='" . $ville . "', enfant='" . $nbenfant . "', information='" . $info . "' WHERE ID='" . $_SESSION['cle'] . "'";
            $stmt = $bdd->prepare($update);
            $stmt->execute();
            // remplacer par foreach
            for ( $i = 0; $i < count($_POST['prenomenfant']); $i++) {
                $prenom = $_POST['prenomenfant'][$i];
                $age = $_POST['ageenfant'][$i];
                $information = $_POST['informationenfant'][$i];
                $sql = "INSERT INTO enfant (ID, prenom, age, information) VALUES ('" . $_SESSION['cle'] . "', '" . $prenom . "', '" . $age . "', '" . $information . "')";
                $bdd->exec($sql);
            }
            header('Location: merci.php');
        } else {
            array_push($erreur, 'Tout les champs doivent être rempli');
        }
    } else {
        array_push($erreur, 'Vous n\êtes pas connecté');
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Inscription</title>
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
        <div style="padding-top: 100px" class="container">
            <div class="row">
                <div style="padding-bottom: 50px" class="col-12">
                    <h1 class="text-center">Inscription</h1>
                </div>
                <div class="col-12">
                    <form method="post" action="">
                        <div class="col-sm-6 offset-sm-3 text-center">
                            <label for="mail2">Nom :</label>
                            <input type="text" placeholder="Votre nom" name="nom" id="mail2" class="form-control">

                            <label for="mdp">Votre ville :</label>
                            <input type="text" name="ville" id="mdp" class="form-control">

                            <label for="mdp">Votre téléphone :</label>
                            <input type="number" name="telephone" id="mdp" class="form-control">

                            <label for="mdp">Nombre d'enfant(s) :</label>

                            <div class="row">
                                <div style="padding-top:5px" class="col-8">
                                    <input style="padding-top: 5px" type="number" name="nbenfant" id="nbenfant" class="form-control">
                                </div>
                                <div class="col-4">
                                    <button type="button" id="btnajout" class="btn btn-primary">Go</button>
                                </div>
                                <span id="ajoutenfant"></span>
                            </div>

                        </div>
                        <div class="col-sm-6 offset-sm-3 text-center">
                            <label for="mdp2">Information générales :</label>
                            <textarea style="width:100%" name="info"></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <input type="submit" name="forminscription" value="Je m'inscris" class="btn btn-primary">
                        </div>
                    </form>
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
        <script src="../js/script.js"></script>
    </body>
    <!--<div class="col-8 text-center">
        <label for="mdp">Nb enfant :</label>
        <input type="text" name="nbenfant" id="nbenfant" class="form-control">
        <button type="button" id="btnajout" class="btn">Go</button>
        <span id="ajoutenfant"></span>
    </div>-->

    </html>
