<?php
// database connection

$dbconnect = mysqli_connect("157.245.132.117", "root", "tescode", "rashak_db");
if(!$dbconnect){
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo "Connected successfully";
}

// $dbconnect = mysqli_connect("localhost", "root", "", "rashak_db");
// if(!$dbconnect){
//     die("Connection failed: " . mysqli_connect_error());
// }