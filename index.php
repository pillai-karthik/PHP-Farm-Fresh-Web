<?php
  session_start();
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
            if(isset($_SESSION['vendorName'])){
              $str="<p class=\"navbar-brand logo_h\"><b><h5>HI, ".strtoupper($_SESSION['vendorName']).".</h5></b></p>";
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
              <li class="nav-item active"><a class="nav-link" href="">Home</a></li> 

              <?php
              if(isset($_SESSION['customerName'])){
                $str="<li class=\"nav-item\"><a href=\"productsPageForCustomer.php\" class=\"nav-link\" >Products</a></li>";
                echo $str;
              }elseif(isset($_SESSION['vendorName'])){
                $str="<li class=\"nav-item\"><a href=\"productsPageForVendor.php\" class=\"nav-link\" >Products</a></li>";
                echo $str;
              } 
               
              ?>

              <li class="nav-item"><a href="#review-div" class="nav-link" >Reviews</a></li>

              <?php
                if(!isset($_SESSION['customerName']) AND !isset($_SESSION['vendorName'])){
                  $str="<li class=\"nav-item\"><a href=\"registerCustomer.php\" class=\"nav-link\" >Register</a></li>

                      <li class=\"nav-item submenu dropdown\">
                        <a href=\"#\" class=\"nav-link dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\"
                            aria-expanded=\"false\">Login</a>
                        <ul class=\"dropdown-menu\">
                          <li class=\"nav-item\"><a class=\"nav-link\" href=\"loginCustomer.php\">Customer Login</a></li>
                          <li class=\"nav-item\"><a class=\"nav-link\" href=\"loginVendor.php\">Vendor Login</a></li>
                          <li class=\"nav-item\"><a class=\"nav-link\" href=\"loginFarmer.php\">Farmer Login</a></li>
                          <li class=\"nav-item\"><a class=\"nav-link\" href=\"loginAdministrator.php\">Admin Login</a></li>
                        </ul>
                      </li>";
                  echo $str;
                } 
              ?>

              <li class="nav-item"><a class="nav-link" href="">Contact</a></li>

              <?php
                if(isset($_SESSION['customerName']) OR isset($_SESSION['vendorName'])){
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

  <!--================Hero Banner Section start =================-->
  <section class="hero-banner">
    <div class="hero-wrapper">
      <div class="hero-left">
        <h1 class="hero-title">Foods the <br> most precious things</h1>
        <div class="d-sm-flex flex-wrap">
          <a class="button button-hero button-shadow" href="productsPage.php">Buy Now</a>
        </div>
        <ul class="hero-info d-none d-lg-block">
          <li>
            <img src="img/banner/fas-service-icon.png" alt=""><br><br>
            <h5>Directly from <br> farm</h5>
          </li>
          <li>
            <img src="img/banner/fresh-food-icon.png" alt="">
            <h4>Fresh food</h4>
          </li>
          <li>
            <img src="img/banner/support-icon.png" alt="">
            <h4>Customer support</h4>
          </li>
        </ul>
      </div>
      <div class="hero-right">
        <div class="owl-carousel owl-theme hero-carousel">
          <div class="hero-carousel-item">
            <img class="img-fluid" height="80" src="img/banner/hero-banner1.png" alt="">
          </div>
          <div class="hero-carousel-item">
            <img class="img-fluid" src="img/banner/hero-banner2.png" alt="">
          </div>
          <div class="hero-carousel-item">
            <img class="img-fluid" src="img/banner/hero-banner1.png" alt="">
          </div>
          <div class="hero-carousel-item">
            <img class="img-fluid" src="img/banner/hero-banner2.png" alt="">
          </div>
        </div>
      </div>
      <ul class="social-icons d-none d-lg-block">
        <li><a href="#"><i class="ti-facebook"></i></a></li>
        <li><a href="#"><i class="ti-twitter"></i></a></li>
        <li><a href="#"><i class="ti-instagram"></i></a></li>
      </ul>
    </div>
  </section>
  <!--================Hero Banner Section end =================-->

  
  <!--================About Section start =================-->
  <section class="about section-margin pb-xl-70">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-xl-6 mb-5 mb-md-0 pb-5 pb-md-0">
          <div class="img-styleBox">
            <div class="styleBox-border">
              <img class="styleBox-img1 img-fluid" src="img/home/about-img1.jpg" alt="" height="450px" width="450px">
            </div>
            <img class="styleBox-img2 img-fluid" src="img/home/about-img2.jpg" alt="" height="300px" width="300px">
          </div>
        </div>
        <div class="col-md-6 pl-md-5 pl-xl-0 offset-xl-1 col-xl-5">
          <div class="section-intro mb-lg-4">
            <h4 class="intro-title">About Us</h4>
            <h2>We speak the good food language</h2>
          </div>
          <p> Eat Healthy Live Healthy.<br> We provide the farm-fresh directly from the farmers farm to the consumers and the buyers. Here there is no intervention of any third party, the farmer sell their produce, and connect with the buyers all over the India. Because of which not only the farmers are benefited with the better price for their produce but also the buyers and the consumers are benefited with the freshness of the produce. </p>
          <!-- <a class="button button-shadow mt-2 mt-lg-4" href="">Learn More</a> -->
        </div>
      </div>
    </div>
  </section>
  <!--================About Section End =================-->


  <!--================Featured Section Start =================-->
  <section class="section-margin mb-lg-100">
    <div class="container">
      <div class="section-intro mb-75px">
        <h4 class="intro-title">Featured Food</h4>
        <h2>Fresh taste and great price</h2>
      </div>


      <div class="owl-carousel owl-theme featured-carousel">
        <div class="featured-item">
          <img class="card-img rounded-0" src="img/home/featured1.png" alt="">
          <div class="item-body">
            <a href="productPage.php">
              <h3>Cabbage</h3>
            </a>
            <p>Vegetable</p>
            <div class="d-flex justify-content-between">
              <ul class="rating-star">
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
              </ul>
              <h3 class="price-tag">Rs.35</h3>
            </div>
          </div>
        </div>
        <div class="featured-item">
          <img class="card-img rounded-0" src="img/home/featured2.png" alt="">
          <div class="item-body">
            <a href="productsPage.php">
              <h3>Tomato</h3>
            </a>
            <p>Fruit</p>
            <div class="d-flex justify-content-between">
              <ul class="rating-star">
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
              </ul>
              <h3 class="price-tag">Rs.30</h3>
            </div>
          </div>
        </div>
        <div class="featured-item">
          <img class="card-img rounded-0" src="img/home/featured3.png" alt="">
          <div class="item-body">
            <a href="productsPage.php">
              <h3>Corn</h3>
            </a>
            <p>Vegetable</p>
            <div class="d-flex justify-content-between">
              <ul class="rating-star">
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
              </ul>
              <h3 class="price-tag">Rs.20</h3>
            </div>
          </div>
        </div>
        <div class="featured-item">
          <img class="card-img rounded-0" src="img/home/featured4.png" alt="">
          <div class="item-body">
            <a href="productsPage.php">
              <h3>Onion</h3>
            </a>
            <p>Vegetable</p>
            <div class="d-flex justify-content-between">
              <ul class="rating-star">
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
                <li><i class="ti-star"></i></li>
              </ul>
              <h3 class="price-tag">Rs.35</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================Featured Section End =================-->

  <!--================Offer Section Start =================-->
  <section class="bg-lightGray section-padding">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-sm">
          <img class="card-img rounded-0" src="img/home/offer-img.png" alt="">
        </div>
        <div class="col-sm">
          <div class="offer-card offer-card-position">
            <h3>Vegetable Basket</h3>
            <h2>50% OFF</h2>
            <h10>Onion+Tomato+Coriander+Spinach+Cabbage</h10><br><br>
            <!-- <a class="button" href="#">Add to cart</a> -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================Offer Section End =================-->


  <!--================Food menu section start =================-->  
  <section class="section-margin">
    <div class="container">
      <div class="section-intro mb-75px">
        <h4 class="intro-title">Groceries</h4>
        <h2>Fresh item</h2>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="media align-items-center food-card">
            <img class="mr-3 mr-sm-4" src="img/home/food1.png" alt="">
            <div class="media-body">
              <div class="d-flex justify-content-between food-card-title">
                <h4>Carrots</h4>
                <h3 class="price-tag">Rs.30/kg</h3>
              </div>
              <p>Fresh crips carrots</p>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="media align-items-center food-card">
            <img class="mr-3 mr-sm-4" src="img/home/food2.png" alt="">
            <div class="media-body">
              <div class="d-flex justify-content-between food-card-title">
                <h4>Brocoli</h4>
                <h3 class="price-tag">Rs.50/kg</h3>
              </div>
              <p>Sweet and leafy</p>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="media align-items-center food-card">
            <img class="mr-3 mr-sm-4" src="img/home/food3.png" alt="">
            <div class="media-body">
              <div class="d-flex justify-content-between food-card-title">
                <h4>Chilly</h4>
                <h3 class="price-tag">Rs.10/100g</h3>
              </div>
              <p>Spicy af</p>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="media align-items-center food-card">
            <img class="mr-3 mr-sm-4" src="img/home/food4.png" alt="">
            <div class="media-body">
              <div class="d-flex justify-content-between food-card-title">
                <h4>Wheat</h4>
                <h3 class="price-tag">Rs.37/kg</h3>
              </div>
              <p>Freshly from farm</p>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="media align-items-center food-card">
            <img class="mr-3 mr-sm-4" src="img/home/food5.png" alt="">
            <div class="media-body">
              <div class="d-flex justify-content-between food-card-title">
                <h4>Potato</h4>
                <h3 class="price-tag">Rs.20/kg</h3>
              </div>
              <p>Perfect for fries</p>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="media align-items-center food-card">
            <img class="mr-3 mr-sm-4" src="img/home/food6.png" alt="">
            <div class="media-body">
              <div class="d-flex justify-content-between food-card-title">
                <h4>Capsicum</h4>
                <h3 class="price-tag">Rs.10/kg</h3>
              </div>
              <p>Juicy and fresh</p>
            </div>
          </div>
        </div>
 
        </div>
      </div>
    </div>
  </section>
  <!--================Food menu section end =================-->  

  <!--================CTA section start =================-->  
  <section class="cta-area text-center">
    <div class="container">
      <h2>Farm workers are society's canaries. Farm workers and their children demonstrate the effects of pesticide poisoning before anyone else.</h2>
      <p>-Cesar Chavez</p>
      <!-- <a class="button" href="#">Buy Now</a> -->
    </div>
  </section>
  <!--================CTA section end =================-->  


  <!--================Chef section start =================-->  
  <section class="section-margin">
    <div class="container">
      <div class="section-intro mb-75px">
        <h4 class="intro-title">Our Farmers</h4>
        <h2>Prominent members</h2>
      </div>

      <div class="row">
        <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
          <div class="chef-card">
            <img class="card-img rounded-0" src="img/home/chef-1.png" alt="">
            <div class="chef-footer">
              <h4>Shri K.V.Rakesh </h4>
              <p>Farmer & Family</p>
            </div>

          </div>
        </div>

        <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
          <div class="chef-card">
            <img class="card-img rounded-0" src="img/home/chef-2.png" alt="">
            <div class="chef-footer">
              <h4>Shri Denanath Vithalrao</h4>
              <p>Farmer</p>
            </div>

          </div>
        </div>

        <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
          <div class="chef-card">
            <img class="card-img rounded-0" src="img/home/chef-3.png" alt="">
            <div class="chef-footer">
              <h4>Shri Keshav Shinde</h4>
              <p>Farmer</p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================Chef section end =================-->  


  <!--================Reservation section start =================-->  
  <section class="bg-lightGray section-padding">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 col-xl-5 mb-4 mb-md-0">
          <div class="section-intro">
            <h4 class="intro-title">Feedback</h4>
            <h2 class="mb-3">Help us to improve our services</h2>
          </div>
          
        </div>
        <div class="col-md-6 offset-xl-2 col-xl-5">
          <div class="search-wrapper">
            <h3>Review</h3>

            <form class="search-form" action="#">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Your Name">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="ti-user"></i></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Email Address">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="ti-email"></i></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="">
                  </textarea>
                </div>
              </div>
              <div class="form-group form-group-position">
                <button class="button border-0" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================Reservation section end =================-->  


  <!--================Blog section start =================-->  
  <section class="section-margin">
    <div class="container">
      <div class="section-intro mb-75px">
        <h4 class="intro-title">Reviews</h4>
        <h2>Latest reviews</h2>
      </div>

      <div class="row" id="review-div">
        <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
          <div class="card-blog">
            <img class="card-img rounded-0" src="img/blog/blog1.png" alt="">
            <div class="blog-body">
              <a href="#">
                <h3><a href="#">Vivek Mishra</a></h3>
                <h3><a href="#">5/5</a></h3>
                </a>
              <ul class="blog-info">
                <li>After reading about 50 reviews up here, I've learned a few things... Either people are just RIDICULOUSLY PICKY, I'm blessed FarmFresh deliver at my location, or I'm just an uncultured noob who doesn't have the same finely-tuned senses as most everybody else commenting here. First, the produce is UNBELIEVABLY FRESH. I bought a few salad bags and boxes, both of which still did not have any trace of wilting or spoilage, even a few days past the sell-by date.</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
          <div class="card-blog">
            <img class="card-img rounded-0" src="img/blog/blog2.png" alt="">
            <div class="blog-body">
              <a href="#">
                <h3><a href="#">Ravindra Kumar</a></h3>
                <h3><a href="#">5/5</a></h3>
                </a>
              <ul class="blog-info">
                <li>Have all of FarmFresh with order from. Can pick delivery time, same day, in one hour (for a small fee) or two hour window, free delivery. Can't beat that. The best, in my opinion, and with FarmFresh I'm assured of the quality of the purchased products.</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
          <div class="card-blog">
            <img class="card-img rounded-0" src="img/blog/blog3.png" alt="">
            <div class="blog-body">
              <a href="#">
                <h3><a href="#">Karthik Pillai</a></h3>
                <h3><a href="#">4/5</a></h3>
                </a>
              <ul class="blog-info">
                <li>Whole Foods is ideal for quality, clean food choices and health products. I especially enjoy shopping here for holiday meals for the family!</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================Blog section end =================-->  


<!-- ================ start footer Area ================= -->
<!--   <footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-xl-2 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
					<h4>Top Products</h4>
					<ul>
						<li><a href="#">Managed Website</a></li>
						<li><a href="#">Manage Reputation</a></li>
						<li><a href="#">Power Tools</a></li>
						<li><a href="#">Marketing Service</a></li>
					</ul>
				</div>
				<div class="col-xl-2 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
					<h4>Quick Links</h4>
					<ul>
						<li><a href="#">Jobs</a></li>
						<li><a href="#">Brand Assets</a></li>
						<li><a href="#">Investor Relations</a></li>
						<li><a href="#">Terms of Service</a></li>
					</ul>
				</div>
				<div class="col-xl-2 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
					<h4>Features</h4>
					<ul>
						<li><a href="#">Jobs</a></li>
						<li><a href="#">Brand Assets</a></li>
						<li><a href="#">Investor Relations</a></li>
						<li><a href="#">Terms of Service</a></li>
					</ul>
				</div>
				<div class="col-xl-2 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
					<h4>Resources</h4>
					<ul>
						<li><a href="#">Guides</a></li>
						<li><a href="#">Research</a></li>
						<li><a href="#">Experts</a></li>
						<li><a href="#">Agencies</a></li>
					</ul>
				</div>
				<div class="col-xl-4 col-md-8 mb-4 mb-xl-0 single-footer-widget">
					<h4>Newsletter</h4>
          <p>You can trust us. we only send promo offers,</p>
          
          <div class="form-wrap" id="mc_embed_signup">
            <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
            method="get">
              <div class="input-group">
                <input type="email" class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '">
                <div class="input-group-append">
                  <button class="btn click-btn" type="submit">
                    <i class="ti-arrow-right"></i>
                  </button>
                </div>
              </div>
              <div style="position: absolute; left: -5000px;">
								<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
							</div>

							<div class="info"></div>
            </form>
          </div>
          
				</div>
			</div>
			<div class="footer-bottom row align-items-center text-center text-lg-left">
				<p class="footer-text m-0 col-lg-8 col-md-12">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="#" target="_blank">FarmFresh</a>
        </p>
				<div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
					<a href="#"><i class="ti-facebook"></i></a>
					<a href="#"><i class="ti-twitter-alt"></i></a>
					<a href="#"><i class="ti-dribbble"></i></a>
					<a href="#"><i class="ti-linkedin"></i></a>
				</div>
			</div>
		</div>
	</footer> -->



<footer class="footer-area section-gap">
    <div class="container">
      <div class="footer-bottom row align-items-center text-center text-lg-left">
            <p class="footer-text m-0 col-lg-8 col-md-12">This website is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="#">FarmFresh</a></p>
      </div>
    </div>
</footer>

  <!-- ================ End footer Area ================= -->




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