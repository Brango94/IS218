<?php include("header.php");?>

	<div class="container-contact">

		<div class="wrap-contact">
			<form class="contact-form validate-form" action="index.php" method="post">

				<input type="hidden" name="action" value="edit_question">
				<input type="hidden" name="email" value="<?php echo $email;?>">
				<input type="hidden" name="id" value="<?php echo $id;?>">	

				<input type="hidden" name="question_id" value="<?php echo $question['id'];?>">	

				<span class="contact-form-title">
					Edit Question
				</span>

				<div class="wrap-input validate-input" data-validate="Enter question name">
					Name <input class="input" type="text" name="Qname" value="<?php echo $question['title'];?>">
					<span class="focus-input"></span>
				</div>

				<div class="wrap-input validate-input" data-validate="Enter question body">
					Body <input class="input" type="text" name="body" value="<?php echo $question['body'];?>">
					<span class="focus-input"></span>
				</div>

				<div class="wrap-input validate-input" data-validate = "Enter skills">
					Skills<input class="input" type="text" name="skills" value="<?php echo $question['skills'];?>">
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
