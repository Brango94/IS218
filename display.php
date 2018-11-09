<?php

include('extra.php');

session_start();

if (!isset($_SESSION['logged'])){
	echo"<br> Login First...<br><br>";
	header("refresh:3;url=login.html");
	exit();
}

$email=$_SESSION["email"];

// getting first name and last name
try{
	$conn = new PDO("mysql:host=$servername;dbname=bsg23", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query="SELECT * FROM accounts where email = '$email' ";
	$st=$conn->prepare($query);
	$st->execute();
	$questions=$st->fetchAll();
	$st->closeCursor();
	
}

catch (PDOException $e){
	echo "<br> connection failed: ". $e->getMessage();
}

foreach($questions as $questions) {

	$fname= $questions['fname'];
	$lname =$questions['lname'];
}


try{
	$conn = new PDO("mysql:host=$servername;dbname=bsg23", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query="SELECT * FROM questions where owneremail = '$email' ";
	$st=$conn->prepare($query);
	$st->execute();
	$questions=$st->fetchAll();
	$st->closeCursor();
	
}

catch (PDOException $e){
	echo "<br> connection failed: ". $e->getMessage();
}

$conn = null;

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<title>Display Questions</title>
</head>
<style>
table,td{
	border:1px black solid;
}
tr.title{
	font-weight:bold;
}
</style>
<body>
	
	<div class="container-contact">

		<div class="wrap-contact">
			<div class="contact-form-title">
				<?php echo "<b>Welcome $fname $lname </b> <br>"; ?>
			</div>
			<table>
			<tr class="title">
				<!-- <td>id</td><td>Email</td>
				<td>Owner ID</td><td>Date</td> -->
				<td>Title</td><td>Body</td><td>Skills</td><!-- <td>Score</td>
			</tr> -->

			<?php foreach($questions as $questions) {?>
			<tr>
				<!-- <td><?php echo $questions['id'];?></td>
				<td><?php echo $questions['owneremail'];?></td>
				<td><?php echo $questions['ownerid'];?></td>
				<td><?php echo $questions['createddate'];?></td> -->
				<td><?php echo $questions['title'];?></td>
				<td><?php echo $questions['body'];?></td>
				<td><?php echo $questions['skills'];?></td>
				<!-- <td><?php echo $questions['score'];?></td>
				 -->
			</tr>
			<?php }?>
			</table>
		<br>
			<div class="container-contact-form-btn">
				<a href="question.html">Create New Question</a>
			</div>
		</div>
	</div>
</body>
</html>