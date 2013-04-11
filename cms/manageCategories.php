<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Manage Categories</title>
	<link rel="stylesheet" href="../css/default.css" type="text/css"/>
</head>

<body>
	<?php 
		require_once "../lib/myFunctions.php";
		echo showCmsMenu();
		
	?>
<a href=add.php> Back to creating new product</a>
<form method="post" action="addCategory.php" 
		enctype="multipart/form-data">
	<input type="text" name="categoryName" placeholder="Name of the category" required /> <br/>
	<input type="file" name="picture" accept="image/*"/> </br>
	<input type="submit" value="Add">
</form>

<?php

$orderBy = filter_input(INPUT_GET, "orderBy", FILTER_SANITIZE_STRING);

if ($orderBy)
{
	$result = getCategories($orderBy);
}else
{
		$result = getCategories();
}
echo showCategories($result);
?>
</body>

</html>