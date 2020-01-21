<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Farmer Panel</title>
  <link rel="icon" href="img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/Magnific-Popup/magnific-popup.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="productsPage.css">
</head>
<body>

<!--================ Header Menu Area start =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <a class="navbar-brand logo_h" href="index.html"><b><h3>FarmFresh</h3></b></a>

          <?php
            if(isset($_SESSION['farmerName'])){
              $str="<p class=\"navbar-brand logo_h\"><b><h5>Hi, ".ucwords($_SESSION['farmerName'])."(Farmer)</h5></b></p>";
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
              <li class="nav-item <?php if($_GET['toview']=="products"){echo "active";}?>"><a href="" class="nav-link" >My Products</a></li> 
              <li class="nav-item <?php if($_GET['toview']=="customers"){echo "active";}?>"><a href="#" class="nav-link" >Orders</a></li>  
              
              <?php
                if(isset($_SESSION['farmerName'])){
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

<h2><u>Your products :</u></h2>

<div class="container">
    <div class="row">

      <?php

        include 'dataBaseConstants.php';
        $link=mysqli_connect('localhost',$user,$pass,$db);

        if(mysqli_connect_error()){
          $error="There was an error connecting to DB!";
          echo $error;
        }else{
          //CONNECTED TO DB SUCCESFULLY
          $farmerId=$_SESSION['farmerId'];
          $query="SELECT * FROM products WHERE farmerid=".$farmerId." ORDER BY id DESC";
          $result=mysqli_query($link,$query);

          while ($row=mysqli_fetch_array($result)) {
            $productId=$row['id'];
            $productName=$row['productname'];
            $quantityInKg=$row['quantityinkg'];
            $pricePerKg=$row['priceperkg'];
            $verified=$row['verified'];

            $str="

              <div class=\"col-lg-3 col-md-4 col-sm-6\">
                <div class=\"card\">
                  <img class=\"card-img-top\" src=\"productImages/$productName.png\" alt=\"Card image cap\">
                  <div class=\"card-body\">
                    <h5 class=\"card-title\">$productName</h5>
                    <h6 class=\"card-title\">Price : Rs.$pricePerKg/Kg</h6>
                    <h6 class=\"card-title\">Quantity : $quantityInKg Kilograms</h6>
                    <h6 class=\"card-title\">ID : $productId</h6>
                    <h6 class=\"card-title\">Verified : $verified</h6>
                    <a href=\"#\" class=\"btn btn-outline-success btn-lg btn-block\"><b>View</b></a>
                  </div>
                </div>
              </div>

            ";

            echo $str;
          }

        }
      ?>

    </div>
  </div>



  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/Magnific-Popup/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/main.js"></script> 
</body>
</html>