<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../app/Controllers/ProductController.php';

use ecom\Controllers\ProductController;



$productController = new ProductController;
$userInfo = $productController->home();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $type1=$_POST['type1'];
    $type2=$_POST['type2'];
    $type3=$_POST['type3'];
    $user = $productController->orderinsert($type1, $type2,$type3);
    if($user){
        header('location:../views/cart.php');
    }
    
 

 
 }

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>User Home</title>
  </head>
  <body style="background-image: url(../image/water-rain-water-drops-nature-water-hd-art-wallpaper-preview.jpg);">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Rain Water</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="orderlist.php">Order List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
     
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<?php 
if ($userInfo !== null) {
    echo$userInfo['name'];
}


?>



<center> <h2>Our Order type</h2>  
<div style="background-color: white; width:1000px;">

<form action="" method="post">
<table >

<tr>
<td> <img src = '../image/WhatsApp Image 2023-07-11 at 8.08.22 PM.jpeg' alt = '' height = '100px' width = '100px'>   <h3>Type1</h3> <br> <p>Totally Purified Water</p> <br> <p>100tk Per Gallon</p> <br> <p> Total Amount Of Type-I: 30500 Gallons <br> ( Minimum Order 1000 Gallons )</p>
<br>
<label for = ''>How Much Gallons You Want To Order?</label> <br><br>
<input type = 'text' name = 'type1'>

</td>
<td>  <img src = '../image/WhatsApp Image 2023-07-11 at 8.15.00 PM.jpeg' alt = '' height = '100px' width = '100px'> <br>
<h3>Type2</h3> <br> <p>Partially Purified Water</p>
<br>
<p>50tk Per Gallon</p>
<br>
<p>Total Amount Of Type-II: 51000 Gallons <br>( Minimum Order 650 Gallons )</p>
<br>
<label for = ''>How Much Gallons You Want To Order?</label> <br><br>
<input type = 'text' name = 'type2'>

</td>

<td>  <img src = '../image/WhatsApp Image 2023-07-11 at 8.21.19 PM.jpeg' alt = '' height = '100px' width = '100px'> <br>
<h3>Type3</h3> <br> <p>Non Purified Water</p>
<br>
<p>10tk Per Gallon</p>
<br>
<p>Total Amount Of Type-III: 31000 Gallons <br>( Minimum Order 500 Gallons )</p>
<br>
<label for = ''>How Much Gallons You Want To Order?</label> <br><br>
<input type = 'text' name = 'type3'>

</td>


</tr>


</table>
<br>
<br>
  <button type="submit">Add To Cart</button>
  <br> </center>
  
</form>


</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>