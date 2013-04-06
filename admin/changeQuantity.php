<?php
require_once "../lib/myFunctions.php";

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$quantity = filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_INT);
if($id && $quantity){
	changeQuantity($id, $quantity);	
}else{
	echo "Id or Quantity invalid.";
}


?>