<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

// Add new extra images
if(isset($_POST['addextra']))
{
$vid = $_POST['vid'];
if(isset($_FILES['extraimages']) && is_array($_FILES['extraimages']['name']))
{
if (!is_dir("img/vehicleimages")) {
mkdir("img/vehicleimages", 0755, true);
}
foreach($_FILES['extraimages']['name'] as $key => $extraname)
{
if($extraname != "")
{
move_uploaded_file($_FILES['extraimages']['tmp_name'][$key], "img/vehicleimages/".$extraname);
$exsql = "INSERT INTO tblvehicleimages(VehicleId, ImagePath) VALUES(:vid, :imgpath)";
$exquery = $dbh->prepare($exsql);
$exquery->bindParam(':vid', $vid, PDO::PARAM_STR);
$exquery->bindParam(':imgpath', $extraname, PDO::PARAM_STR);
$exquery->execute();
}
}
}
header('location:edit-vehicle.php?id='.intval($vid));
exit;
}

// Delete an extra image
if(isset($_GET['delimg']))
{
$imgid = $_GET['delimg'];
$vid = $_GET['vid'];
$delsql = "delete from tblvehicleimages where id=:imgid";
$delquery = $dbh->prepare($delsql);
$delquery->bindParam(':imgid', $imgid, PDO::PARAM_STR);
$delquery->execute();
header('location:edit-vehicle.php?id='.intval($vid));
exit;
}

header('location:manage-vehicles.php');
exit;
}
?>
