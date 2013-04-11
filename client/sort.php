<?php
	require_once "../lib/myFunctions.php";
	$orderBy = filter_input(INPUT_GET, "orderBy", FILTER_SANITIZE_STRING) ;
	
	if($orderBy === "name" || $orderBy === "category" || $orderBy === "price")
	{
		$page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
	
		$searchString = filter_input(INPUT_GET, "searchString", FILTER_SANITIZE_STRING);
		//sanitizing input
		$category = filter_input(INPUT_GET, "category", FILTER_SANITIZE_STRING);

		if(!$page) $page = 1;

		if($searchString)
		{
		 	$result = getProductsBySearchString($searchString, false, $page, $orderBy);	
			echo showItemsForCustomer($result, $page);
			exit();
		}
		if($category)
		{	
			$result = getProductsByCategory($category, $page, $orderBy);
			echo showItemsForCustomer($result, $page);
			exit();
		}
		$result = getAllProducts($orderBy, $page);			
	
		echo showItemsForCustomer($result, $page);
	
	}else echo "";
	
?>

