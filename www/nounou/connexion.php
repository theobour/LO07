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
        $recuperation = "SELECT ID, mdp, nomdecompte, statut FROM connexion WHERE nomdecompte='" . $pseudo . "'";
        $resultat = $bdd->query($recuperation);
        $resultat = $resultat->fetch(PDO::FETCH_ASSOC);
        if ($resultat !== false) {
            if (password_verify($mdp, $resultat['mdp'])) {
                if ($resultat['statut'] === 'nounou') {
                    $_SESSION['cle'] = $resultat['nomdecompte'];
                    header('Location: planning.html');
                } else {
                    $_SESSION['statut'] = $resultat['statut'];
                    header('Location: redirection-erreur.php');
                }
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
        <meta charset="UTF-8">
        <title>Connexion</title>
        <link rel="stylesheet" href="style.css" />
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <!-- fin bootstrap -->
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.html">Sitename</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Espace parent<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Espace nourrice</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">A propos</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page -->
        <header>
            <br />
            <h1 class="centrer">Connexion</h1><br/>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="">
                        <label for="pseudo">Votre pseudo :</label>
                        <div class="col-6">
                            <input type="text" placeholder="Votre pseudo" name="pseudo" id="pseudo" class="form-control"></div><br />
                        <label for="mdp">Votre mot de passe :</label>
                        <div class="col-6">
                            <input type="password" placeholder="Votre mot de passe" name="mdp" id="mdp" class="form-control">
                            <br /><br :></div>
                        <div class="row">
                            <input type="submit" name="submit" value="Je m'inscris" class="btn btn-primary" style="margin: auto;"></div>
                    </form>
                    <?php
                foreach ($erreur as $elt) {
                    echo $elt;
                }
            ?>
                </div>
            </div>
        </div><br />

        <!-- Footer -->
        <footer class="footer">
            <div class="centrer">
                <a href=""><span class="text-muted">Nous contacter</span></a>
            </div>
        </footer>

    </body>

    </html>
