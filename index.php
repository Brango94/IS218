<?php 

require('../model/database.php');
require('../model/questions_db.php');
require('../model/accounts_db.php');
$action=filter_input(INPUT_POST,'action');
if($action==NULL){
	$action=filter_input(INPUT_GET,'action');
	if($action==NULL){
		$action='login';
	}
}
if($action=='login'){
	include('../view/loginAA.php');
}
if($action=='login_user'){
	session_start();
	$email= filter_input(INPUT_POST,"email"); 
	$pass= filter_input(INPUT_POST,"pass");
	$flag=false;
	if (empty($email)){ 
		$error= "<b> email is empty</b>"; include('../view/error.php');
		$flag=true ;}
	else if(!strpos($email,'@')) { 
		$error= "<br> no @ <br>"; include('../view/error.php');
		$flag=true;}
	if (empty($pass)){ 
		$error= "<b><br> Password is empty <br></b>"; include('../view/error.php');
		$flag=true; }
	else if(strlen($pass)<8 ){ 
		$error= "<b> Password must be at least 8 characters</b><br>" ; include('../view/error.php');
		$flag=true;}
	if (!$flag){
		$row=get_user($email,$pass);
		$id=$row['id'];
		if(! $row ){
			$error="Can't authenticate!";
			include('../view/error.php');
		}
		else{
			session_start();
			$_SESSION['logged']=true;
			$_SESSION["email"]=$email;
			$_SESSION['id']=$id;
			$_SESSION['fname']=$row['fname'];
			$_SESSION['lname']=$row['lname'];
			include('../view/display.php');
		}
	}
}
?>

