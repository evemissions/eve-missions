<?php
  session_start();
    $_SESSION['auth_characterid'] = 90792652 ;
    $_SESSION['auth_charactername'] = "vampire Huunuras";
  if (isset($_SESSION['charactername'])) { //if you have more session-vars that are needed for login, also check if they are set and refresh them as well
    #$_SESSION['charactername'] = $_SESSION['charactername'];
      # For development only ! :)
    $_SESSION['auth_characterid'] = 90792652 ;
    $_SESSION['auth_charactername'] = "vampire Huunuras";
  }
?>
