<?php 
$con = mysqli_connect("localhost", "root", "", "ajax");

if (isset($_POST['id'])) {
	$delid = $_POST['id'];
	$query = mysqli_query($con,"DELETE FROM reserve_tickets WHERE id = '$delid' ");

	echo $_POST['id'];
	}

 ?>