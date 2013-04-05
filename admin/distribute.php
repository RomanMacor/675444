<?php
require_once "../lib/myFunctions.php";

$mysqli = connect("localhost","root","","shop");
	

if (isset($_GET['id'])){
	$id = $_GET['id'];
	$sqlQuery = "SELECT * FROM product_order WHERE id=$id";	
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
	$product_order = $result->fetch_object();
	$warning = process($product_order);
	if ($warning === ""){
		header("Location: manage_orders.php");		
	}else{
		echo $warning;	
	}
	
}else{
	echo "id not set";
}


?>