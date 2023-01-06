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
    move_uploaded_file($_FILES['farm_pic']['tmp_name'], "uploads/" . $_FILES['farm_pic']['name']);

    '../'.// insert to db in farm_details
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
if (isset($_POST['harvest'])) {
    // Get form data and store in variables also sanitize data
    $farm_id = mysqli_real_escape_string($dbconnect, $_POST['farm_id']);
    $crop = mysqli_real_escape_string($dbconnect, $_POST['crop']);
    $harvest_date = mysqli_real_escape_string($dbconnect, $_POST['harvest_date']);
    $total_yield = mysqli_real_escape_string($dbconnect, $_POST['total_yield']);
    $warehouse_to_be_delivered_to = mysqli_real_escape_string($dbconnect, $_POST['warehouse_to_be_delivered_to']);
    $status = 1;

    // insert to db in farm_details
    $farm_activity = "INSERT INTO farm_activities (`farm_id`, `crop`, `harvest_date`, `total_yield`, `warehouse_to_be_delivered_to`) VALUES ('$farm_id', '$crop', '$harvest_date', '$total_yield', '$warehouse_to_be_delivered_to')";
    $result = mysqli_query($dbconnect, $farm_activity);
    if ($result) {
        header('location: ../tickets.php?farm_id=' . $farm_id . '&type=success&msg=Farm activity added successfully');
        exit();
    } else {
        header('location: ../tickets.php?farm_id=' . $farm_id . '&type=error&msg=Error adding farm activity');
        exit();
    }
}

// add new user
if (isset($_POST['add_user'])) {
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
        header('location: ../' . $redirect . '?type=success&msg=User added successfully');
        exit();
    } else {
        header('location: ../' . $redirect . '?type=error&msg=Error adding user');
        exit();
    }
}

// edit user
if (isset($_POST['edit_user'])) {
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
        header('location: ../' . $redirect . '?type=success&msg=User updated successfully');
        exit();
    } else {
        header('location: ../' . $redirect . '?type=error&msg=Error updating user');
        exit();
    }
}

// assign user to farm
if (isset($_POST['ass_farm'])) {
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
            header('location: ../' . $redirect . '?type=success&msg=User assigned to farm successfully');
            exit();
        } else {
            header('location: ../' . $redirect . '?type=error&msg=Error assigning user to farm');
            exit();
        }
    } else {
        // insert to db in farm_details
        $ass_farm = "INSERT INTO farm_users (farm_id, user_id) VALUES ('$farm_id', '$user_id')";
        $result = mysqli_query($dbconnect, $ass_farm);
        if ($result) {
            header('location: ../' . $redirect . '?type=success&msg=User assigned successfully');
            exit();
        } else {
            header('location: ../' . $redirect . '?type=error&msg=Error assigning user');
            exit();
        }
    }
}

