<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>webmasters project</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@200&display=swap" rel="stylesheet">
</head>

<body>

  <nav>
    <div class="wrapper">
      <ul>
        <!-- Menu in list type for easy navigation-->
        <?php
        if (isset($_SESSION["useruid"])) {
          if (!$_SESSION["isAdmin"]) {
            echo "<li><a href='accountSettings.php'>Account Settings</a></li>";
            echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
            echo "<li><a href='upload_har.php'>Upload a har file</a></li>";
            echo "<li><a href='heatmap.php'>See the heatmap</a></li>";
            $var =  $_SESSION["useruid"];
          } else if ($_SESSION["isAdmin"]) {
            echo "<li><a href='accountSettings.php'>Account Settings</a></li>";
            echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
            echo "<li><a href='admin.php'>Admin stuff</a></li>";
          }
        } else {
          echo "<li><a href='signup.php'>Sign up</a></li>";
          echo "<li><a href='login.php'>Log in</a></li>";
        }
        ?>
      </ul>
    </div>
  </nav>

  <div class="wrapper">
