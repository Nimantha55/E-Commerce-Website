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
    $record = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM wishlist WHERE user_id = {$user_id}"));
    $page = ceil($record/$per_page);

    //add to cart
    if(isset($_POST['add'])){
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['first_name'];
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_img = $_POST['product_img'];

        $select = "SELECT * FROM cart WHERE product_id = $product_id AND user_id = $user_id";
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
    //remove from wishlist
    if(isset($_POST['remove'])){
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];

        $delete = "DELETE FROM wishlist WHERE user_id = {$user_id} LIMIT 1";
        $result = mysqli_query($connection, $delete);
        if ($result){
            echo"<script>window.location = 'wishlist.php'</script>";
        }
        else{

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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Wishlist</title>
</head>
<body>
<?php require_once("header.php"); ?>

<div class="container mt-5 pt-3 mb-5 pb-3">
    <div class="row">
        <h6 class="text-dark font-weight-bold pl-3 pt-3">My Wishlist</h6>
    </div>
    <div class="row text-center py-3">
        <!--display wishlist items based on logged user's id-->
        <?php

        $user_id = $_SESSION['user_id'];

        $query = "SELECT * FROM wishlist WHERE user_id = {$user_id} LIMIT $start, $per_page";
        $result = mysqli_query($connection, $query);

        if(count($result) == 0){
            emptyData();
        }
        else {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    wishlist_item($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                }
            } else {
                $massage = "Your wishlist is Empty...!";
                no_records($massage);
            }
        }
        ?>
    </div>

        <!--        pagination-->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                <?php

                for ($i=1; $i <= $page; $i++){
                    $class = '';
                    if ($current_page == $i){
                        $class = 'active';
                    }

                ?>

                    <li class="page-item <?php echo $class; ?>"><a class="page-link" href="?start=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
            </ul>
        </nav>

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
