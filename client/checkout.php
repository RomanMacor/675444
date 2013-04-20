
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


if (filter_var($email, FILTER_VALIDATE_EMAIL) && $fName && $lName && $address)
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
	echo "<p> Invalid user information. The order could not be accepted. Please follow the link fill the user detail again</p>";
	echo "<a href=basket.php?basketString=$basketString> Basket</a>";
}


?>