<?php
session_start();
try {
    $bddParent = new PDO('mysql:host=localhost;dbname=parent;charset=utf8', 'root', 'root');
    $bddNounou = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', '');
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
                        <span class="mbr-iconfont mbr-iconfont-btn"></span>
                        Profil
                    </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white display-4" href="../index.html#parents">
                        <span class=" mbr-iconfont mbr-iconfont-btn"></span>
                        Recherche nourrice
                    </a>
                        </li>
                    </ul>

                </div>
            </nav>
        </section>




        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Mes reservations</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
        $dia = date ("d");
        $mes = date ("n");
        $ano = date ("Y");
        $dateDuJour = date_create($dia . '/' . $mes . '/' . $ano);
        $dateDuJour = date_format($dateDuJour, 'm/d/Y');
            foreach ($resultatReservation as $elt) {
                $arrayElt = explode('/', $elt['date']);
                $dateElt = date_create($arrayElt[0] . '/' . $arrayElt[1] . '/' . $arrayElt[2]);
                $dateElt = date_format($dateDuJour, 'm/d/Y');
                if ($dateElt < $dateDuJour) {
                    echo '<form method="post" action="validation.php">';
                    echo '<div class="row element-nounou">';
                    echo '<input type="hidden" name="heure[]" value="' . $elt['heure'] . '">';
                    echo '<input type="hidden" name="date[]" value="' . $elt['date'] . '">';
                    echo '<input type="hidden" name="nomnounou[]" value="' . $elt['ID'] . '">';
                    echo '<input type="hidden" name="prix[]" value="' . $elt['prix'] . '">';
                    echo '<div class="col-12 text-center">';
                    echo '<p>Réservation du ' . $elt['date'] . ' à ' . $elt['heure'] . ' avec ' . $elt['ID'];
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
        <script src="../js/script.js" type="text/javascript"></script>
    </body>


    </html>
    <?php
    }
} catch (Exception $e) {
die('Erreur : ' . $e->getMessage());
}
?>
