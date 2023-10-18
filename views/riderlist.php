<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
require_once '../app/Controllers/ProductController.php';

use ecom\Controllers\ProductController;



$productController = new ProductController;
$data = $productController->adminriderlist();

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Admin Rider List</title>
  </head>
  <body style="background-image: url(../image/photo-1438449805896-28a666819a20.jpeg);">
   

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="adminhome.php">Rain Water</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="adminhome.php">Home</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="riderlist.php">Rider List</a>
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
<center><H1 style="color:white">Order List</H1></center>
<br>
<table class="table table-dark">
  <thead>
    <tr>
    <th>Order Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>email </th>
                <th>Phone</th>
                <th>CV </th>
                <th>Status</th>
                <th>Accept</th>
                <th>Reject</th>
     

    </tr>
  </thead>
  <?php foreach ($data as $da): ?>
  <tbody>
    <tr>
      
    <td><?php echo$da['id'];  ?></td>
                    <td><?php echo$da['name'];  ?></td>
                    <td><?php echo$da['address'];  ?></td>
                    <td><?php echo$da['email'];  ?></td>
                    <td><?php echo$da['phone'];  ?></td>
                   
                    <td><?php echo$da['status'];  ?></td>
                    <td>
                        <?php 
                                             $id=$da['id'];
                                             $name=$da['name'];
                                             $email=$da['email'];

                        
                    
                   echo" <a href='asprej.php?id=$id&&code=1&&email=$email&&name=$name'><button type='button' class='btn btn-success'>Accept</button></a>";
                    
                    ?></td>
                    <td>
                    <?php 
                     $id=$da['id'];
                     $name=$da['name'];
                     $email=$da['email'];
                        
                        echo" <a href='asprej.php?id=$id&&code=2&&email=$email&&name=$name'> <button type='button' class='btn btn-danger'>Reject</button></a>"
                    
                    ?></td>
                   

    </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>
  </body>
</html>