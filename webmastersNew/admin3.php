<?php
include_once 'header.php';
?>

<?php
if (isset($_SESSION["useruid"])) {
    echo "<p>Hello " . $_SESSION["useruid"] . "<p>";
}
?>
<a href="ask3_1.php">
    <button type="button" name="ask3_1">ask3_1</button>
</a>
<a href="ask3_2.php">
    <button type="button" name="ask3_2">ask3_2</button>
</a>
<a href="ask3_3.php">
    <button type="button" name="ask3_3">ask3_3</button>
</a>

<?php
include_once 'footer.php'
?>