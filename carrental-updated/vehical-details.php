<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$customername=$_POST['customername'];
$customeremail=$_POST['customeremail'];
$countrycode=$_POST['countrycode'];
$customerphone=$countrycode.' '.$_POST['customerphone'];
$customerage=$_POST['customerage'];
$licensetype=$_POST['licensetype'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate']; 
$pickupcity=$_POST['pickupcity'];
$dropoffcity=$_POST['dropoffcity'];
$message="Guest enquiry via car detail page";
$status=0;
$vhid=$_POST['vhid'];
$bookingno=mt_rand(100000000, 999999999);
$ret="SELECT * FROM tblbooking where (:fromdate BETWEEN date(FromDate) and date(ToDate) || :todate BETWEEN date(FromDate) and date(ToDate) || date(FromDate) BETWEEN :fromdate and :todate) and VehicleId=:vhid and Status<>2";
$query1 = $dbh -> prepare($ret);
$query1->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query1->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query1->bindParam(':todate',$todate,PDO::PARAM_STR);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);

if($query1->rowCount()==0)
{

$sql="INSERT INTO tblbooking(BookingNumber,CustomerName,CustomerEmail,CustomerPhone,CustomerAge,LicenseType,VehicleId,PickupCity,DropoffCity,FromDate,ToDate,message,Status) VALUES(:bookingno,:customername,:customeremail,:customerphone,:customerage,:licensetype,:vhid,:pickupcity,:dropoffcity,:fromdate,:todate,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':bookingno',$bookingno,PDO::PARAM_STR);
$query->bindParam(':customername',$customername,PDO::PARAM_STR);
$query->bindParam(':customeremail',$customeremail,PDO::PARAM_STR);
$query->bindParam(':customerphone',$customerphone,PDO::PARAM_STR);
$query->bindParam(':customerage',$customerage,PDO::PARAM_STR);
$query->bindParam(':licensetype',$licensetype,PDO::PARAM_STR);
$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
$query->bindParam(':pickupcity',$pickupcity,PDO::PARAM_STR);
$query->bindParam(':dropoffcity',$dropoffcity,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
  // --- AUTOMATIC EMAIL NOTIFICATION CODE ---
    $to = "support@pakdrive365.com.au";
    $subject = "New Booking Request #" . $bookingno . " - PakDrive365";

    $email_content = "You have received a new booking request on PakDrive365!\n\n";
    $email_content .= "Booking Number: " . $bookingno . "\n";
    $email_content .= "Customer Name: " . $customername . "\n";
    $email_content .= "Customer Email: " . $customeremail . "\n";
    $email_content .= "Customer Phone: " . $customerphone . "\n";
    $email_content .= "Age: " . $customerage . "\n";
    $email_content .= "License Type: " . $licensetype . "\n";
    $email_content .= "Pickup City: " . $pickupcity . "\n";
    $email_content .= "Drop-off City: " . $dropoffcity . "\n";
    $email_content .= "From Date: " . $fromdate . "\n";
    $email_content .= "To Date: " . $todate . "\n";

    $headers = "From: webmaster@pakdrive365.com.au\r\n";
    $headers .= "Reply-To: " . $customeremail . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    @mail($to, $subject, $email_content, $headers);
    // ----------------------------------------
echo "<script>alert('Thank you! Your booking request has been received. Our team will contact you shortly to confirm.');</script>";
echo "<script type='text/javascript'> document.location = 'vehical-details.php?vhid=".intval($vhid)."'; </script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
 echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
} }  else{
 echo "<script>alert('This car is already booked for the selected dates. Please choose different dates or another car.');</script>"; 
 echo "<script type='text/javascript'> document.location = 'vehical-details.php?vhid=".intval($vhid)."'; </script>";
}

}

?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Car Rental | Vehicle Details</title>
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

<!--Listing-Image-Slider-->

<?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles left join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
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

