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

$mysqli = connect("localhost","root","","shop");

//TO DO validation of input

if (isset($_GET['orderBy'])){
	$sqlQuery = "SELECT * FROM product ORDER BY ". $_GET['orderBy'];
}else{
	$sqlQuery = "SELECT * FROM product";
}
if (isset($_GET['searchString'])){
	$searchString = $_GET['searchString'];
	//searching in name and description columns	
	$sqlQuery = "SELECT * FROM product WHERE (name like  '%$searchString%') OR
				 (description like  '%$searchString%') OR (category like  '%$searchString%')";
}
$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
echo showItems($result);

echo '<a href="add.php"> Add a product </a>';
?>
</body>
</html>