
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Manage Orders</title>
	<link rel="stylesheet" href="../lib/css/styles.css" type="text/css"/>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body>
	
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