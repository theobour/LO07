<?php

try {
    session_start();
    $bddNounou = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');

    if (isset($_SESSION['cle']) && $_SESSION['cle'] !== '' && isset($_SESSION['statut']) && $_SESSION['statut'] === 'adminsys') {
        $recuperation = "SELECT * FROM salaire";
        $resultat = $bddNounou->query($recuperation)->fetchAll();
    }

}  catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Inscription</h1>
        </div>
        <div class="col-12">
            <div class="row">
                <?php
                    foreach ($resultat as $elt) {
                    echo '<div class="col-12">';
                    echo '<p>';
                    echo 'La nourrice ' . $elt['ID'] . ' a travaillé ' . $elt['nbheure'] . 'h et a gagné ' . $elt['salaire'] . 'euros.';
                    echo '</p>';
                    echo '</div>';
                }
            ?>
            </div>

        </div>
    </div>
</div>
<script src="../js/script.js" type="text/javascript"></script>
</body>


</html>