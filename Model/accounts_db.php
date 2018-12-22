<?php

function get_all(){
	global $conn;
	$query = 'SELECT * FROM accounts ORDER BY id';
	$statement = $db->prepare($query);
	$statement->execute();
	return $statement; 
}

class UsersDB 
	{
	    public static function get_all() 
	    {
	        $db = Database::database();
	        $query = 'SELECT * FROM accounts';
	        $statement = $db->prepare($query);
	        $statement->execute();
	        
	        $accounts = array();
	        foreach ($statement as $row)
	        {
	            $account = new User($row['email'],$row['fname'],$row['lname'],$row['birthday'],$row['password']);
	            $accounts[] = $account;
	        }
	        return $accounts;
	    }
	    public static function get_user($email,$pass){
	    	$db = Database::database();
			$stmt = $db->prepare("SELECT * FROM accounts WHERE email='$email' AND password='$pass' ");
			$stmt->execute();
			$acct = array();
			foreach ($stmt as $row)
	        {
	            $account = new User($row['id'],$row['email'],$row['fname'],$row['lname'],$row['birthday'],$row['password']);
	            $acct[] = $account;
	        }
			return $acct;
		
		}
	    public static function create_user($email,$first,$last,$bday,$pass)
	    {
	    	$db = Database::database();
	    	$query = "INSERT INTO accounts (email,fname,lname,birthday,password) VALUES ('$email','$first','$last','$bday','$pass') ";
	    	$statement = $db->prepare ($query);
	    	$statement->execute();
	    	$statement->closeCursor();
		}
	}
	
class User
	{
		private $id;
		private $email;
		private $fname;
		private $lname;
		private $bday;
		private $pass;
		public function __construct($Id, $Email, $Fname, $Lname, $Birthday, $Password) 
		{
	        $this->id = $Id;
	        $this->email = $Email;
	        $this->fname = $Fname;
	        $this->lname = $Lname;
	        $this->bday = $Birthday;
	        $this->pass = $Password;
    	}
		public function getId()
		{
			return $this->id;
		}
		
		public function getEmail()
		{
			return $this->email;
		}
		
		public function getFname()
		{
			return $this->fname;
		}
		
		public function getLname()
		{
			return $this->lname;
		}
				
		public function getBirthday()
		{
			return $this->bday;
		}
		public function getPass()
		{
			return $this->pass;
		}
		public function displayUserRow() {
			
			return "<td>$this->id</td>

				<td>$this->owneremail</td>
				<td>$this->fname</td>
				<td>$this->bday </td>
				<td>$this->lname</td>";
	
		}
	}
?>
