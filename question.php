<?php
include ('extra.php');

$Qname = $_GET["qname"]; 
$Qbody = $_GET["qbody"];
$Qskills = $_GET["qskills"]; 
$flag = false;

if (empty($Qname)){echo "<br><b>ERROR: No Name <br></b>"; $flag = true;}

else if (strlen($Qname)<3){echo "<b>ERROR: Your name should be at least 3 characters long</b><br>"; $flag = true;}

else {echo "<b>Question Name:</b> is $Qname <br>";}

if (empty($Qbody)){ echo "<br><b>ERROR: Question Body is empty <br></b>";}

else if (strlen($Qbody)>500){echo "<b>ERROR: Body limit is 500 characters</b><br>"; $flag = true;}

else { echo "<b>Question Body:</b> $body <br>";}

$skills_arr = explode(",",$Qskills);

if (sizeof($skills_arr)<2){ echo"<br><b>ERROR: Must have at least 2 skills<br></b>"; $flag = true;} 

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