<?php
	session_start();

	session_unset();//deletes all session

	header("Location: index.php")
?>