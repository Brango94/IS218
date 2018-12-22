<?php 

include("header.php");

?>
	<div class="container-contact">

		<div class="wrap-contact">
			<form class="contact-form validate-form" action="index.php" method="post">

				<input type="hidden" name="action" value="add_ans">

				<input type="hidden" name="email" value="<?php echo $email;?>">
				<input type="hidden" name="id" value="<?php echo $id;?>">	

				<span class="contact-form-title">
					Enter Answer
				</span>

				<div class="wrap-input validate-input">
					<input class="input" type="text" name="answer" >
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
