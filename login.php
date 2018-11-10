<?php
include('extra.php');

$email= $_GET["email"]; 
$pass= $_GET["pass"];
$flag=false;

if (empty($email)){ 
	echo "<b>ERROR: email is empty</b>"; 
	$flag=true ;}

else if (!strpos($email,'@')) { 
	echo"<br><b> ERROR:</b> no @ <br>"; 
	$flag=true;}

else {
	echo "<br><b>Email: </b> $email <br>"; }

if (empty($pass)){ 
	echo "<b><br>ERROR: Password is empty <br></b>"; 
	$flag=true; }

else if (strlen($pass)<8 ){ 
	echo "<b><br>ERROR: Password must be at least 8 characters</b><br>" ; 
	$flag=true;}

else {
	echo "<br><b>Password: </b> $pass <br>"; }

if (!$flag){
	try {
		$conn = new PDO("mysql:host=$servername;dbname=bsg23", $username, $password);
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $conn->prepare('SELECT * FROM accounts WHERE email=? AND password=?');
		$stmt->bindParam(1, $email, PDO::PARAM_INT);
		$stmt->bindParam(2, $pass, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$id=$row['id'];

		if (!$row){
			header ("refresh:1; url=register.html" ); 
			die('<h2> Profile Not Found </h2>');
		}

		else {echo"<h2> Welcome </h2>";
			session_start();
			$_SESSION['logged']=true;
			$_SESSION["email"]=$email;
			$_SESSION['id']=$id;
			header("refresh:1; url=display.php");
		}
	}

	catch (PDOException $e){
		echo "<br> Failed Connection: ". $e->getMessage();
	}

	$conn = null;
}

?>