// start farmer onboardfarmer
if (isset($_POST['onboardfarmer'])) {
    $unique_id = 'RASH/FARMER/' . substr(date("Y"), -2) . '/' . rand(0000, 9999);
    $unique_id = strtoupper($unique_id);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $first_name = mysqli_real_escape_string($dbconnect, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($dbconnect, $_POST['last_name']);
    $phone_number = mysqli_real_escape_string($dbconnect, $_POST['phone_number']);
    $date_of_birth = mysqli_real_escape_string($dbconnect, $_POST['date_of_birth']);
    $gender = mysqli_real_escape_string($dbconnect, $_POST['gender']);
    $disability = mysqli_real_escape_string($dbconnect, $_POST['disability']);
    $marital_status = mysqli_real_escape_string($dbconnect, $_POST['marital_status']);
    $did_you_have_children = mysqli_real_escape_string($dbconnect, $_POST['did_you_have_children']);
    $numbers_of_children = mysqli_real_escape_string($dbconnect, $_POST['numbers_of_children']);
    $is_children_in_school = mysqli_real_escape_string($dbconnect, $_POST['is_children_in_school']);
    $average_monthly_income = mysqli_real_escape_string($dbconnect, $_POST['average_monthly_income']);
    $other_income = mysqli_real_escape_string($dbconnect, $_POST['other_income']);
    $land_size = mysqli_real_escape_string($dbconnect, $_POST['land_size']);
    $land_coordinate = mysqli_real_escape_string($dbconnect, $_POST['land_coordinate']);
    $farm_location = mysqli_real_escape_string($dbconnect, $_POST['farm_location']);
    $home_address = mysqli_real_escape_string($dbconnect, $_POST['home_address']);
    $state_of_origin = mysqli_real_escape_string($dbconnect, $_POST['state_of_origin']);
    $nationality = mysqli_real_escape_string($dbconnect, $_POST['nationality']);
    $input_crop = mysqli_real_escape_string($dbconnect, $_POST['input_crop']);
    // $reciept_of_commitment = mysqli_real_escape_string($dbconnect, $_POST['reciept_of_commitment']);

    $land_picture = $_FILES['land_picture'];
    $profile_picture = $_FILES['profile_picture'];
    $national_means_of_identity = $_FILES['national_means_of_identity'];
    $reciept_of_commitment = $_FILES['reciept_of_commitment'];


    $farmer_profile_pic = $profile_picture['tmp_name']; // get the temporary location of the file
    // get the file extension
    $farmer_profile_pic_ext = explode('.', $profile_picture['name']);
    $farmer_profile_pic_ext = strtolower(end($farmer_profile_pic_ext));
    $farmer_profile_pic_name = uniqid('', true) . '.' . $farmer_profile_pic_ext;
    $farmer_profile_pic_destination = 'uploads/farmers/' . $farmer_profile_pic_name;
    move_uploaded_file($farmer_profile_pic, '../'.$farmer_profile_pic_destination);

    $farmer_land_pic = $land_picture['tmp_name']; // get the temporary location of the file
    // get the file extension
    $farmer_land_pic_ext = explode('.', $land_picture['name']);
    $farmer_land_pic_ext = strtolower(end($farmer_land_pic_ext));
    $farmer_land_pic_name = uniqid('', true) . '.' . $farmer_land_pic_ext;
    $farmer_land_pic_destination = 'uploads/farmers/' . $farmer_land_pic_name;
    move_uploaded_file($farmer_land_pic, '../'.$farmer_land_pic_destination);

    $farmer_national_means_of_identity = $national_means_of_identity['tmp_name']; // get the temporary location of the file
    // get the file extension
    $farmer_national_means_of_identity_ext = explode('.', $national_means_of_identity['name']);
    $farmer_national_means_of_identity_ext = strtolower(end($farmer_national_means_of_identity_ext));
    $farmer_national_means_of_identity_name = uniqid('', true) . '.' . $farmer_national_means_of_identity_ext;
    $farmer_national_means_of_identity_destination = 'uploads/farmers/' . $farmer_national_means_of_identity_name;
    move_uploaded_file($farmer_national_means_of_identity, '../'.$farmer_national_means_of_identity_destination);

    $farmer_reciept_of_commitment = $reciept_of_commitment['tmp_name']; // get the temporary location of the file
    // get the file extension
    $farmer_reciept_of_commitment_ext = explode('.', $reciept_of_commitment['name']);
    $farmer_reciept_of_commitment_ext = strtolower(end($farmer_reciept_of_commitment_ext));
    $farmer_reciept_of_commitment_name = uniqid('', true) . '.' . $farmer_reciept_of_commitment_ext;
    $farmer_reciept_of_commitment_destination = 'uploads/farmers/' . $farmer_reciept_of_commitment_name;
    move_uploaded_file($farmer_reciept_of_commitment, '../'.$farmer_reciept_of_commitment_destination);


    $start_check_list = "INSERT INTO farmer_check_lists(farmer_id) VALUES ('$unique_id')";
    $start_check_list_query = mysqli_query($dbconnect, $start_check_list);


    $onboardfarmer = "INSERT INTO farmers(unique_id, input_crop, email, first_name, last_name, phone_number, date_of_birth, gender, disability, marital_status, did_you_have_children, numbers_of_children, is_children_in_school, average_monthly_income, other_income, land_size,land_coordinate, land_picture, upload_profile_picture, farm_location, home_address, state_of_origin, nationality, national_means_of_identity, commitment_fee, reciept_of_commitment) 
    VALUES ('$unique_id', '$email', '$first_name', '$input_crop', '$last_name', '$phone_number', '$date_of_birth', '$gender', '$disability', '$marital_status', '$did_you_have_children', '$numbers_of_children', '$is_children_in_school', '$average_monthly_income', '$other_income', '$land_size','$land_coordinate', '$farmer_land_pic_destination', '$farmer_profile_pic_destination', '$farm_location', '$home_address', '$state_of_origin', '$nationality', '$farmer_national_means_of_identity_destination', '$commitment_fee', '$farmer_reciept_of_commitment_destination')";
    $result = mysqli_query($dbconnect, $onboardfarmer);
    if ($result) {
        header('location: ../farmers.php?type=success&msg=Farmer onboarded successfully');
        exit();
    } else {
        header('location: ../farmers.php?type=error&msg=Error onboarding farmer');
        exit();
    }
}

// update farmer check list 
if (isset($_POST['update_farmer_check_list'])) {


    if (!isset($_POST['training'])) {
        $training = null;
    } else {
        $training = mysqli_real_escape_string($dbconnect, $_POST['training']);
    }
    if (!isset($_POST['land_preparation'])) {
        $land_preparation = null;
    } else {
        $land_preparation = mysqli_real_escape_string($dbconnect, $_POST['land_preparation']);
    }

    $receiveid_input = mysqli_real_escape_string($dbconnect, $_POST['receiveid_input']);
    $pre_emerg_herbicide = mysqli_real_escape_string($dbconnect, $_POST['pre_emerg_herbicide_app']);
    $planted = mysqli_real_escape_string($dbconnect, $_POST['planted']);
    $post_emerg_herbicide = mysqli_real_escape_string($dbconnect, $_POST['post_emerg_herbicide_app']);
    $fertilized = mysqli_real_escape_string($dbconnect, $_POST['fertilized']);
    $harvest = mysqli_real_escape_string($dbconnect, $_POST['harvest']);
    $farmer_id = mysqli_real_escape_string($dbconnect, $_POST['id']);

    //     find the farmer
    $find_farmer = "SELECT * FROM farmer_check_lists WHERE farmer_id = '$farmer_id'";
    $find_farmer_query = mysqli_query($dbconnect, $find_farmer);
    if (mysqli_num_rows($find_farmer_query) == 0) {
        // insert farmer check list
        $insert_farmer_check_list = "INSERT INTO farmer_check_lists(farmer_id, training, land_preparation, receiveid_input, pre_emerg_herbicide_app, planted, post_emerg_herbicide_app, fertilized, harvest) VALUES 
        ('$farmer_id', '$training', '$land_preparation', '$receiveid_input', '$pre_emerg_herbicide', '$planted', '$post_emerg_herbicide', '$fertilized', '$harvest')";
        $insert_farmer_check_list_query = mysqli_query($dbconnect, $insert_farmer_check_list);
        if ($insert_farmer_check_list_query) {
            header('location: ../farmers.php?type=success&msg=Farmer check list updated successfully');
            exit();
        } else {
            header('location: ../farmers.php?type=error&msg=Error updating farmer check list');
            exit();
        }
    } else {
        $update_farmer_check_list = "UPDATE farmer_check_lists SET training = '$training', land_preparation = '$land_preparation', receiveid_input = '$receiveid_input', pre_emerg_herbicide_app = '$pre_emerg_herbicide', planted = '$planted', post_emerg_herbicide_app = '$post_emerg_herbicide', fertilized = '$fertilized', harvest = '$harvest' WHERE farmer_id = '$farmer_id'";
        $update_farmer_check_list_query = mysqli_query($dbconnect, $update_farmer_check_list);
        if ($update_farmer_check_list_query) {
            header('location: ../farmers.php?type=success&msg=Farmer check list updated successfully');
            exit();
        } else {
            header('location: ../farmers.php?type=error&msg=Error updating farmer check list');
            exit();
        }
    }
}
