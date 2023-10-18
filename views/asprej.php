<?php 
$id=$_GET['id'];
$code=$_GET['code'];
$email=$_GET['email'];
$name=$_GET['name'];

require_once '../app/Controllers/ProductController.php';

use ecom\Controllers\ProductController;



$productController = new ProductController;
$data = $productController->asprej($id,$code,$email,$name);
if($data){
    header('location:riderlist.php');
}
?>