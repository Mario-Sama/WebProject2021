<?php
  require_once '../includes/dbh.inc.php';
  echo $_REQUEST['har_data'];

  if (isset($_REQUEST['har_data'])){
    echo "Hi, ".$_REQUEST['har_data'];
    $harData = $_REQUEST['har_data'];
    $sql = "UPDATE users SET har_data=$harData WHERE usersName='marios';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../upload_har.php?error=stmtfailed");
    }
    else {
      echo"sdsdsds";
      mysqli_stmt_bind_param($stmt, "s", $harData);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      header("location: ../index.php?error=nSDSDSone");
    }
  }
?>
