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
    <link rel="stylesheet" href="assets/css/<?= "$theme" ?>-style.css">
    <title>Paramètres</title>
</head>

<body>
    <header>
        <?php include('components/header.php') ?>
    </header>

    <main class="justify-content-center container">
        <div class="card text-center">
            <div class="card-header text-light h3">
                Bonjour <span class="fw-bold"><?= $_SESSION['user']['nickname'] ?></span>
            </div>
            <div class="card-body text-light">
                <form action="" method="post">
                    <fieldset class="consolepicker">
                        <legend class="fs-5 mt-3">Préférences : </legend>
                            <div><input type="checkbox" id="ps4" name="consolepref[]" value="ps4">
                                <label for="ps4">PS4</label>
                                <input type="checkbox" id="ps5" name="consolepref[]" value="ps5">
                                <label for="ps5">PS5</label>
                                <input type="checkbox" id="xbox" name="consolepref[]" value="xbox">
                                <label for="xbox">Xbox</label>
                            </div>
                            <div>
                                <input type="checkbox" id="switch" name="consolepref[]" value="switch">
                                <label for="switch">Switch</label>
                                <input type="checkbox" id="pc" name="consolepref[]" value="pc">
                                <label for="pc">PC</label>
                                <input type="checkbox" id="mobile" name="consolepref[]" value="mobile">
                                <label for="mobile">Mobile</label>
                            </div>
                    </fieldset>
                    <fieldset class="nbarticles">
                        <div class="mb-3 mt-3">
                            <label for="nbarticles">Nombre d'articles par page</label>
                            <select name="nbarticles">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <fieldset class="themepicker">
                            <div>
                                <input type="checkbox" class="lightDark" id="lightDark" name="theme" value="" <?php
                                                                                                                // check automatique en cas de cookie -->
                                                                                                                if (isset($_COOKIE[$_SESSION['user']['nickname'] . 'theme']) && ($_COOKIE[$_SESSION['user']['nickname'] . 'theme'] == "dark")) {
                                                                                                                    echo 'checked';
                                                                                                                } else if (isset($_POST['theme']) && ($_POST['theme'] === 'dark')) {
                                                                                                                    echo 'checked';
                                                                                                                } else {
                                                                                                                    echo '';
                                                                                                                }
                                                                                                                ?>>
                                <label for="lightDark" id="IDtheme"><img src="https://img.icons8.com/ios-filled/30/FFFFFF/sun--v1.png" />/<img src="https://img.icons8.com/sf-regular-filled/30/FFFFFF/moon-symbol.png" /></label>
                            </div>
                        </fieldset>
                        <div class="m-3">
                            <input type="submit" value="Enregistrer" class="btn btn-outline-light">
                        </div>
                    </fieldset>
                </form>

            </div>

        </div>
    </main>


    <?php include('components/footer.php') ?>

    <script>
        var checkbox = document.getElementById("lightDark");
        var theme = "";
        var link = document.querySelector("head link:nth-of-type(3)"); // target the second link stylesheet in head
        checkbox.onchange = function() {
            if (this.checked) {
                checkbox.value = "dark";
                theme = "dark";
                link.href = "assets/css/" + theme + "-style.css"; // set the link's href to the light theme stylesheet

            } else {
                checkbox.value = "light";
                theme = "light";
                link.href = "assets/css/" + theme + "-style.css"; // set the link's href to the dark theme stylesheet
            }
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>