<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>webmasters project</title>
  <link rel="stylesheet" href="/css/reset.css">
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>

  <nav>
    <div class="wrapper">
      <ul>
        <?php
        if (isset($_SESSION["useruid"])) {
          if (!$_SESSION["isAdmin"]) {
            echo "<li><a href='accountSettings.php'>Account Settings</a></li>";
            echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
            echo "<li><a href='upload_har.php'>Upload a har file</a></li>";
            echo "<li><a href='heatmap.php'>See the heatmap</a></li>";
          } else if ($_SESSION["isAdmin"]) {
            echo "<li><a href='accountSettings.php'>Account Settings</a></li>";
            echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
            echo "<li><a href='admin.php'>Admin stuff</a></li>";
          }
        } else {
          echo "<li><a href='signup.php'>Sign up</a></li>";
          echo "<li><a href='login.php'>Log in</a></li>";
          //echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
        }
        ?>
      </ul>
    </div>
  </nav>

  <div class="wrapper">