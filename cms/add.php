<!DOCTYPE html>
<?php
	require_once "../lib/myFunctions.php";
	
	//for arguments in editing
	$selectedName="";
	$selectedQuantity="";
	$selectedPrice="";
	$selectedCategory="";
	$selectedDescription="";
	$selectedPicture = null;
	

	//ID is selected in case of editing
	$selectedId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	
	if($selectedId){
		$result = getProductById($selectedId);
	
		if($result){
			$row = $result ->fetch_assoc();
			$selectedName=$row['name'];
			$selectedQuantity=$row['quantity'];
			$selectedPrice=$row['price'];
			$selectedCategory=$row['category'];
			$selectedDescription=$row['description'];
			$selectedPicture=$row['img'];
		}
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Add a product</title>
	<link rel="stylesheet" href="../css/default.css" type="text/css"/>
	<script type="text/javascript" src="../lib/javascript/myFunctions.js"></script>
</head>

<body>
	<?php 
		echo showCmsMenu();
		
	?>

	<form  method="post" action= "<?php echo ($selectedId ? "added.php?id=$selectedId" : "added.php"); ?>"
			enctype="multipart/form-data">
		<div>
			<label for="name"> Name: 
			</label>
			<input type ="text" name="name" required placeholder="Name of the product" autofocus value="<?php echo $selectedName; ?>" >
		</div>
		<div>
			<label for ="quantity"> Quantity:
			</label>
			<input type ="number" size="6" name="quantity" required pattern="\d+"  value="<?php echo ($selectedId ? $selectedQuantity : "1"); ?>">
		</div>
		<div>
			<label for ="price"> Price:
			</label>
			<input type ="number" size="6" name="price" min="0" required  step="any" value="<?php echo ($selectedId ? $selectedPrice : "0"); ?>">
		</div>
		
		<div>
			<label for="category"> Category:
			</label>
			<select name="category">
				<?php

					$result = getCategories();
					while($row = $result->fetch_object()){
						$category = $row->name;
						//for editing 
						if($selectedCategory === $category){
							echo "<option value=\"$category\" selected > $category </option> ";
						}else{
							echo "<option value=\"$category\" > $category </option>";
						}
					}
					
				?>
			</select>
			<a href="manageCategories.php"> Manage categories (Add, Delete) </a>
		</div>

		<div>
			<label for="description"> Description:
			</label>
			<textarea name="description" rows="4" cols="50" maxlength="300">
				<?php echo $selectedDescription; ?>
			</textarea>
		</div>			
		<div>
			<label for ="Picture">  <?php echo ($selectedId ? "Selected picture is: ". $selectedPicture : "Picture:"); ?>
			</label>
		
			<input type="file" name="picture" id="picture" accept="image/*">
			<input type="hidden" name="setPicture" value="<?php echo $selectedPicture; ?>">
		</div>
		<div>
			<input type="submit" value="<?php echo ($selectedId ? "Edit" : "Add"); ?>" >
			<input type="reset" value="Clear">
		</div>
 	</form>
</body>

</html>