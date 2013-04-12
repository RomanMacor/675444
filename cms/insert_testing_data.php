<?php
require_once "../lib/myFunctions.php";

//Connecting to server
$mysqli = connect();
//Creating database

//inserting some data
//for testing purposes
$sqlQuery = "INSERT INTO product (name, quantity, price, category, description, img) VALUES 
	('iphone', 25, 500, 'Phones', 'For cool people', 'iphone.jpg')";
$mysqli->query($sqlQuery);

echoQuery($sqlQuery, "Data inserted.", $mysqli);

$sqlQuery = "INSERT INTO product (name, quantity, price, category, description, img) VALUES 
	('nokia', 26, 300, 'Phones', 'Robust device', 'nokia.jpg')";
$mysqli->query($sqlQuery);

$sqlQuery = "INSERT INTO product (name, quantity, price, category, description, img) VALUES 
	('Chromebook', 10, 250, 'Computers', 'Doesnt have a hard drive.', 'chromebook.jpg')";
$mysqli->query($sqlQuery);

$sqlQuery = "INSERT INTO product (name, quantity, price, category, description, img) VALUES 
	('PH Pavilion', 15, 570.99, 'Computers', 
		'i7 - 3610QM Quad-Core, 3.30 GHz Turbo
		8 GB Memory, 1 TB Hard Drive
		Intel HD Graphic 4000
		17.3 HD LED (900p) Screen
		HD Webcam, HDMI, Usb 3.0 
		Beats Audio Sound System', 'hpNotebook.jpg')";
$mysqli->query($sqlQuery);

$sqlQuery = "INSERT INTO product (name, quantity, price, category, description, img) VALUES 
			('TDK SD 700', 5, 40.50, 'Headphones', ' A brand-new, unused, unopened and undamaged item in original retail packaging ',
			'tdkHeadphones.jpg')";
$mysqli->query($sqlQuery);

$sqlQuery = "INSERT INTO product (name, quantity, price, category, description, img) VALUES 
			('Sony MDR', 5, 25.50, 'Headphones', ' A brand-new, unused, unopened and undamaged item in original retail packaging ',
			'sonyHeadphones.jpg')";
$mysqli->query($sqlQuery);

//coping images
copy("../img/iphone.jpg", "../user_img/iphone.jpg");
copy("../img/nokia.jpg", "../user_img/nokia.jpg");
copy("../img/chromebook.jpg", "../user_img/chromebook.jpg");
copy("../img/hpNotebook.jpg", "../user_img/hpNotebook.jpg");
copy("../img/sonyHeadphones.jpg", "../user_img/sonyHeadphones.jpg");

//adding categories
$sqlQuery = "INSERT INTO category (name, img) VALUES ('Phones','phone.jpg')";
$mysqli->query($sqlQuery);

$sqlQuery = "INSERT INTO category (name, img) VALUES ('Computers','computer.jpg')";
$mysqli->query($sqlQuery);

$sqlQuery = "INSERT INTO category (name, img) VALUES ('Headphones','headphones.jpg')";
$mysqli->query($sqlQuery);


//insert product orders
$sqlQuery = "INSERT INTO product_order (first_name, last_name, address, email, item_id, quantity, ordered_date, processed, sum) VALUES
			 ('John', 'Smith', 'London, 356', 'john@gmail.com', 1, 3, '2013-03-30', false, 1500)";
$mysqli->query($sqlQuery);

$sqlQuery = "INSERT INTO product_order (first_name, last_name, address, email, item_id, quantity, ordered_date, processed, sum) VALUES
			 ('John', 'Smith', 'London, 356', 'john@gmail.com', 2, 4, '2013-03-30', false, 1200)";
$mysqli->query($sqlQuery);

$sqlQuery = "INSERT INTO product_order (first_name, last_name, address, email, item_id, 
				quantity, ordered_date, processed, processed_date, sum) VALUES
			 ('John', 'Smith', 'London, 356', 'john@gmail.com', 3, 3, '2013-03-22', true, '2013-03-23', 750)";
$mysqli->query($sqlQuery);

$sqlQuery = "INSERT INTO product_order (first_name, last_name, address, email, item_id, 
				quantity, ordered_date, processed, processed_date, sum) VALUES
			 ('John', 'Smith', 'London, 356', 'john@gmail.com', 1, 3, '2013-03-22', true, '2013-04-30', 1500)";
$mysqli->query($sqlQuery);
	

echo "The data has been succesfully inserted. </br>"; 
echo "<a href=index.php> Please proceed back to home page. </a>";
$mysqli->close();
?>

