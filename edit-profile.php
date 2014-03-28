<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "หน้าแรก - " . $cfg['title'];
	
	include("head.php");
	include("sidebar.php");
	
	// Get variable
	$stuid = $_SESSION['user'];

	$db->Table = "student";
	$db->Where = "Stu_id = '$stuid'";
	$student = $db->Select1();

	echo '<div id="content" class="large-8 medium-8 medium-pull-4 columns">';
?>
