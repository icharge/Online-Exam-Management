<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "บันทึกข้อสอบ - " . $cfg['title'];
	include("head.php");
	include("sidebar.php");

	echo '<div id="content" class="large-8 medium-8 medium-pull-4 columns">';

	// POST Variable
	//$subid = (isset($_GET['sub']) ? $_GET['sub'] : ""); //sub
	$topid = (isset($_POST['top']) ? $_POST['top'] : ""); //top

	$question = (isset($_POST['tquestion']) ? $_POST['tquestion'] : ""); //tquestion
	$correct = (isset($_POST['correct']) ? $_POST['correct'] : ""); //correct
	$choice1 = (isset($_POST['tchoice1']) ? $_POST['tchoice1'] : ""); //tchoice1
	$choice2 = (isset($_POST['tchoice2']) ? $_POST['tchoice2'] : ""); //tchoice2
	$choice3 = (isset($_POST['tchoice3']) ? $_POST['tchoice3'] : ""); //tchoice3
	$choice4 = (isset($_POST['tchoice4']) ? $_POST['tchoice4'] : ""); //tchoice4
	$choice5 = (isset($_POST['tchoice5']) ? $_POST['tchoice5'] : ""); //tchoice5
	
	if ($topid <= 0) {
		die(showwarn("เลือกวิชาและหมวด ด้วย"));
	}
	if (empty($question) or empty($choice1) or empty($choice2) or empty($choice3) 
		or empty($choice4) or empty($topid)) {
		die(showwarn("คุณกรอกข้อมูลไม่ครบ"));
	}

	if (empty($correct)) {
		die(showwarn("ต้องเลือกตัวเลือกที่ถูกด้วย"));
	}

	// INSERT
	$db->Table = "question";
	$db->Field = "q_id, question, choice1, choice2, choice3, choice4, choice5, correct, top_id";
	$db->Value = "null, '$question', '$choice1', '$choice2', '$choice3', '$choice4', '$choice5', '$correct', '$topid'";
	$addquest = $db->Insert();
	if ($addquest) {
		echo showinfo("บันทึกข้อสอบเรียบร้อย","ดำเนินต่อ","images/forward.png", 3, "add-question.php");
	}
	
	include("footer.php");