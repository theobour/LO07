<?php
session_start();
try {
    $bddParent = new PDO('mysql:host=localhost;dbname=parent;charset=utf8', 'root', 'root');
    $bddNounou = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');

    if($_SESSION['cle'] !== 0 && isset($_SESSION['cle']) && $_SESSION['statut'] === 'parent' && isset($_SESSION['statut'])) {
        $k = 0;
        for ($i = 0; $i < count($_POST['heure']); $i++) {
            if ($_POST['count'][$i] !== '') {
                $k = $i;
            }
        }
        $recuperation = "SELECT * FROM salaire WHERE ID='" . $_POST['nomnounou'][$k] . "'";
        $resultatReservation = $bddNounou->query($recuperation)->fetch(PDO::FETCH_ASSOC);
        // Si vide on crée une ligne pour son salaire
        if (empty($resultatReservation)) {
            $insertion = "INSERT INTO salaire (ID, salaire, nbheure) VALUES ('" . $_POST['nomnounou'][$k] . "', '" . $_POST['prix'][$k] . "', 1)";
            $bddNounou->exec($insertion);
        } else {
            $recuperation = "SELECT * FROM salaire WHERE ID='" . $_POST['nomnounou'][$k] . "'";
            $resultatSalaire = $bddNounou->query($recuperation)->fetch(PDO::FETCH_ASSOC);
            $salaire = $resultatSalaire['salaire'] + $_POST['prix'][$k];
            $heure = $resultatSalaire['heure'] + 1;
            echo 'go';
            $update = "UPDATE salaire SET salaire='" . $salaire ."', nbheure='" . $heure . "' WHERE ID='" . $_POST['nomnounou'][$k] . "'";
            $stmt = $bddNounou->prepare($update);
            $stmt->execute();
        }
        // On update le statut dans le planning
        $update = "UPDATE planning SET statut='paye' WHERE ID='" . $_POST['nomnounou'][$k] ."' AND date='" . $_POST['date'][$k] . "' AND heure='" . $_POST['heure'][$k] . "'";
        $stmt = $bddNounou->prepare($update);
        $stmt->execute();
        $insertion = "INSERT INTO avis (ID, note, avis, parent) VALUES ('" . $_POST['nomnounou'][$k] . "', '" . $_POST['note'][$k] . "', '" . $_POST['avis'][$k] . "', '" . $_SESSION['cle'] . "')";
        $bddNounou->exec($insertion);
        header('Location: apres-reservation.php');
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}