<?php
session_start();
//Le pseudo vérifier qu'il n'a pas été utilisé
//Le mail vérifier qu'il est correct
//Le mdp et l'email sont similaire

//password_hash()
//password_verify()

try {
    function secure_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $bdd = new PDO('mysql:host=localhost;dbname=parent;charset=utf8', 'root', 'root');
    $bddGenerique = new PDO('mysql:host=localhost;dbname=generique;charset=utf8', 'root', 'root');
    // On vérifie l'envoie
    if (isset($_POST['submit'])) {
        //  On vérifie que les variables ont toutes été rentré
        if (isset($_POST['pseudo']) && $_POST['pseudo'] !== '' && isset($_POST['mail']) && $_POST['mail'] !== '' && isset($_POST['mail2']) && $_POST['mail2'] !== '' && isset($_POST['mdp']) && $_POST['mdp'] !== '' && isset($_POST['mdp2']) && $_POST['mdp2'] !== '') {
            $erreur = [];
            $pseudo = secure_data($_POST['pseudo']);
            $mail = secure_data($_POST['mail']);
            $mail2 = secure_data($_POST['mail2']);
            $mdp = secure_data($_POST['mdp']);
            $mdp2 = secure_data($_POST['mdp2']);
            // On vérifie l'égalité entre les mails
            if ($mail === $mail2) {
                // On vérifié l'égalité entre les mdp
                if ($mdp === $mdp2) {
                    // le Nom de compte éxiste dans la base générique ?
                    $recuperation = "SELECT nomdecompte FROM connexion WHERE nomdecompte='" . $pseudo . "'";
                    $resultat = $bddGenerique->query($recuperation);
                    $resultat = $resultat->fetch(PDO::FETCH_ASSOC);
                    if ($resultat === false) {
                        $recuperation = "SELECT email FROM connexion WHERE email='" . $mail . "'";
                        $resultat = $bddGenerique->query($recuperation);
                        $resultat = $resultat->fetch(PDO::FETCH_ASSOC);
                        // On vérifie si l'email n'est pas déjà existant
                        if ($resultat === false) {
                            $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                            $statut = "parent";
                            $sql = "INSERT INTO connexion (nomdecompte, mdp, email,statut) VALUES ('"  . $pseudo . "', '" . $mdp . "', '" . $mail . "', '" . $statut . "')";
                            $sqlMail = "INSERT INTO info (ID, email) VALUES ('" . $pseudo . "', '" . $mail . "')";
                            if($bddGenerique->exec($sql) && $bdd->exec($sqlMail)) {
                                header('Location: enregistrement-profil.php');
                                $_SESSION['cle'] = $pseudo;
                                echo 'succes';
                            } else {
                                array_push($erreur, 'Un problème est survenu');
                            }
                        } else {
                            array_push($erreur, 'Cette email est déjà utilisé');
                        }
                    } else {
                        array_push($erreur, 'Ce nom de compte est déjà utilisé');
                    }
                } else {
                    array_push($erreur, "Vos mots de passe ne sont pas similaire");
                }
            } else {
                array_push($erreur, "Vos mails ne sont pas similaire");
            }
        } else {
            array_push($erreur, "Tout les champs n'ont pas été rempli");
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
                    <input type="text" placeholder="Votre pseudo" name="pseudo" id="pseudo" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mail">Votre mail</label>
                    <input type="email" placeholder="Votre mail" name="mail" id="mail" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mail2">Confirmation du mail</label>
                    <input type="email" placeholder="Votre mail" name="mail2" id="mail2" class="form-control">
                </div>
                <div class="col-8 text-center">
                    <label for="mdp">Votre mot de passe :</label>
                    <input type="password" name="mdp" id="mdp" class="form-control">
                </div>

                <div class="col-8 text-center">
                    <label for="mdp2">Confirmer votre mot de passe :</label>
                    <input type="password" name="mdp2" id="mdp2" class="form-control">
                </div>
                <div class="col-12 text-center">
                    <input type="submit" name="submit" value="Je m'inscris" class="btn btn-primary">
                </div>
            </form>
        </div>
        <?php
        foreach ($erreur as $elt) {
            echo $elt;
        }
        ?>
    </div>
</div>
</body>

</html>