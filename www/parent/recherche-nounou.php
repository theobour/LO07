<?php
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');
    if (isset($_SESSION['cle'])) {
        // Récupération des langues et implémentation dynamique
        $langueArray = array();
        $recuperation = "SELECT * FROM langue";
        $resultat = $bdd->query($recuperation)->fetchAll();
        echo '<pre>';
        print_r($resultat);
        echo '</pre>';
        foreach ($resultat as $eltArray) {
            if(!in_array($eltArray['langue'], $langueArray)) {
                array_push($langueArray, $eltArray['langue']);
            }
        }
        $date = $_POST['date'];
        $heure = $_POST['heure'];
    }
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
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
                        <label>L'heure : (ex 11:00)</label>
                        <input type="text" name="heure">
                    </div>
                    <div class="col-3">
                        <label>Nombre d'enfant concerné :</label>
                        <input type="text" name="nbenfant">
                    </div>
                    <div class="col-3">
                        <select name="langue">
                            <?php
                            foreach ($langueArray as $elt) {
                                echo '<option value="$elt">';
                                echo $elt;
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>
