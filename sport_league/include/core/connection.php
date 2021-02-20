<?php
error_reporting(0);
ob_start();
session_start();

header("Content-Type: text/html;charset=UTF-8");

// import database connection variables
require_once __DIR__ . '/config.php';

if ($_SERVER['HTTP_HOST'] == "localhost") {
    //local
    DEFINE('DB_USER', DB_USER);
    DEFINE('DB_PASSWORD', DB_PASSWORD);
    DEFINE('DB_HOST', 'localhost'); //host name depends on server
    DEFINE('DB_NAME', DB_DATABASE);
} else {
    //local live
    DEFINE('DB_USER', DB_USER);
    DEFINE('DB_PASSWORD', DB_PASSWORD);
    DEFINE('DB_HOST', 'localhost'); //host name depends on server
    DEFINE('DB_NAME', DB_DATABASE);
}

$mysql = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysql->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysql->connect_errno . ") " . $mysql->connect_error;
}

mysqli_query($mysql, "SET NAMES 'utf8'");
?>
