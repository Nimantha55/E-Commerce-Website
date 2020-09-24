<?php session_start(); ?>
<?php require_once('component.php'); ?>
<?php require_once('inc/connection.php'); ?>
<?php

//checking if a user is logged in
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
}

if(isset($_POST['addProduct'])){
    //checking if a user is logged in
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }
    else{
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_img = ($_POST['product_image']);
        $product_category = $_POST['product_category'];
        $product_description = $_POST['product_description'];
        $product_features = $_POST['product_features'];

        $select = "SELECT * FROM product WHERE product_name = '{$product_name}'";
        $result = mysqli_query($connection, $select);
        if ($result){
            $product = mysqli_num_rows($result);
            if ($product != 0){
                echo "<script>alert('Product is already added..!')</script>";
                echo"<script>window.location = 'display_products.php'</script>";
            }
            else{
                $addToProduct = "INSERT INTO product(product_name, product_price, product_img, category, product_description, product_features) VALUES ('{$product_name}', {$product_price}, './img/{$product_img}', '{$product_category}', '{$product_description}', '{$product_features}')";
                $results = mysqli_query($connection, $addToProduct);

                if ($results){
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
if(isset($_POST['modifyProduct'])){
    //checking if a user is logged in
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }
    else{
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_img = "";
        $product_category = $_POST['product_category'];
        $product_description = $_POST['product_description'];
        $product_features = $_POST['product_features'];

        if(!empty($_POST['product_image'])){
            $product_img = "./img/" . ($_POST['product_image']);
        }
        else{
            $product_img = ($_POST['img']);
        }

        $updateProduct = "UPDATE product SET product_name = '{$product_name}', product_price = {$product_price}, product_img = '{$product_img}', category = '{$product_category}', product_description = '{$product_description}', product_features = '{$product_features}' WHERE id = {$product_id} LIMIT 1";
        $results = mysqli_query($connection, $updateProduct);

        if ($results){
            //query successful...redirecting to users page
        }
        else{
            $errors[] = "Failed to update the record";
            echo "error" . mysqli_error($connection);
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
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="js/all.js"></script>
    <link rel="stylesheet" href="fonts/fontawesome.min.css">
    <title>Shopping Cart</title>
</head>
<body>

<div class="wrapper">
    <?php require_once("dashboard_header.php"); ?>
    <div id="content">
        <?php require_once("dashboard_navbar.php"); ?>

        <div class="container product mt-4">
            <h5 class="text-muted font-weight-bold">Product Details</h5>
            <button type="button" class="btn btn-outline-primary btn-sm my-2" data-toggle='modal' data-target='#addModal'>Add New Product</button>
            <div class="row bg-white">
                <dic class="col-12 mt-3 table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-dark text-white">
                            <th scope="col">Product ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $query = "SELECT * FROM product";
                        $result = mysqli_query($connection, $query);
                        if ($result){
                            while($row = mysqli_fetch_array($result))
                            {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . "$" . $row['product_price'] . "</td>";
                                echo "<td>" . $row['product_img'] . "</td>";
                                echo "<td><button type='button' class='btn btn-outline-success btn-sm mr-3' data-toggle='modal' data-target='#{$row['id']}'>Edit</button> <a class='btn btn-outline-danger btn-sm' href='delete.php?id={$row['id']}'>Delete</a></td>";
                                echo "</tr>";

                                $element = "
                                    <div class='modal fade' tabindex='-1' role='dialog' id='{$row['id']}'>
                                        <div class='modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal' area-label='Close'>
                                                    <span area-hidden='true'>&times;</span>
                                                    </button>
                                                </div>
                                                <form action='display_products.php' method='post'>
                                                    <div class='modal-body'>
                                                        <h5 class='text-muted font-weight-bold text-center text-uppercase mb-4'>Modify Product Details</h5>
                                                        <div class='row'>
                                                            <div class='col-6'>
                                                                <div class='form-group'>
                                                                    <label for='productName' class='text-dark font-weight-bold'>Product Name</label>
                                                                    <input type='text' name='product_name' class='form-control' id='productName' placeholder='Enter Product Name' value='{$row['product_name']}'>
                                                                </div>
                                                            </div>
                                                            <div class='col-6'>
                                                                <div class='form-group'>
                                                                    <label for='productPrice' class='text-dark font-weight-bold'>Product Price($)</label>
                                                                    <input type='number' name='product_price' class='form-control' id='productPrice' placeholder='Enter Product Price' value='{$row['product_price']}'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='row'>
                                                            <div class='col-6'>
                                                                <div class='form-group'>
                                                                    <h6 class='text-dark font-weight-bold'>Product Image</h6>
                                                                    <div class='custom-file mt-1'>
                                                                        <input type='file' class='custom-file-input' id='customFile' name='product_image'>
                                                                        <label class='custom-file-label' for='customFile'>{$row['product_img']}</label>
                                                                        <input type='hidden' name='img' value='{$row['product_img']}'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='col-6'>
                                                                <div class='form-group'>
                                                                    <label for='productCategory' class='text-dark font-weight-bold'>Product Category</label>
                                                                    <select id='productCategory' class='form-control' name='product_category'>
                                                                        <option selected class='dropdown-item'>{$row['category']}</option>
                                                                        <option class='dropdown-item' value='All'>All</option>
                                                                        <option class='dropdown-item' value='Sport'>Sport</option>
                                                                        <option class='dropdown-item' value='Technology'>Technology</option>
                                                                        <option class='dropdown-item' value='Electronic'>Electronic</option>
                                                                        <option class='dropdown-item' value='Furniture'>Furniture</option>
                                                                        <option class='dropdown-item' value='Foods'>Foods</option>
                                                                        <option class='dropdown-item' value='Cloths'>Cloths</option>
                                                                        <option class='dropdown-item' value='Shoes'>Shoes</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>                        
                                                        <div class='row'>
                                                            <div class='col-12'>
                                                                <div class='form-group'>
                                                                    <label for='productDesc' class='text-dark font-weight-bold'>Product Description</label>
                                                                    <input type='text' name='product_description' class='form-control' id='productDesc' placeholder='Enter Product Description' value='{$row['product_description']}'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='row'>
                                                            <div class='col-12'>
                                                                <div class='form-group'>
                                                                    <label for='productFeat' class='text-dark font-weight-bold'>Product Features</label>
                                                                    <input type='text' name='product_features' class='form-control' id='productFeat' placeholder='Enter Product Features' value='{$row['product_features']}'>
                                                                </div>
                                                            </div>
                                                        </div>                           
                                                        <div class='text-right mt-4'>
                                                            <input type='hidden' name='product_id' value='{$row['id']}'>
                                                            <button type='button' class='btn btn-danger btn-sm' data-dismiss='modal'>Close</button>
                                                            <button type='Submit' class='btn btn-primary btn-sm' name='modifyProduct'>Update</button>                         
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                ";
                                echo $element;
                            }
                        }
                        else{
                            echo "<h5>Records not found</h5>";
                        }
                        ?>
                        </tbody>
                    </table>
            </div>
        </div>

    </div>
</div>

<!--        <footer>-->
<!--            <div class="col-12 bg-dark text-white text-center py-3 mb-0 page-footer">-->
<!--                <span>-->
<!--                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">NS</a>-->
<!--                </span>-->
<!--            </div>-->
<!--        </footer>-->

<!--start popup modals-->
<?php addNewProduct(); ?>
<!--end popup modals-->

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/script.js"></script>
</body>
</html>
