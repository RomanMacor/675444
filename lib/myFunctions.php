<?php
/* 
Connects to database.
*/
function connect($server, $username, $password, $database){
	$mysqli = mysqli_connect($server, $username, $password, $database);
	if(mysqli_connect_errno($mysqli)){
		exit("Failed  to connect to database: (error message) ". mysqli_connect_error() ."<br/>");
	} else {
		return $mysqli;
	}

}
/*
Executes query
*/
function echoQuery($query, $successString, $db){
	$result = $db->query($query);
	if ($result){
		//echo $successString. "<br/>";
		return $result;
	}else{
		exit("Error: ". $db->error);
	}
}

function getItemById($id){
	return $db->query("SELECT * FROM products WHERE id=$id");
}
function getCategories($db){
	return $db->query("SELECT * FROM category");
}
/*
Renders HTML table listing results
*/
function showItems($result){
	$buildHTML = "<table border ='1' id=productList>";
	
	$buildHTML .= "<tr> <th> <a href='list.php?orderBy=id'> ID </a> </th> <th> <a href='list.php?orderBy=name'> Name </a> </th> <th>
					 <a href='list.php?orderBy=quantity'> Quantity </a> </th> <th> <a href='list.php?orderBy=price'> Price </a> </th>
					 <th> <a href='list.php?orderBy=category'> Category </a> </th> <th>Description</th> <th>Picture</th></tr>";
	
	while($row = $result->fetch_object()){
		$buildHTML .= "<tr> <td> $row->id </td> <td> $row->name </td> <td> $row->quantity </td> <td> $row->price </td> 
						<td> $row->category </td> <td> $row->description </td> <td>$row->img</td>";
		$buildHTML .= "<td> <a href='add.php?id=$row->id'> Edit </a> </td> <td> <a href='delete.php?id=$row->id'> Delete </a> </td>";
		$buildHTML .= " </tr>";
	}
	$buildHTML .= "</table>";
	return $buildHTML;
}
function showItemsForCustomer($result){
	$buildHTML = "<table border ='1' id=productList>";
	
	
	$buildHTML .= "<tr> <th>Name</th> <th>Price</th> <th>Category</th> <th>Description</th> <th>Picture</th></tr>";
	while($row = $result->fetch_object()){
		$id = $row->id;
		$name = $row->name;
		$price = $row->price;
		$category = $row->category;
		$description = $row->description;

		$buildHTML .= "<tr> <td> $name <td> $price </td> <td> $category </td> <td> $description </td> ";
		$buildHTML .= "<td> <img src=../img/$row->img height=50 width=50 alt=$row->name > </td> ";
		$buildHTML .= "<td> <button onclick=\"addToBasket($id)\"> Add to Basket </button> <input id=$id type=\"number\" value=1 size=3 /></td>";
		$buildHTML .= "</tr>";
	}
	$buildHTML .= "</table>";
	return $buildHTML;
}
function showCategories($result){
	$buildHTML = "<table border ='1'";
	$buildHTML .= "<tr> <th> <a href='list.php?orderBy=id'> ID </a> </th> <th> <a href='list.php?orderBy=name'> Name </a> </th> <th> Picture </th>";
	if($result){
		while($row = $result->fetch_object()){
			$buildHTML .= "<tr> <td> $row->id </td> <td> $row->name </td> <td> $row->img </td> <td> <a href='deleteCategory.php?id=$row->id'> Delete </a> </td> </tr> ";
		}
		echo $buildHTML;
	}
}
function showCategoriesMenu($nameOfCategories){
	$buildHTML = "";
	
	if($nameOfCategories){
		while($row = $nameOfCategories->fetch_object()){
			
			$buildHTML .= "<a href=list.php?category=$row->name> $row->name </a>";
			
		}
		return $buildHTML;
	}
}
function showCategoriesPictures($nameOfCategories){
	$buildHTML = "";
	
	if($nameOfCategories){
		while($row = $nameOfCategories->fetch_object()){
			
			$buildHTML .= "<a href=list.php?category=$row->name> <img src=../img/$row->img height=100 width=100 alt=$row->name ><br>  $row->name <br></a> ";
			
		}
		return $buildHTML;
	}
}
//creates a row in a table
//has to be surounded by table
function showBasketItems($basketString){
	$mysqli = connect("localhost","root","","shop");
	
	$basketObj = json_decode($basketString);
	
	
	$table = "<table> <tr><th>Name</th><th>Price</th><th>Quantity</th><th>Sum</th>";
	$total = 0;
	//Looping trough array of objects e.g. {"id"=5, "quantity"}
	foreach ($basketObj as $obj){
		$query = "SELECT * FROM product WHERE id=$obj->id";

		$result = $mysqli->query($query);
		$table .= "<tr>";
		if($result){
			$row = $result ->fetch_assoc();
			$sum = $obj->quantity * $row['price'];
			$total += $sum;
			//make name link
			$table .= "<td>". $row['name'] ."</td>";
			
			$table .= "<td>". $row['price'] ."</td>";
			$table .= "<td>". $obj->quantity ."</td>";
			$table .= "<td>". $sum ."</td>";

			$table .= "<td>". '<button onclick="removeItem('.$obj->id. ')">Remove</button>' ."</td>";

			$table .= "</tr>";
		}
	}
		$table .="</table>";
		echo $table;
		echo "<p>Total is $total</p>";
		
		$mysqli->close();	
}
	
	
function showOrders($result){
	$buildHTML = "<table border ='1'>";
	
	$buildHTML .= "<tr> <th> <a href='manage_orders.php?orderBy=id'> ID </a> </th> 
						<th> <a href='manage_orders.php?orderBy=item_id'> Item ID </a> </th> 
						<th> <a href='manage_orders.php?orderBy=quantity'> Quantity </a> </th> 
						<th> <a href='manage_orders.php?orderBy=ordered_date'> Ordered Date </a> </th>
					 	
					 	<th> <a href='manage_orders.php?orderBy=first_name'> Customer Name </a> </th>
					 	<th> <a href='manage_orders.php?orderBy=last_name'> Customer Last Name </a> </th>
					 	<th> <a href='manage_orders.php?orderBy=address'> Address </a> </th>
					 	<th> <a href='manage_orders.php?orderBy=email'> Email </a> </th>			 	
					 	";
	
	while($row = $result->fetch_object()){
		$buildHTML .= "<tr> <td> $row->id </td> <td> $row->item_id </td> <td> $row->quantity </td> <td> $row->ordered_date </td> 
						<td> $row->first_name </td> <td> $row->last_name </td> <td> $row->address </td> <td> $row->email </td>";
		$buildHTML .= "<td> <a href='distribute.php?id=$row->id'> Mark as distributed </a> </td> ";
		$buildHTML .= "</tr>";
	}
	$buildHTML .= "</table>";
	return $buildHTML;
}
function showReport($result){
	$buildHTML = "<table border ='1'>";
	
	$buildHTML .= "<tr> <th> <a href='report.php?orderBy=id'> ID </a> </th> 
						<th> <a href='report.php?orderBy=item_id'> Item ID </a> </th> 
						<th> <a href='report.php?orderBy=quantity'> Quantity </a> </th> 
						<th> <a href='report.php?orderBy=ordered_date'> Ordered Date </a> </th>
						<th> <a href='report.php?orderBy=ordered_date'> Processed Date </a> </th>
					 	
					 	<th> <a href='report.php?orderBy=first_name'> Customer Name </a> </th>
					 	<th> <a href='report.php?orderBy=last_name'> Customer Last Name </a> </th>
					 	<th> <a href='report.php?orderBy=address'> Address </a> </th>
					 	<th> <a href='report.php?orderBy=email'> Email </a> </th>			 	
					 	";
	
	while($row = $result->fetch_object()){
		$buildHTML .= "<tr> <td> $row->id </td> <td> $row->item_id </td> <td> $row->quantity </td> <td> $row->ordered_date </td> 
							<td> $row->processed_date </td> 
						<td> $row->first_name </td> <td> $row->last_name </td> <td> $row->address </td> <td> $row->email </td>";
		$buildHTML .= "<td> <a href='delete.php?id=$row->id'> Delete Record </a> </td> ";
		$buildHTML .= "</tr>";
	}
	$buildHTML .= "</table>";
	return $buildHTML;	
}

