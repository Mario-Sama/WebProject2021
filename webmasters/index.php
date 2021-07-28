<?php
  include_once 'header.php';
?>

<?php

  if (isset($_SESSION["useruid"])) {
    echo "<p>Hello " . $_SESSION["useruid"] . "<p>";
  }
?>

      <a href="accountSettings.php">
        <button type="button" name="settings">Settings</button>
      </a>

  <input type="file">
  <script src="js/harReader.js" charset="utf-8">
  </script>


<?php
  include_once 'footer.php'
?>

<!DOCTYPE html>
<html>
<head>
  <title>Welcome!</title>
</head>
<body>
    <nav>
      <div class="wrapper">
        <a href="index.php"></a>
      </div>
    </nav>
      <h1></h1>
</body>
</html>
