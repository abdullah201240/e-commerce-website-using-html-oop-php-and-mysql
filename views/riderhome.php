<?php 
require_once '../app/Controllers/ProductController.php';

use ecom\Controllers\ProductController;



$productController = new ProductController;
$data = $productController->riderorderlist();

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Rider Home</title>
  </head>
  <body style="background-image: url(../image/water-rain-water-drops-nature-water-hd-art-wallpaper-preview.jpg);">
    
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="riderhome.php">Rain Water</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="riderhome.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="riderprofile.php">Profile</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="riderorderlist.php">Order List</a>
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
        <th>Name</th>
        <th>Address</th>
    <th scope="col">Type1</th>
      <th scope="col">Type2</th>
      <th scope="col">Type3</th>
      <th scope="col">Price</th>
      <th>Pick</th>
      
     

    </tr>
  </thead>
  <?php foreach ($data as $da): ?>
  <tbody>
    <tr>
    <td><?php echo $da['name']; ?></td>
    <td><?php echo $da['address']; ?></td>
      
    <td><?php echo $da['type1']; ?></td>
      <td><?php echo $da['type2']; ?></td>

      <td><?php echo $da['type3']; ?></td>
      <td><?php echo $da['price']; ?></td>
      <td>
        <?php 
        $pic=$da['id'];
        
      
      echo"<a href='pick.php?id=$pic'><button type='button' class='btn btn-success'>Pick</button></a>";
    ?>
    </td>

     

    </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>
  </body>
</html>