<style>
#listing_img_slider .gallery-img-box { width:100%; height:480px; overflow:hidden; }
#listing_img_slider .gallery-img-box img { width:100%; height:100%; object-fit:cover; object-position:center; }
</style>


<section id="listing_img_slider">
  <div class="gallery-img-box"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></div>
  <div class="gallery-img-box"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" alt="image"></div>
  <div class="gallery-img-box"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" alt="image"></div>
  <div class="gallery-img-box"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" alt="image"></div>
  <?php if($result->Vimage5=="")
{

} else {
  ?>
  <div class="gallery-img-box"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" alt="image"></div>
  <?php } ?>
  <?php $extraimgsql="select ImagePath from tblvehicleimages where VehicleId=:vhid2 order by id asc";
$extraimgquery=$dbh->prepare($extraimgsql);
$extraimgquery->bindParam(':vhid2',$vhid,PDO::PARAM_STR);
$extraimgquery->execute();
$extraimgs=$extraimgquery->fetchAll(PDO::FETCH_OBJ);
foreach($extraimgs as $eimg){ ?>
  <div class="gallery-img-box"><img src="admin/img/vehicleimages/<?php echo htmlentities($eimg->ImagePath);?>" alt="image"></div>
  <?php } ?>
</section>
<!--/Listing-Image-Slider-->


<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p>PKR <?php echo htmlentities($result->PricePerDay);?> </p>Per Day
         
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
          
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->ModelYear);?></h5>
              <p>Reg.Year</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->FuelType);?></h5>
              <p>Fuel Type</p>
            </li>
       
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->SeatingCapacity);?></h5>
              <p>Seats</p>
            </li>
            <?php if($result->GearType){?>
            <li> <i class="fa fa-cog" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->GearType);?></h5>
              <p>Gear Type</p>
            </li>
            <?php } ?>
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
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">Accessories</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Air Conditioner</td>
<?php if($result->AirConditioner==1)
{
?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?> 
   <td><i class="fa fa-close" aria-hidden="true"></i></td>
   <?php } ?> </tr>

