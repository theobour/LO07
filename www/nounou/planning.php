<?php
//Erreurs masquées
ini_set("display_errors",0);error_reporting(0);

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');
if (isset($_SESSION['cle']) && $_SESSION['cle'] !== '' && isset($_SESSION['statut']) && $_SESSION['statut'] === 'nounou' && $_POST['envoi'] !== '') {
    ///////
}
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Planning</title>
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
            /* calendar */

            table.calendar {
                border-left: 1px solid #999;
            }

            tr.calendar-row {}

            td.calendar-day {
                min-height: 80px;
                font-size: 11px;
                position: relative;
            }

            * html div.calendar-day {
                height: 80px;
            }

            td.calendar-day:hover {
                background: #eceff5;
            }

            td.calendar-day-np {
                background: #eee;
                min-height: 80px;
            }

            * html div.calendar-day-np {
                height: 80px;
            }

            td.calendar-day-head {
                background: #ccc;
                font-weight: bold;
                text-align: center;
                width: 120px;
                padding: 5px;
                border-bottom: 1px solid #999;
                border-top: 1px solid #999;
                border-right: 1px solid #999;
            }

            div.day-number {
                background: #999;
                padding: 5px;
                color: #fff;
                font-weight: bold;
                float: right;
                margin: -5px -5px 0 0;
                width: 20px;
                text-align: center;
            }

            /* shared */

            td.calendar-day,
            td.calendar-day-np {
                width: 120px;
                padding: 5px;
                border-bottom: 1px solid #999;
                border-right: 1px solid #999;
            }

        </style>
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
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
                        <span class=" mbr-iconfont mbr-iconfont-btn"></span>
                        Profil
                    </a>
                        </li>
                        <li class="nav-item">
                            <a style="font-size: 16px" class="nav-link link text-white display-4" href="planning.php">
                        <span class="mbr-iconfont mbr-iconfont-btn"></span>
                        Planning
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
        <div class="container" style="padding-top: 100px; min-height: 470px">
            <div style="padding-bottom:30px" class="row">
                <div class="col-12 text-center">
                    <h1>Planning</h1>
                </div>
            </div>

            <form method="post" action="../generique-file/ajout-horaire.php">
                <div class="col-4 offset-4 text-center">
                    <label>Date de départ : (ex : 8/6/2018)</label>
                    <input type="text" name="date" class="form-control">
                    <label>Heure : (ex: 11:00)</label>
                    <input type="text" name="heure" class="form-control">
                    <input style="margin-top: 20px" type="submit" name="envoi" class="btn btn-primary" value="Envoyer">
                </div>
            </form>

            <div class="row">
                <div class="col-12" style="margin-bottom: 40px;">
                    <span id="calendrier1"></span>
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
        <script>
            function test() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("calendrier2").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "creation-planning.php?year=2018&month=5&type=week", true);
                xhttp.send();
            }
            addEventListener('load', function() {
                let today = new Date();
                let month = today.getMonth() + 1;
                let year = today.getFullYear();
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("calendrier1").innerHTML = this.responseText;
                    }
                };
                console.log(month);
                console.log(year);
                console.log(today);
                xhttp.open("GET", "creation-planning-semaine.php", true);
                xhttp.send();
            });

        </script>
    </body>

    </html>
