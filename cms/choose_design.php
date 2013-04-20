<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Set web site design</title>
	<link rel="stylesheet" type="text/css" href="../css/default.css">
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body>
	<?php 
		require_once "../lib/myFunctions.php";
		echo showCmsMenu();
		
	?>
	<h2>Please choose a style for the website:</h2>
	
	<form method="post" action="set_design.php">
	
		<input checked type="radio" name="style" value="style1"><img src="../img/style1.jpg"/><br>
		<input type="radio" name="style" value="style2"><img src="../img/style2.jpg"/><br>
		<input type="submit"  value="Save">

	</form>
</body>
</html>