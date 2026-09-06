<?php 
// DB credentials
define('DB_HOST', '__DB_HOST__');
define('DB_USER', '__DB_USER__');
define('DB_PASS', '__DB_PASS__');
define('DB_NAME', '__DB_NAME__');

try {
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>