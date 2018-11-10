<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set ('display_errors' , 1);
include ('extra.php');

$Qname = $_GET["qname"]; 
$body = $_GET["body"];
$skills = $_GET["skills"]; 
$flag = false;

if (empty($Qname)){echo "<br><b>ERROR: Name is empty <br></b>"; $flag = true;}

else if (strlen($Qname)<3){echo "<b>ERROR: Name must be at least 3 characters</b><br>"; $flag = true;}

else {echo "<b>Question Name:</b> is $Qname <br>";}

if (empty($body)){ echo "<br><b>ERROR: Question Body is empty <br></b>";}

else if (strlen($body)>500){echo "<b>ERROR: Body limit is 500 characters</b><br>"; $flag = true;}

else { echo "<b>Question Body:</b> $body <br>";}

$skills_arr = explode(",",$skills);

if (sizeof($skills_arr)<2){ echo"<br><b>ERROR: Enter at least two skills<br></b>"; $flag = true;} 

else {
	echo "<b>Skills:</b><br>";
	print_r($skills_arr);
}

implode(",",$skills_arr);

if (!$flag){
	session_start();
	$email = $_SESSION["email"];
	$id = $_SESSION["id"];

	try {
		$conn = new PDO("mysql:host=$servername;dbname=bsg23", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "<br>Connected successfully <br>"; 
		$stmt = $conn->prepare("INSERT INTO questions (owneremail, ownerid, createddate, title,body, skills) VALUES ('$email', '$id', NOW(), '$Qname','$body','$skills') ");
		$stmt->execute();
	}

	catch (PDOException $e){
		echo "<br> connection failed: ". $e->getMessage();
	}

	header ("refresh:3; url=display.php");
	$conn = null;
}

?>