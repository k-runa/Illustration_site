<?php
	session_start();
	session_regenerate_id(true);

	if (isset($_SESSION['login']) === false) {
		header ('Location: login.php');
		exit();
	}
?>