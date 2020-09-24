<?php session_start(); ?>
<?php require_once('component.php'); ?>
<?php require_once('inc/connection.php'); ?>
<?php

//checking if a user is logged in
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
}
else{
    if(isset($_POST['received'])){
        $user_id = $_SESSION['user_id'];

        //need to check the date - later
        $received = "UPDATE order_list SET received = 1 WHERE user_id = {$user_id}";
        $result = mysqli_query($connection, $received);
        if ($result){
            echo "<script>window.location = 'orders.php'</script>";
        }
        else "Error" . mysqli_error($connection);
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

<div class="container mt-5 pt-3">
    <div class="row mt-4 px-5">
        <div class="col-xl-4 col-lg-4 d-xl-block d-lg-block d-md-none d-sm-none d-none my-5 py-5 mt-3 text-center">
            <img src="img/img8.png" alt="" height="210" width="250" class="img-fluid mt-5">
        </div>
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 d-xl-block d-lg-block d-md-block d-sm-block d-block">
            <h5 class="mb-2">Pending Orders</h5>
            <hr>
            <div class="shopping-cart">
                <?php
                $total = 0;
                $query = "SELECT * FROM order_list WHERE user_id = {$user_id} AND received = 0";
                $result = mysqli_query($connection, $query);
                $count = mysqli_num_rows($result);
                if ($count == 0){
                    $message = "Your Order List is Empty...!";
                    no_records($message);
                    $_SESSION['total'] = $total;
                }
                else{
                    while ($row = mysqli_fetch_assoc($result)){
                        order($row['product_img'], $row['product_name'], $row['product_price'], $row['id']);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php require_once("footer.php"); ?>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/script.js" type="text/javascript"></script>
</body>
</html>