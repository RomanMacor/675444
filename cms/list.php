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

$page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
if(!$page) $page = 1;


if ($searchString)
{
	//searching in name, category and description columns	
	$result = getProductsBySearchString($searchString, true, $page);
} elseif($orderBy)
{
	$result = getAllProducts($orderBy, $page);
}else
{
	$result = getAllProducts("", $page);	
}

echo showItems($result, $page);

echo '<a href="add.php"> Add a product </a>';
?>
</body>
</html>