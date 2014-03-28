<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "แสดงข้อสอบ - " . $cfg['title'];
	
	include("head.php");
	include("sidebar.php");

	// Get Subject id & Topic id
	$subid = (isset($_GET['sub']) ? $_GET['sub'] : "");
	$topid = (isset($_GET['top']) ? $_GET['top'] : "");

	$db->Table = "subject s
LEFT JOIN topics t ON ( s.sub_id = t.sub_id ) 
LEFT JOIN question q ON ( q.top_id = t.top_id ) ";
	$db->Where = "s.sub_id = '$subid' and t.top_id = '$topid' ";
	//echo $db->Where ;
	echo '<div id="content" class="large-8 medium-8 medium-pull-4 columns">';
	$question = $db->Select();
	if ($question) {
?>
	<h1><span>แสดงข้อสอบวิชา <?php echo $question[0]['Sub_name']; ?></span></h1>
	<h3>หมวด <?php echo $question[0]['Top_name']; ?></h3>
	<p>ทั้งหมด <?php echo count($question); ?> ข้อ</p>
<?php
		$exam_count = 1;
		foreach ($question as $value) {
			echo '<div class="examcolor"><span>' . $exam_count . '. ' . $value['Question'] . '</span>';
			echo '<ul class="examcheck">
					<li>
						<input type="radio" name="answer' . $exam_count . '" id="radio' . $exam_count . '1" class="xcheckbox">
						<label class="xcheckbox-label">1) ' . $value['Choice1'] . '</label>
						<div class="checkmark'. ($value['Correct'] == "1" ? ' correct' : '') .'"></div>
					</li>
					<li>
						<input type="radio" name="answer' . $exam_count . '" id="radio' . $exam_count . '2" class="xcheckbox">
						<label class="xcheckbox-label">2) ' . $value['Choice2'] . '</label>
						<div class="checkmark'. ($value['Correct'] == "2" ? ' correct' : '') .'"></div>
					</li>
					<li>
						<input type="radio" name="answer' . $exam_count . '" id="radio' . $exam_count . '3" class="xcheckbox">
						<label class="xcheckbox-label">3) ' . $value['Choice3'] . '</label>
						<div class="checkmark'. ($value['Correct'] == "3" ? ' correct' : '') .'"></div>
					</li>
					<li>
						<input type="radio" name="answer' . $exam_count . '" id="radio' . $exam_count . '4" class="xcheckbox">
						<label class="xcheckbox-label">4) ' . $value['Choice4'] . '</label>
						<div class="checkmark'. ($value['Correct'] == "4" ? ' correct' : '') .'"></div>
					</li>
					<li style="display:none;">
						<input type="radio" name="answer' . $exam_count . '" id="radio' . $exam_count . '5" class="xcheckbox">
						<label class="xcheckbox-label">5) ' . $value['Choice5'] . '</label>
						<div class="checkmark'. ($value['Correct'] == "5" ? ' correct' : '') .'"></div>
					</li>
				</ul></div>';
			$exam_count++;
		}
	} else {
		echo showwarn("ไม่พบข้อสอบ หรือเงื่อนไขวิชาไม่ถูกต้อง");
	}
	include("footer.php");