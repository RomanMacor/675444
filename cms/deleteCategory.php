<?php
	require_once "../lib/myFunctions.php";
	
	$mysqli = connect("localhost","root","","shop");
	
	$id = $_GET['id'];
	//deleting picture from server
	$query = "SELECT img FROM category WHERE id= $id";
	$result =  $mysqli->query($query);
	$obj = $result->fetch_object();
	$image = $obj->img;
	if ($image != "default.png"){
		unlink("../img/".$image);
	}
	//deleting entry in the database
	$query = "DELETE FROM category WHERE id= $id";
	$mysqli->query($query);
	$mysqli->close();
	header("Location: manageCategories.php");
?>