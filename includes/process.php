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

    '../' . // insert to db in farm_details
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
if (isset($_POST['harvest_button'])) {
    // Get form data and store in variables also sanitize data
    $farm_id = mysqli_real_escape_string($dbconnect, $_POST['farm_id']);
    $crop = mysqli_real_escape_string($dbconnect, $_POST['crop']);
    $harvest_date = mysqli_real_escape_string($dbconnect, $_POST['harvest_date']);
    $total_yield = mysqli_real_escape_string($dbconnect, $_POST['total_yield']);
    $total_yield_rashak = mysqli_real_escape_string($dbconnect, $_POST['total_yield_rashak']);
    $warehouse_to_be_delivered_to = mysqli_real_escape_string($dbconnect, $_POST['warehouse_to_be_delivered_to']);
    // $status = 1;

    // insert to db in farm_details
    $farm_activity = "INSERT INTO farm_activities (farm_id, crop, harvest_date, total_yield, total_yield_rashak, warehouse_to_be_delivered_to, status) VALUES ('$farm_id', '$crop', '$harvest_date', '$total_yield', '$total_yield_rashak', '$warehouse_to_be_delivered_to', '1')";
    $result = mysqli_query($dbconnect, $farm_activity);
    if ($result) {
        header('location: ../tickets.php?farm_id=' . $farm_id . '&type=success&msg=Farm activity added successfully');
        exit();
    } else {
        header('location: ../tickets.php?farm_id=' . $farm_id . '&type=error&msg=Error adding farm activity');
        exit();
    }
}

// add new farm activity
if (isset($_POST['harvest_edit'])) {
    // Get form data and store in variables also sanitize data
    $farm_id = mysqli_real_escape_string($dbconnect, $_POST['farm_id']);
    $crop = mysqli_real_escape_string($dbconnect, $_POST['crop']);
    $harvest_date = mysqli_real_escape_string($dbconnect, $_POST['harvest_date']);
    $total_yield = mysqli_real_escape_string($dbconnect, $_POST['total_yield']);
    $total_yield_rashak = mysqli_real_escape_string($dbconnect, $_POST['total_yield_rashak']);
    $warehouse_to_be_delivered_to = mysqli_real_escape_string($dbconnect, $_POST['warehouse_to_be_delivered_to']);
    $status = 1;

    // edit to db in farm_details
    $farm_activity = "UPDATE farm_activities SET `crop` = '$crop', `harvest_date` = '$harvest_date', `total_yield` = '$total_yield', `total_yield_rashak` = '$total_yield_rashak', `warehouse_to_be_delivered_to` = '$warehouse_to_be_delivered_to' WHERE `farm_id` = '$farm_id'";

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
    $supervisor_id = mysqli_real_escape_string($dbconnect, $_POST['supervisor_id']);
    $farmer_id = mysqli_real_escape_string($dbconnect, $_POST['farmer_id']);
    $redirect = mysqli_real_escape_string($dbconnect, $_POST['redirect']);

    // update farm_users table
    $update = "UPDATE farmers SET user_id = '$supervisor_id' WHERE unique_id = '$farmer_id'";
    $result = mysqli_query($dbconnect, $update);
    if ($result) {
        header('location: ../' . $redirect . '?type=success&msg=User assigned to farm successfully');
        exit();
    } else {
        header('location: ../' . $redirect . '?type=error&msg=Error assigning user to farm');
        exit();
    }
}

