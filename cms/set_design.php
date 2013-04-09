<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<div> The desing has been set, <a href="index.php">  Procced back to home bage</a></div>
<body>
</body>
</html>
<?php
require_once "../lib/myFunctions.php";
	// validation probably not necessery with radio input
	$style = filter_input(INPUT_POST, 'style', FILTER_SANITIZE_STRING);
	switch($style)
	{
		case "style1":
			setStyle("style1");
	        break;
	    case "style2":
			setStyle("style2");
			break;
		default:
			setStyle("style1");
	}
?>