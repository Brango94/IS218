<?php include ('view/header.php');?>
<div class="container-contact">

		<div class="wrap-contact">
			<form class="contact-form validate-form" action="register.php">
				<span class="contact-form-title">
					New Account
				</span>

				<div class="wrap-input validate-input" data-validate="Please enter first name">
					<input class="input" type="text" name="first" placeholder="First Name">
					<span class="focus-input"></span>
				</div>

				<div class="wrap-input validate-input" data-validate="Please enter your name">
					<input class="input" type="text" name="last" placeholder="Last Name">
					<span class="focus-input"></span>
				</div>

				<div class="wrap-input validate-input" data-validate = "(YYYY-MM-DD)">
					<input class="input" type="text" name="bday" placeholder="Birthday: (YYYY-MM-DD)">
					<span class="focus-input"></span>
				</div>

				<div class="wrap-input validate-input" data-validate = "Email is required">
					<input class="input" type="text" name="email" placeholder="Email">
					<span class="focus-input"></span>
				</div>

				<div class="wrap-input validate-input" data-validate = "Please enter password">
					<input class="input" type="text" name="pass" placeholder="Password">
					<span class="focus-input"></span>
				</div>

				<div class="container-contact-form-btn">
					<button class="contact-form-btn"> Submit
					</button>
				</div>
			</form>
		</div>
	</div>

<?php
include ('extra.php');

$first = $_GET["first"]; 
$last = $_GET["last"];
$bday = $_GET["bday"]; 
$email = $_GET["email"];
$pass = $_GET["pass"];
$arr = array ('First name'=>$first,
	'Last name'=>$last,
	'Birthday'=>$bday,
	'Email'=>$email,
	'Password'=>$pass);

$flag=false;

foreach ($arr as $key => $value){
	if (empty($value)){ echo "<br><b>ERROR: $key is empty<br></b>"; $flag=true;}

	else if ($key=='Email' && !strpos($value,'@') ){ 
		echo"<br><b>ERROR: no @ in $key<br></b>"; $flag=true;}

	else if ($key=="Password" && strlen($value)<8 ){
		echo "<br><b>ERROR:$key must be at least 8 characters<br></b>";$flag=true;}

	else {
		echo "<br><b> $key </b>: $value<br>";}
}

if (!$flag){
	try{
		$conn = new PDO("mysql:host=$servername;dbname=bsg23", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "<br>Connected successfully <br>"; 
		$stmt = $conn->prepare("INSERT INTO accounts (email,fname,lname,birthday,password) 
			VALUES ('$email','$first','$last','$bday','$pass')");
		$stmt->execute();
		echo "<h2> Account created! </h2> <br> redirecting ...";
		session_start();
		$_SESSION['logged']=true;
		$_SESSION["email"]=$email;
		
		header("refresh:1; url=display.php");
	}

	catch (PDOException $e){
		echo "<br> connection failed: ". $e->getMessage();
	}

	$conn = null;
}

else {
	echo "<h2> Invalid input, please try again! </h2> <br> redirecting ...";
	header("refresh:1; url=register.html");
}

?>