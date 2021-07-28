<?php

if (isset($_POST["change"]) || isset($_SESSION["useruid"])) {
  $newUsername = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $oldUsername = $_POST["olduid"];


  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptySettingsLogin($oldUsername, $newUsername, $pwd) !== false) {
    header("location: ../accountSettings.php?error=emptyinput");
    exit();
  }
  if (sameUsername($oldUsername, $newUsername) == false) {
    header("location: ../accountSettings.php?error=sameusername");
    exit();
  }

  changeUserSettings($conn, $newUsername, $pwd, $oldUsername);
}
else {
  header("location: ../accountSettings.php?");
  exit();
}
