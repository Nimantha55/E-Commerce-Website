<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php

$errors = array();

$uname = '';
$uaddress = '';
$uage = '';
$utel_no = '';
$uemail = '';
$upassword = '';


if (isset($_POST['submit'])){

    $uname = $_POST['uname'];
    $uaddress = $_POST['uaddress'];
    $uage = $_POST['uage'];
    $utel_no = $_POST['utel_no'];
    $uemail = $_POST['uemail'];
    $upassword = $_POST['upassword'];

    //checking required fields
    $req_fields = array('uname', 'uaddress', 'uage', 'utel_no', 'uemail', 'upassword');
    $errors = array_merge($errors, check_req_fields($req_fields));

    //checking max length
    $max_len_fields = array('uname' => 100, 'uaddress' => 200, 'uage' => 3, 'utel_no' => 15, 'uemail' => 100, 'upassword' => 40);
    $errors = array_merge($errors, check_max_length($max_len_fields));

    //checking email address
    if (!is_email($_POST['uemail'])){
        $errors[] = "Email address is invalid";
    }

    //checking if email address already exist
    $check_email = mysqli_real_escape_string($connection, $_POST['uemail']);
    $query = "SELECT * FROM user WHERE uemail = '{$check_email}' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if($result){
        if (mysqli_num_rows($result) == 1){
            $errors[] = "Email address already exists";
        }
    }

    if(empty($errors)){
        //no errors found...adding new records
        $addName = mysqli_real_escape_string($connection, $_POST['uname']);
        $addAddress = mysqli_real_escape_string($connection, $_POST['uaddress']);
        $addAge = mysqli_real_escape_string($connection, $_POST['uage']);
        $addTelno = mysqli_real_escape_string($connection, $_POST['utel_no']);
        $addPassword = mysqli_real_escape_string($connection, $_POST['upassword']);
        $hashed_password = sha1($addPassword);

        $addQuery = "INSERT INTO user(uname, uaddress, uage, utel_no, uemail, upassword) VALUES ('{$addName}', '{$addAddress}', '{$addAge}', '{$addTelno}', '{$check_email}', '{$hashed_password}')";
        $addResults = mysqli_query($connection, $addQuery);

        if ($addResults){
            //query successful...redirecting to users page
            header('Location: login.php');
        }
        else{
            $errors[] = "Failed to add the new record";
        }

    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/datepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="css/alertify.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<?php require_once("header.php"); ?>

<section class="sign-up-section">
    <div class="container mb-xl-0 mb-lg-0 mb-md-5 mb-sm-5 mb-5">
        <div class="row">
            <div class="col-12 mt-xl-3 mt-lg-3 mt-md-3 mt-sm-3 mt-5 pt-xl-3 pt-lg-3 pt-md-3 pt-sm-3 pt-3">
                <div class="row align-content-center justify-content-center mt-xl-5 mt-lg-5 mt-md-5 mt-sm-5 mt-2 pt-xl-3 pt-lg-3 pt-md-3 pt-sm-0 pt-0">
                    <img src="img/loginImg.png" alt="" class="rounded-circle setImg">
                </div>
                <form action="sign_up.php" method="post">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="username" class="text-white setlabel">Name</label>
                                <input type="text" class="form-control text-dark font-weight-bold pl-5" id="username" name="uname" placeholder="Enter Username">
                                <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="username" class="text-white setlabel">Address</label>
                                <input type="text" class="form-control text-dark font-weight-bold pl-5" id="username" name="uaddress" placeholder="Enter Address">
                                <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="age" class="text-white setlabel">Age</label>
                                <input type="number" class="form-control text-dark font-weight-bold pl-5" id="age" name="uage" placeholder="Enter Age">
                                <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="username" class="text-white setlabel">Username</label>
                                <input type="text" class="form-control text-dark font-weight-bold pl-5" id="username" placeholder="Enter Username">
                                <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="username" class="text-white setlabel">Telephone Number</label>
                                <input type="text" class="form-control text-dark font-weight-bold pl-5" id="username" name="utel_no" placeholder="Enter Telephone Number">
                                <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="username" class="text-white setlabel">Email</label>
                                <input type="email" class="form-control text-dark font-weight-bold pl-5" id="username" name="uemail" placeholder="Enter Email">
                                <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="username" class="text-white setlabel">Password</label>
                                <input type="password" class="form-control text-dark font-weight-bold pl-5" id="username" name="upassword" placeholder="Enter Password">
                                <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="username" class="text-white setlabel">Confirm Password</label>
                                <input type="text" class="form-control text-dark font-weight-bold pl-5" id="username" placeholder="Enter Username">
                                <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-5">
                        <button type="submit" class="btn btn-info px-5 py-2 mt-3 setButton" name="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once("footer.php"); ?>
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="js/datepicker.js"></script>
<script type="text/javascript" src="js/alertify.min.js"></script>

</body>
</html>
<?php mysqli_close($connection); ?>