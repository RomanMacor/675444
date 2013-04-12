<?php
	require_once "../lib/myFunctions.php";
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//deleting picture from server

	$result =  getProductById($id);
	$obj = $result->fetch_object();

	$image = $obj->img;
	if ($image != "default.jpg"){
		unlink("../user_img/".$image);
	}
	//deleting data from database
	deleteProduct($id);
	
	header("Location: list.php");
?>