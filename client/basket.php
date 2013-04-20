
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Basket</title>
	<link rel="stylesheet" href="../lib/css/styles.css" type="text/css"/>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
    <link type="text/css" rel="stylesheet" href="../css/default.css" />
</head>

<body>
	
<?php
require_once "../lib/myFunctions.php";

//Rendering menu
$result = getCategories();	
echo showCategoriesMenu($result);
$sum = 0;
if($_GET["basketString"] == "null" ){
	
	echo "<p><b> Basket is Empty  </b> </p>";
	//echo '<a href="list.php"> Back to the shoping</a>';
}else{

	//Sanitazing input, getting rid of html escape characters, keeping the quotes
	$basket = (filter_input(INPUT_GET, "basketString", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
	
	$sum = showBasketItems($basket);

}
?>
<button id="displayFormButton" onclick="displayCustomerForm()">Put down delivery details and buy</button>

<form id="cDetails" style="display: none;" method="post" action="checkout.php">
	<label for=fName> First Name: </label>
	<input type="text" name="fName" required/> <br/>

	<label for=lName> Last Name: </label>
	<input type="text" name="lName" required/> <br/>
	
	<label for=town> Town: </label>
	<input type="text" name="town" required/> <br/>
	
	<label for=street> Street: </label>
	<input type="text" name="street" required/> <br/>
	
	<label for=post> Post code: </label>
	<input type="text" name="post" required/> <br/>
	
	<label for=email> Email: </label>
	<input type="email" name="email" required/> <br/>
	
	<input type="hidden" id="basketString" name="basketString" /> 
	<input type=hidden name=sum value=<?php echo $sum?>>
	
	<input onclick="checkout('basketString')" type="submit" value="Buy" />
    

</form>

</body>

</html>