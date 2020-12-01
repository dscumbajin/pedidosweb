<?php 
function get_row($table,$row, $id, $equal){
	global $con;
	$query=mysqli_query($con,"select $row from $table where $id='$equal'");
/* 	print("select $row from $table where $id='$equal'");
	die(); */
	$rw=mysqli_fetch_array(@$query);
	$value=$rw[$row];
	return $value;
}
?>