//erase!!
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

// Need info about the customer
function process($product_order){
	//	reduce quantity of product
	// check if quantity is too low
	
	$mysqli = connect("localhost","root","","shop");
	$query = "SELECT quantity FROM product WHERE id=$product_order->item_id"; 
	$result = $mysqli->query($query);
	$currentQuantity =  $result->fetch_object()->quantity;

	$newQuantity = $currentQuantity - $product_order->quantity;
	//need some constant
	if($newQuantity < 10){
		//TODO: check for low stock
	}
	
	$query = "UPDATE product_order SET  processed= true, processed_date = CURDATE() WHERE id=$product_order->id"; 
	$mysqli->query($query);

	$query = "UPDATE product SET  quantity= $newQuantity WHERE id=$product_order->item_id"; 
	$mysqli->query($query);
}
function changeNameIfExists($name){
	if (file_exists("../img/" . $name)){
   		//RENAME
    	 $filename  = pathinfo($name)['filename'];
		 $extension = pathinfo($name)['extension'];
		 $name       = $filename.'1.'.$extension;

       changeNameIfExists($name);
   }
   return $name;
}
//check if the picture is a valid format, if not returns the name of default pic
function validateAndSavePicture(){
  if(!isset($_FILES["picture"])){
    return "default.png";
  }
  if ($_FILES["picture"]["error"] > 0){
    return "default.png";
  }
  if ($_FILES["picture"]["type"] == "image/jpng" ||
      $_FILES["picture"]["type"] == "image/gif" ||
      $_FILES["picture"]["type"] == "image/jpeg" ||
      $_FILES["picture"]["type"] == "image/jpg" ) {
  
        $_FILES["picture"]["name"] = changeNameIfExists($_FILES["picture"]["name"]);
        move_uploaded_file($_FILES["picture"]["tmp_name"], "../img/" . $_FILES["picture"]["name"]);
        return $_FILES["picture"]["name"];
  }
}

?>