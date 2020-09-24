<?php session_start(); ?>
<?php require_once('component.php'); ?>
<?php require_once('inc/connection.php'); ?>
<?php



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
    <title>Shopping Cart</title>
</head>
<body>

<p><?php echo $_SESSION['product_name']; ?></p>

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
