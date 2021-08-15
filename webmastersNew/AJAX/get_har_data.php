<?php
  //print_r($_POST);
  session_start();
  require_once '../includes/dbh.inc.php';

  if (isset($_POST["har"])){
    $harData = $_POST["har"];
    $myfile = fopen("testfile.txt", "w");
    fwrite($myfile, $harData);
    $date = date('Y-m-d H:i:s');
    $user = $_SESSION["useruid"];
    $sql = "INSERT INTO har (har_data, uploadDate, usersUid) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo 'alert("Sql query failed!!!")';
    }
    else {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $harData, $date, $user);
        $stmt->execute();
        $stmt->store_result();
        //$stmt->bind_result($harData);
        $stmt->fetch();
        $stmt->close();
    }
  }