// start farmer onboardfarmer
if (isset($_POST['onboardfarmer'])) {
    if ($_SESSION['id'] == 1) {
        $user_id = null;
    } else {
        $user_id = $_SESSION['auth_id'];
    }

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
    $allow_ext = array('jpg', 'jpeg', 'png');
    if (in_array($farmer_profile_pic_ext, $allow_ext)) {
        move_uploaded_file($farmer_profile_pic, '../' . $farmer_profile_pic_destination);
    } else {
        header('location: ../onboardfarmers.php?type=error&msg=Error uploading profile picture, only jpg, jpeg and png files are allowed');
        exit();
    }

    $farmer_land_pic = $land_picture['tmp_name']; // get the temporary location of the file
    // get the file extension
    $farmer_land_pic_ext = explode('.', $land_picture['name']);
    $farmer_land_pic_ext = strtolower(end($farmer_land_pic_ext));
    $farmer_land_pic_name = uniqid('', true) . '.' . $farmer_land_pic_ext;
    $farmer_land_pic_destination = 'uploads/farmers/' . $farmer_land_pic_name;
    $allow_ext = array('jpg', 'jpeg', 'png');
    if (in_array($farmer_land_pic_ext, $allow_ext)) {
        move_uploaded_file($farmer_land_pic, '../' . $farmer_land_pic_destination);
    } else {
        header('location: ../onboardfarmers.php?type=error&msg=Error uploading land picture, only jpg, jpeg and png files are allowed');
        exit();
    }

    $farmer_national_means_of_identity = $national_means_of_identity['tmp_name']; // get the temporary location of the file
    // get the file extension
    $farmer_national_means_of_identity_ext = explode('.', $national_means_of_identity['name']);
    $farmer_national_means_of_identity_ext = strtolower(end($farmer_national_means_of_identity_ext));
    $farmer_national_means_of_identity_name = uniqid('', true) . '.' . $farmer_national_means_of_identity_ext;
    $farmer_national_means_of_identity_destination = 'uploads/farmers/' . $farmer_national_means_of_identity_name;
    $allow_ext = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx');
    if (in_array($farmer_national_means_of_identity_ext, $allow_ext)) {
        move_uploaded_file($farmer_national_means_of_identity, '../' . $farmer_national_means_of_identity_destination);
    } else {
        header('location: ../onboardfarmers.php?type=error&msg=Error uploading national means of identity, only pdf, doc, docx, jpg, jpeg, png are allowed');
        exit();
    }

    $farmer_reciept_of_commitment = $reciept_of_commitment['tmp_name']; // get the temporary location of the file
    // get the file extension
    $farmer_reciept_of_commitment_ext = explode('.', $reciept_of_commitment['name']);
    $farmer_reciept_of_commitment_ext = strtolower(end($farmer_reciept_of_commitment_ext));
    $farmer_reciept_of_commitment_name = uniqid('', true) . '.' . $farmer_reciept_of_commitment_ext;
    $farmer_reciept_of_commitment_destination = 'uploads/farmers/' . $farmer_reciept_of_commitment_name;
    $allow_ext = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx');
    if (in_array($farmer_reciept_of_commitment_ext, $allow_ext)) {
        move_uploaded_file($farmer_reciept_of_commitment, '../' . $farmer_reciept_of_commitment_destination);
    } else {
        header('location: ../onboardfarmers.php?type=error&msg=Error uploading reciept of commitment, only pdf, doc, docx, jpg, jpeg, png are allowed');
        exit();
    }


    $start_check_list = "INSERT INTO farmer_check_lists(farmer_id) VALUES ('$unique_id')";
    $start_check_list_query = mysqli_query($dbconnect, $start_check_list);


    $onboardfarmer = "INSERT INTO farmers(unique_id, user_id, input_crop, email, first_name, last_name, phone_number, date_of_birth, gender, disability, marital_status, did_you_have_children, numbers_of_children, is_children_in_school, average_monthly_income, other_income, land_size,land_coordinate, land_picture, upload_profile_picture, farm_location, home_address, state_of_origin, nationality, national_means_of_identity, commitment_fee, reciept_of_commitment) 
    VALUES ('$unique_id','$user_id','$input_crop', '$email', '$first_name',  '$last_name', '$phone_number', '$date_of_birth', '$gender', '$disability', '$marital_status', '$did_you_have_children', '$numbers_of_children', '$is_children_in_school', '$average_monthly_income', '$other_income', '$land_size','$land_coordinate', '$farmer_land_pic_destination', '$farmer_profile_pic_destination', '$farm_location', '$home_address', '$state_of_origin', '$nationality', '$farmer_national_means_of_identity_destination', '$commitment_fee', '$farmer_reciept_of_commitment_destination')";
    $result = mysqli_query($dbconnect, $onboardfarmer);
    if ($result) {
        header('location: ../farmers.php?type=success&msg=Farmer onboarded successfully');
        exit();
    } else {
        header('location: ../farmers.php?type=error&msg=Error onboarding farmer');
        exit();
    }
}


// delete from any table and redirect to page 
if (isset($_POST['delete'])) {

    $table = mysqli_real_escape_string($dbconnect, $_POST['table']);
    $id = mysqli_real_escape_string($dbconnect, $_POST['id']);
    $redirect = mysqli_real_escape_string($dbconnect, $_POST['redirect']);
    $delete = "DELETE FROM $table WHERE id = '$id'";
    $delete_query = mysqli_query($dbconnect, $delete);

    if (isset($_POST['farm_id'])) {
        $location_success = '../' . $redirect . '.php?farm_id=' . $_POST['farm_id'] . '&type=success&msg=Deleted successfully';
        $location_error = '../' . $redirect . '.php?farm_id=' . $_POST['farm_id'] . '&type=error&msg=Error deleting';
    } else {

        $location_success = '../' . $redirect . '.php?type=success&msg=Deleted successfully';
        $location_error = '../' . $redirect . '.php?type=error&msg=Error deleting';
    }
    if ($delete_query) {
        header('location: ' . $location_success);
        exit();
    } else {
        header('location: ' . $location_error);
        exit();
    }
}

