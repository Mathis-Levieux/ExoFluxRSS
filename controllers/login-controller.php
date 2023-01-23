<?php
session_start(); // On démarre la session


// Cookie thème
if (isset($_COOKIE[$_SESSION['user']['nickname'] . 'theme'])) {
    $theme = $_COOKIE[$_SESSION['user']['nickname'] . 'theme'];
} else {
    $theme = 'light';
}

// Cookie thème
if (isset($_COOKIE[$_SESSION['user']['nickname'] . 'theme'])) {
    $theme = $_COOKIE[$_SESSION['user']['nickname'] . 'theme'];
} else {
    $theme = 'light';
}


// Récupération du JSON des utilisateurs, et décodage en tableau PHP
$file = '../assets/datas/users.json';
$data = file_get_contents($file);
$usersArray = json_decode($data, true);
$users = $usersArray['users'];

$arrayErrors = []; // Tableau d'erreurs

// Si le formulaire est envoyé, on vérifie les champs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification du pseudo
    if (isset($_POST['nickname'])) {
        $nickname = $_POST['nickname'];
    }
    if (empty($nickname)) { // Si le pseudo est vide, on envoie une erreur
        $arrayErrors['nickname'] = "Pseudo requis";
    }

    // Vérification du mot de passe
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if (empty($password)) { // Si le mot de passe est vide, on envoie une erreur
        $arrayErrors['password'] = "Mot de passe requis";
    }

    // Si le tableau d'erreurs est vide, on déclenche la vérification du login
    if (empty($arrayErrors)) {
        foreach ($users as $key => $value) { // On parcourt le tableau des utilisateurs

            $userpassword = $value['password'];
            $usernickname = $value['nickname'];


            if ($usernickname === $nickname) { // Si le pseudo est correct, on vérifie le mot de passe
                if (password_verify($password, $userpassword)) { // Si le mot de passe est correct, on démarre la session
                    $_SESSION['user'] = [
                        'nickname' => $usernickname
                    ];
                    header('Location: home-view.php'); // Redirection vers la page d'accueil
                } else { // Si le mot de passe est incorrect, on envoie une erreur
                    $arrayErrors['password'] = "Mot de passe incorrect";
                }
            }
           // Si le tableau d'erreur est toujours vide, c'est que le pseudo est incorrect
            else if (empty($arrayErrors)) {
                $arrayErrors['nickname'] = "Ce pseudo n'existe pas";
            }
        }
    }
}
