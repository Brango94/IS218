<?php include ('header.php');?>

	<div class="container-contact">

		<div class="wrap-contact">
			<form class="contact-form validate-form" action="index.php" method="post">
				<input type="hidden" name="action" value="new_user">
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

</body>
</html>
