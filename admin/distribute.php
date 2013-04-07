<?php
require_once "../lib/myFunctions.php";

//validating input
$warningLimit = filter_input(INPUT_POST, "warningLimit", FILTER_SANITIZE_NUMBER_INT);	
$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if ($id){
	
	$product_order = getOrderById($id)->fetch_object();
	
	$warning = process($product_order,$warningLimit);

	echo $warning;	
	
}else{
	echo "Invalid id or warningLimit.";
}

?>