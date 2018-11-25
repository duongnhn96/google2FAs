<?php
	$act = $_GET['act'];
	if($act=="login") include('login.php');
	else if($act=="register") include('register.php');
	else if($act=="qrcheck") include('qrcheck.php');
	else if($act=="logincheck") include('logincheck.php');
	else if($act=="dashboard") include('dashboard.php');
	else if($act=="logout") include('logout.php');

	
	else include('login.php');

?>