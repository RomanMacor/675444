<?php
	require_once "../lib/myFunctions.php";
	$mysqli = connect("localhost","root","","shop");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Title of the document</title>
    <link  rel="stylesheet" type="text/css" href="../css/default.css" />
</head>

<body>
	
<?php
	//renderig menu
	$result = getCategories();	
	echo showCategoriesMenu($result);

	$result = getCategories($mysqli);	
	echo showCategoriesPictures($result);
	//echo showCategoriesMenu($result);


?>
</body>

</html>