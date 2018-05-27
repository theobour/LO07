<?php
    session_start();
    if ($_SESSION['statut'] === 'bloque') {
        echo "Vous êtes bloqué, vous allez être redirigé vers la page d'accueil";
        header("refresh:5;url=../index.html");
    } else if ($_SESSION['statut'] === 'candidate') {
        echo "Vous êtes en attente de validation, vous allez être redirigé vers la page d'accueil";
        header("refresh:5;url=../index.html");
    }
    unset($_SESSION['statut']);
?>