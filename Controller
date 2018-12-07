<?php 
require('../model/database.php');
require('../model/questions_db.php');
require('../model/accounts_db.php');
$action=filter_input(INPUT_POST,'action');
$email= filter_input(INPUT_GET,"email");
if(isset($email)){
	$pass= filter_input(INPUT_GET,"pass");
	$action='display';
}
$id=filter_input(INPUT_GET,"owner_id"); 
if($action==NULL){
	$action=filter_input(INPUT_GET,'action');
	if($action==NULL){
		$action='login';
	}
}

if($action=='login'){
	include('../view/loginAA.php');
}
else if($action=='login_user'){
	$email= filter_input(INPUT_GET,"email"); 
	$pass= filter_input(INPUT_GET,"pass");
	if (empty($email)){ 
		$error= "<b> email is empty</b>"; include('../view/error.php'); }
	else if(!strpos($email,'@')) { 
		$error= "<br> no @ <br>"; include('../view/error.php'); }
	if (empty($pass)){ 
		$error= "<b><br> Password is empty <br></b>"; include('../view/error.php');
		 }
	else if(strlen($pass)<8 ){ 
		$error= "<b> Password must be at least 8 characters</b><br>" ; include('../view/error.php'); }
	
	$row=get_user($email,$pass);
	$id=$row['id'];
	global $id,$email;
	if(! $row ){
		$error="Can't authenticate!";
		include('../view/error.php');
	}
	else{	
		$fname=$row['fname'];
		$lname=$row['lname'];
		$questions=get_user_questions($email);
		include('../view/displayAA.php');
	}
}

else if($action=='sign_up'){
	include('../view/registerAA.php');
}
else if ($action=='new_user'){
	$first= filter_input(INPUT_POST,"first"); 
	$last= filter_input(INPUT_POST,"last"); 
	$bday= filter_input(INPUT_POST,"bday"); 
	$email= filter_input(INPUT_POST,"email"); 
	$pass= filter_input(INPUT_POST,"pass"); 
	$arr=array('First name'=>$first,
			'Last name'=>$last,
			'Birthday'=>$bday,
			'Email'=>$email,
			'Password'=>$pass);
	foreach($arr as $key => $value){
		if ( empty($value)){ 
			$error= "<br>$key is empty<br></b>"; include('../view/error.php'); }
		else if ($key=='Email' && !strpos($value,'@') ){ 
			$error= "<br>No @ in $key<br>"; include('../view/error.php'); }
		else if($key=="Password" && strlen($value)<8 ){
			$error= "<br> $key must be at least 8 characters<br>"; include('../view/error.php'); }
	}
	create_user($email,$first,$last,$bday,$pass);
	echo "<h2> Account created! </h2> <br> redirecting ...";
	
	header("Location: ?action=display&email=$email&pass=$pass");
}

else if($action=='display'){
	$email= filter_input(INPUT_GET,"email"); 
	$pass= filter_input(INPUT_GET,"pass");
	$row=get_user($email,$pass);
	$id=$row['id'];
	
	
		$fname=$row['fname'];
		$lname=$row['lname'];
		$questions=get_user_questions($email);
		include('../view/display.php');
	
}

else if ($action=='show_question_form'){
	$email= filter_input(INPUT_GET,"owner_email"); 
	$id=filter_input(INPUT_GET,"owner_id"); 
	global $email,$id;
	
	include('../view/create_question.php');
}
else if ($action=='create_question'){
	$Qname= filter_input(INPUT_POST,"Qname"); 
	$body= filter_input(INPUT_POST,"body"); 
	$skills= filter_input(INPUT_POST,"skills"); 
	$email= filter_input(INPUT_POST,"email");
	$id=filter_input(INPUT_POST,"id"); 
	$questions=get_user_questions($email);
	
	
	if (empty($Qname)){echo "<br><b>ERROR: Question name is empty <br></b>";}
	else if(strlen($Qname)<3 ){echo "<b>ERROR: Name must be at least 3 characters</b><br>";}
	if (empty($body)){ echo "<br><b>ERROR: Body is empty <br></b>";}
	else if(strlen($body)>500 ){echo "<b>ERROR: Body limit is 500 characters</b><br>";}
	$skills_arr=explode(",",$skills);
	if (sizeof($skills_arr)<2){ echo"<br><b>ERROR: Enter at least two skills<br></b>";} 
	
	implode(",",$skills_arr);
	new_question($email,$id,$Qname,$body,$skills);
	include('../view/display.php');
	
}

if ($action=='delete_question'){
	$question_id= filter_input(INPUT_POST,"question_id"); 
	delete_question($question_id);
	echo"deleted";
	header("Location: ?action=display&email=$email&pass=$pass");
}
if ($action=='edit_question'){ //changes it
	$Qname= filter_input(INPUT_POST,"Qname"); 
	$body= filter_input(INPUT_POST,"body"); 
	$skills= filter_input(INPUT_POST,"skills"); 
	$question_id= filter_input(INPUT_POST,"question_id"); 
	edit_question($Qname,$body,$skills,$question_id);
	
	header("Location: ?action=display&email=$email&pass=$pass");
}
if ($action=='show_edit_question'){ //to form
	$question_id= filter_input(INPUT_POST,"question_id"); 
	$question= get_question($question_id);
	
	include('../view/question_edit.php');
}
?>

