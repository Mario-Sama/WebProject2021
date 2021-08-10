<?php
  //print_r($_POST);
  require_once '../includes/dbh.inc.php';
  print "lksdjflkd";
  //echo $_REQUEST['har_data'];

  if (isset($_POST)){
    //echo "Hi, ".$_POST;
    //print_r($_POST);
    $harData = $_POST;
    print_r("lecok");
    print "lksdjflkd";
    $sql = "INSERT INTO har (har_data, userId) VALUES ('{}','Mariosss');";
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
