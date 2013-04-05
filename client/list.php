
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

$mysqli = connect();

//Rendering menu
$result = getCategories();	
echo showCategoriesMenu($result);


if (isset($_GET['category'])){
	
	$sqlQuery = "SELECT * FROM product WHERE category='". $_GET['category']."'";
}else{
	$sqlQuery = "SELECT * FROM product";
}
//if search is set
if (isset($_GET['searchString'])){
	$searchString = $_GET['searchString'];
	//searching in name and description columns	
	$sqlQuery = "SELECT * FROM product WHERE (name like  '%$searchString%') OR
				 (description like  '%$searchString%') OR (category like  '%$searchString%')";
}
$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
echo showItemsForCustomer($result);

?>
</body>

</html>