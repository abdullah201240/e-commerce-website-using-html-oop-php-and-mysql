<?php

use ecom\Controllers\ProductController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include './vendor/autoload.php';



$userController = new ProductController;

$username = $_POST['username']; 
$password = $_POST['password'];

$user = $userController->riderlogin($username, $password);


if ($user !== false) { 
 
    
    

    
    header('location:./views/riderhome.php');
    
} else {
    echo "Authentication failed";
}
?>
