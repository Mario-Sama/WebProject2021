<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "webmastersdb";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("Connction failed: " . mysqli_connect_error());
}

$query = "SELECT langitude,longitude FROM requestedipinfo LIMIT 1;";
 $result = mysqli_query($conn,$query);
 $row = mysqli_fetch_array($result);
 while ($row = $result->fetch_assoc()) {
     echo $row["langitude"];
     echo $row["longitude"];
 }
