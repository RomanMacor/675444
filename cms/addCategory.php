<?php
require_once "../lib/myFunctions.php";

$categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

if($categoryName){
	$mysqli = connect("localhost","root","","shop");

	$sqlQuery = ("INSERT INTO category (name) VALUES ('$categoryName')");
				
	echoQuery($sqlQuery, "Data inserted.", $mysqli);
	header("Location: manageCategories.php");
}else{
	echo "Invalid input, data could not be inserted.";
}

?>