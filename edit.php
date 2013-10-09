<?php

	require("connection.php");

	$edit = array('html' => NULL);

	if (isset($_POST['edit_description']))
	{
		$query = "UPDATE notes SET description = '{$_POST['edit_description']}', updated_at = NOW() WHERE id = {$_POST['edit_id']}";
		mysql_query($query);
		// echo $query;

		$html = "<p class='edit'>{$_POST['edit_description']}</p>";
	}

	$edit['html'] = $html;
	echo json_encode($edit);

?>