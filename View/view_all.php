<?php

include ('header.php');?>

<body>
	<div class="container-contact-form-btn">

			<a href="?action=logout">Log out </a>

		</div>

	<div class="container-contact">
		
		<div class="wrap-contact">
			<div class="container-contact-form-btn">
				<form action="index.php" method="post">
					<input type="hidden" name="action"
                           value="display">
				<button class="contact-form-btn">Questions</button>
				</form>
		&nbsp;&nbsp;&nbsp;
				<form action="index.php" method="post">
                    <input type="hidden" name="action"
                           value="view_all">
					<button class="contact-form-btn"> All Question
					</button>
				</form>
			</div>

		<br><br>

			<div class="contact-form-title">
				All questions
			</div>

			<table>

			<tr class="title">

				<th>Question id</th><th>Owner</th>
				<th>Owner ID</th><th>Date Created</th>
				<th>Title</th><th>Body</th><th>Skills</th><th>Score</th>
				<th>&nbsp;</th><th>&nbsp;</th>

			</tr>

			<?php foreach($questions as $question) {?>
			<tr>
				<?php echo $question->displayQuestionRow(); ?>
			
			
			<td><form action="index.php" method="post">
                    <input type="hidden" name="action"
                           value="view_question">
                    <input type="hidden" name="question_id"
                           value="<?php echo $question->getId(); ?>">
                    <button type="submit">View</button>
                </form></td></tr>
			<?php }?>
			</table>
		<br>
			
		</div>
	</div>
</body>
</html>
