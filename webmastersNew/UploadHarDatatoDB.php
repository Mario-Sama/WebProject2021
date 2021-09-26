<?php
session_start();
//$usersUid=$_POST["uid"];
$usersUid=$_SESSION["useruid"];

//include_once 'includes/dbh.inc.php';
//include_once 'header.php';

//Transfer the original har file(json) in the current php file.Store it in $jsonoriginalrawstring as text and decode it again in json form,as an array usable by php.
//ΔΕΝ ΧΡΕΙΑΣΤΗΚΕ ΤΟ ΑΡΧΙΚΟ HAR
//$jsonoriginalrawstring = $_POST["originaldata"];
//$finaloriginaljson = json_decode($jsonoriginalrawstring);

//Transfer the filtered har file(newHar) in the current php file.Store it in $jsonrawstring as text and decode it again in json form.
$jsonrawstring = $_POST["data"];
$finaljson = json_decode($jsonrawstring);

//Fetch the requestMethod
//$finaljson[0]->requestMethod

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "webmastersdb";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("Connction failed: " . mysqli_connect_error());
}

//,uploadDate,usersUid,usersIp,startedDayTime,domainname,status,provider

  for ($i = 0; $i <= sizeof($finaljson) ; $i++){
    //for ($j = 0; $j <= count($finaljson[$i].responseHeaders[$j]) ; $j++){
    //$url = $finaljson[$i]->requestUrl;
    //$filtereddomain = preg_filter('/^(?:https?:\/\/)?(?:[^@\n]+@)?(?:www\.)?([^:\/\n?]+)/img', '($0)', $url);
    //$filtereddomain = preg_replace('/.*/' , '/((www\.)?[\w-]+\.\w{2,6})?/' , $domain);

  $query= "INSERT INTO har (usersUid,startedDateTime,method,domainname,status,requestedserverIP,wait) VALUES (?,'".$finaljson[$i]->startedDateTime."','".$finaljson[$i]->requestMethod."','".$finaljson[$i]->requestUrl."','".$finaljson[$i]->status."','".$finaljson[$i]->serverIPAddress."','".$finaljson[$i]->wait."')"; //,'".$finaljson[$i].responseHeaders[j]->content-type."'
  $stmt=$conn->prepare($query);                                                                                                                                                                                                                                                                                           //,'".$finaljson[$i].responseHeaders->content-type."'            // newHar[0].responseHeaders["content-type"]
  $stmt->bind_param("s",$usersUid);
  $stmt->execute();

  /*  $query= "INSERT INTO har (startedDateTime,method,domainname,status,requestedserverIP,contenttype,expires,lastmodified,cachecontrol,age,wait,statusText) VALUES ('".$finaljson[$i]->startedDateTime."','".$finaljson[$i]->requestMethod."','".$finaljson[$i]->requestUrl."','".$finaljson[$i]->status."',
      '".$finaljson[$i].serverIPAddress."','".$finaljson[$i].responseHeaders.content-type."','".$finaljson[$i].responseHeaders.expires."','".$finaljson[$i].responseHeaders.last-modified."','".$finaljson[$i].responseHeaders.cache-control."','".$finaljson[$i].responseHeaders.age."','".$finaljson[$i]->wait."','".$finaljson[$i]->statusText."')";
*/
       //$query2= "INSERT INTO har (method,uploadDate,usersUid,usersIp,startedDayTime,domainname,status,provider) VALUES ('','','','','','','".$finaljson[$i]->status."','')";
       mysqli_query($conn,$query);
       //mysqli_query($conn,$query2);
        }
     //}

/*
     for ($i = 0; $i <= sizeof($finaloriginaljson.log->entries) ; $i++){
       for ($j = 0; $j <= sizeof($finaloriginaljson.log->entries[$i].request->cookies) ; $j++){
          $query= "INSERT INTO har (domainname) VALUES ('".$finaloriginaljson.log->entries[$i].request->cookies[$j]->domain."')";
          //$query2= "INSERT INTO har (method,uploadDate,usersUid,usersIp,startedDayTime,domainname,status,provider) VALUES ('','','','','','','".$finaljson[$i]->status."','')";
          mysqli_query($conn,$query);
          //mysqli_query($conn,$query2);
          }
      }
*/
?>
