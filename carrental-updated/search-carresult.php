<?php 
session_start();
include('includes/config.php');
error_reporting(0);

// -------- Collect filters (all optional) --------
$brand      = (!empty($_POST['brand'])) ? $_POST['brand'] : null;
$fueltype   = (!empty($_POST['fueltype'])) ? $_POST['fueltype'] : null;
$categoryid = (!empty($_POST['categoryid'])) ? $_POST['categoryid'] : null;
$fromdate   = (!empty($_POST['fromdate'])) ? $_POST['fromdate'] : null;
$todate     = (!empty($_POST['todate'])) ? $_POST['todate'] : null;

// -------- Build WHERE clause dynamically so any combination of filters works --------
$conditions = array();
$params = array();

if ($brand) {
    $conditions[] = "tblvehicles.VehiclesBrand = :brand";
    $params[':brand'] = $brand;
}
if ($fueltype) {
    $conditions[] = "tblvehicles.FuelType = :fueltype";
    $params[':fueltype'] = $fueltype;
}
if ($categoryid) {
    $conditions[] = "tblvehicles.CategoryId = :categoryid";
    $params[':categoryid'] = $categoryid;
}
if ($fromdate && $todate) {
    // Exclude vehicles already booked for an overlapping date range
    // (same overlap logic used in vehical-details.php for a single booking)
    $conditions[] = "tblvehicles.id NOT IN (SELECT VehicleId FROM tblbooking WHERE VehicleId IS NOT NULL AND (:fromdate BETWEEN date(FromDate) AND date(ToDate) OR :todate BETWEEN date(FromDate) AND date(ToDate) OR date(FromDate) BETWEEN :fromdate AND :todate))";
    $params[':fromdate'] = $fromdate;
    $params[':todate'] = $todate;
}

$whereSql = count($conditions) > 0 ? "WHERE " . implode(" AND ", $conditions) : "";
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>PakDrive365 - Car Rental | Search Results</title>
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
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  

<!--Header--> 
<?php include('includes/header.php');?>
<!-- /Header --> 

<?php
// -------- These queries deliberately run AFTER header.php (which uses its
// own $query/$results/$result variables internally) and use unique
// variable names so nothing here can ever be silently overwritten by
// another include again. --------

// -------- Count query --------
$countSql = "SELECT tblvehicles.id FROM tblvehicles $whereSql";
$countQuery = $dbh->prepare($countSql);
foreach ($params as $key => $val) {
    $countQuery->bindValue($key, $val, PDO::PARAM_STR);
}
$countQuery->execute();
$cnt = $countQuery->rowCount();

// -------- Main listing query --------
$vehSql = "SELECT tblvehicles.*, tblbrands.BrandName, tblbrands.id as bid, tblcategories.CategoryName
        FROM tblvehicles
        LEFT JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand
        LEFT JOIN tblcategories ON tblcategories.id = tblvehicles.CategoryId
        $whereSql";
$vehQuery = $dbh->prepare($vehSql);
foreach ($params as $key => $val) {
    $vehQuery->bindValue($key, $val, PDO::PARAM_STR);
}
$vehQuery->execute();
$results = $vehQuery->fetchAll(PDO::FETCH_OBJ);
?>

<!--Page Header-->
<section class="page-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Search Results</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Search Results</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<!--Listing-->
<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
<p><span><?php echo htmlentities($cnt);?> Listings</span></p>
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
              <?php if($result->GearType){?><li><i class="fa fa-cogs" aria-hidden="true"></i><?php echo htmlentities($result->GearType);?></li><?php } ?>
              <?php if($result->CategoryName){?><li><i class="fa fa-tags" aria-hidden="true"></i><?php echo htmlentities($result->CategoryName);?></li><?php } ?>
            </ul>
            <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          </div>
        </div>
<?php } } else { ?>
        <div class="product-listing-m gray-bg">
          <div class="product-listing-content">
            <h5>No cars matched your search. Try widening your filters.</h5>
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
$query2 = $dbh -> prepare($sql);
$query2->execute();
$brandresults=$query2->fetchAll(PDO::FETCH_OBJ);
foreach($brandresults as $br)
{ ?>  
<option value="<?php echo htmlentities($br->id);?>" <?php echo ($brand==$br->id)?'selected':'';?>><?php echo htmlentities($br->BrandName);?></option>
<?php } ?>
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control" name="categoryid">
                  <option value="">Select Category</option>
                  <?php $sql = "SELECT * from  tblcategories ";
$query3 = $dbh -> prepare($sql);
$query3->execute();
$catresults=$query3->fetchAll(PDO::FETCH_OBJ);
foreach($catresults as $cr)
{ ?>  
<option value="<?php echo htmlentities($cr->id);?>" <?php echo ($categoryid==$cr->id)?'selected':'';?>><?php echo htmlentities($cr->CategoryName);?></option>
<?php } ?>
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control" name="fueltype">
                  <option value="">Select Fuel Type</option>
<option value="Petrol" <?php echo ($fueltype=='Petrol')?'selected':'';?>>Petrol</option>
<option value="Diesel" <?php echo ($fueltype=='Diesel')?'selected':'';?>>Diesel</option>
<option value="CNG" <?php echo ($fueltype=='CNG')?'selected':'';?>>CNG</option>
                </select>
              </div>
              <div class="form-group">
                <label>Pickup Date:</label>
                <input type="date" class="form-control" name="fromdate" value="<?php echo htmlentities($fromdate);?>">
              </div>
              <div class="form-group">
                <label>Return Date:</label>
                <input type="date" class="form-control" name="todate" value="<?php echo htmlentities($todate);?>">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
              </div>
            </form>
          </div>
        </div>

        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Listed Cars</h5>
          </div>
          <div class="recent_addedcars">
            <ul>
<?php $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles left join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand order by id desc limit 4";
$query5 = $dbh -> prepare($sql);
$query5->execute();
$recentresults=$query5->fetchAll(PDO::FETCH_OBJ);
foreach($recentresults as $result)
{  ?>

              <li class="gray-bg">
                <div class="recent_post_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a> </div>
                <div class="recent_post_title"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a>
                  <p class="widget_price">PKR <?php echo htmlentities($result->PricePerDay);?> Per Day</p>
                </div>
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