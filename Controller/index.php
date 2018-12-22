<?php 

require_once('../model/database.php');
require_once('../model/questions_db.php');
require_once('../model/accounts_db.php');
require_once('../model/answers_db.php');
session_start(); 
$action=filter_input(INPUT_POST,'action');

if($action==NULL){
	
	$action=filter_input(INPUT_GET,'action');
	if($action==NULL){ 
		
		$action='login';
	}
}
if($action=='login'){

	if ( $_SESSION['logged']==True){
		header("Location ?action=login_user");
	}
	else{
		include('../view/loginAA.php');
	}
	
}
else if($action=='login_user'){

	$email= filter_input(INPUT_GET,"email"); 
	$pass= filter_input(INPUT_GET,"pass");
	if($email ==NULL ||$pass==NULL){
		$email=$_SESSION["email"];
		$pass=$_SESSION["pass"];
	}
	else if (empty($email)){ 
		$error= "<b> email is empty</b>"; include('../view/error.php'); }
	else if(!strpos($email,'@')) { 
		$error= "<br> no @ <br>"; include('../view/error.php'); }
	if (empty($pass)){ 
		$error= "<b><br> Password is empty <br></b>"; include('../view/error.php');
		 }
	else if(strlen($pass)<8 ){ 
		$error= "<b> Password must be at least 8 characters</b><br>" ; include('../view/error.php'); }
	
	$array=UsersDB::get_user($email,$pass);
	//$id=$row['id'];
	if(! $array ){

		$error="Can't authenticate!";
		include('../view/error.php');
	}
	else{

		$user=$array[0];
		$id=$array[0]->getId();
		$fname=$array[0]->getFname();
		$lname=$array[0]->getLname();
		session_start();
		$_SESSION['email']=$email;
		$_SESSION['id']= $id;
		$_SESSION['name']=$fname." ".$lname;
		$_SESSION['logged']=True;
		$questions=QuestionsDB::get_user_questions($email); //questions[each]
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
	$row=get_user($email,$pass);
	$id=$row['id'];
	
	
	header("Location: ?action=login_user&email=$email&pass=$pass");
	
}
else if($action=='display'){
	$email= $_SESSION['email']; 
	
	if ( $_SESSION['logged']==True){
		//echo $email;
		$questions=QuestionsDB::get_user_questions($email); //questions[each]
		include('../view/displayAA.php');
	}
	else{
		header("Location ?action=login");
	}
	
}
else if($action=='view_all'){
	$questions=QuestionsDB::get_all_q();
	include('../view/view_all.php');
}
else if ($action=='show_question_form'){
	
	include('../view/create_question.php');
}
else if ($action=='create_question'){
	if ( $_SESSION['logged']){
		$Qname= filter_input(INPUT_POST,"Qname"); 
		$body= filter_input(INPUT_POST,"body"); 
		$skills= filter_input(INPUT_POST,"skills"); 
	
		if (empty($Qname)){echo "<br><b>ERROR: Question name is empty <br></b>";}
		else if(strlen($Qname)<3 ){echo "<b>ERROR: Name must be at least 3 characters</b><br>";}
		if (empty($body)){ echo "<br><b>ERROR: Body is empty <br></b>";}
		else if(strlen($body)>500 ){echo "<b>ERROR: Body limit is 500 characters</b><br>";}
		$skills_arr=explode(",",$skills);
		if (sizeof($skills_arr)<2){ echo"<br><b>ERROR: Enter at least two skills<br></b>";} 
	
		implode(",",$skills_arr);
		$email= $_SESSION['email'];
		$id= $_SESSION['id'];
	
		QuestionsDB::new_question($email,$id,$Qname,$body,$skills); 
		header("Location: ?action=display");
	}else{
		header("Location: ?action=login");
	}
}
if ($action=='view_question'){
	$question_id= filter_input(INPUT_POST,"question_id");
	$_SESSION['q_id']=$question_id;
	if ( $_SESSION['logged']){
		$email=$_SESSION['email'];
		$quest=QuestionsDB::get_question($question_id);
		$q_obj=$quest[0];
		$ans=AnswersDB::get_answers_from($question_id); 
		
		include('../view/view_question.php');
	}
	else{
		header("Location: ?action=login");
	}
}
if ($action=='delete_question'){
	$question_id= filter_input(INPUT_POST,"question_id"); 
	if ( $_SESSION['logged']){
		$email=$_SESSION['email'];
		QuestionsDB::delete_question($question_id);
		header("Location: ?action=display");
	}
	else{
		header("Location: ?action=login");
	}
}
if ($action=='edit_question'){ //changes it

	if ( $_SESSION['logged']){

		$Qname= filter_input(INPUT_POST,"Qname"); 
		$body= filter_input(INPUT_POST,"body"); 
		$skills= filter_input(INPUT_POST,"skills"); 
		$email= filter_input(INPUT_POST,"email");
		$question_id= filter_input(INPUT_POST,"question_id"); 
		QuestionsDB::edit_question($Qname,$body,$skills,$question_id);
	
		header("Location: ?action=display");
	}
	else{
		header("Location: ?action=login");
	}
}
if ($action=='show_edit_question'){ //to form
	if ( $_SESSION['logged']){
		$question_id= filter_input(INPUT_POST,"question_id"); 
	
		$to_edit=QuestionsDB::get_question($question_id);
		$q_obj=$to_edit[0];
	
		include('../view/question_edit.php');
	}
	else{
		header("Location: ?action=login");
	}
}
if($action=='create_ans'){
	$q_id=filter_input(INPUT_POST,"q_id");
	$_SESSION['q_id']=$q_id;
	include('../view/create_answer.php');
}
if($action=='add_ans'){
	$answer=filter_input(INPUT_POST,"answer");
	$q_id=$_SESSION['q_id'];
	$email=$_SESSION['email'];
	AnswersDB::create_ans($q_id,$email,$answer);
	header("Location: ?action=display");
}
if ($action=='up_ans'){
	$ans_id=filter_input(INPUT_POST,"ans_id");
	AnswersDB::up_ans($ans_id);
	$q_id=$_SESSION['q_id'];
	header("Location: ?action=display");
}
if ($action=='down_ans'){
	$ans_id=filter_input(INPUT_POST,"ans_id");
	AnswersDB::down_ans($ans_id);
	$q_id=$_SESSION['q_id'];
	
	header("Location: ?action=display");
}

if ($action=='logout'){
	
	$_SESSION=array(); 

	setcookie("PHPSESSID","",time()-3600,'/','web.njit.edu',0,0);
	session_destroy(); //kills server data on session 
	echo "<h2> You have been logged out...</h2> <br>";
	header("refresh:3; index.php");
}
?>
