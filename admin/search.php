<?php
require_once "../lib/myFunctions.php";

$mysqli = connect("localhost","root","","shop");

if (isset($_GET['searchString'])){
	$searchString = $_GET['searchString'];
	//searching in name, id, category and description columns	
	$sqlQuery = "SELECT * FROM product WHERE (name like  '%$searchString%') OR
				 (description like  '%$searchString%') OR (category like  '%$searchString%') OR (id like  '%$searchString%')";
	
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
}
echo showItemsForAdmin($result);

?>