<?php
require_once "../lib/myFunctions.php";

$mysqli = connect("localhost","root","","shop");

//TO DO validation of input

if (isset($_GET['orderBy'])){
	
	$sqlQuery = "SELECT * FROM product ORDER BY ". $_GET['orderBy'];
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
}else{

	$sqlQuery = "SELECT * FROM product";
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
}
echo showItems($result);

echo '<a href="add.php"> Add a product </a>';
?>