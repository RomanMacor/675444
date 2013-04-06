<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detail page.</title>
	<link rel="stylesheet" href="../css/default.css" type="text/css"/>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body>
	<div class="rightContent">
		<form method="get" action="" >
			Search: <input type="search" name="searchString" onkeyup="search(this.value)"/> 
			<input type="submit" value="search" />
		</form>


		<button id="basketButton" onclick="goToBasket()" >Go to basket</button>
	</div>
<?php
require_once "../lib/myFunctions.php";

$result = getCategories();	
echo showCategoriesMenu($result);

//TODO: validation
$id = (filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if($id)
{
	$result = getItemById($id);
	echo showItemDetail($result);	
}else
{
	echo "invalid id.";
}

?>
</body>

</html>