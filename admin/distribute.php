<?php
require_once "../lib/myFunctions.php";

$mysqli = connect("localhost","root","","shop");
	

if (isset($_GET['id'])){
	$id = $_GET['id'];
	$sqlQuery = "SELECT * FROM product_order WHERE id=$id";	
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
	$product_order = $result->fetch_object();
	process($product_order);
	header("Location: manage_orders.php");	
}else{
	echo "id not set";
}


?>