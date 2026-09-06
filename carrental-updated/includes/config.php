<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','carrental');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

// Base site URL, computed from the actual executing script (works correctly
// even when a pretty URL like /rent-a-car-lahore/ is rewritten by .htaccess
// to rent-a-car.php?city=lahore under the hood). Used as a <base href> on
// pages reachable via pretty URLs, so existing relative paths keep working
// unchanged everywhere else.
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$root = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/') . '/';
define('SITE_URL', $scheme . $_SERVER['HTTP_HOST'] . $root);
?>