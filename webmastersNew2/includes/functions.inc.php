<?php

  function emptyInputSingup($name, $email, $username, $pwd, $pwdRepeat) {
    $result;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
  }

  function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
  }

  function invalidPwd($pwd) {
    $result;
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $pwd)) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
  }

  function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
  }

  function pwdMatch($pwd, $pwdRepeat) {
    $result;
    if ($pwd !== $pwdRepeat) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
  }

  function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../signup.php?error=stmtfailed");
      exit();
    }


    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
      return $row;
    }
    else {
      $result = false;
      return $result;
    }

    mysqli_stmt_close($stmt);
  }

  function isAdmin($conn, $username, $email)
  {
    $sql = "SELECT isAdmin FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../signup.php?error=stmtfailed");
      exit();
    }


    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
      return $row;
    } else {
      $result = false;
      return $result;
    }

    mysqli_stmt_close($stmt);
  }

  function createUser($conn, $name, $email, $username, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../signup.php?error=stmtfailed");
      exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
  }

  function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
  }

  function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $pwd);

    if ($uidExists === false) {
      header("location: ../login.php?error=wronglogin");
      exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
      header("location: ../login.php?error=wronglogin");
      exit();    }
    else if ($checkPwd === true) {
      session_start();
      $_SESSION["userid"] = $uidExists["usersId"];
      echo $uidExists["usersId"];
      $_SESSION["useruid"] = $uidExists["usersUid"];
      $isAdmin = isAdmin($conn, $username, $pwd);
      if ($isAdmin === false) {
        header("location: ../login.php?error=problem");
        exit();
      }

      $_SESSION["isAdmin"] = $isAdmin["isAdmin"];

      if ($uidExists["isAdmin"] == true) {
        header("location: ../admin.php?error=none");
        exit();
      }
      else {
        header("location: ../index.php?error=none");
        exit();
      }
    }
  }

  function emptySettingsLogin($oldUsername, $newUsername, $pwd) {
    $result;
    if (empty($oldUsername) || empty($newUsername) || empty($pwd)) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
  }

  function changeUserSettings($conn, $newUsername, $pwd, $oldUsername) {

    $uidExists = uidExists($conn, $oldUsername, $oldUsername);

    if ($uidExists === false) {
      header("location: ../accountSettings.php?error=wrongusername");
      exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);


    if ($checkPwd === false) {
      header("location: ../accountSettings.php?error=wrongpwd");
      exit();
    }
    else if ($checkPwd === true) {
      $sql = "UPDATE users SET usersUid = ?, WHERE userUid = ?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../accountSettings.php?error=stmtfailed");
        exit();
      }

      mysqli_stmt_bind_param($stmt, "ss", $newUsername, $oldUsername);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      header("location: ../index.php?error=none");
      exit();
    }
  }

  function sameUsername($oldUsername, $newUsername) {
    $result;
    if ($oldUsername !== $newUsername) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
  }
