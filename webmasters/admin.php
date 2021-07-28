<?php
  include_once 'header.php';
?>

<?php
  if (isset($_SESSION["useruid"])) {
    echo "<p>Hello " . $_SESSION["useruid"] . "<p>";
  }
?>
<a href="basicData.php">
  <button type="button" name="basicData">Display Basic Data</button>
</a>
<a href="timeData.php">
  <button type="button" name="timeData">Display Time Data</button>
</a>
<a href="httpHeaders.php">
  <button type="button" name="httpHeaders">Analyse HTTP Headers</button>
</a>
<a href="visualizeData.php">
  <button type="button" name="visualizeData">Visualize Data</button>
</a>
      <a href="accountSettings.php">
        <button type="button" name="settings">Settings</button>
      </a>

<section class="index-intro">


<?php
  include_once 'footer.php'
?>
