<?php
	require_once "../lib/myFunctions.php";
	$sortBy = filter_input(INPUT_GET, "sortBy", FILTER_SANITIZE_STRING) ;
	if($sortBy && $sortBy != ""){
		$result = getAllProducts($sortBy);	
	}else{
		//returs unsorted products if order is not set
		$result = getAllProducts();	
	}
	
	echo showItemsForCustomer($result);
?>

