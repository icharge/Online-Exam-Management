<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "หน้าแรก - " . $cfg['title'];
	
	include("head.php");
	include("sidebar.php");
	include("main.php");
	include("footer.php");
	

?>