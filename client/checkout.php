
<?php

require_once "../lib/myFunctions.php";

// sanitizing the input
$fName = filter_input(INPUT_POST, "fName", FILTER_SANITIZE_STRING);
$lName = filter_input(INPUT_POST, "lName", FILTER_SANITIZE_STRING);
$address = filter_input(INPUT_POST, "town", FILTER_SANITIZE_STRING).", ";
$address .= filter_input(INPUT_POST, "street", FILTER_SANITIZE_STRING).", ";
$address .= filter_input(INPUT_POST, "post", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$sum = $_POST['sum'];

$basketString = filter_input(INPUT_POST, "basketString", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$basketObj = json_decode($basketString);

echo "basket string: $basketString";

//validating email
if (filter_var($email, FILTER_VALIDATE_EMAIL))
{
	
	foreach ($basketObj as $obj)
	{
		createProductOrder($fName, $lName, $address, $email, $obj->id, $obj->quantity, 'false', $sum);		
	}

	echo "Thank you for shoping with us today. <br/>";
	echo "Your order has been processed. <br/>";
	echo '<a href="list.php"> Back to the shoping</a>';

}else
{
	echo "Invalid email. Please click return button on the browser or follow the link back to basket";
	echo "<a href=basket.php?basketString=$basketString> Basket</a>";
}


?>