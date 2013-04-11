<?php
//setting global variable for items per page
$GLOBALS["itemsPerPage"] = 5;
/* 
Connects to database.
*/
//setting default values

function connect($server = "localhost", $username = "root", $password = "", $database = "shop")
{
	
	
	$mysqli = mysqli_connect($server, $username, $password, $database);
	if(mysqli_connect_errno($mysqli))
	{
		exit("Failed  to connect to database: (error message) ". mysqli_connect_error() ."<br/>");
	} else 
	{
		return $mysqli;
	}

}
/*
Executes query
This has become obsolete
*/
function echoQuery($query, $successString, $db)
{
	$result = $db->query($query);
	if ($result)
	{
		//echo $successString. "<br/>";
		return $result;
	}else
	{
		exit("Error: ". $db->error);
	}
}
// Fetches the product with specified ID
function getProductById($id)
{
	$db = connect("localhost","root","","shop");
	$result = $db->query("SELECT * FROM product WHERE id=$id");
	$db->close();
	return $result;
}

/*
Renders HTML table listing results for cms
Takes parameter result list
*/
function showItems($result, $page = 0)
{
	$pageMenu = pageMenu($page, "list.php");	
	
	$buildHTML = "<table border ='1' id=productList>";
	//table header
	$buildHTML .= "<tr> <th> <a href='list.php?orderBy=id'> ID </a> </th> <th> <a href='list.php?orderBy=name'> Name </a> </th> <th>
					 <a href='list.php?orderBy=quantity'> Quantity </a> </th> <th> <a href='list.php?orderBy=price'> Price </a> </th>
					 <th> <a href='list.php?orderBy=category'> Category </a> </th> <th>Description</th> <th>Picture</th></tr>";
	//data
	while($row = $result->fetch_object())
	{
		$buildHTML .= "<tr> <td> $row->id </td> <td> $row->name </td> <td> $row->quantity </td> <td> &pound$row->price </td> 
						<td> $row->category </td> <td> $row->description </td> <td>$row->img</td>";
		$buildHTML .= "<td> <a href='add.php?id=$row->id'> Edit </a> </td> <td> <a href='delete.php?id=$row->id'> Delete </a> </td>";
		$buildHTML .= " </tr>";
	}
	$buildHTML .= "</table> $pageMenu";
	return $buildHTML;
}
/*
Renders HTML table listing results for admin
Takes parameter result list
*/
function showItemsForAdmin($result, $page)
{
	$pageMenu = pageMenu($page, "list.php");

	$buildHTML = "<table border ='1' id=productList>";
	//table header
	$buildHTML .= "<tr> <th> <a href='list.php?orderBy=id'> ID </a> </th> <th> <a href='list.php?orderBy=name'> Name </a> </th> 
					<th> <a href='list.php?orderBy=price'> Price </a> </th> <th> <a href='list.php?orderBy=category'> Category </a> </th> 
					<th>Description</th> <th>Picture</th> <th> <a href='list.php?orderBy=quantity'> Quantity </a> </th> <th> New Quantity </th> </tr> ";
	//data
	while($row = $result->fetch_object())
	{
		$buildHTML .= "<tr> <td> $row->id </td> <td> $row->name </td> <td> &pound$row->price </td> 
						<td> $row->category </td> <td> $row->description </td> <td>$row->img</td> <td id=quantity$row->id> $row->quantity </td>";
		$buildHTML .= "<td> <input type=number id=newQuantity$row->id </td> <td> <button onclick=changeQuantity($row->id)> Change quantity</button></td>";
		$buildHTML .= " </tr>";
	}
	$buildHTML .= "</table> $pageMenu";
	return $buildHTML;
}
//generate pagination menu
function pageMenu($page = 0, $url)
{
	if($page < 1 ) return "";
	$itemsPerPage = $GLOBALS["itemsPerPage"];	

	//setting set parameters
	//sanitizing input
	$param = "";
	$searchString = filter_input(INPUT_GET, "searchString", FILTER_SANITIZE_STRING);
	//sanitizing input
	$category = filter_input(INPUT_GET, "category", FILTER_SANITIZE_STRING);
	//sanitizing input
	$orderBy = filter_input(INPUT_GET, "orderBy", FILTER_SANITIZE_STRING);

	if($searchString && $searchString != "") $param .= "searchString=$searchString&";
	if($category && $category != "") $param .= "category=$category&";
	if($orderBy && $orderBy != "") $param .= "orderBy=$orderBy&";

	$uri = $url."?".$param;

	$menu = "<div> Page number: $page </div><nav> ";
	

//previus only if it's not the first page
	 if ($page != 1) 
	 {
	 $previous = $page - 1;

	 $menu .= " <a href='$uri"."page=$previous'> <-Previous page</a> ";
	 }
	
	$next = $page + 1;

	$menu .= " <a href='$uri"."page=$next'>Next page-></a> ";

	$menu .= "</nav> ";


	if( $page < 1) $menu = "";
	return $menu;
}
/*
Renders HTML table listing results for client pages
Takes parameter result list
*/
function showItemsForCustomer($result, $page = 1)
{
	$pageMenu = pageMenu($page, "list.php");
	

	$buildHTML = "<ul > ";
	while($row = $result->fetch_object())
	{
		$id = $row->id;
		$name = $row->name;
		$price = $row->price;
		// $category = $row->category;
		// $description = $row->description;

		$buildHTML .= "<li class=product> <a href=detail.php?id=$id> <div> $name </div><img class=itemImage src=../user_img/$row->img alt=$row->name > </a>
		  				<div> Price: &pound$price <div/>  <button onclick=\"addToBasket($id)\"> Add to Basket </button>
		  				<input class=itemCount id=$id type=\"number\" value=1 /> </li>";
	}
	$buildHTML .= "</ul> $pageMenu";
	return $buildHTML;
}
/*
Renders HTML table listing cagories for client pages
Takes parameter result list
*/

