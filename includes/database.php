<?php
// database connection

$dbconnect = mysqli_connect("157.245.132.117", "tescode", "tescode", "rashak_db");
if(!$dbconnect){
    die("Connection failed: " . mysqli_connect_error());
}