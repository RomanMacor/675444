<?php
	require_once "../lib/myFunctions.php";
	$mysqli = connect("localhost","root","","shop");
	
	$id = $_GET['id'];
	$query = "DELETE FROM product_order WHERE id= $id";
	$mysqli->query($query);
	$mysqli->close();
	header("Location: report.php");
?>