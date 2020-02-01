<?php
session_start();

if (!isset($_SESSION['vendorName'])) {
  header("Location: loginVendor.php");
}
?>

<!DOCTYPE html>
<html lang="en">

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

  <link rel="stylesheet" href="css/shopping-cart/style.css">
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
            $str = "<p class=\"navbar-brand logo_h\"><b><h5>HI, " . strtoupper($_SESSION['customerName']) . ".</h5></b></p>";
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
              <li class="nav-item"><a href="productsPageForVendor.php" class="nav-link">Products</a></li>

              <?php
              if (!isset($_POST['proceed_order'])) {
                header("Location: productsPageForVendor.php");
              }

              if (!isset($_SESSION['vendorName'])) {
                $str = "<li class=\"nav-item\"><a href=\"registerCustomer.php\" class=\"nav-link\" >Register</a></li>
                
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
              if (isset($_SESSION['vendorName'])) {
                $str = "<li class=\"nav-item\"><a class=\"nav-link\" href=\"logoutClicked.php\">Logout</a></li>";
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


  <!--================shopping cart area================-->
  <div class="container">

    <h3>Product ID: #<?php echo $_POST['product_id']?></h3>
    <h4>Quantity: <?php echo $_POST['product_quantity']?> Kg</h4>
    <div class="row">
      <div class="col-sm-12 col-md-10 col-md-offset-1">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity(Kgs)</th>
              <th class="text-center">Price</th>
              <th class="text-center">Total</th>
              <th> </th>
            </tr>
          </thead>
          <tbody>

            <tr>
              <td class="col-md-6">
                <div class="media">
                  <a class="thumbnail pull-left" href="#"> <img class="media-object" src="img/Product/furits/avocado.png" style="width: 72px; height: 72px;"> </a>
                  <div class="media-body">
                    <h4 class="media-heading"><a href="#">Avacado</a></h4>
                    <h5 class="media-heading"> by <a href="#">Farmer name</a></h5>

                  </div>
                </div>
              </td>
              <td class="col-md-1" style="text-align: center">
                <input type="email" class="form-control" id="exampleInputEmail1" value="1000">
              </td>
              <td class="col-md-1 text-center"><strong>Rs.23</strong></td>
              <td class="col-md-1 text-center"><strong>Rs.23000</strong></td>
              <td class="col-md-1">
            </tr>


            <tr>
              <td>   </td>
              <td>   </td>
              <td>   </td>
              <td>
                <h5>Subtotal</h5>
              </td>
              <td class="text-right">
                <h5><strong>Rs.23000</strong></h5>
              </td>
            </tr>
            <tr>
              <td>   </td>
              <td>   </td>
              <td>   </td>
              <td>
                <h5>Estimated shipping (Will implement afterwards)</h5>
              </td>
              <td class="text-right">
                <h5><strong>Rs.2400</strong></h5>
              </td>
            </tr>
            <tr>
              <td>   </td>
              <td>   </td>
              <td>   </td>
              <td>
                <h3>Total</h3>
              </td>
              <td class="text-right">
                <h3><strong>Rs.25400</strong></h3>
              </td>
            </tr>
            <tr>
              <td>   </td>
              <td>   </td>
              <td>   </td>
              <td>
                <a href="productsPageForVendor.php">
                  <button type="button" class="btn btn-default">
                    View other products
                  </button>
                </a>
              </td>
              <td>
                <button type="button" class="btn btn-success">
                  Checkout <span class="glyphicon glyphicon-play"></span>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
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