<?php
	session_start();
	if(!isset($_SESSION['in']) OR !$_SESSION['in']){
		header('Location: login.php');
		exit();
	}
	else {
		header('Location: index2.php');
	}
?>
