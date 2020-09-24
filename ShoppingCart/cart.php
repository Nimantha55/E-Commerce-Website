<?php

session_start();

require_once ('inc/connection.php');
require_once('component.php');

//checking if a user is logged in
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
}
else{
    if(isset($_POST['remove'])){
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $delete = "DELETE FROM cart WHERE user_id = {$user_id} LIMIT 1";
        $result = mysqli_query($connection, $delete);
        if ($result){
            echo "<script>window.location = 'cart.php'</script>";
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
<body class="bg-light">
<?php require_once("header.php"); ?>

<div class="container-fluid mt-5 pt-5 mb-5">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h5>Cart Details</h5>
                <hr>
                <?php
                $total = 0;
                $query = "SELECT * FROM cart WHERE user_id = {$user_id}";
                $result = mysqli_query($connection, $query);
                $count = mysqli_num_rows($result);
                if ($count == 0){
                    $message = "Your Cart is Empty...!";
                    no_records($message);
                    $_SESSION['total'] = $total;
                }
                else{
                    while ($row = mysqli_fetch_assoc($result)){
                        cartElement($row['product_img'], $row['product_name'], $row['product_price'], $row['id']);
                        $total = $total + (int)$row['product_price'];
                        $_SESSION['total'] = $total;
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25 shadow mb-5 pb-2">
            <form action="cart.php" method="post">
                <div class="pt-4">
                    <h6 class="text-secondary font-weight-bold">PRICE DETAILS</h6>
                    <hr>
                    <div class="row price-details">

                        <div class="col-md-6">
                            <?php

                            $user_id = $_SESSION['user_id'];
                            $select = "SELECT * FROM cart WHERE user_id = $user_id";
                            $result = mysqli_query($connection, $select);
                            if ($result){
                                $cart = mysqli_num_rows($result);
                                $_SESSION['items'] = $cart;
                            }
                            if ($cart != 0){
                                echo "<h6>Total Price ($cart items)</h6>";
                            }
                            else{
                                echo "<h6>Total Price (0 items)</h6>";
                            }
                            ?>
                            <hr>
                            <h6>Amount Payable</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>$<?php echo $total; ?></h6>
                            <hr>
                            <h6>$<?php echo $total; ?></h6>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center mb-3">
                        <a href="payment.php" class="btn btn-primary btnCart" name="checkout">Checkout</a>
                    </div>
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
