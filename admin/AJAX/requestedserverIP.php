<?php


$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "webmastersdb";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("Connction failed: " . mysqli_connect_error());
}

$query = "SELECT requestedserverIP FROM har";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
while ($row = $result->fetch_assoc()) {
    echo $row["requestedserverIP"];
}





/*
$sql = "SELECT requestedserverIP FROM har";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo 'alert("Sql query failed!!!")';
} else {
    $result = $conn->query($sql);
      $tourresult = $result->fetch_array()[0] ?? '';
    echo $tourresult;
}
*/
