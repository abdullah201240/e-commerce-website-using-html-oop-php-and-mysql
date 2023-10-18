<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../app/Controllers/ProductController.php';

use ecom\Controllers\ProductController;



$productController = new ProductController;
$data = $productController->buynow();
if($data){
    header('location:orderlist.php');
}


?>