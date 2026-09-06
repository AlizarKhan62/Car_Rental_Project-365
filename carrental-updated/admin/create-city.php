<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
// Code for creating city
if(isset($_POST['submit']))
{
$cityname=$_POST['cityname'];
$slug=$_POST['slug'];
$metatitle=$_POST['metatitle'];
$heroheading=$_POST['heroheading'];
$herodescription=$_POST['herodescription'];

// Normalize slug: lowercase, spaces -> hyphens, strip anything unsafe for a URL segment
$slug = strtolower(trim($slug));
$slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
$slug = trim($slug, '-');

if($slug=='')
{
$error="Please provide a valid slug (letters, numbers, hyphens only)";
}
else
{
// Ensure slug is unique before inserting
$checksql="SELECT id from tblcities WHERE Slug=:slug";
$checkquery=$dbh->prepare($checksql);
$checkquery->bindParam(':slug',$slug,PDO::PARAM_STR);
$checkquery->execute();
if($checkquery->rowCount() > 0)
{
$error="A city with this slug already exists. Please choose a different slug.";
}
else
{
$sql="INSERT INTO tblcities(CityName,Slug,MetaTitle,HeroHeading,HeroDescription) VALUES(:cityname,:slug,:metatitle,:heroheading,:herodescription)";
$query = $dbh->prepare($sql);
$query->bindParam(':cityname',$cityname,PDO::PARAM_STR);
$query->bindParam(':slug',$slug,PDO::PARAM_STR);
$query->bindParam(':metatitle',$metatitle,PDO::PARAM_STR);
$query->bindParam(':heroheading',$heroheading,PDO::PARAM_STR);
$query->bindParam(':herodescription',$herodescription,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="City Created successfully";
}
else
{
$error="Something went wrong. Please try again";
}
}
}

}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>PakDrive365 - Car Rental | Admin Create City</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Create City</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Create City</div>
									<div class="panel-body">
										<form method="post" name="createcity" class="form-horizontal">
										
										
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
					else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-3 control-label">City Name<span style="color:red">*</span></label>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="cityname" id="cityname" placeholder="e.g. Lahore" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">URL Slug<span style="color:red">*</span></label>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="slug" id="slug" placeholder="e.g. lahore" required>
													<p class="help-block">Used in the page URL as /rent-a-car.php?city=<strong>lahore</strong>. Letters, numbers and hyphens only.</p>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Meta / Page Title</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="metatitle" placeholder="e.g. Rent A Car in Lahore">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Hero Heading</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="heroheading" placeholder="e.g. Best Rent a Car in Lahore">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Hero Description</label>
												<div class="col-sm-9">
													<textarea class="form-control" name="herodescription" rows="4" placeholder="Short paragraph shown under the hero heading on the city page"></textarea>
												</div>
											</div>
											<div class="hr-dashed"></div>
											

											<div class="form-group">
												<div class="col-sm-9 col-sm-offset-3">
					
													<button class="btn btn-primary" name="submit" type="submit">Submit</button>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
							
						</div>
						
					

					</div>
				</div>
				
			
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script>
	// Auto-fill slug from city name, but let the admin override it
	var slugTouched = false;
	document.getElementById('slug').addEventListener('input', function(){ slugTouched = true; });
	document.getElementById('cityname').addEventListener('input', function(){
		if(slugTouched) return;
		var v = this.value.toLowerCase().trim().replace(/[^a-z0-9]+/g,'-').replace(/(^-|-$)/g,'');
		document.getElementById('slug').value = v;
	});
	</script>

</body>

</html>
<?php } ?>
