<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "ข้อสอบ - " . $cfg['title'];
	include("head.php");
	include("sidebar.php");

	echo '		<div id="content" class="large-8 medium-8 medium-pull-4 columns">';

	// GET variable
	$topid = (isset($_GET['top']) ? $_GET['top'] : "");

	// Check Answered
/* แบบเดิม
SELECT * 
FROM question_detail qd
LEFT JOIN question q ON ( q.q_id = qd.q_id ) 
WHERE top_id =1
AND Stu_id =  '54310409'
==========================================
แบบใหม่

SELECT * 
FROM question
WHERE q_id NOT 
IN (
SELECT q_id
FROM question_detail
WHERE stu_id =  '54310104'
)
AND top_id =  '3'
ORDER BY RAND() 
LIMIT 5
*/
/*
	$db->Table = "question_detail qd
LEFT JOIN question q ON ( q.q_id = qd.q_id )";
	$db->Where = "Stu_id = '$_SESSION[user]' and Top_id = '$topid'";
	$checkans = $db->Select1();
	if ($checkans) die(showwarn("คุณทำข้อสอบนี้แล้ว ไม่สามารถทำได้อีก"));
*/
	// Select Questions
	$db->Table = "question";
	$db->Where = "q_id NOT 
IN (
SELECT q_id
FROM question_detail
WHERE stu_id =  '$_SESSION[user]'
)
AND top_id =  '$topid'
ORDER BY RAND() 
LIMIT 5";
	$quest = $db->Select();

/* วิชา หมวด แสดงผล
SELECT sub_name, top_name
FROM subject s
LEFT JOIN Topics t ON ( s.sub_id = t.sub_id ) 
WHERE t.top_id =  '2'
*/
	$db->Table = "subject s LEFT JOIN Topics t ON ( s.sub_id = t.sub_id )";
	$db->Where = "t.top_id =  '$topid'";
	$subdata = $db->Select1("Sub_name, Top_name");
?>
			<h1><span>ข้อสอบ วิชา<?php echo $subdata['Sub_name']; ?></span></h1>
			<p>หมวด <?php echo $subdata['Top_name']; ?> <span class="small">มีจำนวน <?php echo count($quest); ?> ข้อ</p>
			<form method="post" action="exam-process.php?top=<?php echo $topid; ?>">
<?php
	
	if ($quest && count($quest) > 0) {
		$count = 1;
		$qids = array();
		echo '				<div class="questions">';
		foreach ($quest as $value) {
			echo '
					<span class="question">' . $count . '. ' . $value['Question'] . '</span>
					<ul class="examcheck">
						<li>
							<input type="radio" name="answer' . $count . '" id="radio' . $count . '1" value="1" class="xcheckbox">
							<label for="radio' . $count . '1" class="xcheckbox-label">1) ' . $value['Choice1'] . '</label>
							<div class="checkmark"></div>
						</li>
						<li>
							<input type="radio" name="answer' . $count . '" id="radio' . $count . '2" value="2" class="xcheckbox">
							<label for="radio' . $count . '2" class="xcheckbox-label">2) ' . $value['Choice2'] . '</label>
							<div class="checkmark"></div>
						</li>
						<li>
							<input type="radio" name="answer' . $count . '" id="radio' . $count . '3" value="3" class="xcheckbox">
							<label for="radio' . $count . '3" class="xcheckbox-label">3) ' . $value['Choice3'] . '</label>
							<div class="checkmark"></div>
						</li>
						<li>
							<input type="radio" name="answer' . $count . '" id="radio' . $count . '4" value="4" class="xcheckbox">
							<label for="radio' . $count . '4" class="xcheckbox-label">4) ' . $value['Choice4'] . '</label>
							<div class="checkmark"></div>
						</li>
						<li style="display:none;">
							<input type="radio" name="answer' . $count . '" id="radio' . $count . '5" value="5" class="xcheckbox">
							<label for="radio' . $count . '5" class="xcheckbox-label">5) ' . $value['Choice5'] . '</label>
							<div class="checkmark"></div>
						</li>
					</ul>';
			$qids[$count-1] = $value['Q_id'];
			$count++;
		}
		$_SESSION['qids'] = $qids;
		echo '				</div>
				<p>
					<button class="liblue subjectbtn"><img src="images/forward.png"> ส่งกระดาษคำตอบ</button>
				</p>';
	} else {
		echo showwarn("ยังไม่มีข้อสอบให้ทำในตอนนี้");
	}
?>


			</form>
		</div>
<?php
	include("footer.php");