<?php
	require_once "../lib/myFunctions.php";
	$mysqli = connect("localhost","root","","shop");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Title of the document</title>
</head>

<body>
	
<nav> 
  <ul>

     <li><a href="">Home</a></li>

     <li><a href="list.php">Products</a></li>

   </ul>
</nav>
<?php
	$result = getCategories($mysqli);	
	echo showCategoriesMenu($result);

?>
</body>

</html>