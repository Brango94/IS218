<?php 

include("header.php");

?>
	<div class="container-contact">

		<div class="wrap-contact">
			<form class="contact-form validate-form" action="index.php" method="post">

				<input type="hidden" name="action" value="create_question">

				<input type="hidden" name="email" value="<?php echo $email;?>">
				<input type="hidden" name="id" value="<?php echo $id;?>">	

				<span class="contact-form-title">
					Enter Question
				</span>

				<div class="wrap-input validate-input" data-validate="Enter question name">
					<input class="input" type="text" name="Qname" placeholder="Question Name">
					<span class="focus-input"></span>
				</div>

				<div class="wrap-input validate-input" data-validate="Enter question body">
					<input class="input" type="text" name="body" placeholder="Question Body">
					<span class="focus-input"></span>
				</div>

				<div class="wrap-input validate-input" data-validate = "Enter skills">
					<input class="input" type="text" name="skills" placeholder="Skills">
					<span class="focus-input"></span>
				</div>

				<div class="container-contact-form-btn">
					<button class="contact-form-btn"> Submit
					</button>
				</div>
			</form>
		</div>
	</div>

</body>
</html>
