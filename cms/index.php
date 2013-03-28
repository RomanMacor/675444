<!DOCTYPE html>
<?php
require_once "../lib/myFunctions.php";

//test if database and table exist
$mysqli = connect("localhost","root","","");

if($mysqli->query("USE shop")){
	$result = $mysqli->query("show tables like 'product'");
	
	if($result->num_rows > 0){ 
		echo "Database is ready. <br/>";
	} else{
		echo "Database will be created now.";
		//creating database;
		include('databaseini.php');
	}
}else{
	echo "Database will be created now.";
	//creating database;
	include('databaseini.php');
	
}
// delete this lane!!
// echoQuery("DROP TABLE IF EXISTS product", "Table was deleted.",$mysqli);

?>
<html>
<head>
	<meta charset="utf-8">
	<title>Title of the document</title>
</head>

<body>
	<div> <a href="add.php"> Add a product </a> </div>
	<div> <a href="list.php"> List all product </a> </div>
</body>

</html>