<?php
  //print_r($_POST);
  require_once '../includes/dbh.inc.php';
  //echo $_REQUEST['har_data'];

  if (isset($_POST["har"])){
    //echo "Hi, ".$_POST;
    //print_r($_POST);
    $name = "ffff";
    $email = "ffff";
    $id = 3;
    $pwd = "ffff";
    $harData = $_POST["har"];
    $myfile = fopen("testfile.txt", "w");
    fwrite($myfile, $harData);
    $har = '{}';
    //echo "'Hello' Is data type - ".gettype($harData);
    $sql = "INSERT INTO users (usersId, userName) VALUES (10, 'aaaa');";
    //$stmt = @mysqli_stmt_init($conn);
    $response = @mysqli_query($conn, $sql);
    //if ($response)
    //{echo "ddddddd"}
    /*
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "ffffffffff";
      echo mysqli_error($conn);
      print_r($harData);
      //header("location: ../upload_har.php?error=stmtfailed");
    }
    else {
      echo"sdsdsds";
      echo mysqli_error($conn);
      mysqli_stmt_bind_param($stmt, "s", $name);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      print_r($_POST["har"]);
      //header("location: ../index.php?error=nSDSDSone");
    }
    */
  }
?>
