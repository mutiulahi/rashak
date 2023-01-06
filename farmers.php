<?php
include "includes/config.php";
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Farmers</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>

<body>

    <div id="mytask-layout" class="theme-indigo">

        <!-- sidebar -->
        <?php include "layout/nav.php"; ?>
        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <?php include "layout/header.php"; ?>

            <!-- Body: Body -->
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header p-0 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold py-3 mb-0">Farmers</h3>
                                <div class="d-flex py-2 project-tab flex-wrap w-sm-100">
                                    <?php if ($_SESSION['id'] == 4) { ?>
                                        <!-- <button type="button" class="btn btn-dark w-sm-100"  data-bs-target="#createproject"><i class="icofont-plus-circle me-2 fs-6"></i>Add Farmer</button>                                 -->
                                        <a href="onboardfarmers.php" type="a" class="btn btn-dark w-sm-100" data-bs-target="#createproject"><i class="icofont-plus-circle me-2 fs-6"></i>Add Farmer</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <!-- alart -->
                                    <?php
                                    if (isset($_GET['type']) && $_GET['type'] == 'success') {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> ' . $_GET['msg'] . '
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                    } ?>
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Input Crop</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($farmers) and $farmers > 0) {
                                                while ($FarmersRow = mysqli_fetch_array($resultFarmers)) {
                                                    $id_id = $FarmersRow['id'];
                                                    $id = $FarmersRow['unique_id'];
                                                    $name = $FarmersRow['last_name'] . ' ' . $FarmersRow['first_name'];
                                                    $email = $FarmersRow['email'];
                                                    $input_crop = $FarmersRow['input_crop'];
                                                    $phone = $FarmersRow['phone_number'];
                                                    $date_of_birth = $FarmersRow['date_of_birth'];
                                                    $gender = $FarmersRow['gender'];
                                                    $disability = $FarmersRow['disability'];
                                                    $marital_status = $FarmersRow['marital_status'];
                                                    $have_children = $FarmersRow['did_you_have_children'];
                                                    $numbers_of_children = $FarmersRow['numbers_of_children'];
                                                    $is_children_in_school = $FarmersRow['is_children_in_school'];
                                                    $average_monthly_income = $FarmersRow['average_monthly_income'];
                                                    $other_income = $FarmersRow['other_income'];
                                                    $land_size = $FarmersRow['land_size'];
                                                    $land_coordinate = $FarmersRow['land_coordinate'];
                                                    $land_picture = $FarmersRow['land_picture'];
                                                    $upload_profile_picture = $FarmersRow['upload_profile_picture'];
                                                    $farm_location = $FarmersRow['farm_location'];
                                                    $home_address = $FarmersRow['home_address'];
                                                    $state_of_origin = $FarmersRow['state_of_origin'];
                                                    $nationality = $FarmersRow['nationality'];
                                                    $national_means_of_identity = $FarmersRow['national_means_of_identity'];
                                                    $commitment_fee = $FarmersRow['commitment_fee'];
                                                    $reciept_of_commitment = $FarmersRow['reciept_of_commitment'];
                                            ?>
                                                    <tr>
                                                        <td><?php echo $id; ?></td>
                                                        <td><?php echo $name; ?></td>
                                                        <td><?php echo $email; ?></td>
                                                        <td><?php echo $input_crop; ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editproject<?php echo substr($id, -2); ?>"><i class="icofont-edit text-success"></i></button>
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#checklist<?php echo substr($id, -2); ?>">monitor field</button>
                                                                <a href="tickets.php?farm_id=<?php echo $id; ?>" class="btn btn-outline-secondary">harvest</a>
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#details<?php echo substr($id, -2); ?>">view</button>
                                                                <button type="button" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#deleteproject<?php echo substr($id, -2); ?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="editproject<?php echo substr($id, -2); ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title  fw-bold" id="editprojectLabel"> Edit Farmar</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="includes/process.php" method="post" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <h4 class="text-primary" style="font-weight: 600;">Farmer Details</h4><br><br><br>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Email</label>
                                                                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $email; ?>" aria-describedby="emailHelp" placeholder="Enter your Email">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">First Name</label>
                                                                                <input type="text" class="form-control" id="exampleInputEmail1" name="first_name" aria-describedby="emailHelp" placeholder="Enter First Name">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Last Name</label>
                                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="last_name" placeholder="Enter Last Name">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Phone Number</label>
                                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone_number" placeholder="Enter Phone Number">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Date Of Birth</label>
                                                                                <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="date_of_birth" placeholder="Enter Date Of Birth">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Enter type of Crop</label>
                                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="input_crop" placeholder="Enter Crop">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Gender</label>
                                                                                <select name="gender" id="" class="form-control">
                                                                                    <option>Select your gender</option>
                                                                                    <option value="Male">Male</option>
                                                                                    <option value="Female">Female</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="form-label">Disability</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" <?php if ($disability == 'Yes') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?> type="radio" name="disability" id="exampleRadios11" value="Yes">
                                                                                            <label class="form-check-label" for="exampleRadios11"> Yes</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" <?php if ($disability == 'No') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?> type="radio" name="disability" id="exampleRadios22" value="No">
                                                                                            <label class="form-check-label" for="exampleRadios22">No </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Marital Status</label>
                                                                                <select name="marital_status" class="form-control" id="">
                                                                                    <option>Select marital status</option>
                                                                                    <option <?php if ($disability == 'Single') {
                                                                                                echo 'selected';
                                                                                            } ?> value="Single">Single</option>
                                                                                    <option value="Married">Married</option>
                                                                                    <option value="Divorced">Divorced</option>
                                                                                    <option value="Widowed">Widowed</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6 form-group col-md-6 mb-4">
                                                                                <label class="form-label">Do you have children</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="radio" name="did_you_have_children" id="exampleRadios11" value="Yes">
                                                                                            <label class="form-check-label" for="exampleRadios11"> Yes</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="radio" name="did_you_have_children" id="exampleRadios22" value="No">
                                                                                            <label class="form-check-label" for="exampleRadios22">No </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Numbers of Children</label>
                                                                                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="numbers_of_children" placeholder="Numbers of Children">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Are your children enrolled in school</label>
                                                                                <select name="is_children_in_school" class="form-control" id="">
                                                                                    <option>Select your option</option>
                                                                                    <option value="Yes private school">Yes private school</option>
                                                                                    <option value="Yes public school">Yes public school</option>
                                                                                    <option value="No not in school">No</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Average monthly income (₦)</label>
                                                                                <input type="number" min="1000.00" step="0.01" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="average_monthly_income" placeholder="Enter average montly income">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Any source of income apart from agriculture? If yes state it here</label>
                                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="other_income" placeholder="Do you have any other source of income apart from agriculture?">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Land size (Archers)</label>
                                                                                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="land_size" placeholder="Enter Land size">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Land coordinate <code>e.g 20x10</code></label>
                                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="land_coordinate" placeholder="Enter Land coordinate">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Land picture</label>
                                                                                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="land_picture" placeholder="upload land picture">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Upload your profile picture</label>
                                                                                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="profile_picture" placeholder="Upload profile Picture">
                                                                            </div>

                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Farm location</label>
                                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="farm_location" placeholder="Enter Farm location">
                                                                            </div>

                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Home address</label>
                                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria- zdescribedby="emailHelp" name="home_address" placeholder="Enter Home Address">
                                                                            </div>

                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">State of origin</label>
                                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="state_of_origin" placeholder="Enter state of origin">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Natonality</label>
                                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nationality" placeholder="Enter name of Country">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Upload National means of identity</label>
                                                                                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="national_means_of_identity" placeholder="Upload National means of identity">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-4">
                                                                                <label class="mb-2" for="exampleInputEmail1">Resciept of commitment Fee</label>
                                                                                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="reciept_of_commitment" placeholder="Upload commitment fee reciept">
                                                                            </div>
                                                                            <button class="btn btn-primary" name="onboardfarmer"> Submit</button>
                                                                            <!-- </div> -->
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="deleteproject<?php echo substr($id, -2); ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title  fw-bold" id="deleteprojectLabel"> Delete <?php echo $name; ?> Permanently?</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="includes/process.php" method="post">
                                                                    <input type="hidden" name="id" value="<?php echo $id_id; ?>">
                                                                    <input type="hidden" name="redirect" value="farmers">
                                                                    <input type="hidden" name="table" value="farmers">
                                                                    <div class="modal-body justify-content-center flex-column d-flex">
                                                                        <i class="icofont-ui-delete text-danger display-2 text-center mt-2"></i>
                                                                        <p class="mt-4 fs-5 text-center"> Are you sure of this Action </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit" name="delete" class="btn btn-danger text-white">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="editproject<?php echo substr($id, -2); ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title  fw-bold" id="editprojectLabel"> Edit Farmar</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="includes/process.php" method="post">
                                                                        <input type="hidden" class="form-control" name="redirect" value="farmers.php">
                                                                        <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
                                                                        <div class="deadline-form">
                                                                            <div class="row g-3 mb-3">
                                                                                <div class="col-sm-12">
                                                                                    <label class="form-label">Name</label>
                                                                                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" id="exampleFormControlInput77" placeholder="Fullname">
                                                                                    <div class="col-sm-12">
                                                                                        <label for="formFileMultipleone" class="form-label">Email</label>
                                                                                        <input class="form-control" type="email" value="<?php echo $email; ?>" name="email" id="formFileMultipleone" multiple>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="edit_user" class="btn btn-primary">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- check list -->
                                                    <div class="modal fade" id="checklist<?php echo substr($id, -2); ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title  fw-bold" id="editprojectLabel">Farmar's Check List</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="includes/process.php" method="post">
                                                                        <input type="hidden" class="form-control" name="redirect" value="farmers.php">
                                                                        <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
                                                                        <div class="deadline-form">
                                                                            <div class="row g-3 mb-3">
                                                                                <div class="col-sm-12">
                                                                                    <?php
                                                                                    $sql = "SELECT * FROM farmer_check_lists WHERE farmer_id = '$id'";
                                                                                    $result = mysqli_query($dbconnect, $sql);
                                                                                    while ($result_data =  mysqli_fetch_array($result)) {
                                                                                        $training = $result_data['training'];
                                                                                        $land_preparation = $result_data['land_preparation'];
                                                                                        $receiveid_input = $result_data['receiveid_input'];
                                                                                        $pre_emerg_herbicide = $result_data['pre_emerg_herbicide_app'];
                                                                                        $planted = $result_data['planted'];
                                                                                        $post_emerg_herbicide = $result_data['post_emerg_herbicide_app'];
                                                                                        $fertilized = $result_data['fertilized'];
                                                                                        $harvest = $result_data['harvest'];
                                                                                    }
                                                                                    if (empty($training)) {
                                                                                        $training = 'No';
                                                                                    }
                                                                                    if (empty($land_preparation)) {
                                                                                        $land_preparation = 'No';
                                                                                    }
                                                                                    ?>

                                                                                    <div class="col-sm-12 mb-3">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" <?php if ($training == 'Yes') {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?> name="training" id="exampleRadios11" value="Yes">
                                                                                            <label class="form-check-label" for="exampleRadios11">Training</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-12 mb-3">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" <?php if ($land_preparation == 'Yes') {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?> name="land_preparation" id="exampleRadios11" value="Yes">
                                                                                            <label class="form-check-label" for="exampleRadios11">Land preparation</label>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-sm-12 mb-3">
                                                                                        <label for="formFileMultipleone" class="form-label">Received input date</label>
                                                                                        <input type="date" class="form-control" value="<?php echo $receiveid_input; ?>" name="receiveid_input" id="">
                                                                                    </div>
                                                                                    <div class="col-sm-12 mb-3">
                                                                                        <label for="formFileMultipleone" class="form-label">Pre Emergence Herbicide Application Data</label>
                                                                                        <input type="date" class="form-control" value="<?php echo $pre_emerg_herbicide; ?>" name="pre_emerg_herbicide_app" id="">
                                                                                    </div>
                                                                                    <div class="col-sm-12 mb-3">
                                                                                        <label for="formFileMultipleone" class="form-label">Planted date</label>
                                                                                        <input type="date" class="form-control" value="<?php echo $planted; ?>" name="planted" id="">
                                                                                    </div>
                                                                                    <div class="col-sm-12 mb-3">
                                                                                        <label for="formFileMultipleone" class="form-label">Post Emergence Herbicide Application Data</label>
                                                                                        <input type="date" class="form-control" value="<?php echo $post_emerg_herbicide; ?>" name="post_emerg_herbicide_app" id="">
                                                                                    </div>
                                                                                    <div class="col-sm-12 mb-3">
                                                                                        <label for="formFileMultipleone" class="form-label">Fertilized Date</label>
                                                                                        <input type="date" class="form-control" value="<?php echo $fertilized; ?>" name="fertilized" id="">
                                                                                    </div>
                                                                                    <div class="col-sm-12 mb-3">
                                                                                        <label for="formFileMultipleone" class="form-label">Harvest Date</label>
                                                                                        <input type="date" class="form-control" value="<?php echo $harvest; ?>" name="harvest" id="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="update_farmer_check_list" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- details -->
                                                    <div class="modal fade" id="details<?php echo substr($id, -2); ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title  fw-bold" id="editprojectLabel">Farmer Info Details</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <!-- farmer details -->
                                                                <div class="modal-body p-0">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <div class="d-flex align-items-center">
                                                                                                <div class="flex-shrink-0 me-3">
                                                                                                    <img src="<?php echo $upload_profile_picture; ?>" alt="Farmer pictures" class="rounded-circle" width="50">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Name</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $name; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Email</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $email; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Phone Number</label>
                                                                                                        <span class="text-muted"><?php echo $phone; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Date of Birth</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $date_of_birth; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Gender</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $gender; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Marital Status</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $marital_status; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Do you have children</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $have_children; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Number of Children </label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $numbers_of_children; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Are your children enrolled in school</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $is_children_in_school; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Average monthly income</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $average_monthly_income; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Do you have any other source of income apart from agriculture</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $other_income; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Land Size</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $land_size; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Land coordinate</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $land_coordinate; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Home address</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $home_address; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Farm location</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $farm_location; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">State of origin</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $state_of_origin; ?></span>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="formFileMultipleone" class="form-label">Nationality</label>
                                                                                                        <span class="text-muted fw-bold"><?php echo $nationality; ?></span>
                                                                                                    </div>

                                                                                                    <!-- view image and documents -->
                                                                                                    <div class="row">
                                                                                                        <div class="card col-md-6">
                                                                                                            <iframe src="<?php echo $national_means_of_identity; ?>" width="100%" height="200px"></iframe>
                                                                                                            <div class="card-body">
                                                                                                                <span class="card-title">Upload national means of identification</span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="card col-md-6">
                                                                                                            <iframe src="<?php echo $land_picture; ?>" width="100%" height="200px"></iframe>
                                                                                                            <div class="card-body">
                                                                                                                <span class="card-title fw-bold">Land picture</span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="card col-md-6">
                                                                                                            <iframe src="<?php echo $commitment_fee; ?>" width="100%" height="200px"></iframe>
                                                                                                            <div class="card-body">
                                                                                                                <span class="card-title fw-bold">Commitment fee</span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="card col-md-6">
                                                                                                            <iframe src="<?php echo $reciept_of_commitment; ?>" width="100%" height="200px"></iframe>
                                                                                                            <div class="card-body">
                                                                                                                <span class="card-title fw-bold">Receipt of commitment fee</span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            <?php
                                                        }
                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Create Project-->
            <div class="modal fade" id="createproject" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="createprojectlLabel">Add Farmer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="includes/process.php" method="post">
                                <div class="deadline-form">
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-12">
                                            <label class="form-label">Name</label>
                                            <input type="hidden" class="form-control" name="redirect" value="supervisor.php">
                                            <input type="hidden" class="form-control" name="role" value="2">
                                            <input type="text" class="form-control" name="name" id="exampleFormControlInput77" placeholder="Fullname" required>
                                            <div class="col-sm-12">
                                                <label for="formFileMultipleone" class="form-label">Email</label>
                                                <input class="form-control" type="email" name="email" name="Enter you email" id="formFileMultipleone" required>
                                            </div>
                                            <!-- <div class="col-sm-12"> -->
                                            <!-- <label for="formFileMultipleone" class="form-label">Password</label> -->
                                            <input class="form-control" type="hidden" value="okay" name="password" id="formFileMultipleone" required>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="add_user" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script src="../js/template.js"></script>

</body>

</html>