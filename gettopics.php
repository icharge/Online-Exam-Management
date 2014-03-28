<?php
	require_once("config.php");
	include("db.php");
	include("functions.php");

	$sid = $_GET['sub_id'];
	echo getTopics($sid, $db);
?>