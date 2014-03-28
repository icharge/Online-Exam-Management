<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "บันทึกข้อสอบ - " . $cfg['title'];
	include("head.php");
	include("sidebar.php");

	echo '<div id="content" class="large-8 medium-8 medium-pull-4 columns">';

	$topid = (!is_null($_GET['top']) ? $_GET['top'] : "");
	//$ans_count = (isset($_POST['anscount']) ? $_POST['anscount'] : "");
	//$subid = ()

	$qids = $_SESSION['qids'];
	$ans = array();

	// Check & Insert Detail
	$i = 0;
	$sum = 0;
	foreach ($_POST as $key => $value) {
	 	if (substr($key, 0, 6) == "answer") {
	 		$ans[$i] = $value;
	 	}
	 	$i++;
	}
	for ($i=0; $i < count($qids); $i++) {
	 	if (!isset($ans[$i])) $ans[$i] = "0";
		$db->Field = "Stu_id, Q_id, Answer";
		$db->Table = "question_detail";
		$db->Value = $_SESSION['user'] . "," . $qids[$i] . "," . $ans[$i];
		//echo $db->Value . "<br>";
		$ansadd = $db->Insert();

		if (!$ansadd) die(showwarn("คุณทำข้อสอบนี้แล้ว ไม่สามารถบันทึกได้"));

		// Check correct
		$db->Table = "question";
		$db->Where = "top_id = '$topid' and q_id = '" . $qids[$i] . "'";
		$qs = $db->Select1("Correct");
		if ($ans[$i] == $qs['Correct']) $sum++;

	}


	// Add summary
	$db->Table = "subject s LEFT JOIN topics t ON ( s.sub_id = t.sub_id ) ";
	$db->Where = "t.top_id = '$topid'";
	$qr = $db->Select1("s.Sub_id");
	//echo $db->Where ;

	$db->Field = "Stu_id, Sub_id, Top_id, Score";
	$db->Table = "scoreboard";
	$db->Value = $_SESSION['user'] . "," . $qr['Sub_id'] . "," . $topid . "," . $sum;
	$db->Insert();
	
	echo showinfo("บันทึกข้อสอบเรียบร้อย","เสร็จ","images/forward.png", 3, "index.php");


?>		</div>
<?php
	include("footer.php");