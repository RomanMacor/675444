<?php
require_once "../lib/myFunctions.php";

//test if database and table exist
$mysqli = connect("localhost","root","","");

if($mysqli->query("USE shop")){
	$result = $mysqli->query("show tables like 'product'");
	
	if($result->num_rows > 0){ 
		echo "Database is ready. <br/>";
	} else{
		echo "Database hase been created.";
		//creating database;
		include('databaseini.php');
	}
}else{
	echo "Database hase been created.";
	//creating database;
	include('databaseini.php');
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CMS pages</title>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body>
	<h1> Welcome to CMS pages</h1>

	<div> <a href="add.php"> Add a product </a> </div>
	<div> <a href="list.php"> List all product </a> </div>

  	<div> <a href="erase_all_data.php" onClick="return eraseAllData()" > Erase all data</a> </div>
	<div> <a href="insert_testing_data.php"> Insert testing data</a> </div>
	<div> <a href="manageCategories.php"> Mangage categories</a> </div>

	
</body>

</html>