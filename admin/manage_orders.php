
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Manage Orders</title>
	<link rel="stylesheet" href="../css/default.css" type="text/css"/>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body onload="populateWarningLimit()">
	<?php
		require_once "../lib/myFunctions.php";
		echo showAdminMenu();
	?>
	<label for="warningLimit"> Set a warning if the quantity gets bellow </label>
	<input type="number" name= "warningLimit" id= "warningLimit" onchange="setWarningLimit()" >
	<div id="warning"> </div>
<?php

$orderBy = filter_input(INPUT_GET, "orderBy", FILTER_SANITIZE_STRING);	

if ($orderBy)
{
	$result = getAllOrders($orderBy);

}else
{
	$result = getAllOrders();
}

echo showOrders($result);

?>
</body>

</html>