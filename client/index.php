<?php
	require_once "../lib/myFunctions.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Web shop</title>
    <link  rel="stylesheet" type="text/css" href="../css/default.css" />
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
	//renderig menu
	$result = getCategories();	
	echo showCategoriesMenu($result);

	//rendering pictures of categories
	$result = getCategories();	
	echo showCategoriesPictures($result);


?>
</body>

</html>