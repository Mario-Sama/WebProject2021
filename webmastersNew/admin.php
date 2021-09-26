<?php
include_once 'header.php';
?>
<?php
if (!isset($_SESSION['useruid']) || $_SESSION['isAdmin'] != 1) {
  header('Location: index.php');
}
?>
<?php

?>
<a href="basicData.php">
  <button type="button" name="basicData">Display Basic Data</button>
</a>
<a href="timeData.php">
  <button type="button" name="timeData">Display Time Data</button>
</a>
<a href="admin3.php">
  <button type="button" name="httpHeaders">Analyse HTTP Headers</button>
</a>
<a href="visualizeData.php">
  <button type="button" name="visualizeData">Visualize Data</button>
</a>

<section class="index-intro">