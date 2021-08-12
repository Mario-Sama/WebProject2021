<?php
//session_start();



    if(!isset($_SESSION))
    {
        session_start();    //Instead of making a connection and start the session on every individual php code we with include the following php code along with database/dbconfig.php to establish a connection to our database.
    }
include('database/dbconfig.php');

if($connection)
{
    // echo "Database Connected";
}
else
{
    header("Location: database/dbconfig.php");
}

if(!$_SESSION['username'])
{
    header('Location: login.php');
}
?>
