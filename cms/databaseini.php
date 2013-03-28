<?php
require_once "../lib/myFunctions.php";

//Connecting to server
$mysqli = connect("localhost","root","","");
//Creating database
echoQuery("CREATE DATABASE IF NOT EXISTS shop","Database was successfully created or connected to.",$mysqli);

echoQuery("USE shop","Database selected.",$mysqli);

$sqlQuery = "CREATE TABLE IF NOT EXISTS product(
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(25),
	quantity INT(10),
	price INT(10),
	category varchar(25),
	description varchar(300)
	)";

echoQuery($sqlQuery, "Table product was successfully created.",$mysqli);

$sqlQuery = "CREATE TABLE IF NOT EXISTS category(
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(25)
	)";

echoQuery($sqlQuery, "Table category was successfully created.",$mysqli);

$sqlQuery = "CREATE TABLE IF NOT EXISTS product_order(
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	first_name varchar(25),
	last_name varchar(25),
	address varchar(100),
	email varchar(35),
	item_id INT(6),
	quantity INT(10),
	ordered_date DATE,
	processed boolean,
	processed_date DATE
	)";

echoQuery($sqlQuery, "Table product was successfully created.",$mysqli);

//inserting some data
//FOR TESTING PURPUSES ONLY
$sqlQuery = "INSERT INTO product (name, quantity, price, category, description) VALUES 
	('iphone', 25, 500, 'Phones', 'For cool people')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO product (name, quantity, price, category, description) VALUES 
	('nokia', 26, 300, 'Phones', 'Robust device')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO product (name, quantity, price, category, description) VALUES 
	('Chromebook', 10, 250, 'Computers', 'Doesnt have a hard drive.')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);
//$mysqli->close();

$sqlQuery = "INSERT INTO category (name) VALUES ('Phone')";

echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO category (name) VALUES ('Computers')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO category (name) VALUES ('Headphones')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);

//show data
$result = $mysqli->query("SELECT * FROM product");

echo showItems($result);

?>