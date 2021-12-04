<?php
	//unset($_SESSION['login']);
	$_SESSION['login'] = "";
	//session_destroy();
	array_map('unlink', glob("uploadslogout/*"));
	include 'signUpVk.php';
	$_SESSION['vk'] = "";
	$_SESSION['vk_in'] == 'false';
	logOut();
	header("location: / ");
	//echo $link = '<p><a href="/">На главную</a></p>';
?>