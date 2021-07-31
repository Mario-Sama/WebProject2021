<?php
  require_once '../includes/dbh.inc.php';
  echo "sdfdfd";
  if (isset($_REQUEST['har_data'])){
    echo "Hi, ".$_REQUEST['har_data'];
    $har_data = $_REQUEST['har_data'];
    $sql = "UPDATE users SET har_data=$harData WHERE usersName='marios';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../upload_har.php?error=stmtfailed");
    }
    else {
    echo"sdsdsds";
    //mysqli_stmt_bind_param($stmt, "s", $har_data);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    //header("location: ../upload_har.php?error=none");
    }
  }
