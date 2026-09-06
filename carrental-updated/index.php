<?php 
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>PakDrive365 - Car Rental</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
</head>
<body>

<!-- Start Switcher -->
<!-- <?php include('includes/colorswitcher.php');?> -->
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!-- Banners -->
<!-- <style>
.hero-slide-wrap {
  position: relative;
  width: 100%;
  overflow: hidden;
  background: #000;
}
.hero-slide-wrap img {
  width: 100%;
  height: 100%;
  display: block;
}
.hero-slide-wrap::after {
  content: "";
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(146, 33, 33, 0.15);
}
.hero-text-overlay {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  display: flex;
  align-items: center;
  z-index: 2;
}
.hero-text-overlay .container { width: 100%; }
.hero-text-box {
  display: inline-block;
  /* background: rgba(0,0,0,0.6); */
  padding: 35px 40px;
  border-radius: 10px;
}
.hero-text-box h1, .hero-text-box h2 {
  color: #ffffff;
  font-size: 42px;
  font-weight: 800;
  line-height: 1.25;
  margin-top: 0;
}
.hero-text-box p {
  color: #f0f0f0;
  font-size: 17px;
  line-height: 1.6;
}
#heroSlider .owl-pagination { position:absolute; bottom:15px; width:100%; text-align:center; z-index:3; }
#heroSlider .owl-page { display:inline-block; margin:0 5px; }
#heroSlider .owl-page span { width:10px; height:5px; background:rgba(255,255,255,0.5); display:block; border-radius:50%; }
#heroSlider .owl-page.active span { background:#ffffff; }
</style> -->
<style>
.hero-slide-wrap {
  position: relative;
  width: 100%;
  height: 580px; /* Perfect balanced height for laptops */
  overflow: hidden;
  background: #0b0b0b;
}
.hero-slide-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center center;
  display: block;
}
.hero-slide-wrap::after {
  content: "";
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: linear-gradient(rgba(0,0,0,0.2), rgba(20,0,0,0.4)); /* Smooth gradient overlay instead of flat tint */
}
.hero-text-overlay {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  display: flex;
  align-items: center;
  z-index: 2;
}
.hero-text-overlay .container { 
  width: 100%; 
}
.hero-text-box {
  /* background: rgba(0, 0, 0, 0.45); Semi-transparent backdrop to make text readable over any car photo */
  padding: 30px 35px;
  border-radius: 8px;
  /* backdrop-filter: blur(3px); Modern subtle glassmorphism effect */
  max-width: 550px;
}
.hero-text-box h1, .hero-text-box h2 {
  color: #ffffff;
  font-size: 38px;
  font-weight: 800;
  line-height: 1.2;
  margin-top: 0;
  margin-bottom: 15px;
}
.hero-text-box p {
  color: #f2f2f2;
  font-size: 15px;
  line-height: 1.5;
  margin-bottom: 20px;
}
#heroSlider {
  margin-bottom: 0 !important;
  padding-bottom: 0 !important;
}
#heroSlider .owl-pagination { 
  position: absolute; 
  bottom: 15px; 
  left: 0;
  width: 100%; 
  text-align: center; 
  z-index: 3; 
  margin: 0 !important;
}
#heroSlider .owl-page { display: inline-block; margin: 0 4px; }
#heroSlider .owl-page span { width: 10px; height: 5px; background: rgba(255,255,255,0.5); display: block; border-radius: 50%; }
#heroSlider .owl-page.active span { background: #ffffff; }

/* Mobile & Tablet Responsiveness */
@media (max-width: 992px) {
  .hero-slide-wrap {
    height: 450px;
  }
  .hero-text-box {
    padding: 20px 25px;
    max-width: 100%;
  }
  .hero-text-box h1, .hero-text-box h2 {
    font-size: 26px;
  }
  .hero-text-box p {
    font-size: 13px;
    line-height: 1.4;
    margin-bottom: 15px;
  }
}

@media (max-width: 576px) {
  .hero-slide-wrap {
    height: 380px;
  }
  .hero-text-box {
    padding: 15px 18px;
  }
  .hero-text-box h1, .hero-text-box h2 {
    font-size: 22px;
  }
}
</style>
<section id="banner">
  <div id="heroSlider" class="owl-carousel owl-theme">

    <!-- Slide 1: main hero content (editable from admin -> Manage Pages -> Homepage Hero Text) -->
    <div class="hero-slide-wrap">
      <img src="assets/images/hero-banner1.png" alt="Car Rentals">
      <div class="hero-text-overlay">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-md-offset-8">
              <div class="hero-text-box">
