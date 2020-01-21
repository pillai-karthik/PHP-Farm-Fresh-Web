<?php
  session_start();

  if(!isset($_SESSION['adminName'])){
    header("Location: loginAdministrator.php");
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
              <li class="nav-item <?php if($_GET['toview']=="products"){echo "active";}?>"><a href="adminPanel.php?toview=products" class="nav-link" >Products</a></li> 
              
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

<div class="container">
    <div class="row">

	  <?php

	  	include 'dataBaseConstants.php';
	        $link=mysqli_connect('localhost',$user,$pass,$db);

	        if(mysqli_connect_error()){
	          $error="There was an error connecting to DB!";
	        }else{
	        	if(isset($_GET['toview'])){
	        		//THERE IS A GET VARIABLE
		        	$toview=$_GET['toview'];
		        	
		        	if ($toview=="farmers") {//TO VIEW FARMERS
		        		$query="SELECT * FROM farmers ORDER BY id DESC";
		          		$result=mysqli_query($link,$query);

		          		while ($row=mysqli_fetch_array($result)) {
		          			$name=$row['name'];
		          			$id=$row['id'];
		          			$phone=$row['phone'];
		          			$location=$row['location'];
		          			$verified=$row['verified'];
		          			$password=$row['password'];

		          			$str="
		          				<div class=\"col-lg-3 col-md-4 col-sm-6\">
						          <div class=\"card\">
						            <div class=\"card-body\">
						              <h5 class=\"card-title\"><u>Farmer's Details</u></h5>
						              <h5 class=\"card-title\">NAME : $name</h5>
						              <h6 class=\"card-title\">ID : $id</h6>
						              <h6 class=\"card-title\">PHONE : $phone</h6>
						              <h6 class=\"card-title\">LOCATION : $location</h6>
						              <h6 class=\"card-title\">VERIFIED : $verified</h6>
						              <p class=\"card-text\">PASSWORD : $password</p>
						              <a href=\"#\" class=\"btn btn-outline-success btn-lg btn-block\"><b>View</b></a>
						            </div>
						          </div>
						        </div>

		          			";
		          			echo $str;
		          		}

		        	}elseif ($toview=="customers") {//TO VIEW CUSTOMERS
		        		$query="SELECT * FROM customers ORDER BY id DESC";
		          		$result=mysqli_query($link,$query);

		          		while ($row=mysqli_fetch_array($result)) {
		          			$name=$row['name'];
		          			$id=$row['id'];
		          			$phone=$row['phone'];
		          			$location=$row['location'];
		          			$verified=$row['verified'];

		          			$str="
		          				<div class=\"col-lg-3 col-md-4 col-sm-6\">
						          <div class=\"card\">
						            <div class=\"card-body\">
						              <h5 class=\"card-title\"><u>Customer's Details</u></h5>
						              <h5 class=\"card-title\">NAME : $name</h5>
						              <h6 class=\"card-title\">ID : $id</h6>
						              <h6 class=\"card-title\">PHONE : $phone</h6>
						              <h6 class=\"card-title\">LOCATION : $location</h6>
						              <h6 class=\"card-title\">VERIFIED : $verified</h6>
						              <a href=\"#\" class=\"btn btn-outline-success btn-lg btn-block\"><b>View</b></a>
						            </div>
						          </div>
						        </div>

		          			";
		          			echo $str;
		          		}
		        	}elseif ($toview=="products") {
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
				                    <h6 class=\"card-title\">Price : Rs.$pricePerKg/Kg</h6>
				                    <h6 class=\"card-title\">Available : $quantityInKg Kilograms</h6>
				                    <h6 class=\"card-title\">Farmer : $farmerName</h6>
				                    <a href=\"#\" class=\"btn btn-outline-success btn-lg btn-block\"><b>View</b></a>
				                  </div>
				                </div>
				              </div>

				            ";
				            echo $str;
				          }
		        	}
		        }
	    }
	  ?>

	</div>
</div>


<!-- <div class="container">
    <div class="row">

    	<div class="col-lg-3 col-md-4 col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">NAME : $name</h5>
              <h6 class="card-title">ID : $id</h6>
              <h6 class="card-title">PHONE : $phone</h6>
              <h6 class="card-title">LOCATION : $location</h6>
              <h6 class="card-title">VERIFIED : $verified</h6>
              <a href="showitem.php?bookid=1&title=automata&price=900" class="btn btn-outline-success btn-lg btn-block"><b>View</b></a>
            </div>
          </div>
        </div>

	</div>
</div> -->




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