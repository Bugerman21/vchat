<?php
  session_start();

  if(isset($_POST["logout"])){
    session_destroy();
    echo 1;
  }

  if(!(isset($_SESSION["id"]))){
    header('Location: http://localhost/pet-store/login.php');
  }
?>
