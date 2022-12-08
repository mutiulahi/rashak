<?php
include "includes/config.php";
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Farms</title>
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
                                <h3 class="fw-bold py-3 mb-0">Farms</h3>
                                <div class="d-flex py-2 project-tab flex-wrap w-sm-100">
                                <?php if($_SESSION['id'] == 4) { ?>
                                    <button type="button" class="btn btn-dark w-sm-100" data-bs-toggle="modal" data-bs-target="#createproject"><i class="icofont-plus-circle me-2 fs-6"></i>Add Farm</button>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12 flex-column">
                            <div class="tab-content mt-4">
                                <div class="tab-pane fade show active" id="All-list">
                                    <div class="row g-3 gy-5 py-3 row-deck">
                                        <?php
                                        if (isset($farm_details) and $farm_details > 0) {
                                            while ($farm = mysqli_fetch_array($resultFarmDetail)) {
                                                $farm_id = $farm['id'];
                                                $farm_name = $farm['name'];
                                                $farm_location = $farm['location'];
                                                $farm_size = $farm['size'];
                                                $farm_pic = $farm['picture'];
                                                $farm_description = $farm['farm_description'];
                                                $farm_date = $farm['created_at'];
                                        ?>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between mt-5">
                                                        <div class="lesson_name">
                                                            <h3 class=" fw-bold project_name fw-bold"> <?php echo $farm_name; ?></h3>
                                                            <h6 class="mb-0 small  fs-6  mb-2"><b>Location:</b> <?php echo $farm_location; ?></h6>
                                                        </div>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editproject"><i class="icofont-edit text-success"></i></button>
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteproject"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="row g-2 pt-4">
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-sand-clock"></i>
                                                                <span class="ms-2"><?php
                                                                    // display date in a human readable format
                                                                    echo date('F j, Y', strtotime($farm_date));
                                                                ?></span>
                                                            </div>
                                                        </div>
                                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                                            <div class="col-12">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="icofont-ui-text-chat"></i>
                                                                    <span class="ms-2">10</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="dividers-block"></div>
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <!-- <h4 class="small fw-bold  mb-0">Progress</h4> -->
                                                        <a href="tickets.php?farm_id=<?php echo $farm_id; ?>" target="_blank" rel="noopener noreferrer"><span class="small light-danger-bg p-2 rounded text-black"> Activities</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        } else {
                                            echo "<h3 class='text-center'>No Farm Found</h3>";
                                        }?>

                                        <!--  -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Members-->
            <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="addUserLabel">Employee Invitation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="inviteby_email">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email address" id="exampleInputEmail1" aria-describedby="exampleInputEmail1">
                                    <button class="btn btn-dark" type="button" id="button-addon2">Sent</button>
                                </div>
                            </div>
                            <div class="members_list">
                                <h6 class="fw-bold ">Employee </h6>
                                <ul class="list-unstyled list-group list-group-custom list-group-flush mb-0">
                                    <li class="list-group-item py-3 text-center text-md-start">
                                        <div class="d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row">
                                            <div class="no-thumbnail mb-2 mb-md-0">
                                                <img class="avatar lg rounded-circle" src="assets/images/xs/avatar2.jpg" alt="">
                                            </div>
                                            <div class="flex-fill ms-3 text-truncate">
                                                <h6 class="mb-0  fw-bold">Rachel Carr(you)</h6>
                                                <span class="text-muted">rachel.carr@gmail.com</span>
                                            </div>
                                            <div class="members-action">
                                                <span class="members-role ">Admin</span>
                                                <div class="btn-group">
                                                    <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="icofont-ui-settings  fs-6"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item py-3 text-center text-md-start">
                                        <div class="d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row">
                                            <div class="no-thumbnail mb-2 mb-md-0">
                                                <img class="avatar lg rounded-circle" src="assets/images/xs/avatar3.jpg" alt="">
                                            </div>
                                            <div class="flex-fill ms-3 text-truncate">
                                                <h6 class="mb-0  fw-bold">Lucas Baker<a href="#" class="link-secondary ms-2">(Resend invitation)</a></h6>
                                                <span class="text-muted">lucas.baker@gmail.com</span>
                                            </div>
                                            <div class="members-action">
                                                <div class="btn-group">
                                                    <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Members
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="icofont-check-circled"></i>

                                                                <span>All operations permission</span>
                                                            </a>

                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fs-6 p-2 me-1"></i>
                                                                <span>Only Invite & manage team</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="icofont-ui-settings  fs-6"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Delete Member</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item py-3 text-center text-md-start">
                                        <div class="d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row">
                                            <div class="no-thumbnail mb-2 mb-md-0">
                                                <img class="avatar lg rounded-circle" src="assets/images/xs/avatar8.jpg" alt="">
                                            </div>
                                            <div class="flex-fill ms-3 text-truncate">
                                                <h6 class="mb-0  fw-bold">Una Coleman</h6>
                                                <span class="text-muted">una.coleman@gmail.com</span>
                                            </div>
                                            <div class="members-action">
                                                <div class="btn-group">
                                                    <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Members
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="icofont-check-circled"></i>

                                                                <span>All operations permission</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fs-6 p-2 me-1"></i>
                                                                <span>Only Invite & manage team</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="btn-group">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="icofont-ui-settings  fs-6"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a></li>
                                                            <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a></li>
                                                            <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Suspend member</a></li>
                                                            <li><a class="dropdown-item" href="#"><i class="icofont-not-allowed fs-6 me-2"></i>Delete Member</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
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
                            <h5 class="modal-title  fw-bold" id="createprojectlLabel">Add Farm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="includes/process.php" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput77" class="form-label">Farm Name</label>
                                    <input type="text" class="form-control" name="farm_name" id="exampleFormControlInput77" placeholder="Farm Name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Farm Location</label>
                                    <input type="text" class="form-control" name="farm_location" id="exampleFormControlInput77" placeholder="Farm Location">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Farm Size</label>
                                    <input type="text" class="form-control" name="farm_size" id="exampleFormControlInput77" placeholder="Farm Size">
                                </div>
                                <div class="mb-3">
                                    <label for="formFileMultipleone" class="form-label">Project Images</label>
                                    <input class="form-control" type="file" name="farm_pic" id="formFileMultipleone" multiple>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea78" class="form-label">Description (optional)</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea78" name="farm_discription" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="add_farm" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Project-->
            <div class="modal fade" id="editproject" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="editprojectLabel"> Edit Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput78" class="form-label">Project Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput78" value="Social Geek Made">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Project Category</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>UI/UX Design</option>
                                    <option value="1">Website Design</option>
                                    <option value="2">App Development</option>
                                    <option value="3">Quality Assurance</option>
                                    <option value="4">Development</option>
                                    <option value="5">Backend Development</option>
                                    <option value="6">Software Testing</option>
                                    <option value="7">Website Design</option>
                                    <option value="8">Marketing</option>
                                    <option value="9">SEO</option>
                                    <option value="10">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple456" class="form-label">Project Images & Document</label>
                                <input class="form-control" type="file" id="formFileMultiple456">
                            </div>
                            <div class="deadline-form">
                                <form>
                                    <div class="row g-3 mb-3">
                                        <div class="col">
                                            <label for="datepickerded123" class="form-label">Project Start Date</label>
                                            <input type="date" class="form-control" id="datepickerded123" value="2021-01-10">
                                        </div>
                                        <div class="col">
                                            <label for="datepickerded456" class="form-label">Project End Date</label>
                                            <input type="date" class="form-control" id="datepickerded456" value="2021-04-10">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-12">
                                            <label class="form-label">Notifation Sent</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>All</option>
                                                <option value="1">Team Leader Only</option>
                                                <option value="2">Team Member Only</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="formFileMultipleone" class="form-label">Task Assign Person</label>
                                            <select class="form-select" multiple aria-label="Default select Priority">
                                                <option selected>Lucinda Massey</option>
                                                <option selected value="1">Ryan Nolan</option>
                                                <option selected value="2">Oliver Black</option>
                                                <option selected value="3">Adam Walker</option>
                                                <option selected value="4">Brian Skinner</option>
                                                <option value="5">Dan Short</option>
                                                <option value="5">Jack Glover</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm">
                                    <label for="formFileMultipleone" class="form-label">Priority</label>
                                    <select class="form-select" aria-label="Default select Priority">
                                        <option selected>Medium</option>
                                        <option value="1">Highest</option>
                                        <option value="2">Low</option>
                                        <option value="3">Lowest</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea786" class="form-label">Description (optional)</label>
                                <textarea class="form-control" id="exampleFormControlTextarea786" rows="3">Social Geek Made,lorem urna commodo sem. Pellentesque venenatis leo quam, sed mattis sapien lobortis ut. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                        </textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                            <button type="button" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal  Delete Folder/ File-->
            <div class="modal fade" id="deleteproject" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="deleteprojectLabel"> Delete item Permanently?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body justify-content-center flex-column d-flex">
                            <i class="icofont-ui-delete text-danger display-2 text-center mt-2"></i>
                            <p class="mt-4 fs-5 text-center">You can only delete this item Permanently</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger color-fff">Delete</button>
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