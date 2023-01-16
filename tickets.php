<?php
include "includes/config.php";
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">


<?php 
$title = 'Farmers';
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
                            <a href="farmers.php" class="btn btn-outline-secondary btn-sm"><i class="icofont-rounded-left me-2"></i>Back</a>
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Harvest History</h3>
                                <!-- arrow back -->

                                <div class="col-auto d-flex w-sm-100">
                                    <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#tickadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Histroy</button>
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
                                                <th>Farm Id</th>
                                                <th>Crop</th>
                                                <th>Harvest Date</th>
                                                <th>Total Yield - Bag(s)</th>
                                                <th>Mark-up Bag(s)</th>
                                                <th>Warehouse to be delivered to</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($farm_Activity_num) and $farm_Activity_num > 0 and isset($_GET['farm_id'])) {
                                                while ($farmActivity = mysqli_fetch_array($resultActivity)) {
                                                    $id_id = $farmActivity['id'];
                                                    $farm_id = $farmActivity['farm_id'];
                                                    $crop = $farmActivity['crop'];
                                                    $harvest_date = $farmActivity['harvest_date'];
                                                    $total_yield = $farmActivity['total_yield'];
                                                    $total_yield_rashak = $farmActivity['total_yield_rashak'];
                                                    $warehouse_to_be_delivered_to = $farmActivity['warehouse_to_be_delivered_to'];
                                                    $created_at = $farmActivity['created_at'];

                                            ?>
                                                    <tr>
                                                        <td><?php echo $farm_id; ?></td>
                                                        <td><?php echo $crop; ?></td>
                                                        <td><?php echo $harvest_date; ?></td>
                                                        <td><?php echo $total_yield; ?></td>
                                                        <td><?php echo $total_yield_rashak; ?></td>
                                                        <td><?php echo $warehouse_to_be_delivered_to; ?></td>

                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edittickit<?php echo $id_id; ?>"><i class="icofont-edit text-success"></i></button>
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteproject<?php echo $id_id; ?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Edit Tickit-->
                                                    <div class="modal fade" id="deleteproject<?php echo $id_id; ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title  fw-bold" id="deleteprojectLabel"> Delete <?php echo $name; ?> Permanently?</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="includes/process.php" method="post">
                                                                    <input type="hidden" name="id" value="<?php echo $id_id; ?>">
                                                                    <input type="hidden" name="farm_id" value="<?php echo $farm_id; ?>">
                                                                    <input type="hidden" name="redirect" value="tickets">
                                                                    <input type="hidden" name="table" value="farm_activities">
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

                                                    <div class="modal fade" id="edittickit<?php echo $id_id; ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Edit Farm Hervest</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <?php if (isset($_GET['farm_id'])) {

                                                                ?>
                                                                    <form action="includes/process.php" method="post">
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <input type="hidden" class="form-control" value="<?php echo $_GET['farm_id']; ?>" name="farm_id" id="sub">
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="deptwo" class="form-label">Crop</label>
                                                                                <input type="text" class="form-control" value="<?php echo $crop; ?>" name="crop" id="deptwo">
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="deptwo" class="form-label">Harvest Date</label>
                                                                                <input type="date" class="form-control" value="<?php echo $harvest_date; ?>" name="harvest_date" id="deptwo">
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="deptwo" class="form-label">Total Yield - Bag(s)</label>
                                                                                <input type="number" class="form-control" value="<?php echo $total_yield; ?>" name="total_yield" id="deptwo">
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="deptwo" class="form-label">Mark-up Bag(s)</label>
                                                                                <input type="number" class="form-control" value="<?php echo $total_yield_rashak; ?>" name="total_yield_rashak" id="deptwo">
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="deptwo" class="form-label">Warehouse to be delivered to</label>
                                                                                <input type="text" class="form-control" value="<?php echo $warehouse_to_be_delivered_to; ?>" name="warehouse_to_be_delivered_to" id="deptwo">
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="harvest_edit" class="btn btn-primary">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                <?php } else {
                                                                    // alert("No farm selected") and redirect to farm page
                                                                    echo "<script>alert('Please select a farm');window.location.href='projects.php' </script>";
                                                                } ?>
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
                    </div><!-- Row End -->
                </div>
            </div>

            <!-- Add Tickit-->
            <div class="modal fade" id="tickadd" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="leaveaddLabel">Farm Hervest</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <?php if (isset($_GET['farm_id'])) {

                        ?>
                            <form action="includes/process.php" method="post">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" value="<?php echo $_GET['farm_id']; ?>" name="farm_id" id="sub">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="deptwo" class="form-label">Crop</label>
                                        <input type="text" class="form-control" name="crop" id="deptwo" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="deptwo" class="form-label">Harvest Date</label>
                                        <input type="date" class="form-control" name="harvest_date" id="deptwo" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="deptwo" class="form-label">Total Yield Bag(s)</label>
                                        <input type="number" class="form-control" name="total_yield" id="deptwo" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="deptwo" class="form-label">Mark-up Bag(s)</label>
                                        <input type="number" class="form-control" name="total_yield_rashak" id="deptwo" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="deptwo" class="form-label">Warehouse to be delivered to</label>
                                        <input type="text" class="form-control" name="warehouse_to_be_delivered_to" id="deptwo" required>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="harvest_button" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        <?php } else {
                            // alert("No farm selected") and redirect to farm page
                            echo "<script>alert('Please select a farm');window.location.href='projects.php' </script>";
                        } ?>
                    </div>
                </div>
            </div>


        </div>
    </div>

   <?php include 'layout/js.php' ?>
</body>


</html>