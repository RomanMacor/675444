
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Title of the document</title>
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

if($_GET["basketString"] == "null" ){
	
	echo "<b> Basket is Empty  </b< <br>";
	//echo '<a href="list.php"> Back to the shoping</a>';
}else{

	//Sanitazing input, getting rid of html escape characters, keeping the quotes
	$basket = (filter_input(INPUT_GET, "basketString", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
	
	$sum = showBasketItems($basket);

}
?>
<button id="displayFormButton" onclick="displayCustomerForm()">Put down delivery details and buy</button>

<form id="cDetails" style="display: none;" method="post" action="checkout.php">
	First Name: <input type="text" name="fName" required/> <br/>
	Last Name: <input type="text" name="lName" required/> <br/>
	
	Town: <input type="text" name="town" required/> <br/>
	Street and Number: <input type="text" name="street" required/> <br/>
	Post code: <input type="text" name="post" required/> <br/>
	
	Email: <input type="email" name="email" required/> <br/>
	<input type="hidden" id="basketString" name="basketString" /> 
	<input onclick="checkout('basketString')" type="submit" value="Buy" />
    <input type=hidden name=sum value=<?php echo $sum?>>

</form>

</body>

</html>