function showCategories($result)
{
	$buildHTML = "<table border ='1'";
	$buildHTML .= "<tr> <th> <a href='list.php?orderBy=id'> ID </a> </th> <th> <a href='list.php?orderBy=name'> Name </a> </th> <th> Picture </th>";
	if($result)
	{
		while($row = $result->fetch_object())
		{
			$buildHTML .= "<tr> <td> $row->id </td> <td> $row->name </td> <td> $row->img </td> <td> <a href='deleteCategory.php?id=$row->id'> Delete </a> </td> </tr> ";
		}
		echo $buildHTML;
	}
}
/*
Renders navigation menu listing cagories for client pages
Takes parameter result list
*/
function showCategoriesMenu($caregories)
{
	$buildHTML = "<nav id=navigation> <ul>";

	//adding Category button
	$buildHTML .= "<li> <a href=index.php> Categories </a> </li>";

	//adding All category
	$buildHTML .= "<li> <a href=list.php> All </a> </li>";
	if($caregories)
	{
		while($row = $caregories->fetch_object())
		{
			
			$buildHTML .= "<li> <a href=list.php?category=$row->name> $row->name </a> </li>";
			
		}
		$buildHTML .= " </ul> </nav>";
		return $buildHTML;
	}
}
function showCategoriesPictures($caregories)
{
	$buildHTML = "<ul>";
	
	if($caregories)
	{
		while($row = $caregories->fetch_object()){
			
			$buildHTML .= "<li> <a href=list.php?category=$row->name> 
							 <h3> $row->name <h3>
							<img src=../user_img/$row->img height=100 width=100 alt=$row->name >
							</a> </li>";
			
		}
		$buildHTML .= "</ul>";
		return $buildHTML;
	}
}
//Renders basket items, returns total

