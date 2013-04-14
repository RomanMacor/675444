<?php
require_once "./lib/myFunctions.php";

//test if database and table exist, if not, it creates it
if (!isDatabaseReady())
{
	header("Location: cms/index.php");
	
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Index page</title>
	<script type="text/javascript" src="lib/javascript/myFunctions.js"></script>
	<link rel="stylesheet" href="css/default.css" type="text/css"/>
</head>

<body>
	<h1> Welcome to Index page</h1>
	
		<nav> <ul>
			<li> <a href="cms/index.php"> CMS</a> </li>
			<li> <a href="admin/index.php"> Admin </a> </li>
			<li> <a href="client/index.php"> Client </a> </li>
		</ul> </nav>
	

	

	
</body>

</html>