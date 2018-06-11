<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');

    if($_SESSION['cle'] !== 0 && isset($_SESSION['cle']) && $_SESSION['statut'] === 'nounou' && isset($_SESSION['statut'])) {
        $recuperation = "SELECT * FROM info WHERE ID='" . $_SESSION['cle'] . "'";
        $resultat = $bdd->query($recuperation)->fetch(PDO::FETCH_ASSOC);

        $recuperation = "SELECT * FROM salaire WHERE ID='" . $_SESSION['cle'] . "'";
        $resultatSalaire = $bdd->query($recuperation)->fetch(PDO::FETCH_ASSOC);
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

                echo '--------------';
                echo 'salaire';
                echo 'Vous avez travaillé ' . $resultatSalaire['nbheure'] . 'h et vous avez gagné ' . $resultatSalaire['salaire'] . 'euros';
                ?>
            <input type="submit" name="modif" value="modifier">
        </form>
    <script src="../js/script.js" type="text/javascript"></script>
    </body>
</html>
