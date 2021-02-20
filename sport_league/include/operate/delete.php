<?php 

require("../core/connection.php");
require("../core/function.php");

$table = $_GET['table'];
$id = $_GET['id'];
$query = Delete($table, 'where id='.$id.'');
exit();

?>