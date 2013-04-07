<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Manage Orders</title>
	<link rel="stylesheet" href="../lib/css/styles.css" type="text/css"/>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body>
<form method="get" action="">
	Show:
	<select name="limit"> 
	  <option value="all">All</option>
	  <option value="week">Last week</option>
	  <option value="month">Last month</option>
	  <option value="year">Last Year</option>
	  
	</select>
	<input type="submit" value="Apply criteria" />
</form>

<?php
require_once "../lib/myFunctions.php";
	
// over a set of time
if (isset($_GET['limit']))
{
	$limit = $_GET['limit'];
	switch ($limit) {
		case 'week':
			$limit = " AND DATEDIFF(CURDATE(),processed_date) < 7";
			break;
		case 'month':
			$limit = " AND DATEDIFF(CURDATE(),processed_date) < 30";
			break;
		case 'year':
			$limit = " AND DATEDIFF(CURDATE(),processed_date) < 365";
			break;
		
		default:
			$limit = "";
			break;
	}
}else
{
	$limit = "";
}
$orderBy = filter_input(INPUT_GET, "orderBy", FILTER_SANITIZE_STRING);	

if ($orderBy)
{
	$result = getAllReports($limit, $orderBy);
}else
{
	$result = getAllReports($limit);
}

echo showReport($result);

?>
</body>

</html>