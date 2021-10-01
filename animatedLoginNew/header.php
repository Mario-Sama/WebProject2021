<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>WEBMASTERS</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">
  </head>

  <body>

    <nav>
      <div class="wrapper">
        <ul>
          <?php
            if (isset($_SESSION["useruid"])) {
              echo "<li><a href='profile.php'>Profile page</a></li>";
              echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
              echo "<li><a href='accountSettings.php'>Account Settings</a></li>";
            }
            else {
              echo "<li><a href='signup.php'>Sign up</a></li>";
              echo "<li><a href='login.php'>Log in</a></li>";
            }
            ?>
        </ul>
      </div>
    </nav>

<div class="wrapper">
