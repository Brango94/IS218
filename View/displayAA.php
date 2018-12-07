<?php
include ('header.php');?>
<body>
	<div class="container-contact">

		<div class="wrap-contact">
			<div class="contact-form-title">
				<?php echo  $fname ." ". $lname ;?>
			</div>
			<table>
			<tr class="title">
				<th>id</th><th>Owner Email</th>
				<th>Owner ID</th><th>Date Created</th>
				<th>Title</th><th>Body</th><th>Skills</th><th>Score</th>
				<th>&nbsp;</th><th>&nbsp;</th>

			</tr>

			<?php foreach($questions as $questions) {?>
			<tr>
				<td><?php echo $questions['id'];?></td>
				<td><?php echo $questions['owneremail'];?></td>
				<td><?php echo $questions['ownerid'];?></td>
				<td><?php echo $questions['createddate'];?></td>
				<td><?php echo $questions['title'];?></td>
				<td><?php echo $questions['body'];?></td>
				<td><?php echo $questions['skills'];?></td>
				<td><?php echo $questions['score'];?></td>
				<td><form action="index.php" method="post">
                    <input type="hidden" name="action"
                           value="delete_question">
                    <input type="hidden" name="question_id"
                           value="<?php echo $questions['id']; ?>">
                    <button type="submit">Delete</button>
                </form></td>
                <td><form action="index.php" method="post">
                    <input type="hidden" name="action"
                           value="show_edit_question">
                    <input type="hidden" name="question_id"
                           value="<?php echo $questions['id']; ?>">
                    <button type="submit">Edit</button>
                </form></td>
			</tr>
			<?php }?>
			</table>
		<br>
			<div class="container-contact-form-btn">
				<form action="index.php" method="post">
					<input type="hidden" name="action"
                           value="show_question_form">

                    <input type="hidden" name="owner_email"
                           value="<?php echo $questions['owneremail'];?>">
                    <input type="hidden" name="email_id"
                           value="<?php echo $questions['ownerid'];?>">
					<input type="submit" value="+ Create New Question">
					
				</form>
			</div>
		</div>
	</div>
</body>
</html>
