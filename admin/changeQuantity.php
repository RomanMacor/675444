<?php
require_once "../lib/myFunctions.php";

//TO DO: validation
$id = $_POST['id'];
$quantity = $_POST['quantity'];

changeQuantity($id, $quantity);
?>