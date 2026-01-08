<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate']; 
$message=$_POST['message'];
$useremail=$_SESSION['login'];
$status=0;
$vhid=$_GET['vhid'];
$sql="INSERT INTO  tblbooking(userEmail,VehicleId,FromDate,ToDate,message,Status) VALUES(:useremail,:vhid,:fromdate,:todate,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Booking successfull.');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}

}

?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Car Rental Port | Vehicle Details</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<!-- SWITCHER -->
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

<?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
$_SESSION['brndid']=$result->bid;  
?>

<!--Page Header-->
<section class="page-header profile_page" style="background-image: url('assets/images/profile-banner.jpg'); text-align: center;">
  <div class="container" style="position: relative; z-index: 2;">
    <h1 style="font-size: 60px; margin-bottom: 20px;"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></h1>
  </div>
  <div class="dark-overlay" style="background: rgba(0,0,0,0.5); position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
</section>
<!--/Page Header--> 


<!--Listing-detail-->
<section class="listing-detail">
  <div class="container" style="max-width: 1600px; width: 100%;">
    <div class="listing_detail_head row" style="margin-top: 40px; margin-bottom: 40px;" data-aos="fade-up">
      <div class="col-md-9">
        <h2 style="font-size: 50px; margin-bottom: 10px; color: var(--premium-primary);"><?php echo htmlentities($result->BrandName);?> <?php echo htmlentities($result->VehiclesTitle);?></h2>
        <p style="font-size: 18px; color: #777;"><i class="fa fa-map-marker"></i> Premium Car Rental Service</p>
      </div>
      <div class="col-md-3">
        <div class="price_info" style="text-align: right; background: var(--premium-gray); padding: 20px; border-radius: 20px;">
          <p style="font-size: 34px; font-weight: 800; color: var(--premium-accent); margin: 0;">৳<?php echo htmlentities($result->PricePerDay);?></p>
          <p style="font-size: 16px; font-weight: 400; color: #777; margin: 0;">per day</p>
        </div>
      </div>
    </div>

  </div> <!-- Closing initial container -->

  <div class="container-fluid" style="padding: 0;">
    <div class="row" style="margin: 0;">
      <div class="col-md-2 col-md-offset-1" data-aos="fade-right" style="padding: 0 15px;">
        <div class="sidebar_widget premium-card" style="margin-bottom: 30px; height: 100%; border-radius: 0 20px 20px 0;">
          <div class="widget_heading">
            <h5 style="color: var(--premium-primary); border-bottom: 2px solid var(--premium-primary); padding-bottom: 10px; margin-bottom: 20px; font-size: 16px;">
              <i class="fa fa-image" aria-hidden="true"></i> Gallery
            </h5>
          </div>
          <div class="vehicle_grid" style="display: flex; flex-direction: column; gap: 10px;">
            <?php if($result->Vimage1!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="clickable-image" style="width:100%; height:95px; object-fit:cover; border-radius:10px;" alt="image"></div><?php } ?>
            <?php if($result->Vimage2!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" class="clickable-image" style="width:100%; height:95px; object-fit:cover; border-radius:10px;" alt="image"></div><?php } ?>
            <?php if($result->Vimage3!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" class="clickable-image" style="width:100%; height:95px; object-fit:cover; border-radius:10px;" alt="image"></div><?php } ?>
            <?php if($result->Vimage4!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" class="clickable-image" style="width:100%; height:95px; object-fit:cover; border-radius:10px;" alt="image"></div><?php } ?>
            <?php if($result->Vimage5!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" class="clickable-image" style="width:100%; height:95px; object-fit:cover; border-radius:10px;" alt="image"></div><?php } ?>
          </div>
        </div>
      </div>
      <div class="col-md-9" style="padding: 0;">
        <div id="listing_img_slider" style="margin-bottom: 30px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);" data-aos="fade-left">
          <div id="owl-demo" class="owl-carousel owl-theme">
            <?php if($result->Vimage1!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive clickable-image" alt="image" style="width:100%; height:650px; object-fit:cover;"></div><?php } ?>
            <?php if($result->Vimage2!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" class="img-responsive clickable-image" alt="image" style="width:100%; height:650px; object-fit:cover;"></div><?php } ?>
            <?php if($result->Vimage3!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" class="img-responsive clickable-image" alt="image" style="width:100%; height:650px; object-fit:cover;"></div><?php } ?>
            <?php if($result->Vimage4!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" class="img-responsive clickable-image" alt="image" style="width:100%; height:650px; object-fit:cover;"></div><?php } ?>
            <?php if($result->Vimage5!="") { ?><div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" class="img-responsive clickable-image" alt="image" style="width:100%; height:650px; object-fit:cover;"></div><?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container" style="max-width: 1600px; width: 100%;">
    <div class="row">
      <div class="col-md-9">
        <div class="main_features" style="margin-bottom: 40px;">
          <ul style="display: flex; gap: 30px; list-style: none; padding: 0;">
            <li class="premium-card" style="flex: 1; text-align: center; padding: 20px;"> 
              <i class="fa fa-calendar" aria-hidden="true" style="font-size: 24px; color: var(--premium-primary); margin-bottom: 10px;"></i>
              <h5 style="margin: 0;"><?php echo htmlentities($result->ModelYear);?></h5>
              <p style="margin: 0; font-size: 12px; color: #777;">Reg.Year</p>
            </li>
            <li class="premium-card" style="flex: 1; text-align: center; padding: 20px;"> 
              <i class="fa fa-cogs" aria-hidden="true" style="font-size: 24px; color: var(--premium-primary); margin-bottom: 10px;"></i>
              <h5 style="margin: 0;"><?php echo htmlentities($result->FuelType);?></h5>
              <p style="margin: 0; font-size: 12px; color: #777;">Fuel Type</p>
            </li>
            <li class="premium-card" style="flex: 1; text-align: center; padding: 20px;"> 
              <i class="fa fa-user-plus" aria-hidden="true" style="font-size: 24px; color: var(--premium-primary); margin-bottom: 10px;"></i>
              <h5 style="margin: 0;"><?php echo htmlentities($result->SeatingCapacity);?></h5>
              <p style="margin: 0; font-size: 12px; color: #777;">Seats</p>
            </li>
          </ul>
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Vehicle Overview </a></li>
          
              <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- vehicle-overview -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                
                <p><?php echo htmlentities($result->VehiclesOverview);?></p>
              </div>
              
              
              <!-- Accessories -->
              <div role="tabpanel" class="tab-pane" id="accessories"> 
                <!--Accessories-->
                <div class="premium-card">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th colspan="2" style="font-size: 24px; color: var(--premium-primary); border-bottom: 2px solid var(--premium-primary);">Available Accessories</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Air Conditioner</td>
                        <td><?php echo ($result->AirConditioner==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                      <tr>
                        <td>AntiLock Braking System</td>
                        <td><?php echo ($result->AntiLockBrakingSystem==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                      <tr>
                        <td>Power Steering</td>
                        <td><?php echo ($result->PowerSteering==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                      <tr>
                        <td>Power Windows</td>
                        <td><?php echo ($result->PowerWindows==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                      <tr>
                        <td>CD Player</td>
                        <td><?php echo ($result->CDPlayer==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                      <tr>
                        <td>Leather Seats</td>
                        <td><?php echo ($result->LeatherSeats==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                      <tr>
                        <td>Central Locking</td>
                        <td><?php echo ($result->CentralLocking==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                      <tr>
                        <td>Power Door Locks</td>
                        <td><?php echo ($result->PowerDoorLocks==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                      <tr>
                        <td>Brake Assist</td>
                        <td><?php echo ($result->BrakeAssist==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                      <tr>
                        <td>Driver Airbag</td>
                        <td><?php echo ($result->DriverAirbag==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                      <tr>
                        <td>Passenger Airbag</td>
                        <td><?php echo ($result->PassengerAirbag==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                      <tr>
                        <td>Crash Sensor</td>
                        <td><?php echo ($result->CrashSensor==1) ? '<i class="fa fa-check-circle" style="color: #28a745; font-size: 20px;"></i>' : '<i class="fa fa-times-circle" style="color: #dc3545; font-size: 20px;"></i>'; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="rental_benefits premium-card" style="margin-top: 30px;" data-aos="fade-up">
          <h5 style="color: var(--premium-primary); border-bottom: 2px solid var(--premium-primary); padding-bottom: 10px; margin-bottom: 25px;">
            <i class="fa fa-star" aria-hidden="true"></i> Why Rent With Us?
          </h5>
          <div class="row">
            <div class="col-md-6 col-sm-6" style="margin-bottom: 20px;">
              <div style="display: flex; gap: 15px; align-items: flex-start;">
                <div style="background: var(--premium-gray); width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                  <i class="fa fa-shield" style="font-size: 24px; color: var(--premium-primary);"></i>
                </div>
                <div>
                  <h6 style="margin: 0 0 5px 0;">Fully Insured</h6>
                  <p style="font-size: 13px; color: #777; margin: 0;">Drive with peace of mind. All our vehicles are covered by comprehensive insurance.</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6" style="margin-bottom: 20px;">
              <div style="display: flex; gap: 15px; align-items: flex-start;">
                <div style="background: var(--premium-gray); width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                  <i class="fa fa-headphones" style="font-size: 24px; color: var(--premium-primary);"></i>
                </div>
                <div>
                  <h6 style="margin: 0 0 5px 0;">24/7 Support</h6>
                  <p style="font-size: 13px; color: #777; margin: 0;">Our dedicated team is available around the clock to assist you with any queries.</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6" style="margin-bottom: 20px;">
              <div style="display: flex; gap: 15px; align-items: flex-start;">
                <div style="background: var(--premium-gray); width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                  <i class="fa fa-calendar-check-o" style="font-size: 24px; color: var(--premium-primary);"></i>
                </div>
                <div>
                  <h6 style="margin: 0 0 5px 0;">Flexible Booking</h6>
                  <p style="font-size: 13px; color: #777; margin: 0;">Easy online booking and flexible return options tailored to your schedule.</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6" style="margin-bottom: 20px;">
              <div style="display: flex; gap: 15px; align-items: flex-start;">
                <div style="background: var(--premium-gray); width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                  <i class="fa fa-wrench" style="font-size: 24px; color: var(--premium-primary);"></i>
                </div>
                <div>
                  <h6 style="margin: 0 0 5px 0;">Premium Maintenance</h6>
                  <p style="font-size: 13px; color: #777; margin: 0;">Regularly serviced and thoroughly cleaned vehicles for a pristine driving experience.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php }} ?>
   
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3">
      
        <div class="share_vehicle premium-card" style="margin-bottom: 20px; padding: 20px; text-align: center;">
          <p style="margin: 0; font-weight: 700;">Share this Car: 
            <a href="https://www.facebook.com/mohammad.talha.848599" style="margin-left: 10px; font-size: 20px; color: #3b5998;"><i class="fa fa-facebook-square"></i></a> 
            <a href="#" style="margin-left: 10px; font-size: 20px; color: #1da1f2;"><i class="fa fa-twitter-square"></i></a> 
            <a href="#" style="margin-left: 10px; font-size: 20px; color: #0077b5;"><i class="fa fa-linkedin-square"></i></a>
          </p>
        </div>

        <div class="sidebar_widget premium-card" data-aos="fade-left">
          <div class="widget_heading">
            <h5 style="color: var(--premium-primary); border-bottom: 2px solid var(--premium-primary); padding-bottom: 10px; margin-bottom: 20px;">
              <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Book This Car
            </h5>
          </div>
          <form method="post">
            <div class="form-group">
              <label style="font-weight: 700; font-size: 13px;">Pick-up Date</label>
              <input type="date" class="form-control" name="fromdate" required>
            </div>
            <div class="form-group">
              <label style="font-weight: 700; font-size: 13px;">Drop-off Date</label>
              <input type="date" class="form-control" name="todate" required>
            </div>
            <div class="form-group">
              <label style="font-weight: 700; font-size: 13px;">Special Message</label>
              <textarea rows="4" class="form-control" name="message" placeholder="Optional notes..." required></textarea>
            </div>
          <?php if($_SESSION['login'])
              {?>
              <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary" name="submit">Confirm Booking</button>
              </div>
              <?php } else { ?>
               <a href="#loginform" class="btn btn-block btn-primary" data-toggle="modal" data-dismiss="modal">Login to Book</a>
              <?php } ?>
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
    
    <div class="space-20"></div>
    <div class="divider"></div>
    
    <!--Similar-Cars-->
    <div class="similar_cars">
      <h3>Similar Cars</h3>
      <div class="row">
<?php 
$bid=$_SESSION['brndid'];
$sql="SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.VehiclesBrand=:bid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bid',$bid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>      
        <div class="col-md-4 grid_listing">
          <div class="premium-car-card">
            <div class="card-header-top">
              <div class="card-title-group">
                  <div class="card-brand-title" style="font-size: 18px;"><?php echo htmlentities($result->BrandName);?> <?php echo htmlentities($result->VehiclesTitle);?></div>
              </div>
              <div class="card-meta-info" style="font-size: 13px;">
                <span class="amount">৳<?php echo htmlentities($result->PricePerDay);?></span>
                <span>/day</span>
              </div>
            </div>
            
            <div class="card-visual">
              <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>">
                <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image">
              </a>
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
    <!--/Similar-Cars--> 
    
  </div>
</section>
<!--/Listing-detail--> 

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

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

<!-- Image Lightbox Modal -->
<div id="imageLightbox" class="lightbox-modal">
  <span class="close-lightbox">&times;</span>
  <img class="lightbox-content" id="imgFull">
  <div id="lightbox-caption"></div>
</div>

<style>
.lightbox-modal {
  display: none;
  position: fixed;
  z-index: 9999;
  padding-top: 50px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.9);
  backdrop-filter: blur(5px);
}

.lightbox-content {
  margin: auto;
  display: block;
  max-width: 85%;
  max-height: 85vh;
  border-radius: 15px;
  box-shadow: 0 0 50px rgba(0,0,0,0.5);
  animation-name: zoom;
  animation-duration: 0.4s;
}

@keyframes zoom {
  from {transform:scale(0.8); opacity: 0;}
  to {transform:scale(1); opacity: 1;}
}

.close-lightbox {
  position: absolute;
  top: 25px;
  right: 50px;
  color: #f1f1f1;
  font-size: 60px;
  font-weight: bold;
  transition: 0.3s;
  cursor: pointer;
  z-index: 10000;
}

.close-lightbox:hover,
.close-lightbox:focus {
  color: var(--premium-primary);
  text-decoration: none;
  transform: rotate(90deg);
}

.clickable-image {
  cursor: pointer;
  transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.clickable-image:hover {
  transform: scale(1.05);
  z-index: 2;
  box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
}
</style>

<script>
$(document).ready(function() {
    // Lightbox Logic
    const modal = document.getElementById("imageLightbox");
    const modalImg = document.getElementById("imgFull");
    
    $(".clickable-image").click(function(){
      modal.style.display = "block";
      modalImg.src = $(this).attr('src');
      $("body").css("overflow", "hidden"); // Prevent scrolling
    });

    $(".close-lightbox, .lightbox-modal").click(function(e) {
      if (e.target !== modalImg) {
        modal.style.display = "none";
        $("body").css("overflow", "auto");
      }
    });

    // Slider Initialization
    var vDetailsSlider = $("#owl-demo");
    vDetailsSlider.owlCarousel({
        singleItem: true,
        autoPlay: 3000,
        pagination: true,
        navigation: true,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });
});
</script>
</body>
</html>