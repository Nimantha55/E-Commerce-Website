<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
if(!empty($_GET['id'])) {
    $id= trim($_GET['id']);
    $query = "DELETE FROM product WHERE id = $id";
    $result = mysqli_query($connection, $query);
    if($result) {
        header("Location: display_products.php");
    }
}