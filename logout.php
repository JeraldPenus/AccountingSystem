<?php
session_start();
	$past = time() - 100;
	//this makes the time in the past to destroy the cookie
	setcookie('username', gone, $past);
	setcookie('userkey', gone, $past);
	setcookie('cname', gone, $past);
	header("Location: home.php");
?>