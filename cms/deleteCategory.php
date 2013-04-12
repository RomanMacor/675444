<?php
	require_once "../lib/myFunctions.php";
	
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	//deleting picture from server
	//commented because it
/*
	$result =  getProductById($id);
	$obj = $result->fetch_object();

	$image = $obj->img;
	if ($image != "default.png"){
		unlink("../img/".$image);
	}
	*/
	//deleting entry in the database
	deleteCategory($id);
	
	header("Location: manageCategories.php");
?>