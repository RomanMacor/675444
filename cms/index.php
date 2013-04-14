<?php
require_once "../lib/myFunctions.php";

//test if database and table exist, if not, it creates it
if (!isDatabaseReady())
{
	include('databaseini.php');	
}

include "list.php";
?>
