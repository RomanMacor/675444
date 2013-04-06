
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
$sum = $_POST['sum'];
$basketObj = json_decode($_POST['basketString']);

$mysqli = connect("localhost","root","","shop");

foreach ($basketObj as $obj){
	//get sum
	//$sqlQuery = "SELECT price FROM product WHERE id=$obj->id";
	//$result =	echoQuery($sqlQuery, "Data inserted.", $mysqli);
	//$item = $result->fetch_object();
	//$sum = $item->price * $obj->quantity;
	$sqlQuery = "INSERT INTO product_order (first_name, last_name, address, email, item_id,
	 quantity, ordered_date, processed, sum) VALUES 
		('$fName', '$lName', '$address', '$email', $obj->id, $obj->quantity, CURDATE(), false, $sum)";
	echoQuery($sqlQuery, "Data inserted.", $mysqli);
}
// $sqlQuery = "INSERT INTO product (name, quantity, price, category, description) VALUES 
// 	('iphone', 25, 500, 'Phones', 'For cool people')";

$mysqli->close();


?>