<?php $herosql = "SELECT detail from tblpages where type='homehero'";
$heroquery = $dbh -> prepare($herosql);
$heroquery->execute();
$heroresult = $heroquery->fetch(PDO::FETCH_OBJ);
if($heroresult && trim($heroresult->detail) != "")
{
echo $heroresult->detail;
}
else
{
?>
                <h1>Best Pakistan Car Rentals</h1>
                <p>Pakistan Car Rentals offers a wide range of vehicles for rent across major cities including Islamabad, Rawalpindi, Lahore, Peshawar, Faisalabad and Karachi. Whether you need a car for business trips, family vacations, or local city tours, our fleet has you covered.</p>
<?php } ?>
                <a href="car-listing.php" class="btn">View All Cars <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slides 2+: one per vehicle, using its main photo at full width and natural height (never cropped) -->
    <?php $heroVsql = "SELECT id, VehiclesTitle, PricePerDay, Vimage1 FROM tblvehicles WHERE Vimage1 IS NOT NULL AND Vimage1 != '' ORDER BY id DESC LIMIT 6";
$heroVquery = $dbh -> prepare($heroVsql);
$heroVquery->execute();
$heroVehicles = $heroVquery->fetchAll(PDO::FETCH_OBJ);
foreach($heroVehicles as $hv) { ?>
    <div class="hero-slide-wrap">
      <img src="admin/img/vehicleimages/<?php echo htmlentities($hv->Vimage1);?>" alt="<?php echo htmlentities($hv->VehiclesTitle);?>">
      <div class="hero-text-overlay">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-md-offset-8">
              <div class="hero-text-box">
                <h2><?php echo htmlentities($hv->VehiclesTitle);?></h2>
                <p>Starting from PKR <?php echo htmlentities($hv->PricePerDay);?> / day</p>
                <a href="vehical-details.php?vhid=<?php echo htmlentities($hv->id);?>" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>

  </div>
</section>
<!-- /Banners --> 

<!-- Hero Search Bar -->
<section class="hero-search-section" style="background:#fff;padding:25px 0;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
  <div class="container">
    <div class="hero-search-box">
      <form action="search-carresult.php" method="post" class="form-inline" id="heroSearchForm" onsubmit="return heroSearchSubmit();">
        <div class="row">
          <div class="col-md-4">
            <label>Pickup Location</label>
            <select class="form-control" name="city" id="heroCitySelect" style="width:100%;">
              <option value="">All Location</option>
              <?php $sql = "SELECT CityName, Slug from tblcities ORDER BY DisplayOrder ASC, CityName ASC";
$hquery = $dbh -> prepare($sql);
$hquery->execute();
$hcityresults=$hquery->fetchAll(PDO::FETCH_OBJ);
foreach($hcityresults as $hct)
{ ?>
              <option value="<?php echo htmlentities($hct->Slug);?>"><?php echo htmlentities($hct->CityName);?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-3">
            <label>Pickup Date</label>
            <input type="date" class="form-control" name="fromdate" style="width:100%;">
          </div>
          <div class="col-md-3">
            <label>Return Date</label>
            <input type="date" class="form-control" name="todate" style="width:100%;">
          </div>
          <div class="col-md-2">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-block" style="width:100%;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- /Hero Search Bar -->
<!-- /Banners --> 
<script>
function heroSearchSubmit(){
  var city = document.getElementById('heroCitySelect').value;
  if(city){
    window.location.href = 'rent-a-car.php?city=' + encodeURIComponent(city);
    return false;
  }
  return true; // no city chosen, let it submit to search-carresult.php for date filtering
}
</script>


<!-- Resent Cat-->
<!-- <style>
#resentnewcar .row { display: flex; flex-wrap: wrap; }
#resentnewcar .col-list-3 { display: flex; margin-bottom: 25px; }
#resentnewcar .recent-car-list { display: flex; flex-direction: column; width: 100%; }
#resentnewcar .car-info-box { position: relative; }
#resentnewcar .car-info-box img { width: 150%; height: 500px; object-fit: cover; }
#resentnewcar .car-title-m, #resentnewcar .inventory_info_m { flex-shrink: 0; }
#resentnewcar .inventory_info_m p {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  min-height: 100px;
}
</style> -->

<style>
#resentnewcar .row { display: flex; flex-wrap: wrap; }
#resentnewcar .col-list-3 { display: flex; margin-bottom: 25px; }
#resentnewcar .recent-car-list { display: flex; flex-direction: column; width: 100%; }
#resentnewcar .car-info-box { 
  position: relative; 
  overflow: hidden;
}
#resentnewcar .car-info-box img { 
  width: 100%; 
  height: 350px; /* Balanced height to keep cards uniform */
  object-fit: cover; /* Fills the container completely */
  object-position: center; /* Centers the crop so the car stays in view */
}
#resentnewcar .car-title-m, #resentnewcar .inventory_info_m { flex-shrink: 0; }
#resentnewcar .inventory_info_m p {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  min-height: 100px;
}
</style>
<section class="section-padding gray-bg">
  <div class="container">
    <div class="section-header text-center">
      <h2>Find Your Dream <span>Ride</span></h2>
      <p>Whether you are looking for a reliable daily commuter, a spacious family sedan, or a luxury vehicle for a special occasion, PakDrive365 offers a seamless and trusted car rental experience across Pakistan. Browse our verified fleet, choose your preferred pickup and drop-off cities, and enjoy transparent daily rates with zero hidden surprises. Book your car with confidence today and hit the road in style.</p>
    </div>
    <div class="row"> 
      
      <!-- Nav tabs -->
      <div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
          <a href="car-listing.php" class="btn">View All Cars <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          <!-- <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">New Car</a></li> -->
        </ul>
      </div>
      <!-- Recently Listed New Cars -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewcar">

