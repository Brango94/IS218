<?php

class QuestionsDB 
	{
	    public static function get_all_q() 
	    {
	        $db = Database::database();
	        $query = 'SELECT * FROM questions';
	        $statement = $db->prepare($query);
	        $statement->execute();
	        
	        $questions = array();
	        foreach ($statement as $row)
	        {
	            $quest = new Questions($row['id'],$row['owneremail'],$row['ownerid'],$row['createddate'],$row['title'],$row['body'],$row['skills'],$row['score']);
	            $questions[] = $quest;
	        }
	        return $questions;
	    }
	    public static function get_user_questions($email){

	    	$db = Database::database();
			$stmt = $db->prepare("SELECT * FROM questions WHERE owneremail='$email' ");
			$stmt->execute();
			 $questions = array();
			foreach ($stmt as $row)
	        {
	            $quest = new Questions($row['id'],$row['owneremail'],$row['ownerid'],$row['createddate'],$row['title'],$row['body'],$row['skills'],$row['score']);
	            $questions[] = $quest;
	        }
			return $questions;
			
		}
	    public static function new_question($email,$id,$Qname,$body,$skills)
	    {

	    	$db = Database::database();
	    	$query = "INSERT INTO questions (owneremail,ownerid, createddate,title,body,skills) VALUES ('$email' ,'$id',NOW(),'$Qname','$body','$skills') ";
	    	$statement = $db->prepare ($query);
	    	$statement->execute();
	    	$statement->closeCursor();
		}
		public static function delete_question($question_id){

			$db = Database::database();
	    	$query = "DELETE FROM questions WHERE id='$question_id'";
			$statement = $db->prepare ($query);
	    	$statement->execute();
	    	$statement->closeCursor();
	    }
	    public static function get_question($question_id){

			$db = Database::database();
			$query = "SELECT * FROM questions WHERE  id='$question_id' ";
			$statement = $db->prepare ($query);
	    	$statement->execute();
	    	$toedit = array();
			foreach ($statement as $row)
	        {
	            $quest = new Questions($row['id'],$row['owneremail'],$row['ownerid'],$row['createddate'],$row['title'],$row['body'],$row['skills'],$row['score']);
	            $toedit[] = $quest;
	        }
			return $toedit;
		}
	    public static function edit_question($title,$body,$skills,$question_id){

	    	$db = Database::database();
			$query = "UPDATE questions SET
				title='$title',
				body ='$body', 
				skills= '$skills' 
				WHERE id='$question_id'
				";
			$statement = $db->prepare ($query);
	    	$statement->execute();
	    	$statement->closeCursor();
	    }
	}

class Questions

	{
		private $id;
		private $owneremail;
		private $ownerid;
		private $createddate;
		private $title;
		private $body;
		private $skills;
		public function __construct($Id, $ownerEmail, $ownerId, $createdDate, $Title, $Body, $Skills,$Score) 
		{
			$this->id = $Id;
	        $this->owneremail = $ownerEmail;
	        $this->ownerid = $ownerId;
	        $this->createddate = $createdDate;
	        $this->title = $Title;
	        $this->body = $Body;
	        $this->skills = $Skills;
	        $this->score=$Score;
    	}
		public function getId()
		{
			return $this->id;
		}
		
		public function getEmail()
		{
			return $this->owneremail;
		}
		public function getOwnerId()
		{
			return $this->ownerid;
		}
		public function getDate()
		{
			return $this->createddate;
		}
		
		public function getTitle()
		{
			return $this->title;
		}
				
		public function getBody()
		{
			return $this->body;
		}
		public function getSkills()
		{
			return $this->skills;
		}
		public function displayQuestionRow() {
			return "<td>$this->id</td>
				<td>$this->owneremail</td>
				<td>$this->ownerid</td>
				<td>$this->createddate </td>
				<td>$this->title</td>
				<td>$this->body</td>
				<td>$this->skills</td>
				<td>$this->score</td>";
	
		}
	}
?>
