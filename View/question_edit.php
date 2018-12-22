<?php include("header.php");?>

	<div class="container-contact">

		<div class="wrap-contact">
			
			<form class="contact-form validate-form" action="index.php" method="post">

				<input type="hidden" name="action" value="edit_question">	

				<input type="hidden" name="question_id" value="<?php echo $question_id  ;?>">	

				<span class="contact-form-title">
					Edit Question?
				</span>

				<div class="wrap-input validate-input" data-validate="Enter question name">
					Name <input class="input" type="text" name="Qname" value="<?php echo $q_obj->getTitle();?>">
					<span class="focus-input"></span>
				</div>

				<div class="wrap-input validate-input" data-validate="Enter question body">
					Body <input class="input" type="text" name="body" value="<?php echo $q_obj->getBody();?>">
					<span class="focus-input"></span>
				</div>

				<div class="wrap-input validate-input" data-validate = "Enter skills">
					Skills<input class="input" type="text" name="skills" value="<?php echo $q_obj->getSkills();?>">
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
