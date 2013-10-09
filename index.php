<?php require("connection.php"); ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ajax</title>

	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="ajax_advanced.css">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	<script type="text/javascript">

		$(document).on("submit", '#add-note', function() {
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(data) {
					if (data.error)
					{
						alert(data.error);
					}
					else
					{
						$('#notes-container').append(data.html);
					}
				},
				"json"); //end post
			return false;
		}); //end add note submit

		$(document).on("submit", "#delete", function() {
			$(this).parent().hide();
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function() {},
				"json"); //end post
			return false;
		}); //end delete note submit

		$(document).on("click", ".edit", function() {
			var note_text = $(this).text();
			var id = $(this).parent().find('.note_id').attr('value');
			var textbox = "<form id='editor' action='edit.php' method='post'><textarea cols='34' rows='7' class='edit_box' name='edit_description'>" + note_text + "</textarea><input type='submit' name='note_edit' value='Edit' class='btn btn-primary btn-small'><input type='hidden' name='edit_id' value='" + id + "'></form>";
			$(this).hide();
			$(this).parent().append(textbox);
		}); //end edit note click

		$(document).on("submit", "#editor", function() {
			var place = $(this);
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(edit) {
					place.parent('.note').append(edit.html);
					place.hide();
				},
				"json"); //end post
			return false;
		}); //end edit note submit

	</script>

</head>
<body>

	<div id="wrapper">
		
		<div id="add-note-container">
			<form id="add-note" action="process.php" method="post">
				<input type="text" name="title" placeholder="Title">
				<textarea cols="25" rows="10" name="description" class="margin" placeholder="Description"></textarea>
				<input type="submit" value="Add Note" class="btn btn-primary margin">
			</form>
		</div>

		<div id="notes-display">
			<h2>Notes</h2>
			<div id="notes-container">
				
			</div>
		</div>

		<div class="clear"></div>

	</div>
	
</body>
</html>