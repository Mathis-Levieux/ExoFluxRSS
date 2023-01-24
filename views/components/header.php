<?php
require ("../controllers/controller.php");
?>
<nav class="navbar sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../assets/img/logo-Light.png" alt="Logo">
      GameScope
    </a>
    <?php
    checkProfil();
    ?>
  </div>
</nav>