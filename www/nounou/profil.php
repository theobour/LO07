<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');

    if($_SESSION['cle'] !== 0 && isset($_SESSION['cle'])) {
        $recuperation = "SELECT * FROM info";
        $resultat = $bdd->query($recuperation);
        $resultat = $resultat->fetch(PDO::FETCH_ASSOC);
        echo '<table>';
        foreach ($resultat as $key => $value) {
            echo '<tr><td>';
            echo $key;
            echo '</td><td>';
            echo $value;
            echo '</td></tr>';
        }
        echo '</table>';

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

    </body>
</html>
