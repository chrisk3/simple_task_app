<?php

	require("connection.php");

	$data = array();

	if (isset($_POST['note_id']) and $_POST['note_id'] > 0)
	{
		$query = "DELETE FROM notes WHERE id = {$_POST['note_id']}";
		mysql_query($query);
	}

	echo json_encode($data);

?>