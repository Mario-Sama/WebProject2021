<?php
    require_once '../includes/dbh.inc.php';

    $sql = "SELECT har_data FROM har_information WHERE usersUid=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo mysqli_error($conn);
    }
    else {
        //mysqli_stmt_bind_param($stmt, "s", $name);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_GET['name']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($data);
        $stmt->fetch();
        $stmt->close();
        echo $data;
    }
