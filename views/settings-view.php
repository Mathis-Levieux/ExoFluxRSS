<?php
require('../controllers/settings-controller.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/<?= "$theme" ?>-style.css">
    <title>Paramètres</title>
</head>

<body>
    <header>
        <?php include('components/header.php') ?>
    </header>
    <main class="justify-content-center container">
        <div class="profil-container">
            <ul>
                <li>Pseudo : <?= $_SESSION['user']['nickname'] ?></li>
            </ul>
            <form action="" method="post">
        </div>
        <fieldset class="themepicker">
            <legend>Choisis ton thème</legend>

            <div>
                <input <?php
                        if (isset($_COOKIE[$_SESSION['user']['nickname'] . 'theme']) && ($_COOKIE[$_SESSION['user']['nickname'] . 'theme'] == "light")) {
                            echo 'checked';
                        } else if (isset($_POST['theme']) && ($_POST['theme'] === 'light')) {
                            echo 'checked';
                        } else {
                            echo '';
                        }


                        ?> type="radio" id="light" name="theme" value="light">
                <label for="light">Basique</label>
            </div>

            <div>
                <input <?php
                        if (isset($_COOKIE[$_SESSION['user']['nickname'] . 'theme']) && ($_COOKIE[$_SESSION['user']['nickname'] . 'theme'] == "dark")) {
                            echo 'checked';
                        } else if (isset($_POST['theme']) && ($_POST['theme'] === 'dark')) {
                            echo 'checked';
                        } else {
                            echo '';
                        }

                        ?> type="radio" id="dark" name="theme" value="dark">
                <label for="dark">Sombre</label>
            </div>
        </fieldset>
        <fieldset class="consolepicker">
            <legend>Choisis tes consoles</legend>
            <div>
                <input type="checkbox" id="ps4" name="consolepref[]" value="ps4">
                <label for="ps4">Playstation 4</label>
                <input type="checkbox" id="ps5" name="consolepref[]" value="ps5">
                <label for="ps5">Playstation 5</label>
                <input type="checkbox" id="xbox" name="consolepref[]" value="xbox">
                <label for="xbox">Xbox</label>
                <input type="checkbox" id="switch" name="consolepref[]" value="switch">
                <label for="switch">Nintendo Switch</label>
                <input type="checkbox" id="pc" name="consolepref[]" value="pc">
                <label for="pc">PC</label>
                <input type="checkbox" id="mobile" name="consolepref[]" value="mobile">
                <label for="mobile">Mobile</label>

            </div>
        </fieldset>

        <fieldset class="nbarticles">
            <legend>Choisis le nombre d'articles par page</legend>
            <div>
                <label for="nbarticles">Nombre d'articles par page</label>
                <select name="nbarticles">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>

            <div>
                <input type="submit" value="Enregistrer">
            </div>
        </fieldset>
        </form>





    </main>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>