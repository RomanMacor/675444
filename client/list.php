
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Title of the document</title>
	<link rel="stylesheet" href="../lib/css/styles.css" type="text/css"/>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body>
	
	<!-- <form method="get" action="basket.php" class="rightContent">
		<input id="basketString" name="basketString" type="hidden" value=""/>
		<input onclick="updateBasket()" type="submit"  value="Go to basket" />
	</form> -->
	<button onclick="goToBasket()" class="rightContent">Go to basket</button>
<?php
require_once "../lib/myFunctions.php";

$mysqli = connect("localhost","root","","shop");

//TO DO validation of input
$result = getCategories($mysqli);	
echo showCategoriesMenu($result);


/*$basketString = '<div id="basket" class="rightContent">'; 
$basketString .= 
$basketString .= '<a href="basket.php" id="goToBasket"> Go to basket </a> </div>';
echo $basketString;
*/	
if (isset($_GET['category'])){
	
	$sqlQuery = "SELECT * FROM product WHERE category='". $_GET['category']."'";
	
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
}else{
	$sqlQuery = "SELECT * FROM product";
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
}
echo showItemsForCustomer($result);

?>
</body>

</html>