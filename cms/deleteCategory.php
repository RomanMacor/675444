<?php
	require_once "../lib/myFunctions.php";
	
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	//deleting picture from server

	$result =  getCategoryById($id);
	$obj = $result->fetch_object();

	$image = $obj->img;
	if ($image != "default.jpg"){
		unlink("../user_img/".$image);
	}
	
	//deleting entry in the database
	deleteCategory($id);
	
	header("Location: manageCategories.php");
?>