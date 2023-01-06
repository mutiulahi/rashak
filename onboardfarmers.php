<?php
include "includes/config.php";
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Farmers | Rashak</title>
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
                                <h3 class="fw-bold py-3 mb-0">Add Farmers</h3>
                                <div class="d-flex py-2 project-tab flex-wrap w-sm-100">
                                    <?php if ($_SESSION['id'] == 4) { ?>
                                        <button type="button" class="btn btn-dark w-sm-100" data-bs-toggle="modal" data-bs-target="#createproject"><i class="icofont-plus-circle me-2 fs-6"></i>Add Farmer</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <?php
                        if (isset($_GET['type']) && $_GET['type'] == 'success') {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> ' . $_GET['msg'] . '
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                        } ?>

                        <?php
                        if (isset($_GET['type']) && $_GET['type'] == 'error') {
                            echo '<div class="alert alert-error alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> ' . $_GET['msg'] . '
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                        } ?>
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="container">
                                        <form action="includes/process.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <h4 class="text-primary" style="font-weight: 600;">Farmer Details</h4><br><br><br>
                                                <div class="form-group col-md-6 mb-4">
                                                    <label class="mb-2" for="exampleInputEmail1">Email</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter your Email">
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
                                                                <input class="form-check-input" type="radio" name="disability" id="exampleRadios11" value="Yes">
                                                                <label class="form-check-label" for="exampleRadios11"> Yes</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="disability" id="exampleRadios22" value="No">
                                                                <label class="form-check-label" for="exampleRadios22">No </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 mb-4">
                                                    <label class="mb-2" for="exampleInputEmail1">Marital Status</label>
                                                    <select name="marital_status" class="form-control" id="">
                                                        <option>Select marital status</option>
                                                        <option value="Single">Single</option>
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
                                                <!-- <div class="form-group col-md-6 mb-4">
                                                        <label class="mb-2" for="exampleInputEmail1">Commitment Fee</label>
                                                        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="commitment_fee" placeholder="">
                                                    </div> -->
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

            <!-- Edit Project-->
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script src="../js/template.js"></script>

</body>

</html>