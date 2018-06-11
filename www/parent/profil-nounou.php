<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');
    $bddParent = new PDO('mysql:host=localhost;dbname=parent;charset=utf8', 'root', 'root');
    if (isset($_GET['nounou']) && $_GET['nounou'] !== '' && isset($_SESSION['cle']) && $_SESSION['cle'] !== '' && isset($_SESSION['statut']) && $_SESSION['statut'] === 'parent') {
        $recuperation = "SELECT * FROM info WHERE ID='" . $_GET['nounou'] . "'";
        $resultat = $bdd->query($recuperation)->fetch(PDO::FETCH_ASSOC);

        $recuperation = "SELECT * FROM planning WHERE ID='" . $_GET['nounou'] . "' AND statut='libre'";
        $resultatPlanning = $bdd->query($recuperation)->fetchAll();

        $recuperation = "SELECT enfant FROM info WHERE ID='" . $_SESSION['cle'] . "'";
        $nbEnfant = $bddParent->query($recuperation)->fetch(PDO::FETCH_ASSOC);

        $recuperation = "SELECT * FROM avis WHERE ID ='" . $_GET['nounou'] ."'";
        $resultatAvis = $bdd->query($recuperation)->fetchAll();
    }

}  catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<html>
<head>
    <title>Profil</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php
    echo '<table>';
    foreach ($resultat as $key => $value) {
        echo '<tr><td>';
        echo $key;
        echo '</td><td>';
        echo $value;
        echo '</td></tr>';
    }
    echo '</table>';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Ses créneeaux de dispo</h2>
            </div>
            <div class="col-12">
                <?php
                $dia = date ("d");
                $mes = date ("n");
                $ano = date ("Y");
                $date = $dia . '/' . $mes . '/' . $ano;
                foreach ($resultatPlanning as $elt) {
                    if ($elt['heure'] < $date){
                        $output .= '////// <br>';
                        $output .= $elt['heure'] . ' et ' . $elt['date'] . '<br>';
                        $output .= '//////';
                    }
                }
                echo $output;
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>avis</h2>
            </div>
            <div class="col-12">
                <?php
                foreach ($resultatAvis as $elt) {
                    echo 'Avis de : ' . $elt['parent'] . '<br>';
                    echo 'Note : ' . $elt['note'] . '<br>';
                    echo 'Avis : ' . $elt['avis'] . '<br>';
                    echo '-----------<br>';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>Réserver un créneau</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="post" action="../generique-file/ajout-horaire.php">
                    <div class="row">
                        <div class="col-8">
                            <label>Date de départ : (ex : 8/6/2018)</label>
                            <input type="text" name="date" class="form-control">
                        </div>
                        <div class="col-8">
                            <label>Heure : (ex: 11:00)</label>
                            <input type="text" name="heure" class="form-control">
                        </div>
                        <div class="col-8">
                            <select name="nbenfant">
                                <?php
                                for ($i = 0; $i <= $nbEnfant['enfant']; $i++) {

                                    echo '<option value="' . $i . '">';
                                    echo $i;
                                    echo '</option>';

                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="IDnounou" value="<?php echo $_GET['nounou']?>">
                        <div class="col-8" style="margin-bottom: 20px;">
                            <input type="submit" name="envoi" class="btn btn-primary" value="Envoyer">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="../js/script.js" type="text/javascript"></script>
</body>
</html>
