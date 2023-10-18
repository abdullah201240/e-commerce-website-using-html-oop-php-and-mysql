<?php
require_once '../app/Controllers/ProductController.php';

use ecom\Controllers\ProductController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




$userController = new ProductController;



 $userController->logout();



?>
