<?php 
function checkProfil()
{
    if (isset($_SESSION['user'])) {
        echo '<a href="home-view.php" type="button" class="btn"><img src="https://img.icons8.com/fluency-systems-filled/40/FFFFFF/home.png"/></a>';
    } else {
        echo '<a href="login-view.php" type="button" class="btn"><img src="https://img.icons8.com/fluency-systems-filled/40/FFFFFF/shutdown.png"/></a>';
    }
}
