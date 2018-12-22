<?php include("header.php");?>

	<div class="container-contact">

		<div class="wrap-contact">

			<span class="contact-form-title">
					View Question
				</span>

			<form class="contact-form validate-form" action="index.php" method="post">

					<input type="hidden" name="action"
                           value="display">
					<div class="titles">Question <?php echo $q_obj->getId();?>:  <strong><?php echo $q_obj->getTitle();?></strong></div>
					
					<div class="input display"><?php echo $q_obj->getBody();?></div>
					<div class="titles">Date created: </div>
					<?php echo $q_obj->getDate();?>
					<div class="titles">Skills: </div>
					<div class="show"><?php echo $q_obj->getSkills();?></div>
		
				<div class="container-contact-form-btn">
					<button class="contact-form-btn"> Go back
					</button>
				</div>
<br><br><br>
			</form>
			<span class="contact-form-title">
					Answers
				</span>

			<form class="contact-form validate-form" action="index.php" method="post">
					<input type="hidden" name="action"
                           value="new_answer">

                    <?php foreach($ans as $ans) {?>
                    	<div class="answer">
				<div class="titles">Answer
						by: <?php echo $ans->getOwner();?>
					</div>
					
					<div class=" display"><?php echo $ans->getAns();?></div>
						
					<div class="titles">Date created: </div>
					<div class="show"><?php echo $ans->getDate();?></div>
					<div class="titles">Score: </div>
					<div class="show"><?php echo $ans->getScore();?></div>
					<form action="index.php" method="post">
							<input type="hidden" name="action" value="up_ans">
							<input type="hidden" name="ans_id" value="<?php echo $ans->getId();?>">
							<button type=submit class="ans_btn">Up &#8613;</button>

					</form>
					<form action="index.php" method="post">
							<input type="hidden" name="action" value="down_ans">
							<input type="hidden" name="ans_id" value="<?php echo $ans->getId();?>">
							<button type=submit class="ans_btn">down &#8615;</button>

					</form>
				</div>
					
					
				<?php }?>
				<div class="container-contact-form-btn">
					<form action="index.php" method="post">
							<input type="hidden" name="action" value="create_ans">
							<input type="hidden" name="q_id" value="<?php echo $ans->getQId();?>">
							<input type="hidden" name="owner" value="<?php echo $ans->getOwner();?>">

					<button class="contact-form-btn"> + New Answer?
					</button>
					
				</form>
				</div>

			</form>

		</div>
	</div>

</body>
</html>
