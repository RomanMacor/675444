
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Manage Orders</title>
	<link rel="stylesheet" href="../css/default2.css" type="text/css"/>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body onload=populateWarningLimit()>
	<label for=warningLimit> Set a warning if the quantity gets bellow </label>
	<input type="number" name= "warningLimit" id= "warningLimit" onchange=setWarningLimit() >
	<div id="warning"> </div>
<?php
require_once "../lib/myFunctions.php";

$mysqli = connect("localhost","root","","shop");
	

if (isset($_GET['orderBy'])){
	$sqlQuery = "SELECT * FROM product_order WHERE processed=false ORDER BY ". $_GET['orderBy'];	
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
}else{
	$sqlQuery = "SELECT * FROM product_order WHERE processed=false";
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
}

echo showOrders($result);

?>
</body>

</html>