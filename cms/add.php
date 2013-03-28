<!DOCTYPE html>
<?php
	require_once "../lib/myFunctions.php";
	
	//for arguments in editing
	$selectedName="";
	$selectedQuantity="";
	$selectedPrice="";
	$selectedCategory="";
	$selectedDescription="";

	//ID is selected in case of editing
	if(isset($_GET['id'])){
		$mysqli = connect("localhost","root","","shop");
		
		$selectedId= $_GET['id'];
		$query = "SELECT * FROM product WHERE id=$selectedId";
		$result = $mysqli->query($query);
		if($result){
			$row = $result ->fetch_assoc();
			$selectedName=$row['name'];
			$selectedQuantity=$row['quantity'];
			$selectedPrice=$row['price'];
			$selectedCategory=$row['category'];
			$selectedDescription=$row['description'];
		}else{
			echo "QUERY NOT SUCCESFUL:".$query;
		}
		$mysqli->close();
		
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Title of the document</title>
</head>

<body>
	<form  method="post" action= <?php echo isset($_GET['id']) ? "added.php?id=$selectedId" : "added.php"; ?> >
		<div>
			<label for="name"> Name: 
			</label>
			<input type ="text" name="name" required placeholder="Name of the product" autofocus value=<?php echo $selectedName; ?> >
		</div>
		<div>
			<label for ="quantity"> Quantity:
			</label>
			<input type ="number" size="6" name="quantity" min="1" required pattern="\d+"  value=<?php echo isset($_GET['id']) ? $selectedQuantity : "1"; ?>>
		</div>
		<div>
			<label for ="price"> Price:
			</label>
			<input type ="number" size="6" name="price" min="0" required pattern="\d+"  value=<?php echo isset($_GET['id']) ? $selectedPrice : "0"; ?>>
		</div>
		
		<div>
			<label for="category"> Category:
			</label>
			<select name="category">
				<?php
					$mysqli = connect("localhost","root","","shop");
					$result = getCategories($mysqli);
					while($row = $result->fetch_object()){
						$category = $row->name;
						//for editing 
						if($selectedCategory === $category){
							echo "<option value=$category selected > $category </option> ";
						}else{
							echo "<option value=$category > $category </option>";
						}
					}
					
				?>
			</select>
			<a href="manageCategories.php"> Manage categories (Add, Delete) </a>
		</div>

		<div>
			<label for="description"> Description:
			</label>
			<textarea name="description"  >
				<?php echo $selectedDescription; ?>
			</textarea>
		</div>			
		<div>
			<input type="submit" value=<?php echo isset($_GET['id']) ? "Edit" : "Add"; ?> >
			<input type="reset" value="Clear">
		</div>
 	</form>
</body>
<!-- quantity INT(10),
	category varchar(25),
	description -->
</html>