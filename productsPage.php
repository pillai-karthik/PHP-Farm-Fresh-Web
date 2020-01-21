<?php
  session_start();

  if(!isset($_SESSION['customerName'])){
    header("Location: loginCustomer.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>FarmFresh - Home</title>
  <link rel="icon" href="img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/Magnific-Popup/magnific-popup.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="vendors/Product-page-list/style.css">
  <link rel="stylesheet" type="text/css" href="productsPage.css">
  <link rel="stylesheet" type="text/css" href="vendors/fontawesome/css/all.min.css">

  <script>
    function onchangeAdd(productId){
      document.getElementById('numberr'+productId).stepUp(1);
    }


    function onchangeSubtract(productId){
      if(document.getElementById('numberr'+productId).value==0){
        document.getElementById('numberr'+productId).value=0;
      }else{
        document.getElementById('numberr'+productId).stepDown(1);
      }
    }
  </script>

</head>
<body>

<!--================ Header Menu Area start =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <a class="navbar-brand logo_h" href="index.html"><b><h3>FarmFresh</h3></b></a>
          <?php
            if(isset($_SESSION['customerName'])){
              $str="<p class=\"navbar-brand logo_h\"><b><h5>HI, ".strtoupper($_SESSION['customerName']).".</h5></b></p>";
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
              <li class="nav-item"><a href="shoppingCart.php" class="nav-link" >My Cart</a></li> 
              <li class="nav-item"><a href="index.php" class="nav-link" >Home</a></li> 
              <li class="nav-item active"><a href="productsPage.php" class="nav-link" >Products</a></li> 

              <?php
                if(!isset($_SESSION['customerName'])){
                  $str="<li class=\"nav-item\"><a href=\"registerCustomer.php\" class=\"nav-link\" >Register</a></li>

                      <li class=\"nav-item submenu dropdown\">
                        <a href=\"#\" class=\"nav-link dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\"
                            aria-expanded=\"false\">Login</a>
                        <ul class=\"dropdown-menu\">
                          <li class=\"nav-item\"><a class=\"nav-link\" href=\"loginCustomer.php\">Customer Login</a></li>
                          <li class=\"nav-item\"><a class=\"nav-link\" href=\"loginFarmer.php\">Farmer Login</a></li>
                          <li class=\"nav-item\"><a class=\"nav-link\" href=\"loginAdministrator.php\">Admin Login</a></li>
                        </ul>
                      </li>
                      ";
                  echo $str;
                } 
              ?>

              <li class="nav-item"><a class="nav-link" href="">Contact</a></li>

              <?php
                if(isset($_SESSION['customerName'])){
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
  <p>
    <a href="shoppingCart.php" class="btn btn-outline-success btn-lg btn-block gotocart" >
      <b>ADD TO CART</b>
    </a>
  </p>

  <div class="container">
    <div class="row">

      <?php

        include 'dataBaseConstants.php';
        $link=mysqli_connect('localhost',$user,$pass,$db);

        if(mysqli_connect_error()){
          $error="There was an error connecting to DB!";
        }else{
          //CONNECTED TO DB SUCCESFULLY
          $query="SELECT * FROM products ORDER BY id DESC";
          $result=mysqli_query($link,$query);

          
          while ($row=mysqli_fetch_array($result)) {
            
            $productId=$row['id'];
            $farmerId=$row['farmerid'];
            $productName=$row['productname'];
            $quantityInKg=$row['quantityinkg'];
            $pricePerKg=$row['priceperkg'];
            $verified=$row['verified'];

            $queryForFarmerName="SELECT * FROM farmers WHERE id=".$farmerId;
            $resultForFarmerName=mysqli_query($link,$queryForFarmerName);

            $farmerName="Farmer";
            if(mysqli_num_rows($result)>0){
              $rowForFarmerName=mysqli_fetch_array($resultForFarmerName);
              $farmerName=$rowForFarmerName['name'];
            }

            $str="

              <div class=\"col-lg-3 col-md-4 col-sm-6\">
                <div class=\"card\">
                  <img class=\"card-img-top\" src=\"productImages/$productName.png\" alt=\"Card image cap\">
                  <div class=\"card-body\">
                    <h5 class=\"card-title\">$productName</h5>
                    <h6 class=\"card-title\">Rs.$pricePerKg/kg</h6>
                    <p class=\"card-text\">Sold By, $farmerName.</p>
                    <div align=\"center\" class=\"text-center add_sub\">
                      <button class=\"btn btn-danger btn_1\" onclick=\"onchangeSubtract($productId)\"><b>-</b></button>
                      <input type=\"number\" class=\"number \" disabled id=\"numberr$productId\" value=\"0\">
                      <button class=\"btn btn-success btn_2\" onclick=\"onchangeAdd($productId)\"><b>+</b></button>
                    </div>
                  </div>
                </div>
              </div>

            ";
            echo $str;
            
          }

        }
      ?>


  <div class="col-lg-3 col-md-4 col-sm-6">
    <div class="card">
      <img class="card-img-top" src="productImages/tomato.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">$productName</h5>
        <h6 class="card-title">Rs.$pricePerKg per Kilogram</h6>
        <p class="card-text">Sold By, $farmerName.</p>
        <a href="shoppingCart.php" class="btn btn-outline-success btn-lg btn-block" >
        <b>Add to cart</b></a>
        <div align="center" class="text-center add_sub">
          <button class="btn btn-danger btn_1" onclick="onchangeSubtract()"><b>-</b></button>
          <input type="number" class="number " disabled id="numberr" value="0">
          <button class="btn btn-success btn_2" onclick="onchangeAdd()"><b>+</b></button>
        </div>
      </div>

    </div>  
  </div>





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