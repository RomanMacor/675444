<?php
//Recursive function keep changing the name until it's unique

require_once "../lib/myFunctions.php";

$categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

//TODO: validation is neccesery here
//SAVING FILE


  $imgName = validateAndSavePicture();

 	
 	if($categoryName){
		$mysqli = connect("localhost","root","","shop");

		$sqlQuery = ("INSERT INTO category (name, img) VALUES ('$categoryName','$imgName')");
					
		echoQuery($sqlQuery, "Data inserted.", $mysqli);

		header("Location: manageCategories.php");
	}else{
		echo "Invalid input, data could not be inserted.";
	}	
  


?>