<?php
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
    <title>Inscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
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