<?php 

require("../core/connection.php");
require("../core/function.php");

$table = $_GET['table'];
$category = $_GET['category'];
$operate = $_GET['operate'];
if ($category == "team_edit") {
	if ($operate == "delete_player") {
		$data = array(
			'team_id' => 0,
        );
		$query = Update('users', $data, "WHERE id = '".$_GET['id']."'");
	}
}
exit();

?>