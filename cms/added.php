<?php
require_once "../lib/myFunctions.php";

//Validation of input
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, array('options'=>array('min_range'=>1)));
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT, array('options'=>array('min_range'=>0)));
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

//If the item is being edited set picture has to be preserved 
// unless new picture is set
if(isset($_POST["setPicture"]) && $_POST["setPicture"] != ""){
	//edit clause
	if ($_FILES["picture"]["error"] == 0){
		//new file has been set
		$imgName = validateAndSavePicture();
	}else{
		//file input has been left out
		$imgName = $_POST["setPicture"];
	}
}else{
	//create new product clause
	$imgName = validateAndSavePicture();

}
//setting default values in case they are not set
if(!$quantity) $quantity = 0;
if(!$price) $price = 0;
//Connecting to server and iserting data ONLY if valid input
if($name && $category && $imgName){
	$mysqli = connect("localhost","root","","shop");

	if(isset($_GET['id'])){
		$sqlQuery = sprintf("UPDATE product SET name='%s', quantity='%s', price='%s', category='%s', description='%s', img='%s'
					WHERE id='%s'", 
					$name, $quantity, $price, $category, $description, $imgName, $_GET['id']);
		}else{
			$sqlQuery = sprintf("INSERT INTO product (name, quantity, price, category, description, img) 
					VALUES ('%s', '%s', '%s', '%s', '%s', '%s')", 
					$name, $quantity, $price, $category, $description, $imgName);
			}	

	echoQuery($sqlQuery, "Data inserted.", $mysqli);
	header("Location: list.php");
}else{
	echo "Invalid input, data could not be inserted.";

}
echo '<a href="list.php"> Back to list</a>';

?>