<?php

try {
    session_start();
    $bddNounou = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');

    if (isset($_SESSION['cle']) && $_SESSION['cle'] !== '' && isset($_SESSION['statut']) && $_SESSION['statut'] === 'nounou' && $_POST['envoi'] !== '') {
        $insertion = "INSERT INTO planning(ID, date, heure, statut) VALUES ('" . $_SESSION['cle'] . "', '" .  $_POST['date'] . "', '" . $_POST['heure'] . "', 'libre')";
        $bddNounou->exec($insertion);
        header('Location: ../nounou/planning.php');
    } else if (isset($_SESSION['cle']) && $_SESSION['cle'] !== '' && isset($_SESSION['statut']) && $_SESSION['statut'] === 'parent' && $_POST['envoi'] !== '') {
        $ID = $_POST['IDnounou'];
        if ($_POST['langue'] !== "français") {
            $prix = 15 * $_POST['nbenfant'];
        } else {
            if($_POST['nbenfant'] === 1) {
                $prix = 7;
            } else {
                $prix = 4 * $_POST['nbenfant'] + 3;
            }
        }
        $update = "UPDATE planning SET statut='reserve', prix='" . $prix . "', client='" . $_SESSION['cle'] . "' WHERE ID='" . $ID ."' AND heure='" . $_POST['heure'] . "' AND date='" . $_POST['date'] . "'";
        $bddNounou->exec($update);
        header('Location: ../parent/profil-nounou.php?nounou=' . $_POST['IDnounou'] . '&langue=' . $_POST['langue'] . '&date=' . $_POST['date']);
    }

}  catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
