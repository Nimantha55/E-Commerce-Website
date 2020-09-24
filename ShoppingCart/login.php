<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('component.php'); ?>
<?php

//check for form submission
if(isset($_POST['submit'])){

    $errors = array();

    //check if the username and password has been entered
    if(!isset($_POST['uemail']) || strlen(trim($_POST['uemail'])) < 1){
        $errors[] = 'Username is missing or invalid';
        $username = 'Username is missing or invalid';
    }
    if(!isset($_POST['upassword']) || strlen(trim($_POST['upassword'])) < 1){
        $errors[] = 'Password is missing or invalid';
    }

    //check if there are any error in the form
    if(empty($errors)){
        //save username and password into variables
        $email = mysqli_real_escape_string($connection, $_POST['uemail']);
        $password = mysqli_real_escape_string($connection, $_POST['upassword']);
        $hashed_password = sha1($password);

        //prepare database query
        $query = "SELECT * FROM user WHERE uemail = '{$email}' AND upassword = '{$hashed_password}' LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if($result_set){
            //query successful

            if(mysqli_num_rows($result_set) == 1){
                //valid user found
                $user = mysqli_fetch_assoc($result_set);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['first_name'] = $user['uname'];
                $_SESSION['account_type'] = $user['account_type'];
                $_SESSION['email'] = $user['uemail'];

                //set user id as a cookie
                if (!isset($_COOKIE['username'])){
                    setcookie('username', $user['uname'], time()+60*60*24*7*4*12);
                }
                if (!isset($_COOKIE['userId'])){
                    setcookie('userId', $user['id'], time()+60*60*24*7*4*12);
                }

                //updating last login
                $login = "UPDATE user SET last_login = NOW() WHERE id = {$_SESSION['user_id']} LIMIT 1";

                $login_result = mysqli_query($connection, $login);
                if(!$login_result){
                    die("Database Query Failed");
                }

                if($_SESSION['account_type'] == 0){
                    //redirect to users.php
                    header('Location: index.php');
                }
                elseif ($_SESSION['account_type'] == 1){
                    //redirect to display_products.php (Admin)
                    header('Location: display_products.php');
                }
                else{
                    //redirect to admin.php
                    header('Location: login.php');
                }

            }
            else{
                //username or password invalid
                $errors[] = 'Invalid Username or Password...!';
            }
        }
        else{
            $errors[] = 'Database Query Failed';
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
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<?php require_once("header.php"); ?>

<section class="login-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-xl-block d-lg-block d-md-none d-sm-none d-none">
                <div class="row align-content-center">
                    <img src="img/people.png" alt="" class="imgSet">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 margin mt-xl-5 mt-lg-5 mt-md-5 mt-sm-5 mt-5 pt-xl-5 pt-lg-5 pt-md-5 pt-sm-5 pt-3">
                <div class="row align-content-center justify-content-center mt-xl-5 mt-lg-5 mt-md-5 mt-sm-5 mt-2 pt-xl-3 pt-lg-3 pt-md-3 pt-sm-0 pt-0">
                    <img src="img/loginImg.png" alt="" class="rounded-circle setImg">
                </div>
                <form action="login.php" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div>
                                    <?php
                                    if (!empty($errors)) {
                                        echo '<label for="username" class="text-white setlabel">Username</label>';
                                        echo '<input type="email" class="form-control text-dark font-weight-bold pl-5 alert-danger" id="username" name="uemail" placeholder="Enter Email Address">';
                                        echo '<i class="fa fa-user fa-lg position-absolute text-muted"></i>';
                                    }
                                    else{
                                        echo '<label for="username" class="text-white setlabel">Username</label>';
                                        echo '<input type="email" class="form-control text-dark font-weight-bold pl-5" id="username" name="uemail" placeholder="Enter Email Address">';
                                        echo '<i class="fa fa-user fa-lg position-absolute text-muted"></i>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div>
                                    <?php
                                    if (!empty($errors)) {
                                        echo '<label for="password" class="text-white setlabel">Password</label>';
                                        echo '<input type="password" class="form-control text-dark font-weight-bold pl-5 alert-danger" id="password" name="upassword" placeholder="Enter Password">';
                                        echo '<i class="fa fa-lock fa-lg position-absolute text-muted"></i>';
                                    }
                                    else{
                                        echo '<label for="password" class="text-white setlabel">Password</label>';
                                        echo '<input type="password" class="form-control text-dark font-weight-bold pl-5" id="password" name="upassword" placeholder="Enter Password">';
                                        echo '<i class="fa fa-lock fa-lg position-absolute text-muted"></i>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center justify-content-center">
                        <div class="text-center">
                            <button type="submit" class="btn btn-info px-5 py-2 mt-3 setButton" name="submit">Login</button>
                        </div>
                    </div>
                    <div class="row text-center justify-content-center">
                        <div class="mt-5">
                            <h6 class="text-white setLine mr-2">Don't have an account?</h6>
                            <a href="sign_up.php" class="badge badge-warning setLine p-2 text-dark btnAnimate">Sign Up</a>
                        </div>
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
</body>
</html>