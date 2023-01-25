<?php
require ("../controllers/controller.php");
?>
<nav class="navbar sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="accueil.php">
      <img src="../assets/img/logo-Light.png" alt="Logo">
      GAMESCOPE
    </a>
    <?php
    checkProfil();
    ?>
  </div>
</nav>