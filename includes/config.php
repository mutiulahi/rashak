<?php
// farmers = 3
// supervisor = 2
// members = 1
// admin = 4
session_start();
// check if the user is logged in
if (!isset($_SESSION['auth']) and !isset($_SESSION['auth_id'])) {
    // distroy all session
    session_destroy();
    // redirect to login page
    header('location: index.php?msg=Please you have to login before access the portal&type=error');
    exit();
}

// Path: admission\includes\database.php
include 'includes/database.php';
$student_id = $_SESSION['auth_id'];
// get the student information from the database
$sql = "SELECT * FROM users WHERE id = '$student_id'";
$result = mysqli_query($dbconnect, $sql);
while ($user = mysqli_fetch_array($result)) {
    $name = $user['name'];
    $email = $user['email'];
}

// get farm details from the database inner join farm_comment table
$sql_farmdetails = "SELECT * FROM farm_details";
$resultFarmDetail = mysqli_query($dbconnect, $sql_farmdetails);
$farm_details = mysqli_num_rows($resultFarmDetail);





// get farm comment from the database inner join farm_comment table
$sql_farmcomment = "SELECT * FROM farm_comments";
$result = mysqli_query($dbconnect, $sql_farmcomment);
$farm_comment_num = mysqli_num_rows($result);


// get farm activity from the database inner join farm_comment table
if (isset($_GET['farm_id'])) {
    $farm_id = $_GET['farm_id'];
    $sql_farmActivity = "SELECT * FROM farm_activities WHERE farm_id = '$farm_id'";
    $resultActivity = mysqli_query($dbconnect, $sql_farmActivity);
    $farm_Activity_num = mysqli_num_rows($resultActivity);
}

// get farmer 
$sql_farmers = "SELECT * FROM farmers";
$resultFarmers = mysqli_query($dbconnect, $sql_farmers);
$farmers = mysqli_num_rows($resultFarmers);

// get supervisor
$sql_supervisor = "SELECT * FROM users WHERE role_id = '2'";
$resultSupervisor = mysqli_query($dbconnect, $sql_supervisor);
$supervisor = mysqli_num_rows($resultSupervisor);

// get members
$sql_members = "SELECT * FROM users WHERE role_id = '1'";
$resultMembers = mysqli_query($dbconnect, $sql_members);
$members = mysqli_num_rows($resultMembers);


// function to get the assigned farm to the supervisor

function getAssignedFarm($supervisor_id)
{
    include 'includes/database.php';
    $sql = "SELECT * FROM farm_users INNER JOIN farmers ON  farmers.unique_id = farm_users.farm_id WHERE farm_users.user_id = '$supervisor_id'";
    $result = mysqli_query($dbconnect, $sql);
    $farm = mysqli_num_rows($result);
    $farm_detail = mysqli_fetch_array($result);
    if ($farm > 0) {
        return $farm_detail['first_name'] . " " . $farm_detail['last_name'];
    } else {
        return "not assigned";
    }
}



$sql_farmdetails = "SELECT * FROM farmers";
$resultFarmDetails = mysqli_query($dbconnect, $sql_farmdetails);
$farm_details = mysqli_num_rows($resultFarmDetail);
$farm_array = array();
while ($farmaa = mysqli_fetch_array($resultFarmDetails)) {
    $farm_id = $farmaa['unique_id'];
    $farm_name = $farmaa['first_name'] . " " . $farmaa['last_name'];
    $farm_array[$farm_id] = $farm_name;
}
