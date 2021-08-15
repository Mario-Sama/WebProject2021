<?php
include_once 'header.php';
if (isset($_SESSION["useruid"])) {
  header("location: upload_har.php?error=none");
}
?>

<?php
include_once 'footer.php'
?>
