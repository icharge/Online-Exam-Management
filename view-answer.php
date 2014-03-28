<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "ข้อสอบ - " . $cfg['title'];
	
	include("head.php");
	include("sidebar.php");

	$tStu_id = (isset($_GET['stu']) ? $_GET['stu'] : "");
	$tTop_id = (isset($_GET['top']) ? $_GET['top'] : "");
	$tSub_id = (isset($_GET['sub']) ? $_GET['sub'] : "");

	$db->Table = "student";
	$db->Where = "stu_id = '$tStu_id'";
	$Stu_name = $db->Select1();
	$Stu_name = $Stu_name['Stu_name'];

	$db->Table = "topics";
	$db->Where = "top_id = '$tTop_id'";
	$Top_name = $db->Select1();
	$Top_name = $Top_name['Top_name'];

	$db->Table = "subject";
	$db->Where = "sub_id = '$tSub_id'";
	$Sub_name = $db->Select1();
	$Sub_name = $Sub_name['Sub_name'];

	$db->Table = "question q, question_detail qd";
	$db->Where = "q.q_id = qd.q_id AND q.top_id = '$tTop_id' AND qd.Stu_id = '$tStu_id'";
	//echo $db->Where;
	$data = $db->Select();

	/* OLD
	$db->Table = "Scoreboard";
	$db->Where = "Stu_id = '$tStu_id' and Sub_id = '$tSub_id' and Top_id = '$tTop_id'";
	$score = $db->Select1();
	*/
	$db->Table = "Scoreboard";
	$db->Where = "Stu_id = '$tStu_id' and Sub_id = '$tSub_id' and Top_id = '$tTop_id' group by Stu_id";
	$score = $db->Select1("Stu_id, Sub_id, Top_id, Sco_time, sum(Score) as Score");

?>		<div id="content" class="large-8 medium-8 medium-pull-4 columns">
			<h1><span>แสดงข้อสอบของ <?php echo $Stu_name; ?></span></h1>
			<h2>วิชา <?php echo $Sub_name; ?></h2>
			<h3>หมวด <?php echo $Top_name; ?></h3>
<?php
	if ($data) { ?>
			<div class="scorecircle">
				<span class="score"><?php echo $score['Score']; ?></span>
				<span class="maxsco"><?php echo count($data); ?></span>
			</div>
<?php
	}
	if ($data) {
		$exam_count = 1;
		foreach ($data as $value) {
			echo '<div class="examcolor' . ($value['Answer'] != $value['Correct'] ? ' wrong' : '') .'"><span>' . $exam_count . '. ' . $value['Question'] . '</span>';
			echo '<ul class="examcheck">
					<li>
						<input type="radio" name="answer' . $exam_count . '" id="radio' . $exam_count . '1" class="xcheckbox" ' . ($value['Answer'] == "1" ? 'checked' : '') . '>
						<label class="xcheckbox-label">1) ' . $value['Choice1'] . '</label>
						<div class="checkmark'. ($value['Correct'] == "1" ? ' correct' : '') .'"></div>
					</li>
					<li>
						<input type="radio" name="answer' . $exam_count . '" id="radio' . $exam_count . '2" class="xcheckbox" ' . ($value['Answer'] == "2" ? 'checked' : '') . '>
						<label class="xcheckbox-label">2) ' . $value['Choice2'] . '</label>
						<div class="checkmark'. ($value['Correct'] == "2" ? ' correct' : '') .'"></div>
					</li>
					<li>
						<input type="radio" name="answer' . $exam_count . '" id="radio' . $exam_count . '3" class="xcheckbox" ' . ($value['Answer'] == "3" ? 'checked' : '') . '>
						<label class="xcheckbox-label">3) ' . $value['Choice3'] . '</label>
						<div class="checkmark'. ($value['Correct'] == "3" ? ' correct' : '') .'"></div>
					</li>
					<li>
						<input type="radio" name="answer' . $exam_count . '" id="radio' . $exam_count . '4" class="xcheckbox" ' . ($value['Answer'] == "4" ? 'checked' : '') . '>
						<label class="xcheckbox-label">4) ' . $value['Choice4'] . '</label>
						<div class="checkmark'. ($value['Correct'] == "4" ? ' correct' : '') .'"></div>
					</li>
					<li style="display:none;">
						<input type="radio" name="answer' . $exam_count . '" id="radio' . $exam_count . '5" class="xcheckbox" ' . ($value['Answer'] == "5" ? 'checked' : '') . '>
						<label class="xcheckbox-label">5) ' . $value['Choice5'] . '</label>
						<div class="checkmark'. ($value['Correct'] == "5" ? ' correct' : '') .'"></div>
					</li>
				</ul></div>';
			$exam_count++;
		}
	} else {
		echo '<span>ไม่ได้ทำข้อสอบนี้</span>';
	}
	echo '</div>';
	include("footer.php");