<?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles left join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand limit 9";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
?>  

<div class="col-list-3">
<div class="recent-car-list">
<div class="car-info-box"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image"></a>
<ul>
<li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
<li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> Model</li>
<li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
</ul>
</div>
<div class="car-title-m">
<h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"> <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
<span class="price">PKR <?php echo htmlentities($result->PricePerDay);?> /Day</span> 
</div>
<div class="inventory_info_m">
<p><?php echo substr($result->VehiclesOverview,0,70);?></p>
</div>
</div>
</div>
<?php }}?>
       
      </div>
    </div>
  </div>
</section>
<!-- /Resent Cat --> 
<?php
/*
<!-- Fun Facts-->
<section class="fun-facts-section">
  <div class="container div_zindex">
    <div class="row">
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-calendar" aria-hidden="true"></i>40+</h2>
            <p>Years In Business</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>1200+</h2>
            <p>New Cars For Sale</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>1000+</h2>
            <p>Used Cars For Sale</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>600+</h2>
            <p>Satisfied Customers</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Fun Facts--> 


<!--Testimonial -->
<section class="section-padding testimonial-section parallex-bg">
  <div class="container div_zindex">
    <div class="section-header white-text text-center">
      <h2>Our Satisfied <span>Customers</span></h2>
    </div>
    <div class="row">
      <div id="testimonial-slider">
<?php 
$tid=1;
$sql = "SELECT tbltestimonial.Testimonial,tblusers.FullName from tbltestimonial join tblusers on tbltestimonial.UserEmail=tblusers.EmailId where tbltestimonial.status=:tid limit 4";
$query = $dbh -> prepare($sql);
$query->bindParam(':tid',$tid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>


        <div class="testimonial-m">
 
          <div class="testimonial-content">
            <div class="testimonial-heading">
              <h5><?php echo htmlentities($result->FullName);?></h5>
            <p><?php echo htmlentities($result->Testimonial);?></p>
          </div>
        </div>
        </div>
        <?php }} ?>
        
       
  
      </div>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Testimonial--> 
*/
?>

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
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
<script>
jQuery(document).ready(function($){
  $('#heroSlider').owlCarousel({
    items: 1,
    singleItem: true,
    autoPlay: 2000,
    stopOnHover: true,
    navigation: false,
    pagination: true,
    transitionStyle: "fade"
  });
});
</script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->
</html>