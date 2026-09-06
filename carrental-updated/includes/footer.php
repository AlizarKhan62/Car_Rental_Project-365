<?php
if(isset($_POST['emailsubscibe']))
{
$subscriberemail=$_POST['subscriberemail'];
$sql ="SELECT SubscriberEmail FROM tblsubscribers WHERE SubscriberEmail=:subscriberemail";
$query= $dbh -> prepare($sql);
$query-> bindParam(':subscriberemail', $subscriberemail, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<script>alert('Already Subscribed.');</script>";
}
else{
$sql="INSERT INTO  tblsubscribers(SubscriberEmail) VALUES(:subscriberemail)";
$query = $dbh->prepare($sql);
$query->bindParam(':subscriberemail',$subscriberemail,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Subscribed successfully.');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
}
?>

<footer>
<?php $wasql = "SELECT WhatsAppNo from tblcontactusinfo limit 1";
$waquery = $dbh -> prepare($wasql);
$waquery->execute();
$wainfo = $waquery->fetch(PDO::FETCH_OBJ);
if($wainfo && trim($wainfo->WhatsAppNo) != ""){ ?>
<a href="https://api.whatsapp.com/send?phone=<?php echo htmlentities($wainfo->WhatsAppNo);?>&text=Hello%2C%20I%20need%20help%20booking%20a%20car" target="_blank" rel="noopener" title="Chat with us on WhatsApp"
style="position:fixed;bottom:25px;right:25px;z-index:999;background:#25D366;width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 10px rgba(0,0,0,0.3);">
<i class="fa fa-whatsapp" aria-hidden="true" style="color:#fff;font-size:28px;"></i>
</a>
<?php } ?>
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-md-3 col-sm-6">
          <h6>About Company</h6>
          <ul>
          <li><a href="page.php?type=aboutus">About Us</a></li>
            <li><a href="page.php?type=faqs">FAQs</a></li>
            <li><a href="page.php?type=privacy">Privacy Policy</a></li>
          <li><a href="page.php?type=terms">Terms &amp; Conditions</a></li>
               <!-- <li><a href="admin/">Admin Login</a></li> -->
          </ul>
        </div>

        <div class="col-md-3 col-sm-6">
          <h6>Rent A Car Cities</h6>
          <ul>
<?php $ftrcitysql = "SELECT CityName, Slug from tblcities ORDER BY DisplayOrder ASC, CityName ASC";
$ftrcityquery = $dbh -> prepare($ftrcitysql);
$ftrcityquery->execute();
$ftrcityresults = $ftrcityquery->fetchAll(PDO::FETCH_OBJ);
foreach($ftrcityresults as $ftrcity)
{ ?>
            <li><a href="rent-a-car.php?city=<?php echo htmlentities($ftrcity->Slug);?>">Rent A Car in <?php echo htmlentities($ftrcity->CityName);?></a></li>
<?php } ?>
          </ul>
        </div>

        <div class="col-md-3 col-sm-6">
          <h6>Quick Links</h6>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="page.php?type=aboutus">About Us</a></li>
            <li><a href="car-listing.php">All Cars</a></li>
            <li><a href="page.php?type=services">Services</a></li>
            <li><a href="contact-us.php">Contact Us</a></li>
          </ul>
        </div>

        <div class="col-md-3 col-sm-6">
          <h6>Contact Info</h6>
          <ul>
<?php $ftrcontactsql = "SELECT * from tblcontactusinfo limit 1";
$ftrcontactquery = $dbh -> prepare($ftrcontactsql);
$ftrcontactquery->execute();
$ftrcontact = $ftrcontactquery->fetch(PDO::FETCH_OBJ);
if($ftrcontact){ ?>
            <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo htmlentities($ftrcontact->Address);?></li>
            <li><i class="fa fa-phone" aria-hidden="true"></i> <?php echo htmlentities($ftrcontact->ContactNo);?></li>
            <li><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo htmlentities($ftrcontact->EmailId);?></li>
<?php } ?>
          </ul>
          <div class="newsletter-form" style="margin-top:15px;">
            <form method="post">
              <div class="form-group">
                <input type="email" name="subscriberemail" class="form-control newsletter-input" required placeholder="Enter Email Address" />
              </div>
              <button type="submit" name="emailsubscibe" class="btn btn-block">Subscribe <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-push-6 text-right">
          <div class="footer_widget">
            <p>Follow PakDrive365</p>
            <ul>
              <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-md-pull-6">
          <p class="copy-right">PakDrive365.
                        All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </div>
</footer>