<?php
require_once "../lib/myFunctions.php";

//Validation of input
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, array('options'=>array('min_range'=>1)));
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT, array('options'=>array('min_range'=>0)));
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

//echo input
	// echo $_POST["name"] ."<br>";
	// echo $_POST["quantity"] ."<br>";
	// echo $_POST["category"] ."<br>";
	// echo $_POST["description"] ."<br>";


// echo "Filtered attributes: <br/> quantity: $quantity <br/> name: $name <br/> category: $category <br/> description: $description <br>";

//Connecting to server and iserting data ONLY if valid input
if($quantity && $name && $category && $price){
	$mysqli = connect("localhost","root","","shop");

	if(isset($_GET['id'])){
		$sqlQuery = sprintf("UPDATE product SET name='%s', quantity='%s', price='%s', category='%s', description='%s'
					WHERE id='%s'", 
					$name, $quantity, $price, $category, $description,$_GET['id']);
		}else{
			$sqlQuery = sprintf("INSERT INTO product (name, quantity, price, category, description) 
					VALUES ('%s', '%s', '%s', '%s', '%s')", 
					$name, $quantity, $price, $category, $description);
			}	

	echoQuery($sqlQuery, "Data inserted.", $mysqli);
	header("Location: list.php");
}else{
	echo "Invalid input, data could not be inserted.";

}
echo '<a href="list.php"> Back to list</a>';

?>