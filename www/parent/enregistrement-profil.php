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
    echo $_SESSION['cle'];
    $bdd = new PDO('mysql:host=localhost;dbname=parent;charset=utf8', 'root', 'root');
    if (isset($_SESSION['cle']) && $_SESSION['cle'] !== '') {
        if (isset($_POST['nom']) && $_POST['nom'] !== '') {
            $nom = secure_data($_POST['nom']);
            $ville = secure_data($_POST['ville']);
            $telephone = secure_data($_POST['telephone']);
            $info = secure_data($_POST['info']);
            $nbenfant = secure_data($_POST['nbenfant']);
            echo $telephone;
            $update = "UPDATE info SET nom='" . $nom . "', telephone='" . $telephone . "', ville='" . $ville . "', enfant='" . $nbenfant . "', information='" . $info . "' WHERE ID='" . $_SESSION['cle'] . "'";
            $stmt = $bdd->prepare($update);
            $stmt->execute();
            for ( $i = 0; $i < count($_POST['prenomenfant']); $i++) {
                $prenom = $_POST['prenomenfant'][$i];
                $age = $_POST['ageenfant'][$i];
                $information = $_POST['informationenfant'][$i];
                $sql = "INSERT INTO enfant (ID, prenom, age, information) VALUES ('" . $_SESSION['cle'] . "', '" . $prenom . "', '" . $age . "', '" . $information . "')";
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
                    <label for="mail2">Nom :</label>
                    <input type="text" placeholder="Votre nom" name="nom" id="mail2" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mdp">Votre ville :</label>
                    <input type="text" name="ville" id="mdp" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mdp">Votre téléphone :</label>
                    <input type="text" name="telephone" id="mdp" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mdp">Nb enfant :</label>
                    <input type="text" name="nbenfant" id="nbenfant" class="form-control">
                    <button type="button" id="btnajout" class="btn">Go</button>
                    <span id="ajoutenfant"></span>
                </div>
                <div class="col-8 text-center">
                    <label for="mdp2">Infomration général :</label>
                    <textarea name="info"></textarea>
                </div>
                <div class="col-12 text-center">
                    <input type="submit" name="forminscription" value="Je m'inscris" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/script.js" type="text/javascript"></script>
</body>


</html>