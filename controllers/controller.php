<?php
function checkProfil()
{
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: ../views/home-view.php');
    } elseif (isset($_SESSION['user'])) {
        echo '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://img.icons8.com/external-smashingstocks-glyph-smashing-stocks/40/FFFFFF/external-profile-web-smashingstocks-glyph-smashing-stocks.png"/>
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../views/settings-view.php"><i class="bi bi-gear"></i> Settings</a></li>
            <li><a class="dropdown-item" href="?logout" name="logout" ><i class="bi bi-x-circle"></i> Déconnection</a></li>
        </ul>
        ';
    } else {
        echo '<a href="login-view.php" type="button" class="btn"><img src="https://img.icons8.com/pastel-glyph/40/FFFFFF/shutdown--v4.png"/></a>';
    }
}
