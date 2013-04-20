<?php
require_once "../lib/myFunctions.php";

//Validation of input

$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, array('options'=>array('min_range'=>0)));
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_REGEXP,
	array("options"=>array("regexp"=>"/^[0-9]+(?:\.[0-9]{0,2})?$/")));
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
//if(!$price) $price = 0;
//Connecting to server and iserting data ONLY if valid input

if($name && $category && $imgName && $price && $name != "")
{
	$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
	
	if($id)
	{
		editProduct($id, $name, $quantity, $price, $category, $description, $imgName);
	}else
	{
		createProduct($name, $quantity, $price, $category, $description, $imgName);
	}	
	header("Location: list.php");
}else{
	echo "Invalid input, data could not be inserted.";

}
echo '<a href="add.php"> Back to "Add product"</a>';

?>