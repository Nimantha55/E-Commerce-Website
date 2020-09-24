<?php session_start(); ?>
<?php require_once('component.php'); ?>
<?php require_once('inc/connection.php'); ?>
<?php

//set pagination
$per_page = 4;
$start = 0;
$current_page = 1;
if(isset($_GET['start'])){
$start = $_GET['start'];
if ($start<=0){
    $start = 0;
    $current_page = 1;
}
else{
    $current_page = $start;
    $start--;
    $start = $start * $per_page;
}

}
$record = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM product"));
$page = ceil($record/$per_page);

if(isset($_POST['add'])){
    //checking if a user is logged in
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }
    else{
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['first_name'];
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_img = $_POST['product_img'];

        $select = "SELECT * FROM cart WHERE product_id = $product_id AND user_id = $user_id AND still_here = 0";
        $result = mysqli_query($connection, $select);
        if ($result){
            $cart = mysqli_num_rows($result);
            if ($cart != 0){
                echo "<script>alert('Product is already added in the cart..!')</script>";
                echo"<script>window.location = 'index.php'</script>";
            }
            else{
                $addToCart = "INSERT INTO cart(user_id, user_name, product_id, product_name, product_price, product_img, still_here) VALUES ({$user_id}, '{$user_name}', {$product_id}, '{$product_name}', {$product_price}, '{$product_img}', 0)";
                $cartResults = mysqli_query($connection, $addToCart);

                if ($cartResults){
                    //query successful...redirecting to users page
                }
                else{
                    $errors[] = "Failed to add the new record";
                    echo "error" . mysqli_error($connection);
                }

                //add to order list
                $addTolist = "INSERT INTO order_list(user_id, user_name, product_id, product_name, product_price, product_img, order_date, paid, received) VALUES ({$user_id}, '{$user_name}', {$product_id}, '{$product_name}', {$product_price}, '{$product_img}', NOW() , 0, 0)";
                $listResult = mysqli_query($connection, $addTolist);

                if ($listResult){
                    //query successful...redirecting to users page
                }
                else{
                    $errors[] = "Failed to add the new record";
                    echo "error" . mysqli_error($connection);
                }
            }
        }
    }
}

//add to cart in popup modal
if(isset($_POST['modal_cart'])){
    //checking if a user is logged in
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }
    else{
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['first_name'];
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_img = $_POST['product_img'];

        $select = "SELECT * FROM cart WHERE product_id = $product_id AND user_id = $user_id AND still_here = 0";
        $result = mysqli_query($connection, $select);
        if ($result){
            $cart = mysqli_num_rows($result);
            if ($cart != 0){
                echo "<script>alert('Product is already added in the cart..!')</script>";
                echo"<script>window.location = 'index.php'</script>";
            }
            else{
                $addToCart = "INSERT INTO cart(user_id, user_name, product_id, product_name, product_price, product_img, still_here) VALUES ({$user_id}, '{$user_name}', {$product_id}, '{$product_name}', {$product_price}, '{$product_img}', 0)";
                $cartResults = mysqli_query($connection, $addToCart);

                if ($cartResults){
                    //query successful...redirecting to users page
                }
                else{
                    $errors[] = "Failed to add the new record";
                    echo "error" . mysqli_error($connection);
                }

                //add to order list
                $addTolist = "INSERT INTO order_list(user_id, user_name, product_id, product_name, product_price, product_img, order_date, paid, received) VALUES ({$user_id}, '{$user_name}', {$product_id}, '{$product_name}', {$product_price}, '{$product_img}', NOW() , 0, 0)";
                $listResult = mysqli_query($connection, $addTolist);

                if ($listResult){
                    //query successful...redirecting to users page
                }
                else{
                    $errors[] = "Failed to add the new record";
                    echo "error" . mysqli_error($connection);
                }
            }
        }
    }
}

