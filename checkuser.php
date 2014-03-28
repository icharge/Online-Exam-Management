<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");

	if(empty($_GET['username'])) die("1");
	$db->Table = "student";
	$db->Where = "Stu_id = '$_GET[username]'";
	$result = $db->Select1();
	if($result)
	{
		echo "1";
	} else {
		echo "0";
	}
?>