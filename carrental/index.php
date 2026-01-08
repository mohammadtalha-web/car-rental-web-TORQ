<?php 
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Torq</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
<link rel="stylesheet" href="assets/css/premium-ui.css" type="text/css">
<link rel="stylesheet" href="assets/css/dark-theme.css" type="text/css">
<!-- AOS Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!-- Premium Hero Section -->
<section class="premium-hero" style="background-image: url(assets/images/hero-luxury-car.jpg);">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>Drive Your Moment<br>in Style</h1>
        <a href="car-listing.php" class="btn-rent">Rent Now</a>
      </div>
    </div>
  </div>
  
  </div>
</section>
<!-- /Premium Hero Section --> 
 


<!-- About Us Section -->
<section class="premium-about">
  <div class="container">
    <?php 
    $pagetype='aboutus';
    $sql = "SELECT detail, image1, image2, experience_years from tblpages where type=:pagetype";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
    $query->execute();
    $aboutData=$query->fetch(PDO::FETCH_OBJ);
    
    $exp_years = $aboutData->experience_years ? $aboutData->experience_years : 10;
    $img1 = $aboutData->image1 ? 'admin/img/vehicleimages/'.$aboutData->image1 : 'assets/images/about-main-car.jpg';
    $img2 = $aboutData->image2 ? 'admin/img/vehicleimages/'.$aboutData->image2 : 'assets/images/recent-car-1.jpg';
    ?>
    <div class="grid-container">
      <div class="about-text">
        <h2>About Us</h2>
        <?php 
        $about_paragraphs = explode("\n", $aboutData->detail);
        foreach($about_paragraphs as $para) {
            if(trim($para) != "") {
                echo "<p>".htmlentities($para)."</p>";
            }
        }
        ?>
      </div>
      <div class="about-images">
        <div class="main-img">
          <img src="<?php echo $img1; ?>" alt="about_image_1">
        </div>
        <div class="exp-card">
          <h1 style="font-size: 60px; margin: 0;">+<?php echo htmlentities($exp_years);?></h1>
          <p style="margin: 0; font-size: 16px;">years<br>Experience</p>
        </div>
        <div class="small-img">
          <img src="<?php echo $img2; ?>" alt="about_image_2">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Best Offer Section -->
<section class="best-offer-section" data-aos="zoom-in">
  <div class="offer-content">
    <h2>Best offer</h2>
    <h3>Bentley Flying Spur<br>for ৳40000/day</h3>
    <p>Experience the ultimate in luxury and performance with our exclusive Bentley Flying Spur. Perfect for business travel, special occasions, or simply enjoying the thrill of a world-class grand tourer on the open road.</p>
    <a href="car-listing.php" class="btn-rent">Rent Now</a>

  </div>
  <div class="offer-image" style="background-image: url(assets/images/bentley-offer.jpg);"></div>
</section>

<!-- Premium Vehicles Section -->
<section class="vehicles-section-premium">
  <div class="container">
    <div class="premium-title-row">
      <h2 data-aos="fade-right">Vehicles</h2>
      <div class="title-description" data-aos="fade-left">
        Discover our curated collection of premium vehicles, ranging from high-performance sports cars to elegant luxury sedans and spacious SUVs.
      </div>
      <div class="slider-controls">
        <div class="control-btn prev"><i class="fa fa-arrow-left"></i></div>
        <div class="control-btn next"><i class="fa fa-arrow-right"></i></div>
      </div>
    </div>

    <div class="row owl-carousel auto-grid-slider"> 
      <?php 
      $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1,tblvehicles.Vimage2,tblvehicles.Vimage3,tblvehicles.Vimage4,tblvehicles.Vimage5 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand order by tblvehicles.id desc limit 50";
      $query = $dbh -> prepare($sql);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
      if($query->rowCount() > 0)
      {
        foreach($results as $result)
        {  
      ?>
      <div class="serial-grid-item" data-aos="fade-up">
        <div class="premium-car-card">
          <div class="card-header-top">
            <div class="card-brand-title"><?php echo htmlentities($result->BrandName);?> <?php echo htmlentities($result->VehiclesTitle);?></div>
            <div class="card-meta-info">
              <span class="amount">৳<?php echo htmlentities($result->PricePerDay);?></span>
              <span>/day</span>
            </div>
          </div>
          
          <div class="card-visual">
            <div class="car-card-slider owl-carousel owl-theme">
              <?php if($result->Vimage1!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image"></div><?php } ?>
              <?php if($result->Vimage2!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" class="img-responsive" alt="image"></div><?php } ?>
              <?php if($result->Vimage3!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" class="img-responsive" alt="image"></div><?php } ?>
              <?php if($result->Vimage4!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" class="img-responsive" alt="image"></div><?php } ?>
              <?php if($result->Vimage5!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" class="img-responsive" alt="image"></div><?php } ?>
            </div>
          </div>
          
          <div class="card-footer-action">
            <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>" class="arrow-link">
              <i class="fa fa-long-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <?php }} ?>
    </div>
    
  </div>
</section>
<!-- /Premium Vehicles Section --> 






<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!--/Forgot-password-Form --> 

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/interface.js"></script> 
<script>
$(document).ready(function() {
    // In-card image slider
    $(".car-card-slider").owlCarousel({
        singleItem: true,
        autoPlay: false,
        pagination: true,
        navigation: false
    });

    // Main horizontal car grid slider
    var carGrid = $(".auto-grid-slider");
    carGrid.owlCarousel({
        items: 4,
        itemsCustom: [
            [0, 1],
            [600, 2],
            [1000, 4],
            [1400, 5]
        ],
        pagination: true,
        navigation: false
    });

    // Custom controls
    $(".prev").click(function() { carGrid.trigger('owl.prev'); });
    $(".next").click(function() { carGrid.trigger('owl.next'); });
});
</script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->
</html>