
<?php
// TODO, all the logic ()
require_once "../lib/myFunctions.php";

echo "Thank you for shoping with us today. <br/>";
echo "Your order has been processed. <br/>";
echo '<a href="list.php"> Back to the shoping</a>';


//TODO: validation
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$address = $_POST['town'].", ";
$address .= $_POST['street'].", ";
$address .= $_POST['post'];
$email = $_POST['email'];

$basketObj = json_decode($_POST['basketString']);

$mysqli = connect("localhost","root","","shop");

foreach ($basketObj as $obj){
	$sqlQuery = "INSERT INTO product_order (first_name, last_name, address, email, item_id,
	 quantity, ordered_date, processed) VALUES 
		('$fName', '$lName', '$address', '$email', $obj->id, $obj->quantity, CURDATE(), false)";
	echoQuery($sqlQuery, "Data inserted.", $mysqli);
}
// $sqlQuery = "INSERT INTO product (name, quantity, price, category, description) VALUES 
// 	('iphone', 25, 500, 'Phones', 'For cool people')";

$mysqli->close();


?>