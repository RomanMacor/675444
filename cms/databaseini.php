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
	description varchar(300),
	img varchar(35)
	)";

echoQuery($sqlQuery, "Table product was successfully created.",$mysqli);

$sqlQuery = "CREATE TABLE IF NOT EXISTS category(
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(25),
	img varchar(35)
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

?>