<?php
session_start();

if (!isset($_SESSION['vendorName'])) {
  header("Location: loginVendor.php");
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
  <link rel="stylesheet" type="text/css" href="productsPageForVendor.css">
  <link rel="stylesheet" type="text/css" href="vendors/fontawesome/css/all.min.css">

  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>


  <style>
    .card {
      box-shadow: 5px 5px 16px #eee;
    }

    .modal-header {
      background: #7676ff;
      color: #fff;
      padding: .5rem 1rem;
      margin: -1px;
    }
  </style>
</head>

<body>

  <!--================ Header Menu Area start =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <a class="navbar-brand logo_h" href="index.html"><b>
              <h3>FarmFresh</h3>
            </b></a>
          <?php
          if (isset($_SESSION['customerName'])) {
            $str = "<p class='navbar-brand logo_h'><b><h5>HI, " . strtoupper($_SESSION['customerName']) . ".</h5></b></p>";
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
              <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
              <li class="nav-item active"><a href="productsPageForVendor.php" class="nav-link">Products</a></li>

              <?php
              if (!isset($_SESSION['vendorName'])) {
                $str = "<li class='nav-item'><a href='registerCustomer.php' class='nav-link' >Register</a></li>

                      <li class='nav-item submenu dropdown'>
                        <a href='#' class='nav-link dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true'
                            aria-expanded='false'>Login</a>
                        <ul class='dropdown-menu'>
                          <li class='nav-item'><a class='nav-link' href='loginCustomer.php'>Customer Login</a></li>
                          <li class='nav-item'><a class='nav-link' href='loginFarmer.php'>Farmer Login</a></li>
                          <li class='nav-item'><a class='nav-link' href='loginAdministrator.php'>Admin Login</a></li>
                        </ul>
                      </li>
                      ";
                echo $str;
              }
              ?>

              <li class="nav-item"><a class="nav-link" href="">Contact</a></li>

              <?php
              if (isset($_SESSION['vendorName'])) {
                $str = "<li class='nav-item'><a class='nav-link' href='logoutClicked.php'>Logout</a></li>";
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

  <?php include 'dataBaseConstants.php';
  $link = mysqli_connect('localhost', $user, $pass, $db);
  $product_list = "";

  if (mysqli_connect_error()) {
    $error = "There was an error connecting to DB!";
  } else {
    //CONNECTED TO DB SUCCESFULLY
    $query = "SELECT * FROM products ORDER BY id DESC";
    $result = mysqli_query($link, $query);


    while ($row = mysqli_fetch_array($result)) {

      $productId = $row['id'];
      $farmerId = $row['farmerid'];
      $productName = $row['productname'];
      $quantityInKg = $row['quantityinkg'];
      $pricePerKg = $row['priceperkg'];
      $verified = $row['verified'];

      $queryForFarmerName = "SELECT * FROM farmers WHERE id=" . $farmerId;
      $resultForFarmerName = mysqli_query($link, $queryForFarmerName);

      $farmerName = "Farmer";
      if (mysqli_num_rows($result) > 0) {
        $rowForFarmerName = mysqli_fetch_array($resultForFarmerName);
        $farmerName = $rowForFarmerName['name'];
      }

      $product_list .= "<div class='col-lg-3 col-md-4 col-sm-6'>
                          <div class='card' id='$productId'>
                            <img class='card-img-top' src='productImages/$productName.png' height='220px' alt='Card image cap'>
                            <div class='card-body'>
                              <h5 class='card-title product-name'>$productName</h5>
                              <h6 class='card-title'>Rs.<span class='product-cost'>$pricePerKg</span>/kg</h6>
                              <p class='card-text sold-by'>Sold By, $farmerName.</p>
                                <button class='btn btn-success btn-lg btn-block' data-product='" . $productId . "' data-toggle='modal'>Order Now</button>
                            </div>
                          </div>  
                        </div>";
    }
  }
  ?>

  <div class="container mb-3">
    <div class="row">
      <div class="form-group col-12">
        <label for="">Search</label>
        <input type="text" id="product_search" class="form-control" placeholder="Enter the product name ..." aria-describedby="helpId">
      </div>

      <!-- The Modal -->
      <div class="modal fade" id="product_modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <p class="modal-title h6">Apple</p>
              <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body py-5">
              <div class="row">
                <div class="col-md-6">
                  <img src="" height="350px" width="350px" alt="product">
                </div>
                <div class="col-md-6">
                  <form action="shoppingCartForVendor.php" method="post">

                    <h3 class="product-name"></h3>
                    <h6 class=''>Rs. <span class="product-cost"></span>/kg</h6>
                    <p class='sold-by mb-5'></p>

                    <div class="input-group mb-3 plusminusgroup">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Qty (Kgs)</span>
                        <input type="number" class="form-control quantity" value="" min="10" step="5" max="30000" required>
                        <input type="hidden" name="product_id" required>
                        <input type="hidden" name="product_quantity" required>
                      </div>
                    </div>
                    <h3 class="mt-5 mb-0">Total Cost: Rs. <span class="calculated-cost"></span></h3>
                    <small>*This is the product cost not including delivery charges</small>

                    <input type="submit" class="btn btn-success btn-sm mt-3" name="proceed_order" value="Proceed">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php echo $product_list ?>


    </div>
  </div>

  <script>
    
    $('#product_modal .calculated-cost').text(0);//Added so that the initial value be 0
    $(document).ready(function() {
      $("#product_search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".row .col-md-4").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
      $('.quantity').keyup(function() {
        var quantity = $(this).val();
        var product_cost = $('#product_modal .product-cost').text();
        $('#product_modal .calculated-cost').text(Number(quantity) * Number(product_cost));
        $('[name="product_quantity"]').val(quantity);
      });


      $('[data-product]').click(function() {
        var product_id = $(this).attr('data-product');
        var product_name = $('#' + product_id + ' .product-name').text();
        var product_cost = $('#' + product_id + ' .product-cost').text();
        var sold_by = $('#' + product_id + ' .sold-by').text();
        var product_image = $('#' + product_id + ' img').attr('src');
        
        $('[name="product_id"]').val(product_id);
        $('#product_modal .modal-title').text(product_name);
        $('#product_modal .product-name').text(product_name);
        $('#product_modal .product-cost').text(product_cost);
        $('#product_modal .sold-by').text(sold_by);
        $('#product_modal img').attr('src', product_image);
        $('#product_modal').modal('show');

        // console.log(product_name);

      });
    });
  </script>


  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/Magnific-Popup/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>

</html>