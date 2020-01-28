<?php
  session_start();

  if(!isset($_SESSION['adminName'])){
    header("Location: loginAdministrator.php");
  }

  if (!isset($_GET['productid']) AND !isset($_GET['updateStatus'])) {
    header("Location: adminPanel.php?toview=allproducts");
  }


  if(isset($_GET['updateStatus'])){

    $productId=$_GET['productid'];
    $productName=$_GET['productNameInput'];
    $productQuantity=$_GET['productQuantityInput'];
    $productPrice=$_GET['productPriceInput'];
    $productGrade=$_GET['productGradeInput'];
    $productVerified=0;

    if(isset($_GET['productVerifiedInput'])){
      $productVerified=1;
    }
    
    include 'dataBaseConstants.php';
    $link=mysqli_connect('localhost',$user,$pass,$db);

    if(mysqli_connect_error()){
      $error="There was an error connecting to DB!";
    }else{
      //CONNECTED TO DB SUCCESFULLY
      $query="UPDATE products SET productname='$productName', quantityinkg=$productQuantity, priceperkg=$productPrice, grade='$productGrade', verified=$productVerified WHERE id=$productId";
      if(mysqli_query($link,$query)){
          //echo "Record updated successfully";
      } else {
          //echo "Error updating record: " . mysqli_error($link);
      }

    }


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

<?php

  include 'dataBaseConstants.php';
  $link=mysqli_connect('localhost',$user,$pass,$db);

  if(mysqli_connect_error()){
    $error="There was an error connecting to DB!";
  }else{
    //CONNECTED TO DB SUCCESFULLY
    $productId=$_GET['productid'];
    $query="SELECT * FROM products WHERE id=$productId ORDER BY id DESC";
    $result=mysqli_query($link,$query);

    $row=mysqli_fetch_array($result);

    $farmerId=$row['farmerid'];
    $productName=$row['productname'];
    $quantityInKg=$row['quantityinkg'];
    $pricePerKg=$row['priceperkg'];
    $productGrade=$row['grade'];
    $productVerifyStatus=$row['verified'];

    $queryForFarmer="SELECT * FROM farmers WHERE id=$farmerId";
    $resultForFarmer=mysqli_query($link,$queryForFarmer);

    $rowForFarmer=mysqli_fetch_array($resultForFarmer);

    $farmerName=$rowForFarmer['name'];
    $farmerPhone=$rowForFarmer['phone'];
    $farmerLocation=$rowForFarmer['location'];
    $farmerVerifyStatus=$rowForFarmer['verified'];

  }

?>


<div class="containerOfProductDetails">

  <h3><u>Product details :</u></h3>

  <div class="text-center">
    <img src="productImages/<?php echo $productName ?>.png" class="rounded productImage" alt="...">
  </div>

<form method="GET" action="adminViewSingleProduct.php">

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Product ID</span>
    </div>
    <input type="text" class="form-control" placeholder="0" readonly="readonly" value="<?php echo $productId ?>" name="productid">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Product Name</span>
    </div>
    <input type="text" class="form-control" placeholder="Product Name" aria-label="Username" aria-describedby="addon-wrapping" value="<?php echo $productName ?>" name="productNameInput">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Quantity (Kgs)</span>
    </div>
    <input type="text" class="form-control" placeholder="Product Name" aria-label="Username" aria-describedby="addon-wrapping" value="<?php echo $quantityInKg ?>" name="productQuantityInput">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Price per Kg</span>
    </div>
    <input type="text" class="form-control" placeholder="Product Name" aria-label="Username" aria-describedby="addon-wrapping" value="<?php echo $pricePerKg ?>" name="productPriceInput">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Grade</span>
    </div>
    <input type="text" class="form-control" placeholder="Null" aria-label="Username" aria-describedby="addon-wrapping" value="<?php echo $productGrade ?>" name="productGradeInput">
  </div>
  

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Product Verified</span>
    </div>
    <div class="input-group-text">
      <input type="checkbox" name="productVerifiedInput" value="1"
      <?php 
        if($productVerifyStatus==1){
          echo "checked";
        }
      ?>
      >
    </div>
  </div>

  <input type="hidden" name="updateStatus" value="1">

  <input type="submit" class="btn btn-success" name="Update">
</form>


  <h3><u>Farmer's details :</u></h3>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Farmer ID</span>
    </div>
    <input type="text" class="form-control" placeholder="0" aria-label="Username" aria-describedby="addon-wrapping" disabled="true" value="<?php echo $farmerId ?>">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Farmer Name</span>
    </div>
    <input type="text" class="form-control" placeholder="0" aria-label="Username" aria-describedby="addon-wrapping" disabled="true" value="<?php echo $farmerName ?>">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Farmer Phone</span>
    </div>
    <input type="text" class="form-control" placeholder="0" aria-label="Username" aria-describedby="addon-wrapping" disabled="true" value="<?php echo $farmerPhone ?>">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Location</span>
    </div>
    <input type="text" class="form-control" placeholder="0" aria-label="Username" aria-describedby="addon-wrapping" disabled="true" value="<?php echo $farmerLocation ?>">
  </div>

  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
      <span class="input-group-text" id="addon-wrapping">Farmer Verified</span>
    </div>
    <div class="input-group-text">
      <input type="checkbox" disabled="true"
      <?php 
        if($farmerVerifyStatus==1){
          echo "checked";
        }
      ?>
      >
    </div>
  </div>

</div>
