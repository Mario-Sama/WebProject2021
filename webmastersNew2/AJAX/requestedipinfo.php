<?php
session_start();
require_once '../includes/dbh.inc.php';

if (isset($_POST["usersIp"]) && isset($_POST["latitude"])&& isset($_POST["longitude"])&& isset($_POST["provider"])){  //&& isset($_POST["provider"])
$userIp = $_POST["usersIp"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$provider = $_POST["provider"];

$sql = "INSERT INTO requestedipinfo (usersIp,langitude,longitude,Provider) VALUES (? , ?, ?, ?);";   //,Provider

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  echo 'alert("Sql query failed!!!")';
}
else {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $userIp, $latitude, $longitude,$provider);
    $stmt->execute();
    $stmt->store_result();
    $stmt->fetch();
    $stmt->close();
}
}