if (isset($_POST['wishlist'])){
    //checking if a user is logged in
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }
    else{
        //add to wishlist
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['first_name'];
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_img = $_POST['product_img'];

        $addQuery = "INSERT INTO wishlist(user_id, user_name, product_id, product_name, product_price, product_img, still_here) VALUES ({$user_id}, '{$user_name}', {$product_id}, '{$product_name}', {$product_price}, '{$product_img}', 0)";
        $addResults = mysqli_query($connection, $addQuery);

        if ($addResults){
            //query successful...redirecting to users page
        }
        else{
            $errors[] = "Failed to add the new record";
            echo "error" . mysqli_error($connection);
        }
    }
}
//add to wishlist in popup modal
if (isset($_POST['modal_wishlist'])){
    //checking if a user is logged in
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }
    else{
        //add to wishlist
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['first_name'];
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_img = $_POST['product_img'];

        $addQuery = "INSERT INTO wishlist(user_id, user_name, product_id, product_name, product_price, product_img, still_here) VALUES ({$user_id}, '{$user_name}', {$product_id}, '{$product_name}', {$product_price}, '{$product_img}', 0)";
        $addResults = mysqli_query($connection, $addQuery);

        if ($addResults){
            //query successful...redirecting to users page
        }
        else{
            $errors[] = "Failed to add the new record";
            echo "error" . mysqli_error($connection);
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Shopping Cart</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
    <script src="js/all.js"></script>
    <link rel="stylesheet" href="fonts/fontawesome.min.css">
</head>
<body>
<?php require_once("header.php"); ?>

<!-- Hero section -->
<?php require_once("hero-section.php"); ?>
<!-- Hero section end -->

<div class="container-fluid bg-light pt-4 pb-3">
    <h4 class="text-center text-dark font-weight-bold">SHOP WITH <span class="text-warning font-weight-bold">US</span></h4>
    <h6 class="text-center text-muted">Buy your favorite products in one place with sensational discounts.</h6>
    <div class="row text-center mt-5">
        <div class="col-12">
            <div class="row d-xl-flex d-lg-flex d-md-flex d-sm-none d-none">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-6 bg-white py-3">
                            <img src="img/p1.jpg" alt="" class="rounded-circle p-img">
                            <h6 class="mt-2"><a href="#" class="badge badge-warning px-3 py-1">All Products</a></h6>
                        </div>
                        <div class="col-6 bg-white py-3">
                            <img src="img/p2.jpg" alt="" class="rounded-circle p-img">
                            <h6 class="mt-2"><a href="#" class="badge badge-warning px-3 py-1">Sport</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-6 bg-white py-3">
                            <img src="img/p3.jpg" alt="" class="rounded-circle p-img">
                            <h6 class="mt-2"><a href="#" class="badge badge-warning px-3 py-1">Technology</a></h6>
                        </div>
                        <div class="col-6 bg-white py-3">
                            <img src="img/p4.jpg" alt="" class="rounded-circle p-img">
                            <h6 class="mt-2"><a href="#" class="badge badge-warning px-3 py-1">Electronic</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-6 bg-white py-3">
                            <img src="img/p5.jpg" alt="" class="rounded-circle p-img">
                            <h6 class="mt-2"><a href="#" class="badge badge-warning px-3 py-1">Furniture</a></h6>
                        </div>
                        <div class="col-6 bg-white py-3">
                            <img src="img/p6.jpg" alt="" class="rounded-circle p-img">
                            <h6 class="mt-2"><a href="#" class="badge badge-warning px-3 py-1">Foods</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-6 bg-white py-3">
                            <img src="img/p7.jpg" alt="" class="rounded-circle p-img">
                            <h6 class="mt-2"><a href="#" class="badge badge-warning px-3 py-1">Cloths</a></h6>
                        </div>
                        <div class="col-6 bg-white py-3">
                            <img src="img/p8.jpg" alt="" class="rounded-circle p-img">
                            <h6 class="mt-2"><a href="#" class="badge badge-warning px-3 py-1">Shoes</a></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-xl-none d-lg-none d-md-none d-sm-flex d-flex">
                <div class="col-sm-12 col-12">
                    <a href="#" class="badge badge-primary px-3 py-1">All Products</a>
                    <a href="#" class="badge badge-primary px-3 py-1">Sport</a>
                    <a href="#" class="badge badge-primary px-3 py-1">Technology</a>
                    <a href="#" class="badge badge-primary px-3 py-1">Electronic</a>
                    <a href="#" class="badge badge-primary px-3 py-1">Furniture</a>
                    <a href="#" class="badge badge-primary px-3 py-1">Foods</a>
                    <a href="#" class="badge badge-primary px-3 py-1">Cloths</a>
                    <a href="#" class="badge badge-primary px-3 py-1">Shoes</a>
                </div>
                <div class="col-sm-12 col-12 mt-3">
                    <h5>Get 20% Discount for our all products.</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <h6 class="text-dark font-weight-bold pl-3 pt-3">All products</h6>
    </div>
    <div class="row text-center py-3">
        <?php

            $query = "SELECT * FROM product LIMIT $start, $per_page";
            $result = mysqli_query($connection, $query);

            if(count($result) == 0){
                $massage = "Product details not available...!";
                no_product($massage);
            }
            else{
                if (mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                        component($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                        popupModel($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                    }
                }
                else{
                    echo "<h5>No Records Found.</h5>";
                }
            }
        ?>
    </div>

    <!--    pagination-->
<!--    <nav aria-label="Page navigation example">-->
<!--        <ul class="pagination justify-content-center">-->
<!---->
<!--            --><?php
//
//            for ($i=1; $i <= $page; $i++){
//                $class = '';
//                if ($current_page == $i){
//                    $class = 'active';
//                }
//
//            ?>
<!---->
<!--                <li class="page-item --><?php //echo $class; ?><!--"><a class="page-link" href="?start=--><?php //echo $i; ?><!--">--><?php //echo $i; ?><!--</a></li>-->
<!--            --><?php //} ?>
<!--        </ul>-->
<!--    </nav>-->
    <div class="text-center form-text mb-4">
        <a href="#" class="btn btn-outline-primary">Show More</a>
    </div>
</div>

<div class="container-fluid bg-light">
    <h4 class="text-center text-dark font-weight-bold pt-3">SHOPPING <span class="text-warning font-weight-bold">CART</span></h4>
    <h6 class="text-center text-muted pb-3">Buy your favorite products in one place with sensational discounts.</h6>
<div class="row text-center">
    <div class="col-xl-2 d-xl-flex d-lg-none d-md-none d-sm-none d-none">
        <img src="img/img4.png" alt="" class="img-line">
    </div>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12">
        <img src="img/img3.png" alt="" class="img-line">
    </div>
    <div class="col-xl-2 d-xl-flex d-lg-none d-md-none d-sm-none d-none">
        <img src="img/img5.png" alt="" class="img-line">
    </div>
    <div class="col-xl-2 col-lg-3 d-xl-flex d-lg-flex d-md-none d-sm-none d-none">
        <img src="img/img1.png" alt="" class="img-line">
    </div>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 d-xl-flex d-lg-flex d-md-flex d-sm-flex d-none">
        <img src="img/img2.png" alt="" class="img-line">
    </div>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 d-xl-flex d-lg-flex d-md-flex d-sm-flex d-none">
        <img src="img/img6.png" alt="" class="img-line">
    </div>
</div>
</div>

<div class="container mt-3">
    <div class="row">
        <h6 class="text-dark font-weight-bold pl-3 pt-3">This week special</h6>
    </div>
    <div class="row text-center py-3">
        <?php

        $query = "SELECT * FROM product LIMIT $start, $per_page";
        $result = mysqli_query($connection, $query);

        if(count($result) == 0){
            $massage = "Product details not available...!";
            no_product($massage);
        }
        else{
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    component($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                    popupModel($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                }
            }
            else{
                echo "<h5>No Records Found.</h5>";
            }
        }
        ?>
    </div>

    <!--    pagination-->
<!--    <nav aria-label="Page navigation example">-->
<!--        <ul class="pagination justify-content-center">-->
<!---->
<!--            --><?php
//
//            for ($i=1; $i <= $page; $i++){
//                $class = '';
//                if ($current_page == $i){
//                    $class = 'active';
//                }
//
//                ?>
<!---->
<!--                <li class="page-item --><?php //echo $class; ?><!--"><a class="page-link" href="?start=--><?php //echo $i; ?><!--">--><?php //echo $i; ?><!--</a></li>-->
<!--            --><?php //} ?>
<!--        </ul>-->
<!--    </nav>-->
    <div class="text-center form-text mb-4">
        <a href="#" class="btn btn-outline-primary">Show More</a>
    </div>
</div>

<footer>
    <div class="col-12 bg-dark text-white text-center py-3 mb-0 page-footer">
        <span>
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i class="fas fa-star" aria-hidden="true"></i> by <a href="#" target="_blank">NS</a>
        </span>
    </div>
</footer>

	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
</body>
</html>