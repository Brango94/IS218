<?php

class AnswersDB 
	{
	    public static function get_all() 
	    {
	        $db = Database::database();
	        $query = 'SELECT * FROM answers';
	        $statement = $db->prepare($query);
	        $statement->execute();
	        
	        $ans = array();
	        foreach ($statement as $row)
	        {
	            $account = new Answer($row['id'],$row['question_id'],$row['owneremail'],$row['answer'],$row['email'],$row['score'],$row['date1']);
	            $ans[] = $account;
	        }
	        return $ans;
	    }
	    public static function get_answers_from($id){
	    	
	    	$db = Database::database();
			$stmt = $db->prepare("SELECT * FROM answers WHERE question_id='$id' ORDER BY score DESC  ");
			$stmt->execute();
			$ans = array();
	        foreach ($stmt as $row)
	        {
	            $account = new Answer($row['id'],$row['question_id'],$row['owneremail'],$row['answer'],$row['date1'],$row['score']);
	            $ans[] = $account;
	        }
	        return $ans;
			
		}
	    public static function create_ans($question_id,$owneremail,$ans)
	    {
	    	$db = Database::database();
	    	$query = "INSERT INTO answers (question_id,owneremail,answer,date1)  VALUES ('$question_id','$owneremail','$ans',NOW()) ";
	    	$statement = $db->prepare ($query);
	    	$statement->execute();
	    	$statement->closeCursor();
		}
		public static function up_ans($ans_id)
	    {
	    	$db = Database::database();
	    	$query = "UPDATE answers SET score=score+1 WHERE id='$ans_id'";
	    	$statement = $db->prepare ($query);
	    	$statement->execute();
	    	$statement->closeCursor();
	    }
	    public static function down_ans($ans_id)
	    {
	    	$db = Database::database();
	    	$query = "UPDATE answers SET score=score-1 WHERE id='$ans_id'";
	    	$statement = $db->prepare ($query);
	    	$statement->execute();
	    	$statement->closeCursor();
	    }
	}
	
class Answer
	{
		private $id;
		private $question_id;
		private $owneremail;
		private $answer;
		private $score;
		private $createddate;
		public function __construct($Id, $q_id,$ownerEmail, $Ans,$Date, $Sc) 
		{
	        $this->id = $Id;
	        $this->question_id = $q_id;
	        $this->owneremail=$ownerEmail;
	        $this->answer= $Ans;
	        $this->createddate=$Date;
	        $this->score = $Sc;
    	}
		public function getId()
		{
			return $this->id;
		}
		
		public function getQId()
		{
			return $this->question_id;
		}
		
		public function getOwner()
		{
			return $this->owneremail;
		}
		
		public function getAns()
		{
			return $this->answer;
		}
		public function getDate()
		{
			return $this->createddate;
		}
		public function getScore()
		{
			return $this->score;
		}
				
		public function displayAnsRow() {
			return "<td>$this->id</td>
				<td>$this->question_id</td>
				<td>$this->owneremail</td>
				
				<td>$this->answer</td>
				<td>$this->createddate</td>
				<td>$this->score</td>";
	
		}
	}
?>
