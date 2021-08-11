<?php

if (isset($_POST["change"]) || isset($_SESSION["useruid"])) {
  $newUsername = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdRepeat"];
  $oldUsername = $_POST["olduid"];


  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptySettingsLogin($oldUsername, $newUsername, $pwd) !== false) {
    header("location: ../accountSettings.php?error=emptyinput");
    exit();
  }
  if (invalidUid($oldUsername) !== false) {
    header("location: ../accountSettings.php?error=invaliduid");
    exit();
  }
  //if (sameUsername($oldUsername, $newUsername) == false) {
    //header("location: ../accountSettings.php?error=sameusername");
    //exit();
//  }
  if (uidExists($conn, $oldUsername, $email) !== false) {
    header("location: ../signup.php?error=usernametaken");
    exit();
  }
  if (invalidPwd($pwd) !== false) {
    header("location: ../accountSettings.php?error=invalidepwd");
    exit();
  }
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../accountSettings.php?error=passworddontmatch");
    exit();
  }

  changeUserSettings($conn, $newUsername, $pwd, $pwdRepeat, $oldUsername);
}
else {
  header("location: ../accountSettings.php?");
  exit();
}
