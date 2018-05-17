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

    $bdd = new PDO('mysql:host=localhost;dbname=nounou;charset=utf8', 'root', 'root');
    if (isset($_POST['submit']) && $_POST['submit'] !== '' && isset($_POST['pseudo']) && $_POST['pseudo'] !== '' && isset($_POST['mdp']) && $_POST['mdp'] !== '') {
        $erreur = [];
        $pseudo = secure_data($_POST['pseudo']);
        $mdp = secure_data($_POST['mdp']);
        $recuperation = "SELECT ID, mdp, nomdecompte FROM connexion WHERE nomdecompte='" . $pseudo . "'";
        $resultat = $bdd->query($recuperation);
        $resultat = $resultat->fetch(PDO::FETCH_ASSOC);
        if ($resultat !== false) {
            if (password_verify($mdp, $resultat['mdp'])) {
                $_SESSION['cle'] = $resultat['ID'];
                echo 'redirect';
            } else {
                array_push($erreur, 'Identifiant ou mot de passe incorrect');
            }
        } else {
            array_push($erreur, 'Identifiant ou mot de passe incorrect');
        }
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
                    <label for="pseudo">Votre pseudo :</label>
                    <input type="text" placeholder="Votre pseudo" name="pseudo" id="pseudo" class="form-control" value="<?php echo $_SESSION['pseudo']; ?>">
                </div>
                <div class="col-8 text-center">
                    <label for="mdp">Votre mot de passe :</label>
                    <input type="password" name="mdp" id="mdp" class="form-control">
                </div>
                <div class="col-12 text-center">
                    <input type="submit" name="submit" value="Je m'inscris" class="btn btn-primary">
                </div>
            </form>
            <?php
                foreach ($erreur as $elt) {
                    echo $elt;
                }
            ?>
        </div>
    </div>
</div>
</body>

</html>