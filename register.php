<?php

$FName=$_POST["FName"];
$LName=$_POST["LName"];
$bday=$_POST["bday"];
$email=$_POST["email"];
$password=$_POST["password"];

if ($FName==""){
	echo "First name is empty<br>";
}

else {
	echo "Your first name is $FName<br>";
}

if ($LName==""){
	echo "Last name is empty<br>";
}

else {
	echo "Your last name is $LName<br>";
}

if ($bday==""){
	echo "Your birthday is empty<br>";
}

else {
	echo "Your birthday is $bday<br>";
}

if ($email==""){
    echo "Email is empty<br>";
}

elseif (!strpos($email,'@')){
    echo "Need to have '@'<br>";
}

else {
	echo "Your email is $email<br>";
}

if ($password==""){
    echo "Password is empty<br>";
}

elseif (strlen($password)<8){
    echo "Your password needs at least 8 characters<br>";
}

else {
	echo "Your password is $password<br>";
}

?>