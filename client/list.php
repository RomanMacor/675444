
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Producs</title>
	<link rel="stylesheet" href="../css/default.css" type="text/css"/>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body onload="updateBasketButton()">


	<div class="rightContent">
		<form method="get" action="" >
			Search: <input type="search" name="searchString" onkeyup="search(this.value)"/> 
			<input type="submit" value="search" />
		</form>


		<button id="basketButton" onclick="goToBasket()" >Go to basket</button>
	</div>
  
<?php
require_once "../lib/myFunctions.php";

//Rendering menu
$result = getCategories();	
echo showCategoriesMenu($result);
?>
<div id="sortBy">
  Sort By: 
  <form action="" method="get">
	 <select name=orderBy id="sortMenu" onchange="sortBy()">
		  <option selected value="">Do not sort</option>
		  <option value="name">Product name</option>
		  <option value="price">Price</option>
		  <option value="category">Category</option>
	</select> 
   </form>
</div>
<div id="productList">
<?php

//sanitizing input
$searchString = filter_input(INPUT_GET, "searchString", FILTER_SANITIZE_STRING);
//sanitizing input
$category = filter_input(INPUT_GET, "category", FILTER_SANITIZE_STRING);

$page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
if(!$page) $page = 1;

$orderBy = filter_input(INPUT_GET, "orderBy", FILTER_SANITIZE_STRING) ;
if($orderBy != "name" && $orderBy != "category" && $orderBy != "price") $orderBy = false;



if ($searchString)
{
	if($orderBy)
	{
		$result = getProductsBySearchString($searchString, false, $page, $orderBy);	
	}else
	{
		//searching in name, category and description columns	
		$result = getProductsBySearchString($searchString, false, $page);
	}

	
} elseif($category)
{
	if($orderBy)
	{
		$result = getProductsByCategory($category, $page, $orderBy);
	}else
	{
		$result = getProductsByCategory($category, $page);
	}
}else
{
	if($orderBy)
	{
		$result = getAllProducts($orderBy, $page);			
	}else
	{
		$result = getAllProducts("", $page);	
	}
}


echo showItemsForCustomer($result, $page);

?>
 </div>
 


</body>

</html>