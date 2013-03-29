<?php
require_once "../lib/myFunctions.php";

//Connecting to server
$mysqli = connect("localhost","root","","shop");
//Creating database

//inserting some data
//for testing purposes
$sqlQuery = "INSERT INTO product (name, quantity, price, category, description) VALUES 
	('iphone', 25, 500, 'Phones', 'For cool people')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO product (name, quantity, price, category, description) VALUES 
	('nokia', 26, 300, 'Phones', 'Robust device')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO product (name, quantity, price, category, description) VALUES 
	('Chromebook', 10, 250, 'Computers', 'Doesnt have a hard drive.')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);


$sqlQuery = "INSERT INTO category (name) VALUES ('Phone')";

echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO category (name) VALUES ('Computers')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO category (name) VALUES ('Headphones')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);

echo "The data has been succesfully inserted. </br>"; 
echo "<a href=index.php> Please proceed back to home page. </a>";
$mysqli->close();
?>