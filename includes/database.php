<?php
// database connection

$dbconnect = mysqli_connect("localhost", "root", "", "rashak_db");
if(!$dbconnect){
    die("Connection failed: " . mysqli_connect_error());
}