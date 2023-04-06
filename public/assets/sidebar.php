<p class="text-center mt-5">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center">

        </div>
        <div class="col-3"></div>
    </div>
<!--    <i class="fa fa-5x text-white fa-user-circle-o"></i>-->
</p>
<?php $admin_data = $administrator->SelectWhere($_SESSION['administratorID']); ?>
<h4 class="text-center text-warning"><?=ucwords($admin_data->firstname." ".$admin_data->middlename." ".$admin_data->lastname)?></h4>


        <img width="200" height="200" class="rounded rounded-circle d-block  bg-white" src="../assets/images/pictures/<?=$admin_data->profile?>" alt="">
        <h4 class="text-center text-white"><?=strtoupper($admin_data->role)?></h4>
        <a href="manage_instructor.php" class="btn btn-sm btn-block btn-outline-info">Manage Instructors</a>
        <a href="manage_utility.php" class="btn btn-sm btn-block btn-outline-danger">Manage Utility</a>
        <a href="manage_equipments.php" class="btn btn-sm btn-block btn-outline-success">Manage Inventory</a>
        <a href="manage_report.php" class="btn btn-sm btn-block btn-outline-light">Manage Reports</a>
        <a href="manage_accepted_request.php" class="btn btn-sm btn-block btn-outline-warning">Manage Accepted Request</a>
