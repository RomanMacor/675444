<?php
require_once "../lib/myFunctions.php";
?>
<form method="post" action="addCategory.php">
	<input type="text" name="categoryName" placeholder="Name of the category" required> 
	<input type="submit" value="Add">
</form>

<?php
$mysqli = connect("localhost","root","","shop");

if (isset($_GET['orderBy'])){
	
	$sqlQuery = "SELECT * FROM category ORDER BY ". $_GET['orderBy'];
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
}else{

	$sqlQuery = "SELECT * FROM category";
	$result = echoQuery($sqlQuery, "Data retrieved.", $mysqli);
}
echo showCategories($result);


?>