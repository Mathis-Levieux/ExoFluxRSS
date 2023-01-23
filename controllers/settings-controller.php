<?php

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login-view.php');
}



if (isset($_POST['theme'])) { // Si on détecte la méthode POST pour l'input "theme"
    setcookie($_SESSION['user']['nickname'] . 'theme', $_POST['theme'], time() + (86400 * 30), "/"); // 86400 = 1 jour // Alors on crée un cookie au nom "theme", qui aura pour valeur le contenu du $_POST['theme'], le '/' fait que le cookie sera là sur toutes les pages du domaine
    $theme = $_POST['theme']; // On crée une variable $theme, qui a pour valeur le thème choisi
} elseif (isset($_COOKIE[$_SESSION['user']['nickname'] . 'theme'])) { // Sinon, si le cookie existe déjà
    $theme = $_COOKIE[$_SESSION['user']['nickname'] . 'theme']; // alors la variable prend pour valeur celle du cookie
} else {
    $theme = 'light'; // Sinon, le thème sera par défaut "light"
}