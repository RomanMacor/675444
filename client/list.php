
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Title of the document</title>
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


//sanitizing input
$searchString = filter_input(INPUT_GET, "searchString", FILTER_SANITIZE_STRING);
//sanitizing input
$category = filter_input(INPUT_GET, "category", FILTER_SANITIZE_STRING);

if ($searchString)
{
	//searching in name, category and description columns	
	$result = getProductsBySearchString($searchString);
} elseif($category)
{
	$result = getProductsByCategory($category);
}else
{
	$result = getAllProducts();	
}


echo showItemsForCustomer($result);

?>
</body>

</html>