<?php
	require_once "../lib/myFunctions.php";
	
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	
	if($id)
	{
		deleteOrder($id);
		header("Location: report.php");	
	}else{
		echo "Invalid id.";
	}
	
?>