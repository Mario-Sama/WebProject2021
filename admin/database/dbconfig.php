<?php

$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "webmastersdb";

$connection = mysqli_connect($server_name,$db_username,$db_password,$db_name);        //This is where the magin happens.We create a variable $connection, which is vital field of funtion mysqli_query(),where we establish our connection.
                                                                                      //Exception handling is including.This code along with security.php are necessary to connect to our database!
if(!$connection)
{
    die("Connection failed: " . mysqli_connect_error());
    echo '
        <div class="container">
            <div class="row">
                <div class="col-md-8 mr-auto ml-auto text-center py-5 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title bg-danger text-white"> Database Connection Failed </h1>
                            <h2 class="card-title"> Database Failure</h2>
                            <p class="card-text"> Please Check Your Database Connection.</p>
                            <a href="#" class="btn btn-primary">:( </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';
}
?>
