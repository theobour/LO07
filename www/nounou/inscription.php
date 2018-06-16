<?php
//Erreurs masquées
ini_set("display_errors",0);error_reporting(0);

session_start();
//Le pseudo vérifier qu'il n'a pas été utilisé
//Le mail vérifier qu'il est correct
//Le mdp et l'email sont similaire

//password_hash()
//password_verify()

try {
    function secure_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', '');
    $bddGenerique = new PDO('mysql:host=localhost;dbname=generique;charset=utf8', 'root', '');
    // On vérifie l'envoie
    if (isset($_POST['submit'])) {
        //  On vérifie que les variables ont toutes été rentré
        if (isset($_POST['pseudo']) && $_POST['pseudo'] !== '' && isset($_POST['mail']) && $_POST['mail'] !== '' && isset($_POST['mail2']) && $_POST['mail2'] !== '' && isset($_POST['mdp']) && $_POST['mdp'] !== '' && isset($_POST['mdp2']) && $_POST['mdp2'] !== '') {
            $erreur = [];
            $pseudo = secure_data($_POST['pseudo']);
            $mail = secure_data($_POST['mail']);
            $mail2 = secure_data($_POST['mail2']);
            $mdp = secure_data($_POST['mdp']);
            $mdp2 = secure_data($_POST['mdp2']);
            // On vérifie l'égalité entre les mails
            if ($mail === $mail2) {
                // On vérifié l'égalité entre les mdp
                if ($mdp === $mdp2) {
                    // le Nom de compte éxiste dans la base générique ?
                    $recuperation = "SELECT nomdecompte FROM connexion WHERE nomdecompte='" . $pseudo . "'";
                    $resultat = $bddGenerique->query($recuperation);
                    $resultat = $resultat->fetch(PDO::FETCH_ASSOC);
                    if ($resultat === false) {
                        $recuperation = "SELECT email FROM connexion WHERE email='" . $mail . "'";
                        $resultat = $bddGenerique->query($recuperation);
                        $resultat = $resultat->fetch(PDO::FETCH_ASSOC);
                        // On vérifie si l'email n'est pas déjà existant
                        if ($resultat === false) {
                            $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                            $statut = "candidate";
                            $sql = "INSERT INTO connexion (nomdecompte, mdp, email,statut) VALUES ('"  . $pseudo . "', '" . $mdp . "', '" . $mail . "', '" . $statut . "')";
                            $sqlMail = "INSERT INTO info (ID, email) VALUES ('" . $pseudo . "', '" . $mail . "')";
                            if($bddGenerique->exec($sql) && $bdd->exec($sqlMail)) {
                                header('Location: enregistrement-profil.php');
                                $_SESSION['cle'] = $pseudo;
                                echo 'succes';
                            } else {
                                array_push($erreur, 'Un problème est survenu');
                            }
                        } else {
                            array_push($erreur, 'Cette email est déjà utilisé');
                        }
                    } else {
                        array_push($erreur, 'Ce nom de compte est déjà utilisé');
                    }
                } else {
                    array_push($erreur, "Vos mots de passe ne sont pas similaire");
                }
            } else {
                array_push($erreur, "Vos mails ne sont pas similaire");
            }
        } else {
            array_push($erreur, "Tout les champs n'ont pas été rempli");
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
                <div class="col-12">
                    <br />
                    <h1 class="text-center">Inscription</h1><br />
                </div>
                <div class="col-sm-6 offset-sm-3" style="padding-bottom: 20px">
                    <form method="post" action="">
                        <label for="pseudo">Votre pseudo :</label>
                        <input type="text" placeholder="Votre pseudo" name="pseudo" id="pseudo" class="form-control">

                        <label style="padding-top: 20px" for="mail">Votre mail</label>
                        <input type="email" placeholder="Votre mail" name="mail" id="mail" class="form-control">

                        <label style="padding-top: 20px" for="mail2">Confirmation du mail</label>
                        <input type="email" placeholder="Votre mail de nouveau" name="mail2" id="mail2" class="form-control">

                        <label style="padding-top: 20px" for="mdp">Votre mot de passe :</label>
                        <input type="password" name="mdp" id="mdp" class="form-control">

                        <label style="padding-top: 20px" for="mdp2">Confirmer votre mot de passe :</label>
                        <input type="password" name="mdp2" id="mdp2" class="form-control">
                        <br />
                        <div class="col-12 text-center">
                            <input type="submit" name="submit" value="Je m'inscris" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <?php
        foreach ($erreur as $elt) {
            echo $elt;
        }
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
