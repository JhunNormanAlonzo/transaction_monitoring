<?php
    if (!isset($_SESSION['administratorID'])){
        echo "<script>alert('Login First!'); window.location.href='../index.php'</script>";
    }

    if (isset($_POST['logout'])){
        unset($_SESSION['administratorID']);
        echo "<script>window.location.href='../index.php'</script>";
    }

    $admin_notifs = $notification->SelectWhereIdNumber($admin_data->username);

    $instructor_request_borrow_items = $administrator_equipment->SelectInstructorBorrowItemsNotApprove();

    if (isset($_POST['acceptRequest'])){
        $request_id = $_POST['request_id'];

        $bc = $_POST['eq_barcode'];
        $equipment_data = $master_equipment->SelectWhereBarcode($bc);
        date_default_timezone_set("Asia/Manila");
        $today = date("Y-m-d H:i:s");
        if ($administrator_equipment->AcceptRequest($request_id, $today)){

            $equipment_to_borrow_data = $master_equipment->SelectEquipmentToBorrowWhere($request_id);
//            die(json_encode($equipment_to_borrow_data));
            $name = $equipment_data->name;
            $brand = $equipment_data->brand;
            $type = $equipment_data->type;
            $model = $equipment_data->model;
            $pic1 = $equipment_data->pic1;
            $pic2 = $equipment_data->pic2;
            $pic3 = $equipment_data->pic3;
            $pic4 = $equipment_data->pic4;
            $item_code = $equipment_data->barcode;
            $borrower_id = $equipment_to_borrow_data->user_id_borrower;
            $qty = $_POST['quantity'];
            $date_accepted = $equipment_to_borrow_data->date_accepted;
            $date_to_return = $equipment_to_borrow_data->date_to_return;
            $date_to_pick = $equipment_to_borrow_data->date_to_pick;
            $array = array($item_code, $name, $brand, $type, $model, $pic1, $pic2, $pic3, $pic4, $bc, $borrower_id, $qty, $date_accepted, $date_to_pick, $date_to_return);



            $utilities = $utility->Select();
//            die(json_encode($utilities));
            foreach ($utilities as $ut){
                $arrs = array($ut->username, "You have borrow request from Department.");
                $notification->Add($arrs);
            }

            if ($master_equipment->AddToRelease($array)){
                echo "<script>alert('Equipment Accepted Successfully!'); window.location.href='manage_equipments.php'</script>";
            }
        }
    }

    if (isset($_POST['cancelRequest'])){
        $request_id = $_POST['request_id'];
    }


    if (isset($_POST['updatePassword'])){
        $data = $administrator->SelectWhere($_SESSION['administratorID']);
        $data_password = $data->password;
        $original_password = $_POST['original_password'];
        if ($data_password == $original_password){
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            if ($new_password == $confirm_password){
                $id = $_SESSION['administratorID'];
                $array = array($new_password);
                if ($administrator->UpdatePassword($array, $id)){
                    echo "<script>alert('password updated successfully!'); window.location.href='index.php'</script>";
                }
            }else{
                echo "<script>alert('password do not match!'); window.location.href='index.php'</script>";
            }
        }else{
            echo "<script>alert('password incorrect!'); window.location.href='index.php'</script>";
        }

    }



    $administrator_data = $administrator->SelectWhere($_SESSION['administratorID']);



    if (isset($_POST['updateInfo'])) {
        $id = $_SESSION['administratorID'];

        $un = $_POST['username'];
        $pass = $_POST['password'];


        $validate = $administrator->SelectWhere($id);
        if ($validate->username == $un && $validate->password == $pass){
            $birthday = $_POST['birthday'];
            $contact_no = $_POST['contact_no'];
            $address = $_POST['address'];
            $lastname = $_POST['lastname'];
            $middlename = $_POST['middlename'];
            $firstname = $_POST['firstname'];

            $oprofile = $administrator_data->profile;
            $opicture_front = $administrator_data->picture_front;
            $opicture_back = $administrator_data->picture_back;

            $profile = $_FILES['profile']['size'] == 0 ? $oprofile : $filemanager->InsertPicture($_FILES['profile']);
            $front = $_FILES['front']['size'] == 0 ? $opicture_front : $filemanager->InsertPicture($_FILES['front']);
            $back = $_FILES['back']['size'] == 0 ? $opicture_back : $filemanager->InsertPicture($_FILES['back']);

            if ($_FILES['profile']['size'] != 0){
                if (file_exists("../assets/images/pictures/".$oprofile)){unlink("../assets/images/pictures/".$oprofile);}
            }

            if ($_FILES['front']['size'] != 0){
                if (file_exists("../assets/images/pictures/".$opicture_front)){unlink("../assets/images/pictures/".$opicture_front);}
            }

            if ($_FILES['back']['size'] != 0){
                if (file_exists("../assets/images/pictures/".$opicture_back)){unlink("../assets/images/pictures/".$opicture_back);}
            }


            $array = array($firstname, $middlename, $lastname, $address, $contact_no, $birthday, $profile, $front, $back);
            if ($administrator->Update($array, $id)){

                echo "<script>alert('Information Updated Successfully!'); window.location.href='index.php'</script>";
            }
        }else{
            echo "<script>alert('Username or Password  Incorrect!'); window.location.href='index.php'</script>";
        }
    }

