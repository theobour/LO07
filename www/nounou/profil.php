<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');

    if($_SESSION['cle'] !== 0 && isset($_SESSION['cle'])) {
        $recuperation = "SELECT * FROM info";
        $resultat = $bdd->query($recuperation);
        $resultat = $resultat->fetch(PDO::FETCH_ASSOC);
    }
    if ($_SESSION['cle'] !== 0 && isset($_SESSION['cle']) && $_POST['modif'] !== '' && isset($_POST['modif'])) {
        echo 'a';
        unset($_POST['modif']);
        $_POST['modif'] = '';
    }
} catch (Exception $e) {
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
    </head>
    <body>
        <form>
            <?php
                echo '<table>';
                foreach ($resultat as $key => $value) {
                    echo '<tr><td>';
                    echo $key;
                    echo '</td><td>';
                    echo $value;
                    echo '<button type="button" id="' . $key . '" onclick="modification(this.id)">Modifier</button>';
                    echo '<span id="' . $key . '1"></span>';
                    echo '</td></tr>';
                }
                echo '</table>';
                ?>
            <input type="submit" name="modif" value="modifier">
        </form>
    <script src="script.js" type="text/javascript"></script>
    </body>
</html>
