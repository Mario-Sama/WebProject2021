<?php

if(isset($_POST['logout_btn']))
{
//include('includes/navbar.php');
  session_start();
  session_unset();
  session_destroy();
//$_SESSION['status'] = "Logging Out...";
header('Location: login.php');
exit();
}
