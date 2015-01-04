<?php
  session_start();
  if (isset($_SESSION['charactername'])) { //if you have more session-vars that are needed for login, also check if they are set and refresh them as well
    $_SESSION['charactername'] = $_SESSION['charactername'];
  }
?>
