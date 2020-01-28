<?php
  session_start();

  if(!isset($_SESSION['adminName'])){
    header("Location: loginAdministrator.php");
  }

  if (!isset($_GET['productid'])) {
    header("Location: adminPanel.php?toview=allproducts");
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Panel</title>
  <link rel="icon" href="img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/Magnific-Popup/magnific-popup.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="adminViewSingleProduct.css">
</head>
<body>

<!--================ Header Menu Area start =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <a class="navbar-brand logo_h" href="index.html"><b><h3>FarmFresh</h3></b></a>

          <?php
            if(isset($_SESSION['adminName'])){
              $str="<p class=\"navbar-brand logo_h\"><b><h5>Hi, ".ucwords($_SESSION['adminName']).".</h5></b></p>";
              echo $str;
            } 
          ?>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-end">
              <li class="nav-item <?php if($_GET['toview']=="farmers"){echo "active";}?>"><a href="adminPanel.php?toview=farmers" class="nav-link" >Farmers</a></li>
              <li class="nav-item <?php if($_GET['toview']=="customers"){echo "active";}?>"><a href="adminPanel.php?toview=customers" class="nav-link" >Customers</a></li>  
              <li class="nav-item <?php if($_GET['toview']=="products"){echo "active";}?>"><a href="adminPanel.php?toview=allproducts" class="nav-link" >Products</a></li> 
              
              <?php
                if(isset($_SESSION['adminName'])){
                  $str="<li class=\"nav-item\"><a class=\"nav-link\" href=\"logoutClicked.php\">Logout</a></li>";
                  echo $str;
                } 
              ?>

            </ul>
          </div> 
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->

<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <a href="adminPanel.php?toview=allproducts">
      <button class="btn btn-outline-success navbtn" type="button">All Products</button>
    </a>
    <a href="adminPanel.php?toview=unverifiedproducts">
      <button class="btn btn-outline-success navbtn" type="button">Un-verified Products</button>
  </a>
  <a href="adminPanel.php?toview=verifiedproducts">
      <button class="btn btn-outline-success navbtn" type="button">Verified Products</button>
    </a>
  </form>
</nav>


<div class="containerOfProductDetails">

  <h3><u>Product details :</u></h3>
  <div class="text-center">
    <img src="productImages/onion.png" class="rounded productImage" alt="...">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Product ID</span>
    </div>
    <input type="text" class="form-control" placeholder="0" aria-label="Username" aria-describedby="addon-wrapping" disabled="true">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Product Name</span>
    </div>
    <input type="text" class="form-control" placeholder="Product Name" aria-label="Username" aria-describedby="addon-wrapping" value="XYZ">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Quantity (Kgs)</span>
    </div>
    <input type="text" class="form-control" placeholder="Product Name" aria-label="Username" aria-describedby="addon-wrapping" value="0">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Price per Kg</span>
    </div>
    <input type="text" class="form-control" placeholder="Product Name" aria-label="Username" aria-describedby="addon-wrapping" value="0">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Grade</span>
    </div>
    <input type="text" class="form-control" placeholder="A" aria-label="Username" aria-describedby="addon-wrapping" value="A">

  </div>
  

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Verified</span>
    </div>
    <div class="input-group-text">
      <input type="checkbox">
    </div>
  </div>

  <button type="button" class="btn btn-success">Update</button>


  <h3><u>Farmer's details :</u></h3>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Farmer ID</span>
    </div>
    <input type="text" class="form-control" placeholder="0" aria-label="Username" aria-describedby="addon-wrapping" disabled="true">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Farmer Name</span>
    </div>
    <input type="text" class="form-control" placeholder="0" aria-label="Username" aria-describedby="addon-wrapping" disabled="true">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Farmer Phone</span>
    </div>
    <input type="text" class="form-control" placeholder="0" aria-label="Username" aria-describedby="addon-wrapping" disabled="true">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Location</span>
    </div>
    <input type="text" class="form-control" placeholder="0" aria-label="Username" aria-describedby="addon-wrapping" disabled="true">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Verification status</span>
    </div>
    <input type="text" class="form-control" placeholder="0" aria-label="Username" aria-describedby="addon-wrapping" disabled="true">
  </div>

</div>
