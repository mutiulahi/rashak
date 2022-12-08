<?php
session_start();
include "database.php";

// Login user using prepared statement if login button is clicked
if (isset($_POST['login'])) {
    // Get form data and store in variables also sanitize data
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);

    // Check if email or JRN already exists 
    $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($dbconnect, $sql);
    $user = mysqli_num_rows($result);
    if ($user == 1) {
        // Check if password match
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND password = '$password' LIMIT 1";
        $result = mysqli_query($dbconnect, $sql);
        $user = mysqli_num_rows($result);
        if ($user == 1) {
            // Login user
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND password = '$password' LIMIT 1";
            $result = mysqli_query($dbconnect, $sql);
            $user = mysqli_fetch_assoc($result);
            $_SESSION['auth'] = uniqid();
            $_SESSION['id'] = $user['role_id'];
            $_SESSION['auth_id'] = $user['id'];
            header('location: ../dashboard.php?type=success&msg=Login Successful');
            exit();
        } else {
            header('location: ../index.php?type=error&msg=Incorrect Password');
            exit();
        }
    } else {
        header('location: ../index.php?type=error&msg=Email does not exist');
        exit();
    }
}

// add new farm details

if (isset($_POST['add_farm'])) {
    // Get form data and store in variables also sanitize data
    $farm_name = mysqli_real_escape_string($dbconnect, $_POST['farm_name']);
    $farm_location = mysqli_real_escape_string($dbconnect, $_POST['farm_location']);
    $farm_size = mysqli_real_escape_string($dbconnect, $_POST['farm_size']);
    $farm_pic = mysqli_real_escape_string($dbconnect, $_FILES['farm_pic']);
    $farm_description = mysqli_real_escape_string($dbconnect, $_POST['farm_discription']);

    // move file to the server
    move_uploaded_file($_FILES['farm_pic']['tmp_name'], "../uploads/" . $_FILES['farm_pic']['name']);

    // insert to db in farm_details
    $sql = "INSERT INTO farm_details (name, location, size, picture, farm_description) VALUES ('$farm_name', '$farm_location', '$farm_size', '$farm_pic', '$farm_description')";
    $result = mysqli_query($dbconnect, $sql);
    if ($result) {
        header('location: ../projects.php?type=success&msg=Farm details added successfully');
        exit();
    } else {
        header('location: ../projects.php?type=error&msg=Error adding farm details');
        exit();
    }
}

// add new farm activity
if(isset($_POST['farm_activity']))
{
    // Get form data and store in variables also sanitize data
    $farm_id = mysqli_real_escape_string($dbconnect, $_POST['farm_id']);
    $activity = mysqli_real_escape_string($dbconnect, $_POST['activity']);
    $starting_date = mysqli_real_escape_string($dbconnect, $_POST['stating_date']);
    $ending_date = mysqli_real_escape_string($dbconnect, $_POST['ending_date']);
    $status = mysqli_real_escape_string($dbconnect, $_POST['status']);
    $status = 1;

    // insert to db in farm_details
    $farm_activity = "INSERT INTO farm_activities (farm_id, activity, start_date, end_date, status) VALUES ('$farm_id', '$activity', '$starting_date', '$ending_date', '$status')";
    $result = mysqli_query($dbconnect, $farm_activity);
    if ($result) {
        header('location: ../tickets.php?farm_id='.$farm_id.'&type=success&msg=Farm activity added successfully');
        exit();
    } else {
        header('location: ../tickets.php?farm_id='.$farm_id.'&type=error&msg=Error adding farm activity');
        exit();
    }
}

// add new user
if(isset($_POST['add_user']))
{
    // Get form data and store in variables also sanitize data
    $name = mysqli_real_escape_string($dbconnect, $_POST['name']);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);
    $role = mysqli_real_escape_string($dbconnect, $_POST['role']);
    $redirect = mysqli_real_escape_string($dbconnect, $_POST['redirect']);

    // insert to db in farm_details
    $add_user = "INSERT INTO users (name, email, password, role_id) VALUES ('$name', '$email', '$password', '$role')";
    $result = mysqli_query($dbconnect, $add_user);
    if ($result) {
        header('location: ../'.$redirect.'?type=success&msg=User added successfully');
        exit();
    } else {
        header('location: ../'.$redirect.'?type=error&msg=Error adding user');
        exit();
    }
}

// edit user
if(isset($_POST['edit_user']))
{
    // Get form data and store in variables also sanitize data
    $name = mysqli_real_escape_string($dbconnect, $_POST['name']);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);
    $role = mysqli_real_escape_string($dbconnect, $_POST['role']);
    $redirect = mysqli_real_escape_string($dbconnect, $_POST['redirect']);
    $id = mysqli_real_escape_string($dbconnect, $_POST['id']);

    // insert to db in farm_details
    $edit_user = "UPDATE users SET name = '$name', email = '$email' WHERE id = '$id'";
    $result = mysqli_query($dbconnect, $edit_user);
    if ($result) {
        header('location: ../'.$redirect.'?type=success&msg=User updated successfully');
        exit();
    } else {
        header('location: ../'.$redirect.'?type=error&msg=Error updating user');
        exit();
    }
}

// assign user to farm
if(isset($_POST['ass_farm'])) {
    // Get form data and store in variables also sanitize data
    $farm_id = mysqli_real_escape_string($dbconnect, $_POST['farm_id']);
    $user_id = mysqli_real_escape_string($dbconnect, $_POST['id']);
    $redirect = mysqli_real_escape_string($dbconnect, $_POST['redirect']);

    // check if user is already assigned to farm
    $check = "SELECT * FROM farm_users WHERE user_id = '$user_id'";
    $result = mysqli_query($dbconnect, $check);
    if (mysqli_num_rows($result) > 0) {
        // update farm_users table
        $update = "UPDATE farm_users SET farm_id = '$farm_id', user_id = '$user_id' WHERE user_id = '$user_id'";
        $result = mysqli_query($dbconnect, $update);
        if ($result) {
            header('location: ../'.$redirect.'?type=success&msg=User assigned to farm successfully');
            exit();
        } else {
            header('location: ../'.$redirect.'?type=error&msg=Error assigning user to farm');
            exit();
        }
    } else {
        // insert to db in farm_details
        $ass_farm = "INSERT INTO farm_users (farm_id, user_id) VALUES ('$farm_id', '$user_id')";
        $result = mysqli_query($dbconnect, $ass_farm);
        if ($result) {
            header('location: ../'.$redirect.'?type=success&msg=User assigned successfully');
            exit();
        } else {
            header('location: ../'.$redirect.'?type=error&msg=Error assigning user');
            exit();
        }
    }
    
}