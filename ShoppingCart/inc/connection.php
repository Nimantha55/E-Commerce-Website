<?php

//$connection = mysqli_connect(dbserver, dbuser, dbpass, dbname);//database connection

$connection = mysqli_connect('localhost', 'root', '', 'cartdb');
//mysqli_connect_errno(); mysqli_connect_error();

//Checking the connection
if(mysqli_connect_errno()){
    die('Database connection failed...! ' . mysqli_connect_error());
}
else{
    //echo "Connection Successful.";
}