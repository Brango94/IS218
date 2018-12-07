<?php

	$servername= "sql1.njit.edu";
	$username="bsg23";
	$project="bsg23";
	$password= "Faly0aJZJ";
	
	try{
		$conn = new PDO("mysql:host=$servername;dbname=bsg23", $username, $password);
	}
	catch(PDOException $e){
		$error_message= $e->getMessage();
		include('db_error.php');
		exit();
	}
?>
