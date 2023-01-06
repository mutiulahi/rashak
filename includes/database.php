<?php
// database connection

$dbconnect = mysqli_connect("dbaas-db-5831699-do-user-12325480-0.b.db.ondigitalocean.com", "doadmin", "AVNS_6yeUKio300fObf6VPBg", "defaultdb");
if(!$dbconnect){
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo "Connected successfully";
}

// $dbconnect = mysqli_connect("localhost", "root", "", "rashak_db");
// if(!$dbconnect){
//     die("Connection failed: " . mysqli_connect_error());
// }