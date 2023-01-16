<?php
include "includes/config.php";
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php
$title = 'Assign Farmer';
include 'layout/head.php';
?>

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
                                <h3 class="fw-bold py-3 mb-0">Assign Supervisors</h3>
                                <div class="d-flex py-2 project-tab flex-wrap w-sm-100">
                                    <button type="button" class="btn btn-dark w-sm-100" data-bs-toggle="modal" data-bs-target="#createproject"><i class="icofont-plus-circle me-2 fs-6"></i>Add Supervisor</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Farmer Id</th>
                                                <th>Farmer's Name</th>
                                                <th>Supervisor's Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($supervisor) and $supervisor > 0) {
                                                while ($supervisorRow = mysqli_fetch_array($resultSupervisor)) {
                                                    // $id = $supervisorRow['id'];
                                                    // $name = $supervisorRow['name'];
                                                    $supervisorArry[$supervisorRow['id']] = $supervisorRow['name'];
                                                }
                                            }
                                            ?>
                                            <?php
                                            if (isset($farmers) and $farmers > 0) {
                                                while ($FarmersRow = mysqli_fetch_array($resultFarmers)) {
                                                    $id = $FarmersRow['id'];
                                                    $unique_id = $FarmersRow['unique_id'];
                                                    $user_id = $FarmersRow['user_id'];
                                                    $name = $FarmersRow['first_name'] . ' ' . $FarmersRow['last_name'];
                                            ?>
                                                    <tr>
                                                        <td><?php echo $unique_id; ?></td>
                                                        <td><?php echo $name; ?></td>
                                                        <td><?php echo getAssignedFarm($user_id)
                                                            ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editproject<?php echo $id; ?>"><i class="icofont-edit text-success"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <div class="modal fade" id="editproject<?php echo $id ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title  fw-bold" id="editprojectLabel"> Assign Supervisor </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="includes/process.php" method="post">
                                                                        <input type="hidden" class="form-control" name="redirect" value="assign_farms.php">
                                                                        <input type="hidden" class="form-control" name="farmer_id" value="<?php echo $unique_id ?>">
                                                                        <div class="deadline-form">
                                                                            <div class="row g-3 mb-3">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-12">
                                                                                        <label for="formFileMultipleone" class="form-label">Supervisor</label>
                                                                                        <select class="form-select" name="supervisor_id" aria-label="Default select example">
                                                                                            <option selected>Select Supervisor</option>
                                                                                            <?php
                                                                                            if (!empty($supervisorArry)) {
                                                                                                foreach ($supervisorArry as $key => $name) {
                                                                                                    echo '<option value=' . $key . '>' . $name . '</option>';
                                                                                                }
                                                                                            ?>
                                                                                            <?php

                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="ass_farm" class="btn btn-primary">Assign</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            } ?>
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
                            <h5 class="modal-title  fw-bold" id="createprojectlLabel">Add Supervisor</h5>
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
                                            <div class="col-sm-12">
                                                <label for="formFileMultipleone" class="form-label">Password</label>
                                                <input class="form-control" type="password" name="email" name="*******" id="formFileMultipleone" required>
                                            </div>
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

    <!-- Plugin Js-->
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script src="../js/template.js"></script>
    <script>
        // project data table
        $(document).ready(function() {
            $('#myProjectTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }]
                });
            $('.deleterow').on('click', function() {
                var tablename = $(this).closest('table').DataTable();
                tablename
                    .row($(this)
                        .parents('tr'))
                    .remove()
                    .draw();

            });
        });
    </script>



</body>

</html>