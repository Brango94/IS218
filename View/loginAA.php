<?php include ('header.php');?>

	<div class="container-contact">

		<div class="wrap-contact">
			
			<form class="contact-form validate-form" action="index.php" method="get">

				<input type="hidden" name="action" value="login_user">
				<span class="contact-form-title">
					Login
				</span>

				<div class="wrap-input validate-input" data-validate="Please enter your name">
					<input class="input" type="text" name="email" placeholder="Email">
					<span class="focus-input100"></span>
				</div>


				<div class="wrap-input validate-input" data-validate = "Please enter password">
					<input class="input" type="text" name="pass" placeholder="Password">
					<span class="focus-input"></span>
				</div>

				<div class="container-contact-form-btn">
					<button class="contact-form-btn"> Log in
					</button>
				</div>
			</form>
			
				<div class="container-contact-form-btn">
					<a href="?action=sign_up">Sign up	
					</a>
				</div>
			</form>
		</div>
	</div>
</body>
