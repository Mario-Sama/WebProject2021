<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "webmastersdb";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("Connction failed: " . mysqli_connect_error());
}

$query = "SELECT (longitude,langitude) FROM requestedipinfo;";
 mysqli_query($conn,$query);