function showBasketItems($basketString)
{
	$mysqli = connect("localhost","root","","shop");
	
	$basketObj = json_decode($basketString);
	
	
	$table = "<table> <tr><th>Name</th><th>Price</th><th>Quantity</th><th>Sum</th>";
	$total = 0;
	//Looping trough array of objects e.g. {"id"=5, "quantity"}
	foreach ($basketObj as $obj)
	{
		$query = "SELECT * FROM product WHERE id=$obj->id";

		$result = $mysqli->query($query);
		$table .= "<tr>";
		if($result)
		{
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
		echo "<p>Total is $total &pound</p>";
		
		$mysqli->close();	
		return $total;
}
	
/*
Renders items ordered by user
*/
function showOrders($result)
{
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
	
	while($row = $result->fetch_object())
	{
		$buildHTML .= "<tr id=$row->id> <td> $row->id </td> <td> $row->item_id </td> <td> $row->quantity </td> <td> $row->ordered_date </td> 
						<td> $row->first_name </td> <td> $row->last_name </td> <td> $row->address </td> <td> $row->email </td>";
		$buildHTML .= "<td> <button onclick=distribute($row->id)> Mark as Distributed </button> </td> ";
		$buildHTML .= "</tr>";
	}
	$buildHTML .= "</table>";
	return $buildHTML;
}
/*
Renders orders that has been marked as delivered 
*/
function showReport($result)
{
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
					 	<th> <a href='report.php?orderBy=sum'> Sum </a> </th>			 	
					 	</tr>";
	$total = 0;
	while($row = $result->fetch_object())
	{
		$total += $row->sum;
		$buildHTML .= "<tr> <td> $row->id </td> <td> $row->item_id </td> <td> $row->quantity </td> <td> $row->ordered_date </td> 
							<td> $row->processed_date </td> 
						<td> $row->first_name </td> <td> $row->last_name </td> <td> $row->address </td> <td> $row->email </td> <td> &pound$row->sum </td>";
		$buildHTML .= "<td> <a href='delete.php?id=$row->id'> Delete Record </a> </td> ";
		$buildHTML .= "</tr>";
	}
	$buildHTML .= "</table>";
	$buildHTML .= "<div> Total profit = &pound$total </div>";
	return $buildHTML;	
}


//	reduce quantity of product
// check if quantity is too low
	
function process($product_order, $warningLimit)
{
	$mysqli = connect();
	$itemId = $product_order->item_id;
	$query = "SELECT * FROM product WHERE id=$itemId"; 
	$result = $mysqli->query($query);
	$item = $result->fetch_object();
	if ($item === null)
	{
		return ("<div>Item id: $itemId doesn't exist in the database</div>
			<a href=../admin/manage_orders.php> Return to managing pages</a>");
	}

	$currentQuantity =  $item->quantity;
	
	// Storing name and id for report warning purpuses
	$id =  $item->id;
	$name = $item->name;

	$newQuantity = $currentQuantity - $product_order->quantity;
		
	$query = "UPDATE product_order SET  processed= true, processed_date = CURDATE() WHERE id=$product_order->id"; 
	$mysqli->query($query);

	$query = "UPDATE product SET  quantity= $newQuantity WHERE id=$product_order->item_id"; 
	$mysqli->query($query);
	$mysqli->close();
	//return warning if quality is lower than 10
	if($newQuantity < $warningLimit)
	{
		$warning = "The quantity of item $name (id = $id) is less than $warningLimit <br> quantity = $newQuantity </br>
					<a href=../admin/list.php> Please check the stock</a>"; 
		return $warning;
	}else
	{
		return "";
	}
	
}
/*
Changes the name of the file if such a file already exists
*/
function changeNameIfExists($name)
{
	if (file_exists("../user_img/" . $name))
	{
   		//RENAME
		$path = pathinfo($name);
    	 $filename  = $path['filename'];
		 $extension = $path['extension'];
		 $name       = $filename.'1.'.$extension;

       changeNameIfExists($name);
   }
   return $name;
}
//check if the picture is a valid format, if not returns the name of default pic
function validateAndSavePicture()
{
  if(!isset($_FILES["picture"]))
  {
    return "default.png";
  }
  if ($_FILES["picture"]["error"] > 0)
  {
    return "default.png";
  }
  if ($_FILES["picture"]["type"] == "image/jpng" ||
      $_FILES["picture"]["type"] == "image/gif" ||
      $_FILES["picture"]["type"] == "image/jpeg" ||
      $_FILES["picture"]["type"] == "image/jpg" ) 
  {
  
        $_FILES["picture"]["name"] = changeNameIfExists($_FILES["picture"]["name"]);
        move_uploaded_file($_FILES["picture"]["tmp_name"], "../user_img/" . $_FILES["picture"]["name"]);
        return $_FILES["picture"]["name"];
  }
}
//adds echo
function showItemDetail($result)
{

	$row = $result->fetch_object();
		$id = $row->id;
		$name = $row->name;
		$price = $row->price;
		$category = $row->category;
		$description = $row->description;

		$buildHTML = "  <h2> $name </h2>
						<img id=detailImage class=rightContent src=../user_img/$row->img alt=$row->name >
		  				<div> Price: &pound$price <div/>  
		  				<div> Description: $description <div/>  
		  				<button onclick=addToBasket($id)> Add to Basket </button>
		  				<input class=itemCount id=$id type=number value=1 />";
	
	
	return $buildHTML;
}
function changeQuantity($id, $quantity)
{
	$db = connect();
	$db->query("UPDATE product SET quantity=$quantity WHERE id=$id");
	$db->close();	
}
//Insert product order into database
// if processed date is not set, null is set in database
function createProductOrder($fName, $lName, $address, $email, $id, $quantity, $processed, $sum, $processed_date = "null")
{
	$mysqli = connect();
	$sqlQuery = "INSERT INTO product_order (first_name, last_name, address, email, item_id,
		 quantity, ordered_date, processed, sum, processed_date) VALUES 
			('$fName', '$lName', '$address', '$email', $id, $quantity, CURDATE(), $processed, $sum, $processed_date)";
	$mysqli->query($sqlQuery);
	$mysqli->close();
}
//Insert category into database
function createcategory($categoryName, $imgName)
{
	$mysqli = connect();
	$sqlQuery = ("INSERT INTO category (name, img) VALUES ('$categoryName','$imgName')");
	$mysqli->query($sqlQuery);
	$mysqli->close();
}
//fetch procducts that has selected category
function getProductsByCategory($category, $page=0, $orderBy="")
{	

	if($orderBy) $orderBy = " ORDER BY ". $orderBy; 
	//Pagination
	
	$itemsPerPage = $GLOBALS["itemsPerPage"];	

		
	$limit = ' limit ' .($page - 1) * $itemsPerPage .',' .$itemsPerPage; 	

	if($page < 1) $limit = "";

	$mysqli = connect();
	$sqlQuery = "SELECT * FROM product WHERE category= '$category'".$orderBy.$limit;

	$result = $mysqli->query($sqlQuery);
	$mysqli->close();
	return $result;
}
//fetch all products, if order by parameter is set, the result is ordered by this parameter


function getAllProducts($orderBy = "", $page=0)
{
	//Pagination
	
	$itemsPerPage = $GLOBALS["itemsPerPage"];	

	
	
	$limit = ' limit ' .($page - 1) * $itemsPerPage .',' .$itemsPerPage; 	
	
	if ($page < 1) $limit = "";

	$mysqli = connect();
	if($orderBy === "")
	{
		$sqlQuery = "SELECT * FROM product" .$limit;
	}else{
		$sqlQuery = "SELECT * FROM product ORDER BY $orderBy" .$limit;
	}
	
	$result = $mysqli->query($sqlQuery);
	$mysqli->close();
	return $result;
}
//Fetches all category if order by attribute is set, the result is ordered by this attribute
function getCategories($orderBy = "")
{
	$mysqli = connect();
	if($orderBy === "")
	{
		$sqlQuery = "SELECT * FROM category";
	}else{
		$sqlQuery = "SELECT * FROM category ORDER BY $orderBy";
	}
	
	$result = $mysqli->query($sqlQuery);
	$mysqli->close();
	return $result;
}
//fetch producst that encompass the searchString , has search in id (bool) flag
function getProductsBySearchString($searchString, $searchInId = false, $page=0, $orderBy="")
{
	if($orderBy) $orderBy = " ORDER BY ". $orderBy; 
	
	
	//Pagination
	
	$itemsPerPage = $GLOBALS["itemsPerPage"];	

		
	$limit = ' limit ' .($page - 1) * $itemsPerPage .',' .$itemsPerPage; 	

	if($page < 1) $limit = "";

	$mysqli = connect();
	if($searchInId)
	{
		$sqlQuery = "SELECT * FROM product WHERE (name like  '%$searchString%') OR
				 (description like  '%$searchString%') OR (category like  '%$searchString%') OR (id like  '%$searchString%')".$limit.$orderBy.$limit;	
	}else
	{
		$sqlQuery = "SELECT * FROM product WHERE (name like  '%$searchString%') OR
				 (description like  '%$searchString%') OR (category like  '%$searchString%')".$orderBy.$limit;	
	}
	
	$result = $mysqli->query($sqlQuery);
	$mysqli->close();
	return $result;
}
//deletes order with specified id
function deleteOrder($id)
{
	$mysqli = connect();
	$sqlQuery = "DELETE FROM product_order WHERE id= $id";
	$mysqli->query($sqlQuery);
	$mysqli->close();
}
//deletes product with specified id
function deleteProduct($id)
{
	$mysqli = connect();
	$sqlQuery = "DELETE FROM product WHERE id= $id";
	$mysqli->query($sqlQuery);
	$mysqli->close();
}
//deletes category with specified id
function deleteCategory($id)
{
	$mysqli = connect();
	$sqlQuery = "DELETE FROM category WHERE id= $id";
	$mysqli->query($sqlQuery);
	$mysqli->close();
}

//fetches order with specified id
function getOrderById($id){

	$mysqli = connect();
	$sqlQuery = "SELECT * FROM product_order WHERE id=$id";	
	$result = $mysqli->query($sqlQuery);
	$mysqli->close();
	return $result;
}
function getAllOrders($orderBy = "")
{
	$mysqli = connect();
	if($orderBy === "")
	{
		$sqlQuery = "SELECT * FROM product_order WHERE processed=false";
	}else{
		$sqlQuery = "SELECT * FROM product_order WHERE processed=false ORDER BY $orderBy";
	}

	$result = $mysqli->query($sqlQuery);
	$mysqli->close();
	return $result;
}
function getAllReports($limit, $orderBy = "")
{
	$mysqli = connect();
	if($orderBy === "")
	{
		$sqlQuery = "SELECT * FROM product_order WHERE processed=true". $limit;
	}else{
		$sqlQuery = "SELECT * FROM product_order WHERE processed=true".$limit. " ORDER BY $orderBy";
	}

	$result = $mysqli->query($sqlQuery);
	$mysqli->close();
	return $result;
}
//Update product in database
function editProduct($id, $name, $quantity, $price, $category, $description, $imgName)
{
	$mysqli = connect();
	//using sprintf to mix it up
	$sqlQuery = sprintf("UPDATE product SET name='%s', quantity='%s', price='%s', category='%s', description='%s', img='%s'
					WHERE id='%s'", 
					$name, $quantity, $price, $category, $description, $imgName, $id);
	$mysqli->query($sqlQuery);
	$mysqli->close();
}
//Create product in database
function createProduct($name, $quantity, $price, $category, $description, $imgName)
{	
	$mysqli = connect();
	//using sprintf to mix it up
	$sqlQuery = sprintf("INSERT INTO product (name, quantity, price, category, description, img) 
					VALUES ('%s', '%s', '%s', '%s', '%s', '%s')", 
					$name, $quantity, $price, $category, $description, $imgName);
	$mysqli->query($sqlQuery);
	$mysqli->close();
}
function dropDatabase()
{
	$mysqli = connect();

	$sqlQuery = "DROP DATABASE shop";
	$mysqli->query($sqlQuery);
	$mysqli->close();	
}
function isDatabaseReady()
{
	$mysqli = connect("localhost","root","","");

	if($mysqli->query("USE shop")){
		$result = $mysqli->query("show tables like 'product'");
		
		if($result->num_rows > 0){ 
			//echo "Database is ready. <br/>";
			return true;
		} else{
			echo "Database hase been created.";
			//creating database;
			//include('databaseini.php');
			return false;
		}
	}else{
		echo "Database hase been created.";
		//creating database;
		//include('databaseini.php');
		return false;
	}
}
function setStyle($style)
{
	$filePath = "../css_options/".$style.".css";
	if (!copy($filePath, "../css/default.css")) {
		echo "File could not be copy";
	}
	
}
?>
