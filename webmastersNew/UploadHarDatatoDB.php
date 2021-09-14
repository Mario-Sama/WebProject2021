<?php
session_start();
//include_once 'includes/dbh.inc.php';
//include_once 'header.php';

//Transfer the filtered har file(newHar) in the current php file.Store it in $jsonrawstring as text and decode it again in json form.

$jsonrawstring = $_POST["data"];
$finaljson = json_decode($jsonrawstring);

//Fetch the requestMethod
//$finaljson[0]->requestMethod

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "webmastersdb";

$conn = @mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("Connction failed: " . mysqli_connect_error());
}


  $query= "INSERT INTO har (method) VALUES ('".$finaljson[1]->requestMethod."')";
  mysqli_query($conn,$query);




/*
foreach($finaljson->requestMethod as $method)

    {
      $query= "INSERT INTO har (method) VALUES ('".$$method."')";
      mysqli_query($conn,$query);
         echo $method->requestMethod . "\n";
         foreach($mydata->values as $values)                ΟΗΗΗΗ ΝΟΟΟΟΟΟΟΟΟΟΟΟΟΟΟΟΟΟΟΟΟ
         {
              echo $values->value . "\n";
         }
    }
*/



?>
