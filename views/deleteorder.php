<?php 
$id=$_GET['id'];
require_once '../app/Controllers/ProductController.php';

use ecom\Controllers\ProductController;



$productController = new ProductController;
$data = $productController->deleteorder($id);
if($data){
    header('location:cart.php');
}
?>