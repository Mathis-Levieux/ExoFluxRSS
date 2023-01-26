<?php
function checkProfil()
{
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: accueil.php');
    } elseif (isset($_SESSION['user'])) {
        echo '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://img.icons8.com/external-smashingstocks-glyph-smashing-stocks/40/FFFFFF/external-profile-web-smashingstocks-glyph-smashing-stocks.png"/>
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="parametres.php"><i class="bi bi-gear"></i> Paramètres</a></li>
            <li><a class="dropdown-item" href="?logout" name="logout" ><i class="bi bi-x-circle"></i> Déconnexion</a></li>
        </ul>
        ';
    } else {
        echo '<a href="connexion.php" type="button" class="btn"><img src="https://img.icons8.com/pastel-glyph/40/FFFFFF/shutdown--v4.png"/></a>';
    }
}
