<?php require('../controllers/404-controller.php') ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/<?= "$theme" ?>-style.css">
    <link rel="icon" type="image/png" href="assets/img/logo-Light.png" />

    <title>ERREUR</title>
</head>

<body>
    <header>
        <?php include('components/header.php') ?>
    </header>
    
    <main >
        <div class="card text-center error404 m-5 p-2">
            <div class="card-body text-light h1">
            ERREUR 404 
            </div>
            <div class="h1 text-light">
            <img src="https://img.icons8.com/windows/96/FFFFFF/dead-emoji.png"/>
            </div>
        </div>
    </main>


    <?php include('components/footer.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>