$notifStatus = "";

$results = $notification->validateIfSeen($administrator_data->username);

if ($results){
    foreach ($results as $result){
        if ($result->status == "N"){
            $notifStatus = "Y";
            break;
        }
    
    }

}




if (isset($_POST['assistantRegister'])) {
    $password = $_POST['password'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        echo "<script>alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.'); window.location.href='index.php'</script>";
    }else {
        $confirm_password = $_POST['confirm_password'];
        if ($password == $confirm_password) {
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $address = $_POST['address'];
            $contact_no = $_POST['contact_no'];
            $birthday = $_POST['birthday'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $profile = $filemanager->InsertPicture($_FILES['profile']);
            $front = $filemanager->InsertPicture($_FILES['front']);
            $back = $filemanager->InsertPicture($_FILES['back']);

            $array = array($fname, $mname, $lname, $address,$contact_no, $birthday, $username, $password, $profile, $front, $back, "assistant administrator");
            if ($administrator->AddAssistant($array)) {
                echo "<script>alert('Registered Successfully!'); window.location.href='index.php'</script>";
            }

        } else {
            echo "<script>alert('Password not match!'); window.location.href='index.php'</script>";
        }
    }
}



?>

<input hidden value="<?=$administrator_data->username?>" name="" id="id_user_name"  type="text">

<nav class="navbar navbar-expand-lg bg-secondary sticky-top"  id="mainNav">
    <a href="index.php" class="navbar-brand text-white">
        <img width="60" height="60" class="rounded rounded-circle  bg-white" src="../assets/images/pictures/<?=$admin_data->profile?>" alt="">
        <?=ucwords(strtolower($admin_data->firstname." ".$admin_data->middlename." ".$admin_data->lastname))?>
    </a>
    <button class="navbar-toggler bg-secondary text-white navbar-toggler-right" data-toggle="collapse" data-target="#navbarResponsive" aria-label="Toggle" aria-expanded="false"><i class="fa fa-bars"></i></button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="nav navbar-nav ml-auto text-uppercase">


            <li class="nav-item nav-link text-center" role="presentation">
                <a href="manage_instructor.php" class="nav-link">Instructors</a>
            </li>
            <li class="nav-item nav-link text-center" role="presentation">
                <a href="manage_utility.php" class="nav-link">Utility</a>
            </li>
            <li class="nav-item nav-link text-center" role="presentation">
                <a href="manage_equipments.php" class="nav-link">Inventory</a>
            </li>

            <li class="nav-item nav-link text-center" role="presentation">
                <a href="manage_report.php" class="nav-link">Reports</a>
            </li>
            <li class="nav-item nav-link text-center" role="presentation">
                <a href="manage_accepted_request.php" class="nav-link">Request</a>
            </li>


            <div data-toggle="tooltip" data-placement="bottom" title="Add Assistant">
                <li class="nav-item" id="bell1" role="presentation"><a data-toggle="modal" data-target="#addAssistantModal" class="nav-link text-center js-scroll-trigger"><i class="fa text-dark fa-2x fa-user"></i></a></li>
            </div>
            <div data-toggle="tooltip" data-placement="bottom" title="Request to Utility">
                <li class="nav-item" id="bell1" role="presentation"><a href="request_item.php" class="nav-link text-center js-scroll-trigger"><i class="fa text-dark fa-2x fa-table"></i></a></li>
            </div>
            <div data-toggle="tooltip" data-placement="bottom" title="Instructor Request">
                <li class="nav-item" id="bell1" role="presentation"><a data-toggle="modal" data-target="#viewInstructorRequestModal" class="nav-link text-center js-scroll-trigger"><i class="fa text-dark fa-2x fa-male"></i></a></li>
            </div>
            <div data-toggle="tooltip" data-placement="right" title="Notifications">
                <li class="nav-item" id="setSeen" role="presentation"><a type="button" data-toggle="dropdown" data-target="#dpdown" class="nav-link text-center js-scroll-trigger"><i id="bell" class="fa <?=$notifStatus == "Y" ? "text-info" : "text-dark"?> fa-2x fa-bell"></i></a></li>
                <div id="dpdown" class="dropdown" style="max-width: 300px; text-transform: lowercase;">
                    <div style="background-color: rgb(227,227,227); max-height: 150px; overflow: auto;" class="dropdown-menu px-2 dropdown-menu-right">
                        <?php if (is_array($admin_notifs)) : ?>
                        <?php foreach ($admin_notifs as $adn): ?>
                                <div class="mt-2">
                                    <div class="text-center">
                                        <small class="text-muted" style="font-family: Georgia"><?=$adn->date_created?></small>
                                    </div>
                                    <div class="w-100 p-2" style="border-radius: 16px; background-color: cornflowerblue">
                                        <small style="font-size: 13px; color: black;" ><?=strtolower($adn->message)?></small>
                                    </div>
                                </div>
                        <?php endforeach; ?>
                        <?php else:  ?>
                            <div class="mt-2 text-center">
                                <div class="w-100 p-2" style="border-radius: 16px; background-color: cornflowerblue">
                                    <small style="font-size: 13px; text-transform: uppercase; color: black;" ><?=ucwords("No Notification.")?></small>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <li class="nav-item nav-link text-center">
                <div class="btn-group">
                    <button class="btn btn-light dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</button>

                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a data-toggle="modal" data-target="#changePasswordModal" class="dropdown-item text-center" type="button">Change Password</a>
                        <a data-toggle="modal" data-target="#updateInformationModal" class="dropdown-item text-center" type="button">Update Information</a>
                        <form action="" method="POST">
                            <button class="dropdown-item text-center" name="logout">Logout</button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="modal" id="addAssistantModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Assistant</h5>
                    <button data-dismiss="modal" class="btn btn-light"><i class="fa text-dark fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="container px-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Personal Information</h5>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <div data-toggle="tooltip" data-placement="bottom" title="Firstname">
                                            <input type="text" name="fname" class="form-control" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <div data-toggle="tooltip" data-placement="bottom" title="Middle Name">
                                            <input type="text" name="mname" class="form-control" placeholder="Middle Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <div data-toggle="tooltip" data-placement="bottom" title="Last Name">
                                            <input type="text" name="lname" class="form-control" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-sm-12 form-group">
                                        <div data-toggle="tooltip" data-placement="bottom" title="Complete Address">
                                            <input type="text" name="address" class="form-control" placeholder="Complete Address">
                                        </div>
                                    </div>

                                    <div class="col-lg-6  col-sm-12 form-group">
                                        <div data-toggle="tooltip" data-placement="bottom" title="Contact Number">
                                            <input type="number" name="contact_no" class="form-control" placeholder="Contact No">
                                        </div>
                                    </div>
                                    <div class="col-lg-6  col-sm-12 form-group">
                                        <div data-toggle="tooltip" data-placement="bottom" title="Birthday">
                                            <input type="date" name="birthday" class="form-control" placeholder="Birthday">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="bg-dark">
                                    </div>

                                    <div class="col-12 form-group">
                                        <h5>Authentication</h5>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 form-group">
                                        <div data-toggle="tooltip" data-placement="bottom" title="Username">
                                            <input type="number" name="username" class="form-control" placeholder="Username (ID Number)">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12 form-group">
                                        <div data-toggle="tooltip" data-placement="bottom" title="Password">
                                            <input type="password" name="password"  id="passwordassistant"    class="form-control" placeholder="Password  ">
                                        </div>
                                    </div>
                                    <div class="col-lg12 col-sm-12 form-group">
                                        <div data-toggle="tooltip" data-placement="bottom" title="Confirm Password">
                                            <input type="password" name="confirm_password" id="confirmpasswordassistant" class="form-control" placeholder="Confirm Password  ">
                                        </div>
                                    </div>
                                    <div class="col-12" id="assistantMessage">
                                        <div class="alert alert-danger">
                                            <h5 class="alert-heading">Password not match!</h5>
                                            <p>Please retype your password.</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="bg-dark">
                                    </div>

                                    <div class="col-12 form-group">
                                        <h5>Profile and Identification</h5>
                                    </div>
                                    <div class="col-12 form-group">
                                        <p class="text-center">
                                            <i class="fa fa-user-circle-o fa-4x"></i>
                                        </p>
                                    </div>

                                    <div class="col-lg-12 col-sm-12  form-group ">
                                        <div class="border border-secondary p-2 rounded">
                                            <div data-toggle="tooltip" data-placement="top" title="Profile Picture">
                                                <input type="file" name="profile" class="form-control-file" placeholder="Profile Picture">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6  col-sm-12 form-group">
                                        <div class="border border-secondary p-2 rounded">
                                            <div data-toggle="tooltip" data-placement="top" title="ID Picture Front">
                                                <input type="file" name="front" class="form-control-file" placeholder="ID Picture Front">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6  col-sm-12 form-group">
                                        <div class="border border-secondary p-2 rounded">
                                            <div data-toggle="tooltip" data-placement="top" title="ID Picture Back">
                                                <input type="file" name="back" class="form-control-file" placeholder="ID Picture Front">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4 form-group">
                                        <button name="assistantRegister" class="btn btn-block btn-success">Register</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="modal" id="viewInstructorRequestModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Request <i class="fa fa-spinner fa-spin"></i></h5>
                <button data-dismiss="modal" class="btn btn-sm btn-dark"><i class="fa fa-times text-white"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">


                    <?php if (is_array($instructor_request_borrow_items)) : ?>
                        <div class="col-12 form-group">
                            <h5>Borrower Information</h5>
                        </div>
                    <?php foreach($instructor_request_borrow_items as $irbi) : ?>
                    <div class="col-12 form-group">
                        <div data-toggle="tooltip" data-placement="top" title="View" class="">
                            <div class="input-group">
                                <input type="text" readonly value="<?=$irbi->department?>" class="form-control">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" data-toggle="modal" data-target="#viewRequestModal<?=$irbi->iri_id?>">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                       <?php else: ?>

                        <div class="col-12 text-center">
                            <h5 class="text-danger">No Data to Approve!</h5>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if (is_array($instructor_request_borrow_items)) : ?>
    <?php foreach($instructor_request_borrow_items as $irbi) : ?>
        <form action="" method="POST">
            <div class="modal" id="viewRequestModal<?=$irbi->iri_id?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Request Information <i class="fa fa-spinner fa-spin"></i></h5>
                            <button data-dismiss="modal" class="btn btn-sm btn-dark"><i class="fa fa-times text-white"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Instructor</h5>
                                </div>
                                <div class="col-4 form-group">
                                    <input type="text" readonly class="form-control" value="<?=$irbi->firstname?>">
                                </div>
                                <div class="col-4 form-group">
                                    <input type="text" readonly class="form-control" value="<?=$irbi->middlename?>">
                                </div>
                                <div class="col-4 form-group">
                                    <input type="text" readonly class="form-control" value="<?=$irbi->lastname?>">
                                    <input type="text" readonly class="form-control" name="eq_barcode" value="<?=$irbi->barcode?>">
                                </div>
                                <div class="col-12 form-group">
                                    <input type="text" readonly class="form-control" value="<?=$irbi->complete_address?>">
                                </div>
                                <div class="col-6 form-group">
                                    <input type="text" readonly class="form-control" value="<?=$irbi->department?>">
                                </div>
                                <div class="col-6 form-group">
                                    <input type="text" readonly class="form-control" value="<?=$irbi->contact_no?>">
                                </div>

                                <div class="col-4 form-group">
                                    <img class="w-100" style="height: 200px" src="../assets/images/pictures/<?=$irbi->profile?>" alt="">
                                </div>
                                <div class="col-4 form-group">
                                    <img class="w-100" style="height: 200px" src="../assets/images/pictures/<?=$irbi->picture_front?>" alt="">
                                </div>
                                <div class="col-4 form-group">
                                    <img class="w-100" style="height: 200px" src="../assets/images/pictures/<?=$irbi->picture_back?>" alt="">
                                </div>

                                <div class="col-12 form-group">
                                    <h5> Borrow Item</h5>
                                </div>
                                <div class="col-12 form-group">
                                    <input type="text" readonly class="form-control" value="<?=$irbi->name?>">
                                </div>
                                <div class="col-3 form-group">
                                    <input type="text" readonly class="form-control" value="<?=$irbi->brand?>">
                                </div>
                                <div class="col-3 form-group">
                                    <input type="text" readonly class="form-control" value="<?=$irbi->type?>">
                                </div>
                                <div class="col-3 form-group">
                                    <input type="text" readonly class="form-control" value="<?=$irbi->model?>">
                                </div>
                                <div class="col-3 form-group">
                                    <div data-toggle="tooltip" data-placement="top" title="Qantity to borrow">
                                        <input type="text" readonly class="form-control" name="quantity" value="<?=$irbi->quantity?>">
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <img class="w-100" style="height: 200px" src="../assets/images/pictures/<?=$irbi->pic1?>" alt="">
                                </div>
                                <div class="col-6 form-group">
                                    <img class="w-100" style="height: 200px" src="../assets/images/pictures/<?=$irbi->pic2?>" alt="">
                                </div>
                                <div class="col-6 form-group">
                                    <img class="w-100" style="height: 200px" src="../assets/images/pictures/<?=$irbi->pic3?>" alt="">
                                </div>
                                <div class="col-6 form-group">
                                    <img class="w-100" style="height: 200px" src="../assets/images/pictures/<?=$irbi->pic4?>" alt="">
                                </div>
                                <div class="col-12 form-group">
                                    <div data-toggle="tooltip" data-placement="top" title="Purpose">
                                        <textarea name="" readonly class="form-control" id="" cols="3"><?=$irbi->purpose?></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="">Date to pick</label>
                                    <input type="text" readonly name="date_to_pick" value="<?=$irbi->date_to_pick?>" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="">Date to Return</label>
                                    <input type="text" readonly name="date_to_return" value="<?=$irbi->date_to_return?>" class="form-control">
                                </div>
                                <input type="text" hidden name="date_accepted" value="<?=$irbi->date_accepted?>">
                                <input type="text" hidden name="request_id" value="<?=$irbi->iri_id?>">
                                <input type="text" hidden name="utility_equipment_id" value="<?=$irbi->utility_equipment_id?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button name="acceptRequest" class="btn btn-success">Accept</button>
                            <button name="cancelRequest" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endforeach; ?>
<?php endif; ?>


<div class="modal" id="changePasswordModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button data-dismiss="modal" class="btn rounded-circle btn-dark"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-12 form-group">
                            <input type="password" required name="original_password" class="form-control" placeholder="Current Password">
                        </div>
                        <div class="col-12 form-group">
                            <input type="password" id="newpassword" required name="new_password" class="form-control" placeholder="New Password">
                        </div>
                        <div class="col-12 form-group">
                            <input type="password" required id="confirmpassword" name="confirm_password"  class="form-control" placeholder="Confirm Password">
                        </div>

                        <div class="col-12" id="Message">
                            <div class="alert alert-danger">
                                <h5 class="alert-heading">Password not match!</h5>
                                <p>Please retype your password.</p>
                            </div>
                        </div>

                        <div class="col-12 form-group">
                            <div class="small" id="msg"></div>
                        </div>
                        <div class="col-12 form-group">
                            <button name="updatePassword" class="btn btn-block btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<style>
    @media screen and (max-width: 1100px) {


        #namecontent {
            font-size: 30px;
        }
    }

    @media screen and (max-width: 1000px) {


        #namecontent {
            font-size: 14px;
        }
    }


