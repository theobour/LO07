<?php
session_start();
try {
    function secure_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $bdd = new PDO('mysql:host=localhost;dbname=generique;charset=utf8', 'root', 'root');

    if($_SESSION['cle'] !== 0 && isset($_SESSION['cle'])) {
        if (isset($_POST['submitcandidat']) && $_POST['submitcandidat'] !== '') {
            $action = secure_data($_POST['submitcandidat']);
            $ndc = secure_data($_POST['nomdecompte']);
            if ($action === 'supprimer') {
                $suppression = "DELETE FROM connexion WHERE nomdecompte='" . $ndc . "'";
                $suppression2 = "DELETE FROM info WHERE ID='" . $ndc . "'";
                $bdd->exec($suppression);
                $bdd->exec($suppression2);

            } else if ($action === 'accepter') {
                $update = "UPDATE connexion SET statut='nounou' WHERE nomdecompte='" . $ndc . "'";
                $stmt = $bdd->prepare($update);
                $stmt->execute();
                //envoi mail si exec et si suppression
            }
        }

        if (isset($_POST['submitbloquer']) && $_POST['submitbloquer'] !== '') {
            $action = secure_data($_POST['submitbloquer']);
            $ndc = secure_data($_POST['nomdecompte']);
            if ($action === 'supprimer') {
                $suppression = "DELETE FROM connexion WHERE nomdecompte='" . $ndc . "'";
                $suppression2 = "DELETE FROM info WHERE ID='" . $ndc . "'";
                $bdd->exec($suppression);
                $bdd->exec($suppression2);

            } else if ($action === 'debloquer') {
                $update = "UPDATE connexion SET statut='nounou' WHERE nomdecompte='" . $ndc . "'";
                $stmt = $bdd->prepare($update);
                $stmt->execute();
                //envoi mail si exec et si suppression
            }
        }

        if (isset($_POST['submitnounou']) && $_POST['submitnounou'] !== '') {
            $action = secure_data($_POST['submitnounou']);
            $ndc = secure_data($_POST['nomdecompte']);
            if ($action === 'bloquer') {
                $update = "UPDATE connexion SET statut='bloque' WHERE nomdecompte='" . $ndc . "'";
                $stmt = $bdd->prepare($update);
                $stmt->execute();
                //envoi mail si exec et si suppression
            }
        }

        $recuperation = "SELECT nomdecompte FROM connexion WHERE statut='candidate'";
        $resultat = $bdd->query($recuperation);
        $resultatCandidate = $resultat->fetch(PDO::FETCH_ASSOC);

        $recuperation = "SELECT nomdecompte FROM connexion WHERE statut='bloque'";
        $resultat = $bdd->query($recuperation);
        $resultatBloque = $resultat->fetch(PDO::FETCH_ASSOC);

        $recuperation = "SELECT nomdecompte FROM connexion WHERE statut='nounou'";
        $resultat = $bdd->query($recuperation);
        $resultatNounou = $resultat->fetch(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
<a id="btn-logout" class="btn btn-danger" href="../generique-file/deconnexion.php">Déco</a>
<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <p>Nounou en attente de validation</p>
                </div>
            </div>
            <form method="post" action="">
                <?php
                foreach ($resultatCandidate as $elt) {
                    echo '<div class="row">';
                    echo '<div class="col-4">';
                    echo '<p>' . $elt . '</p>';
                    echo '</div>';
                    echo '<div class="col-4">';
                    echo '<input type="submit" class="btn btn-primary" name="submitcandidat" value="supprimer">';
                    echo '</div>';
                    echo '<div class="col-4">';
                    echo '<input type="submit" class="btn btn-primary" name="submitcandidat" value="accepter">';
                    echo '</div>';
                    echo '</div>';
                    echo '<input type="hidden" name="nomdecompte" value="' . $elt . '">';
                }
                ?>
            </form>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <p>Nounou bloqué</p>
                </div>
            </div>
            <form method="post" action="">
                <?php
                foreach ($resultatBloque as $elt) {
                    echo '<div class="row">';
                    echo '<div class="col-4">';
                    echo '<p>' . $elt . '</p>';
                    echo '</div>';
                    echo '<div class="col-4">';
                    echo '<input type="submit" class="btn btn-primary" name="submitbloquer" value="supprimer">';
                    echo '</div>';
                    echo '<div class="col-4">';
                    echo '<input type="submit" class="btn btn-primary" name="submitbloquer" value="debloquer">';
                    echo '</div>';
                    echo '</div>';
                    echo '<input type="hidden" name="nomdecompte" value="' . $elt . '">';
                }
                ?>
            </form>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <p>Nounou en activité</p>
                </div>
            </div>
            <form method="post" action="">
                <?php
                foreach ($resultatNounou as $elt) {
                    echo '<div class="row">';
                    echo '<div class="col-5">';
                    echo '<p>' . $elt . '</p>';
                    echo '</div>';
                    echo '<div class="col-5">';
                    echo '<input type="submit" class="btn btn-primary" name="submitnounou" value="bloquer">';
                    echo '</div>';
                    echo '</div>';
                    echo '<input type="hidden" name="nomdecompte" value="' . $elt . '">';
                }
                ?>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>

</html>
