<?php
require('../controllers/login-controller.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/<?= "$theme" ?>-style.css">
    <title>Connexion</title>
</head>

<body>
    <header>
        <?php include('components/header.php') ?>
    </header>
    <?php if (isset($_SESSION['user'])) {
        header('Location: accueil.php');
    } ?>
    <main class="main-login">
        <div class="login-container card text-center">
            <div class="text-light h3 m-3">
                Connexion
            </div>
            <div class="card-body text-light">
                <form action="" method="POST">
                    <div>
                        <div class="input-group mx-auto">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control rounded" placeholder="Pseudo" aria-label="Username" aria-describedby="basic-addon1" value="<?= $_POST['nickname'] ?? '' ?>" name="nickname">
                        </div>
                        <div class="login-error">
                        <?= $arrayErrors['nickname'] ?? '' ?>
                        </div>
                        <div class="input-group mx-auto">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control rounded" placeholder="Mot de passe" aria-label="Username" aria-describedby="basic-addon1" name="password">
                        </div>
                        <div class="login-error">
                        <?= $arrayErrors['password'] ?? '' ?>
                        </div>  
                    </div>
                    <div>
                        <button id="submit" type="submit" class="btn btn-outline-light m-3">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </main>





    <?php include('components/footer.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>