<tr>
<td>AntiLock Braking System</td>
<?php if($result->AntiLockBrakingSystem==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else {?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
                    </tr>

<tr>
<td>Power Steering</td>
<?php if($result->PowerSteering==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>
                   

<tr>

<td>Power Windows</td>

<?php if($result->PowerWindows==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>
                   
 <tr>
<td>CD Player</td>
<?php if($result->CDPlayer==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Leather Seats</td>
<?php if($result->LeatherSeats==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Central Locking</td>
<?php if($result->CentralLocking==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Power Door Locks</td>
<?php if($result->PowerDoorLocks==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
                    </tr>
                    <tr>
<td>Brake Assist</td>
<?php if($result->BrakeAssist==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php  } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Driver Airbag</td>
<?php if($result->DriverAirbag==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
 </tr>
 
 <tr>
 <td>Passenger Airbag</td>
 <?php if($result->PassengerAirbag==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else {?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Crash Sensor</td>
<?php if($result->CrashSensor==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
        </div>
<?php }} ?>
   
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3">
      
        <div class="share_vehicle">
          <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
        </div>
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Booking Form</h5>
          </div>
          <form method="post">
            <input type="hidden" name="currentvhid" value="<?php echo htmlentities($result->id);?>">
            <div class="form-group">
              <label>Your name *</label>
              <input type="text" class="form-control" name="customername" placeholder="Your name" required>
            </div>
            <div class="form-group">
              <label>Your email *</label>
              <input type="email" class="form-control" name="customeremail" placeholder="Your email" required>
            </div>
            <div class="form-group">
              <label>Your Phone *</label>
              <div class="row">
                <div class="col-xs-4" style="padding-right:5px;">
                  <select class="form-control" name="countrycode">
                    <option value="+92" selected>PK +92</option>
                    <option value="+966">SA +966</option>
                    <option value="+971">AE +971</option>
                    <option value="+44">UK +44</option>
                    <option value="+1">US +1</option>
                    <option value="+91">IN +91</option>
                    <option value="+61">AU +61</option>
                    <option value="+974">QA +974</option>
                    <option value="+968">OM +968</option>
                    <option value="+965">KW +965</option>
                  </select>
                </div>
                <div class="col-xs-8" style="padding-left:5px;">
                  <input type="text" class="form-control" name="customerphone" placeholder="Phone / whatsapp number" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Your Age (optional)</label>
              <input type="text" class="form-control" name="customerage" placeholder="Your age">
            </div>
            <div class="form-group">
              <label>Which Driving License do you have? *</label><br>
              <label class="radio-inline"><input type="radio" name="licensetype" value="Pakistani Driving License" required> Pakistani Driving License</label><br>
              <label class="radio-inline"><input type="radio" name="licensetype" value="International Driving License"> International Driving License</label>
            </div>
            <div class="form-group">
              <label>Pickup Date? *</label>
              <input type="date" class="form-control" name="fromdate" required>
            </div>
            <div class="form-group">
              <label>Drop-off Date? *</label>
              <input type="date" class="form-control" name="todate" required>
            </div>
            <div class="form-group">
              <label>Pickup City?</label>
              <select class="form-control" name="pickupcity">
                <?php $ret2="select CityName from tblcities order by DisplayOrder asc, CityName asc";
$cquery=$dbh->prepare($ret2);
$cquery->execute();
$cityrows=$cquery->fetchAll(PDO::FETCH_OBJ);
foreach($cityrows as $crow){ ?>
                <option value="<?php echo htmlentities($crow->CityName);?>"><?php echo htmlentities($crow->CityName);?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Drop-off / Return City?</label>
              <select class="form-control" name="dropoffcity">
                <?php foreach($cityrows as $crow){ ?>
                <option value="<?php echo htmlentities($crow->CityName);?>"><?php echo htmlentities($crow->CityName);?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Which car do you need on rent?</label>
              <select class="form-control" name="vhid">
                <?php $ret3="select tblvehicles.id,tblvehicles.VehiclesTitle,tblbrands.BrandName from tblvehicles left join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand order by tblvehicles.VehiclesTitle asc";
$vquery=$dbh->prepare($ret3);
$vquery->execute();
$vehrows=$vquery->fetchAll(PDO::FETCH_OBJ);
foreach($vehrows as $vrow){ $selected = ($vrow->id == $result->id) ? 'selected' : ''; ?>
                <option value="<?php echo htmlentities($vrow->id);?>" <?php echo $selected;?>><?php echo htmlentities($vrow->BrandName);?> <?php echo htmlentities($vrow->VehiclesTitle);?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <input type="submit" class="btn" name="submit" value="Submit">
            </div>
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
    
    <div class="space-20"></div>
    <div class="divider"></div>
    
    <!--Similar-Cars-->

<style>
.similar_cars .row { display: flex; flex-wrap: wrap; }
.similar_cars .grid_listing { display: flex; margin-bottom: 25px; }
.similar_cars .product-listing-m { display: flex; flex-direction: column; width: 100%; }
.similar_cars .product-listing-img img { width: 100%; height: 230px; object-fit: cover; }
</style>    
    <div class="similar_cars">
      <h3>Similar Cars</h3>
      <div class="row">
<?php 
$bid=$_SESSION['brndid'];
$sql="SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles left join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.VehiclesBrand=:bid limit 4";
$query = $dbh -> prepare($sql);
$query->bindParam(':bid',$bid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>      
        <div class="col-md-3 grid_listing">
          <div class="product-listing-m gray-bg">
            <div class="product-listing-img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" /> </a>
            </div>
            <div class="product-listing-content">
              <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h5>
              <p class="list-price">PKR <?php echo htmlentities($result->PricePerDay);?></p>
          
              <ul class="features_list">
                
             <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
                <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
              </ul>
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



<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>