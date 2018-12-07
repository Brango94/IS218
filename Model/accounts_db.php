<?php
function get_user($email,$pass){
	global $conn;
	$stmt = $conn->prepare('SELECT * FROM accounts WHERE email=? AND password=?');
	$stmt->bindParam(1, $email, PDO::PARAM_INT);
	$stmt->bindParam(2, $pass, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $row;
}
function create_user($email,$first,$last,$bday,$pass){
	global $conn;
	$stmt = $conn->prepare("INSERT INTO accounts (email,fname,lname,birthday,password) 
			VALUES ('$email','$first','$last','$bday','$pass')");
	$stmt->execute();
}
?>
