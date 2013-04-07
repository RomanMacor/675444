<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List of products CMS</title>
	<link rel="stylesheet" href="../css/default2.css" type="text/css"/>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body >
	<form method="get" action="" >
		Search: <input type="search" name="searchString" onkeyup="search(this.value)"/> 
		<input type="submit" value="search" />
	</form>
<?php
require_once "../lib/myFunctions.php";

//sanitizing input
$searchString = filter_input(INPUT_GET, "searchString", FILTER_SANITIZE_STRING);
//sanitizing input
$orderBy = filter_input(INPUT_GET, "orderBy", FILTER_SANITIZE_STRING);

if ($searchString)
{
	//searching in name, category and description columns	
	$result = getProductsBySearchString($searchString, true);
} elseif($orderBy)
{
	$result = getAllProducts($orderBy);
}else
{
	$result = getAllProducts();	
}

echo showItems($result);

echo '<a href="add.php"> Add a product </a>';
?>
</body>
</html>