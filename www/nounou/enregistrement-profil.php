<?php
session_start();
//Le pseudo vérifier qu'il n'a pas été utilisé
//Le mail vérifier qu'il est correct
//Le mdp et l'email sont similaire


try {
    function secure_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $erreur = [];
    $bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');
        if (isset($_SESSION['cle']) && $_SESSION['cle'] !== '') {
            if (isset($_SESSION['cle']) && $_SESSION['cle'] !== '' && isset($_POST['nom']) && $_POST['nom'] !== '' && isset($_POST['prenom']) && $_POST['prenom'] !== '' && isset($_POST['nom']) && $_POST['nom'] !== '' && isset($_POST['sexe']) && $_POST['sexe'] !== '' && isset($_POST['age']) && $_POST['age'] !== '' && isset($_POST['nblangue']) && $_POST['nblangue'] !== '' && isset($_POST['ville']) && $_POST['ville'] !== '' && isset($_POST['portable']) && $_POST['portable'] !== '' && isset($_POST['presentation']) && $_POST['presentation'] !== '' && isset($_POST['experience']) && $_POST['experience'] !== '') {
                $nom = secure_data($_POST['nom']);
                $prenom = secure_data($_POST['prenom']);
                $sexe = secure_data($_POST['sexe']);
                $age = secure_data($_POST['age']);
                $nblangue = secure_data($_POST['nblangue']);
                $ville = secure_data($_POST['ville']);
                $portable = secure_data($_POST['portable']);
                $presentation = secure_data($_POST['presentation']);
                $experience = secure_data($_POST['experience']);
                $update = "UPDATE info SET nom = '" . $nom . "', prenom = '" . $prenom . "', sexe = '" . $sexe . "', age = '" . $age . "', nblangue = '" . $nblangue . "', ville = '" . $ville . "', portable = '" . $portable . "', presentation = '" . $presentation . "', experience = '" . $experience . "' WHERE ID='" . $_SESSION['cle'] . "'";
                $stmt = $bdd->prepare($update);
                $stmt->execute();
                /*
                for ( $i = 0; $i < count($_POST['langue']); $i++) {
                    $langue = $_POST['informationenfant'][$i];
                    $sql = "INSERT INTO langue (ID, langue) VALUES ('" . $_SESSION['cle'] . "', '" . $langue . "')";
                    $bdd->exec($sql);
                }
                */
                foreach ($_POST['langue'] as $elt) {
                    $elt = secure_data($elt);
                    $sql = "INSERT INTO langue (ID, langue) VALUES ('" . $_SESSION['cle'] . "', '" . $elt . "')";
                    $bdd->exec($sql);
                }
                header('Location: merci.php');
            } else {
                array_push($erreur, 'Tout les champs doivent être rempli');
            }
        } else {
            array_push($erreur, 'Vous n\êtes pas connecté');
        }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
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
            <form method="post" action="">
                <div class="col-8 text-center">
                    <label for="mail2">nom</label>
                    <input type="text" placeholder="Votre mail" name="nom" id="mail2" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mail">prenom</label>
                    <input type="text" placeholder="Votre mail" name="prenom" id="mail" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mdp2">sexe:</label>
                    <input type="radio" name="sexe" id="homme" class="form-control" value="homme"><label for="homme">homme</label>
                    <input type="radio" name="sexe" id="femme" class="form-control" value="femme"><label for="femme">femme</label>
                </div>
                <div class="col-8 text-center">
                    <label for="mdp2">Age :</label>
                    <input type="number" name="age" id="mdp2" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mdp">Nb langue :</label>
                    <input type="text" name="nblangue" id="nblangue" class="form-control">
                    <button type="button" id="btnajoutlangue" class="btn">Go</button>
                    <span id="ajoutlangue"></span>
                </div>
                <div class="col-8 text-center">
                    <label for="mdp">Votre ville :</label>
                    <input type="text" name="ville" id="mdp" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mdp2">Port :</label>
                    <input type="number" name="portable" id="mdp2" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mdp2">photo :</label>
                    <input type="file" name="photo" id="mdp2" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mdp2">presentation :</label>
                    <textarea name="presentation"></textarea>
                </div>
                <div class="col-8 text-center">
                    <label for="mdp2">exp :</label>
                    <textarea name="experience"></textarea>
                </div>
                <div class="col-12 text-center">
                    <input type="submit" name="forminscription" value="Je m'inscris" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/script.js"></script>
</body>

</html>