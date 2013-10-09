<?php

	require("connection.php");

	$data = array('error' => NULL, 'html' => NULL);

	if (empty($_POST['title']) OR empty($_POST['description']))
	{
		$data['error'] = "Description or Title fields cannot be empty";
	}
	else
	{
		$title = mysql_real_escape_string($_POST['title']);
		$description = mysql_real_escape_string($_POST['description']);

		$query = "INSERT INTO notes (title, description, created_at) VALUES ('{$title}', '{$description}', NOW())";
		mysql_query($query);

		$query2 = "SELECT * FROM notes ORDER BY id DESC LIMIT 1";
		$result = fetch_record($query2);
		$note_id = $result['id'];

		$html = "<div class='note'>
		<form id='delete' action='delete.php' method='post' class='right'>
			<input type='submit' value='Delete' class='btn btn-link'>
			<input type='hidden' class='note_id' name='note_id' value='{$note_id}'>
		</form>
		<h4>{$_POST['title']}</h4>
		<p class='edit'>{$_POST['description']}</p>
		</div>
		";
		$data['html'] = $html;
	}

	echo json_encode($data);

?>