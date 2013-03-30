<?php
require_once "../lib/myFunctions.php";

//Connecting to server
$mysqli = connect("localhost","root","","shop");
//Creating database

//inserting some data
//for testing purposes
$sqlQuery = "INSERT INTO product (name, quantity, price, category, description, img) VALUES 
	('iphone', 25, 500, 'Phones', 'For cool people', 'iphone.jpg')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO product (name, quantity, price, category, description, img) VALUES 
	('nokia', 26, 300, 'Phones', 'Robust device', 'nokia.jpg')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO product (name, quantity, price, category, description, img) VALUES 
	('Chromebook', 10, 250, 'Computers', 'Doesnt have a hard drive.', 'chromebook.jpg')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);


$sqlQuery = "INSERT INTO category (name, img) VALUES ('Phones','phone.jpg')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO category (name, img) VALUES ('Computers','computer.png')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);
$sqlQuery = "INSERT INTO category (name, img) VALUES ('Headphones','headphones.jpg')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);


//TODO: Also insert product orders
$sqlQuery = "INSERT INTO product_order (first_name, last_name, address, email, item_id, quantity, ordered_date, processed) VALUES
			 ('John', 'Smith', 'London, 356', 'john@gmail.com', 1, 3, '2013-03-30', false)";
echoQuery($sqlQuery, "Data inserted.", $mysqli);

$sqlQuery = "INSERT INTO product_order (first_name, last_name, address, email, item_id, quantity, ordered_date, processed) VALUES
			 ('John', 'Smith', 'London, 356', 'john@gmail.com', 2, 4, '2013-03-30', false)";
echoQuery($sqlQuery, "Data inserted.", $mysqli);

$sqlQuery = "INSERT INTO product_order (first_name, last_name, address, email, item_id, 
				quantity, ordered_date, processed, processed_date) VALUES
			 ('John', 'Smith', 'London, 356', 'john@gmail.com', 3, 3, '2013-03-22', true, '2013-03-23')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);

$sqlQuery = "INSERT INTO product_order (first_name, last_name, address, email, item_id, 
				quantity, ordered_date, processed, processed_date) VALUES
			 ('John', 'Smith', 'London, 356', 'john@gmail.com', 1, 3, '2013-03-22', true, '2013-04-30')";
echoQuery($sqlQuery, "Data inserted.", $mysqli);

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


echo "The data has been succesfully inserted. </br>"; 
echo "<a href=index.php> Please proceed back to home page. </a>";
$mysqli->close();
?>

