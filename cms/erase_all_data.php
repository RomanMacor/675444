<?php
$mysqli =  mysqli_connect("localhost","root","","");
//Creating database
$mysqli->query("DROP DATABASE shop");

echo "The data has been succesfully destroyed. </br>"; 
echo "<a href=index.php> Please proceed back to home page. </a>";
$mysqli->close();

?>