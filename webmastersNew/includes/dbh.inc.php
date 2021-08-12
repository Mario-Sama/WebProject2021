<?php
  $serverName = "localhost";
  $dBUsername = "root";
  $dBPassword = "7812";
  $dBName = "webmastersdb";

  $conn = @mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

  if (!$conn) {
    die("Connction failed: " . mysqli_connect_error());
  }
