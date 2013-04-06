<?php
require_once "../lib/myFunctions.php";

$searchString = filter_input(INPUT_GET, "searchString", FILTER_SANITIZE_STRING);

if ($searchString)
{
	//searching in name and description columns	
	$result = getProductsBySearchString($searchString);
}
echo showItemsForCustomer($result);
?>