<?php 
$con = mysqli_connect("localhost","root","","ajax");
if (isset($_POST['id'])) {
	$updid = $_POST['id'];
	$query = mysqli_query($con, "SELECT * FROM reserve_tickets WHERE id = '$updid' ");
	$row = mysqli_fetch_array($query);
	echo json_encode($row);
}

 ?>