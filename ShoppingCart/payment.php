<?php session_start(); ?>
<?php require_once('component.php'); ?>
<?php require_once('inc/connection.php'); ?>
<?php

//checking if a user is logged in
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
}
else{
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['first_name'];
    $email = $_SESSION['email'];
    $items = $_SESSION['items'];
    $total = $_SESSION['total'];

    if(isset($_POST['pay'])){

        //account details not implemented - later
        $payment = "INSERT INTO payments(user_id, user_name, items, net_amount, date) VALUES({$user_id}, '{$user_name}', {$items}, {$total}, NOW())";
        $payment_result = mysqli_query($connection, $payment);

        if ($payment_result){
            echo "<script>window.location = 'payment.php'</script>";
        }
        else{
            echo "Error" . mysqli_error($connection);
        }

        //need to check the date - later
        $update_list = "UPDATE order_list SET paid = 1 WHERE user_id = {$user_id}";
        $set = mysqli_query($connection, $update_list);
        if ($set){
            echo "<script>window.location = 'payment.php'</script>";
        }
        else{
            echo "Error" . mysqli_error($connection);
        }

        //need to check the date - later
        $detele_cart = "DELETE FROM cart WHERE user_id = {$user_id}";
        $delete_result = mysqli_query($connection, $detele_cart);
        if ($delete_result){
            echo "<script>window.location = 'payment.php'</script>";
        }
        else{
            echo "Error" . mysqli_error($connection);
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
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<?php require_once("header.php"); ?>

<div class="container">
    <div class="row mt-5 pt-5 mb-lg-0 mb-lg-0 mb-md-5 pb-md-5 mb-sm-5 pb-sm-5 mb-5 pb-5">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-5 pt-3 text-center">
            <div class="mt-4">
                <img src="img/img5.png" alt="" width="350" height="300">
            </div>
            <div class="mt-4">
                <div class="row">
                    <div class="col-6">
                        <h5>Total Items - <span class="text-muted"><?php echo $items; ?></span></h5>
                    </div>
                    <div class="col-6">
                        <h5>Total Amount - <span class="text-muted"><?php echo $total; ?></span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-5 pt-3">
            <form action="payment.php" method="post">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="user_id" class="text-uppercase text-dark font-weight-bold">User Id</label>
                            <input type="text" name="user_id" id="" class="form-control pl-5" value="<?php echo $user_id; ?>" disabled>
                            <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="user_name" class="text-uppercase text-dark font-weight-bold">Name</label>
                            <input type="text" name="user_name" id="" class="form-control pl-5" value="<?php echo $user_name; ?>" disabled>
                            <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="email" class="text-uppercase text-dark font-weight-bold">Email</label>
                            <input type="text" name="email" id="" class="form-control pl-5" value="<?php echo $email; ?>" disabled>
                            <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="account_number" class="text-uppercase text-dark font-weight-bold">Account Number</label>
                            <input type="text" name="account_number" id="" class="form-control pl-5">
                            <i class="fa fa-user fa-lg position-absolute text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary btnCart px-3" name="pay">Pay Now</button>
                </div>
            </form>
        </div>
    </div>

</div>

<footer>
    <div class="col-12 bg-dark text-white text-center py-3 mb-0 fixed-bottom">
        <span>
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">NS</a>
        </span>
    </div>
</footer>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/script.js" type="text/javascript"></script>
</body>
</html>
