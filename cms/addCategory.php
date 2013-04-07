<?php
//Recursive function keep changing the name until it's unique

require_once "../lib/myFunctions.php";

$categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

//validation
//SAVING FILE

$imgName = validateAndSavePicture();

  
if($categoryName){

	createcategory($categoryName, $imgName);

	header("Location: manageCategories.php");
}else{
	echo "Invalid input, data could not be inserted.";
}	

?>