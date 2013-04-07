<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List of products Admin</title>
	<link rel="stylesheet" href="../css/default2.css" type="text/css"/>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body>
	<form method="get" action="" >
		Search: <input type="search" name="searchString" onkeyup="search(this.value)"/> 
		<input type="submit" value="search" />
	</form>
	
<?php
require_once "../lib/myFunctions.php";

//validation of input
$orderBy = filter_input(INPUT_GET, "orderBy", FILTER_SANITIZE_STRING);
$searchString = filter_input(INPUT_GET, "searchString", FILTER_SANITIZE_STRING);

if ($searchString)
{
	$result = getProductsBySearchString($searchString,true);
	
} elseif ($orderBy)
{
	$result = getAllProducts($orderBy);
	
}else
{
	$result = getAllProducts();
}

echo showItemsForAdmin($result);

?>
</body>
</html>