</style>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="modal" id="updateInformationModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="position-relative">
                        <img class="w-100" style="position: relative; " src="../assets/images/pictures/<?=$administrator_data->profile?>" alt="">
                        <div style="position: absolute; bottom: 20px; left: 20px"  class="bg-transparent">
                            <div style="position: relative">
                                <div style="background-color: #615ff6;  border-radius: 100%;" class="p-1">
                                    <img id="picture" class="rounded-circle" style="width: 150px; left: 20px;   bottom: 20px; height: 150px; margin-left: 0px;  border: 1px solid black;" src="../assets/images/pictures/<?=$administrator_data->profile?>" alt="">
                                </div>
                                <div style="background-color: #b3fce7; position: absolute; right: 5px; bottom: 5px;" class="p-2 rounded-circle">
                                    <div data-toggle="tooltip" data-placement="bottom"; title="Change Profile">
                                        <label  style="margin-bottom: 0px; ">

                                            <i   class="fa fa-2x fa-camera" id="camera" onmouseover="changeColor(this.id, 'blue')"  onmouseout="changeColor(this.id, 'black')"><input hidden  name="profile" oninput="picture.src=window.URL.createObjectURL(this.files[0])" type="file" /></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="position-absolute" style="left: 170px; width: 500px; bottom: 80px">
                                    <h2 class="text-white " id="namecontent" style="text-shadow: 5px 5px 10px #9e1818"><?=ucwords($administrator_data->lastname.", ".$administrator_data->firstname." ".$administrator_data->middlename[0].".")?></h2>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 form-group">
                            <h5>Customize your info</h5>
                        </div>
                        <div class="col-lg-4 col-sm-12 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                    <i class="fa  fa-user" ></i>
                                </span>
                                </div>
                                <input name="firstname" value="<?=$administrator_data->firstname?>" type="text" style="-webkit-box-shadow: none; border: none;" id="fname" placeholder="First Name" class="form-control bg-transparent" readonly  >
                                <div class="input-group-append">
                                <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                    <div data-toggle="tooltip" data-placement="top" title="edit">
                                        <i class="fa  text-danger fa-edit" onclick="setAvailable('fname')"></i>
                                    </div>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                    <i class="fa  fa-user" ></i>
                                </span>
                                </div>
                                <input name="middlename" value="<?=$administrator_data->middlename?>" type="text" style="-webkit-box-shadow: none; border: none;" id="mname" placeholder="Middle Name" class="form-control bg-transparent" readonly  >
                                <div class="input-group-append">
                                <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                    <div data-toggle="tooltip" data-placement="top" title="edit">
                                        <i class="fa  text-danger fa-edit" onclick="setAvailable('mname')"></i>
                                    </div>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                        <i class="fa  fa-user" ></i>
                                    </span>
                                </div>
                                <input name="lastname" value="<?=$administrator_data->lastname?>" type="text" style="-webkit-box-shadow: none; border: none;" id="lname" placeholder="Last Name" class="form-control bg-transparent" readonly  >
                                <div class="input-group-append">
                                <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                    <div data-toggle="tooltip" data-placement="top" title="edit">
                                        <i class="fa  text-danger fa-edit" onclick="setAvailable('lname')"></i>
                                    </div>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                        <i class="fa  fa-location-arrow" ></i>
                                    </span>
                                </div>

                                <input name="address" value="<?=$administrator_data->complete_address?>" type="text" style="-webkit-box-shadow: none; border: none;" id="address" placeholder="Complete Address" class="form-control bg-transparent" readonly  >

                                <div class="input-group-append">
                                <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                    <div data-toggle="tooltip" data-placement="top" title="edit">
                                        <i class="fa  text-danger fa-edit" onclick="setAvailable('address')"></i>
                                    </div>
                                </span>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6 col-sm-12 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                        <i class="fa  fa-phone" ></i>
                                    </span>
                                </div>

                                <input name="contact_no" value="<?=$administrator_data->contact_no?>" type="number" style="-webkit-box-shadow: none; border: none;" id="contact_no" placeholder="Contact Number" class="form-control bg-transparent" readonly  >

                                <div class="input-group-append">
                                <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                    <div data-toggle="tooltip" data-placement="top" title="edit">
                                        <i class="fa  text-danger fa-edit" onclick="setAvailable('contact_no')"></i>
                                    </div>
                                </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                        <i class="fa  fa-birthday-cake" ></i>
                                    </span>
                                </div>
                                <input name="birthday" value="<?=$administrator_data->birthday?>" type="date" style="-webkit-box-shadow: none; border: none;" id="birthday" placeholder="Contact Number" class="form-control bg-transparent" readonly  >
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent" style="outline: none; border: none;">
                                        <div data-toggle="tooltip" data-placement="top" title="edit">
                                            <i class="fa  text-danger fa-edit" onclick="setAvailable('birthday')"></i>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 form-group mt-3">
                            <h5>ID Picture</h5>
                        </div>

                        <div class="col-lg-6 col-sm-12 form-group">
                            <div data-toggle="tooltip" data-placement="top" title="ID Front">
                                <div style="position: relative">
                                    <img class="w-100" src="../assets/images/pictures/<?=$administrator_data->picture_front?>" id="frontpic" alt="">

                                    <label style="position: absolute; right: 5px; bottom: 5px">
                                        <i class="fa text-info fa-2x fa-camera">
                                            <input  name="front" oninput="frontpic.src=window.URL.createObjectURL(this.files[0])" hidden type="file" />
                                        </i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 form-group">
                            <div data-toggle="tooltip" data-placement="top" title="ID Back">
                                <div class="position-relative">
                                    <img class="w-100" src="../assets/images/pictures/<?=$administrator_data->picture_back?>" id="backpic" alt="">
                                    <label style="position: absolute; right: 5px; bottom: 5px">
                                        <i class="fa text-info fa-2x fa-camera">
                                            <input  name="back" oninput="backpic.src=window.URL.createObjectURL(this.files[0])" hidden type="file" />
                                        </i>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="modal" data-backdrop="static" id="verificationModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Verification
                                        </h5>
                                        <button data-dismiss="modal" class="btn btn-dark">close</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <input type="text" name="username" class="form-control" placeholder="Username as you  ID Number">
                                            </div>

                                            <div class="col-12 form-group">
                                                <input type="password" name="password" class="form-control" placeholder="Password">
                                            </div>

                                            <div class="col-12 form-group">
                                                <button class="btn btn-success btn-block"  name="updateInfo" >Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 form-group">
                            <button type="button" data-toggle="modal" data-target="#verificationModal" class="btn btn-dark float-right">Verification</button>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


</form>
<script>
    function changeColor(id, color) {
        document.getElementById(id).style.color = color;
    }

    function setAvailable(id) {
        document.getElementById(id).readOnly = false;
        document.getElementById(id).style.border = "1px solid cornflowerblue";
        document.getElementById(id).focus();

    }
</script>