// update farmer check list 
if (isset($_POST['check_list'])) {


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
    $harvest = mysqli_real_escape_string($dbconnect, $_POST['harvest']);
    $weeding = mysqli_real_escape_string($dbconnect, $_POST['weeding']);
    $watering = mysqli_real_escape_string($dbconnect, $_POST['watering']);
    $first_fertilized = mysqli_real_escape_string($dbconnect, $_POST['first_fertilized']);
    $second_fertilized = mysqli_real_escape_string($dbconnect, $_POST['second_fertilized']);
    $farmer_id = mysqli_real_escape_string($dbconnect, $_POST['id']);


    $allowed = array('jpg', 'jpeg', 'png');
    foreach ($_FILES as $key => $file) {
        if ($file['size'] > 0) {
            $file_name =  strtolower(uniqid() . $file['name']);
            $file_type = $key;
            $file_temp = $file['tmp_name'];
            $file_destination = '../uploads/activity/' . $file_name;
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);
            if (!in_array($file_extension, $allowed)) {
                $file_error[] = $file_type;
            } else {
                move_uploaded_file($file_temp, $file_destination);
                $documents[$file_type] =  $file_name;
            }
        }
    }

    // get the jsson doc in the database and update it 
    $get_json = "SELECT documents FROM farmer_check_lists WHERE farmer_id = '$farmer_id'";
    $get_json_query = mysqli_query($dbconnect, $get_json);
    $get_json_result = mysqli_fetch_assoc($get_json_query);
    $json = $get_json_result['documents'];
    if ($json != null) {
        $json = json_decode($json, true);
        foreach ($documents as $key => $value) {
            if (array_key_exists($key, $json)) {
                $json[$key] = $value;
            } else {
                $json[$key] = $value;
            }
        }
    } else {
        $json = $documents;
    }

    if (isset($json)) {
        $json = json_encode($json);
    } else {
        $json = null;
    }

    // //     find the farmer
    $find_farmer = "SELECT * FROM farmer_check_lists WHERE farmer_id = '$farmer_id'";
    $find_farmer_query = mysqli_query($dbconnect, $find_farmer);
    if (mysqli_num_rows($find_farmer_query) == 0) {
        // insert farmer check list
        $insert_farmer_check_list = "INSERT INTO farmer_check_lists(farmer_id, training, land_preparation, receiveid_input, pre_emerg_herbicide_app, planted, post_emerg_herbicide_app, first_fertilized, second_fertilized, harvest, weeding, watering, documents) VALUES 
        ('$farmer_id', '$training', '$land_preparation', '$receiveid_input', '$pre_emerg_herbicide', '$planted', '$post_emerg_herbicide', '$first_fertilized', '$second_fertilized', '$harvest', '$weeding', '$watering', '$json')";
        $insert_farmer_check_list_query = mysqli_query($dbconnect, $insert_farmer_check_list);
        if ($insert_farmer_check_list_query) {
            header('location: ../farmers.php?type=success&msg=Farmer check list updated successfully');
            exit();
        } else {
            header('location: ../farmers.php?type=error&msg=Error updating farmer check list');
            exit();
        }
    } else {
        $update_farmer_check_list = "UPDATE farmer_check_lists SET training = '$training', land_preparation = '$land_preparation', receiveid_input = '$receiveid_input', pre_emerg_herbicide_app = '$pre_emerg_herbicide', planted = '$planted', post_emerg_herbicide_app = '$post_emerg_herbicide', first_fertilized = '$first_fertilized', second_fertilized = '$second_fertilized', harvest = '$harvest', weeding = '$weeding', watering = '$watering', documents = '$json' WHERE farmer_id = '$farmer_id'";
        $update_farmer_check_list_query = mysqli_query($dbconnect, $update_farmer_check_list);
        if ($update_farmer_check_list_query) {
            header('location: ../farmers.php?type=success&msg=Farmer check list updated successfully');
            exit();
        } else {
            header('location: ../farmers.php?type=error&msg=Error updating farmer check list');
            exit();
        }
    }

    // file upload error handling 
    if (isset($file_error)) {
        $file_error = implode(', ', $file_error);
        header('location: ../farmers.php?type=error&msg=Error uploading ' . $file_error . ' file only jpg, jpeg, png allowed');
        exit();
    }
}
