<?php
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', '');
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
                echo 'cas2';
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../style/style.css">
    </head>

    <body>
        <a id="btn-logout" class="btn btn-danger" href="../generique-file/deconnexion.php">Déco</a>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form method="get" action="">
                        <div class="row">
                            <div class="col-3">
                                <label>La date : (ex 23/6/2018)</label>
                                <input type="text" name="date">
                            </div>
                            <div class="col-3">
                                <label>A partir de : (ex 11:00)</label><br>
                                <input type="text" name="heure">
                            </div>
                            <div class="col-3">
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
                            <div class="col-3">
                                <input type="submit" value="Envoyer" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h1>La liste des nounou correspondant à votre recherche</h1>
                </div>
            </div>
            <?php
               foreach ($listeNounouFrancais as $elt) {
                   $recuperation = "SELECT nom,prenom,sexe,age FROM info WHERE ID='" . $elt['ID'] . "'";
                   $resultat = $bdd->query($recuperation)->fetch(PDO::FETCH_ASSOC);
                   $output .= '<a href="profil-nounou.php?nounou=' . $elt['ID'] . '&date=' . $date . '&heure=' . $heure . '">';
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
                print_r($resultat);
                $output .= '<a href="profil-nounou.php?nounou=' . $elt . '&date=' . $date . '&heure=' . $elt['heure'][$key] . '">';
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
    </body>

    </html>
