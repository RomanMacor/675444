<?php
	require_once "../lib/myFunctions.php";
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	deteleProduct($id);
	
	header("Location: list.php");
?>