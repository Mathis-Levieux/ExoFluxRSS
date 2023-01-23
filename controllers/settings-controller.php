<?php

session_start(); // On démarre la session


if (!isset($_SESSION['user'])) {
    header('Location: login-view.php');
}



if (isset($_POST['theme'])) { // Si on détecte la méthode POST pour l'input "theme"
    setcookie($_SESSION['user']['nickname'] . 'theme', $_POST['theme'], time() + (86400 * 30), "/"); // 86400 = 1 jour // Alors on crée un cookie au nom "theme", qui aura pour valeur le contenu du $_POST['theme'], le '/' fait que le cookie sera là sur toutes les pages du domaine
    $theme = $_POST['theme']; // On crée une variable $theme, qui a pour valeur le thème choisi
    header('Location: settings-view.php'); // On redirige vers la page de paramètres
} elseif (isset($_COOKIE[$_SESSION['user']['nickname'] . 'theme'])) { // Sinon, si le cookie existe déjà
    $theme = $_COOKIE[$_SESSION['user']['nickname'] . 'theme']; // alors la variable prend pour valeur celle du cookie
} else {
    $theme = 'light'; // Sinon, le thème sera par défaut "light"
}

// Récupération des choix de l'utilisateur
if (isset($_POST['consolepref'])) {
    $consolepref = $_POST['consolepref'];
    // Stockage des choix dans un cookie
    setcookie($_SESSION['user']['nickname'] . 'consolepref', json_encode($consolepref), time() + (86400 * 30), "/");
    header('Location: settings-view.php');
} elseif (isset($_COOKIE[$_SESSION['user']['nickname'] . 'consolepref'])) {
    // Récupération des choix stockés dans le cookie
    $consolepref = json_decode($_COOKIE[$_SESSION['user']['nickname'] . 'consolepref'], true);
}
