<?php
  include_once 'header.php';
?>

  <section class="signup-form">
    <h2>Enter the new username and the new password</h2>
    <div class="signup-form-form">
      <form action="includes/accountSettings.inc.php" method="post">
        <input type="text" name="olduid" placeholder="Old username">
        <input type="text" name="uid" placeholder="New username">
        <input type="password" name="pwd" placeholder="New password...">
        <input type="password" name="pwdRepeat" placeholder="Repeat password...">
        <button type="submit" name="change">Apply changes</button>
      </form>
    </div>
  </section>

  <?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "Fill in all the fields!";
      }
      //if ($_GET["error"] == "sameusername") {
        //echo "The new username must be different than the old one!";
      //}
      if ($_GET["error"] == "invaliduid") {
        echo "<p>Choose a proper username!</p>";
      }
      if ($_GET["error"] == "passworddontmatch") {
        echo "<p>Password doesn't match!</p>";
      }
      if ($_GET["error"] == "usernametaken") {
        echo "<p>Username already exists!</p>";
      }
      if ($_GET["error"] == "invalidepwd") {
        echo "<p>Password must be at least 8 characters and must include a least one capital character, one number and one special character.</p>";
      }
      if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong try again!</p>";
      }
      if ($_GET["error"] == "none") {
        echo "<p>Your username has been updated!</p>";
      }
    }
  ?>

<?php
  include_once 'footer.php'
?>
