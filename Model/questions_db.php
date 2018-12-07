<?php

function get_user_questions($email){
	global $conn;
	$query= " SELECT * FROM questions where owneremail ='$email' ";
	$st=$conn->prepare($query);
	$st->execute();
	$questions=$st->fetchAll();
	$st->closeCursor();
	return $questions;
}
function get_question($question_id){
	global $conn;
	$stmt = $conn->prepare("SELECT * FROM questions WHERE  id='$question_id' ");
	$stmt->execute();
	$question=$stmt->fetch();
	$stmt->closeCursor();
	return $question;
}
function new_question($email,$id,$Qname,$body,$skills){
	global $conn;
	$stmt = $conn->prepare("INSERT INTO questions (owneremail,ownerid, createddate,title,body,skills) VALUES ('$email' ,'$id',NOW(),'$Qname','$body','$skills') ");
	$stmt->execute();
}
function edit_question($title,$body,$skills,$question_id){
	global $conn;
	$stmt = $conn->prepare("UPDATE questions SET
		title='$title',
		body ='$body', 
		skills= '$skills' 
		WHERE id='$question_id'
		");
	$stmt->execute();
}
function delete_question($question_id){
	global $conn;
	$stmt = $conn->prepare("DELETE FROM questions WHERE id='$question_id'");
	$stmt->execute();
}
?>
