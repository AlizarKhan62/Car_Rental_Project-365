<?php 
session_start();
include('includes/config.php');
error_reporting(0);

$citySlug = isset($_GET['city']) ? trim($_GET['city']) : '';

$sql = "SELECT * from tblcities WHERE Slug=:slug";
$query = $dbh->prepare($sql);
$query->bindParam(':slug', $citySlug, PDO::PARAM_STR);
$query->execute();
$city = $query->fetch(PDO::FETCH_OBJ);

// Unknown city slug -> send to the main car listing instead of a blank/broken page
if (!$city) {
    header('location:car-listing.php');
    exit;
}

$pageTitle = $city->MetaTitle ? $city->MetaTitle : ('Rent A Car in ' . $city->CityName);
$heroHeading = $city->HeroHeading ? $city->HeroHeading : ('Best Rent a Car in ' . $city->CityName);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PakDrive365 - Car Rental | <?php echo htmlentities($pageTitle);?></title>
<base href="<?php echo htmlentities(SITE_URL);?>">
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

        
<!-- Fav and touch icons -->
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<style>
.city-cat-widget{display:flex;flex-wrap:wrap;gap:12px;margin:0 0 30px 0;padding:0;list-style:none;}
.city-cat-widget li{background:#f7f7f7;border:1px solid #eee;border-radius:4px;padding:10px 18px;font-size:14px;}
.city-cat-widget li strong{display:block;font-size:18px;}
</style>
</head>
<body>

<!-- Start Switcher -->
<!-- <?php include('includes/colorswitcher.php');?> -->
<!-- /Switcher -->  

<!--Header--> 
<?php include('includes/header.php');?>
<!-- /Header --> 

<?php
// -------- Car-type (category) count widget — counts the FULL fleet,
// since every car is offered in every city.
// NOTE: these queries deliberately run AFTER header.php (which uses its
// own $query/$results/$result variables internally for contact info) and
// use unique variable names below so nothing here can ever be silently
// overwritten by another include again. --------
$catSql = "SELECT tblcategories.id, tblcategories.CategoryName, COUNT(tblvehicles.id) as VehicleCount
           FROM tblcategories
           LEFT JOIN tblvehicles ON tblvehicles.CategoryId = tblcategories.id
           GROUP BY tblcategories.id, tblcategories.CategoryName
           ORDER BY tblcategories.CategoryName ASC";
$catQuery = $dbh->prepare($catSql);
$catQuery->execute();
$categoryCounts = $catQuery->fetchAll(PDO::FETCH_OBJ);

// -------- Vehicles — show the FULL fleet on every city page,
// since cars are not restricted to a particular city --------
$vehSql = "SELECT tblvehicles.*, tblbrands.BrandName, tblbrands.id as bid, tblcategories.CategoryName
        FROM tblvehicles
        LEFT JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand
        LEFT JOIN tblcategories ON tblcategories.id = tblvehicles.CategoryId
        ORDER BY tblvehicles.id DESC";
$vehQuery = $dbh->prepare($vehSql);
$vehQuery->execute();
$results = $vehQuery->fetchAll(PDO::FETCH_OBJ);
$cnt = $vehQuery->rowCount();
?>

<!--Hero (same background image + layout as homepage, using this city's own heading/description) -->
<style>
.site-hero-banner {
  background-image: url("assets/images/hero-banner1.png");
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  padding: 130px 0;
  position: relative;
}
.hero-text-box {
  display: inline-block;
  /* background: rgba(0,0,0,0.6); */
  padding: 35px 40px;
  border-radius: 10px;
}
.site-hero-banner .hero-text-box h1 {
  color: #ffffff;
  font-size: 42px;
  font-weight: 800;
  line-height: 1.25;
  margin-top: 0;
}
.site-hero-banner .hero-text-box p {
  color: #f0f0f0;
  font-size: 17px;
  line-height: 1.6;
}
</style>
<section class="site-hero-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-8">
        <div class="hero-text-box">
          <h1><?php echo htmlentities($heroHeading);?></h1>
          <?php if($city->HeroDescription){?>
          <p><?php echo nl2br(htmlentities($city->HeroDescription));?></p>
          <?php } ?>
          <a href="car-listing.php" class="btn">View All Cars <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Hero --> 

<!--Listing-->
<section class="listing-page">
  <div class="container">

    <!-- Car-type count widget for this city -->
    <!-- <div class="row">
      <div class="col-md-12">
        <ul class="city-cat-widget">
        <?php foreach($categoryCounts as $cc) { ?>
          <li><strong><?php echo htmlentities($cc->VehicleCount);?></strong><?php echo htmlentities($cc->CategoryName);?> Cars</li>
        <?php } ?>
        </ul>
      </div>
    </div> -->

    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
            <p><span><?php echo htmlentities($cnt);?> Listings in <?php echo htmlentities($city->CityName);?></span></p>
          </div>
        </div>

<?php if($cnt > 0) { foreach($results as $result) { ?>
        <div class="product-listing-m gray-bg">
          <div class="product-listing-img"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="Image" /> </a> 
          </div>
          <div class="product-listing-content">
            <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h5>
            <p class="list-price">PKR <?php echo htmlentities($result->PricePerDay);?> Per Day</p>
            <ul>
              <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
              <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
              <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo htmlentities($city->CityName);?></li>
              <?php if($result->GearType){?><li><i class="fa fa-cogs" aria-hidden="true"></i><?php echo htmlentities($result->GearType);?></li><?php } ?>
              <?php if($result->CategoryName){?><li><i class="fa fa-tags" aria-hidden="true"></i><?php echo htmlentities($result->CategoryName);?></li><?php } ?>
            </ul>
            <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          </div>
        </div>
<?php } } else { ?>
        <div class="product-listing-m gray-bg">
          <div class="product-listing-content">
            <h5>No cars are currently listed. Please check back soon.</h5>
          </div>
        </div>
<?php } ?>
         </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your  Car </h5>
          </div>
          <div class="sidebar_filter">
            <form action="search-carresult.php" method="post">
              <div class="form-group select">
                <select class="form-control" name="brand">
                  <option value="">Select Brand</option>

                  <?php $sql = "SELECT * from  tblbrands ";
$query = $dbh -> prepare($sql);
$query->execute();
$brandresults=$query->fetchAll(PDO::FETCH_OBJ);
foreach($brandresults as $br)
{       ?>  
<option value="<?php echo htmlentities($br->id);?>"><?php echo htmlentities($br->BrandName);?></option>
<?php } ?>
                 
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control" name="categoryid">
                  <option value="">Select Category</option>
                  <?php $sql = "SELECT * from  tblcategories ";
$query = $dbh -> prepare($sql);
$query->execute();
$catresults=$query->fetchAll(PDO::FETCH_OBJ);
foreach($catresults as $cr)
{ ?>
<option value="<?php echo htmlentities($cr->id);?>"><?php echo htmlentities($cr->CategoryName);?></option>
<?php } ?>
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control" name="fueltype">
                  <option value="">Select Fuel Type</option>
<option value="Petrol">Petrol</option>
<option value="Diesel">Diesel</option>
<option value="CNG">CNG</option>
                </select>
              </div>
              <div class="form-group">
                <label>Pickup Date:</label>
                <input type="date" class="form-control" name="fromdate">
              </div>
              <div class="form-group">
                <label>Return Date:</label>
                <input type="date" class="form-control" name="todate">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
              </div>
            </form>
          </div>
        </div>

        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-map-marker" aria-hidden="true"></i> Other Cities</h5>
          </div>
          <div class="recent_addedcars">
            <ul>
<?php $sql = "SELECT * from tblcities ORDER BY DisplayOrder ASC, CityName ASC";
$query = $dbh -> prepare($sql);
$query->execute();
$allcities=$query->fetchAll(PDO::FETCH_OBJ);
foreach($allcities as $ct) { if($ct->Slug==$city->Slug) continue; ?>
              <li class="gray-bg">
                <div class="recent_post_title"> <a href="rent-a-car.php?city=<?php echo htmlentities($ct->Slug);?>">Rent A Car in <?php echo htmlentities($ct->CityName);?></a></div>
              </li>
<?php } ?>
            </ul>
          </div>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
  </div>
</section>
<!-- /Listing--> 

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

</body>
</html>