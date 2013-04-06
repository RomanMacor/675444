<?php
require_once "../lib/myFunctions.php";

$mysqli = connect();
	

if (isset($_POST['id']) && isset($_POST['warningLimit'])){
	$id = $_POST['id'];
	$warningLimit = $_POST['warningLimit'];

	$sqlQuery = "SELECT * FROM product_order WHERE id=$id";	
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
	$product_order = $result->fetch_object();
	$warning = process($product_order,$warningLimit);

	echo $warning;	
	
}else{
	echo "id not set";
}

?>