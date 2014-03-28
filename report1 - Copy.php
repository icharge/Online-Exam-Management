<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "ผลการสอบของสมาชิกแต่ละคน - " . $cfg['title'];
	
	include("head.php");
	include("sidebar.php");

	echo '<div id="content" class="large-8 medium-8 medium-pull-4 columns">';
	echo '<h1><span>ผลการสอบของสมาชิกแต่ละคน</span></h1>';

	$sub_id = "";
	$top_id = "";
	$stu_id = "";

	$db->Table = "Student";
	$db->Where = "1";
	$Stu_Data = $db->Select();

	echo '			<table class="dc_table_s12" summary="Students list" style="width: 100%">
				<thead>
					<tr>
						<th scope="col" style="text-align: center;">รหัสสมาชิก</th>
						<th scope="col" style="text-align: center;">ชื่อ</th>
						<th scope="col" style="text-align: center;">สาขา</th>
						<th scope="col" style="text-align: center;">วิชา</th>
						<th scope="col" style="text-align: center;">หมวด</th>
						<th scope="col" style="text-align: center;">คะแนน</th>
					</tr>
				</thead>
				<tbody>';


	if ($Stu_Data) {
		// Students
		echo '<ul>';
		foreach ($Stu_Data as $value) {
			// Each student
			$stu_id = $value['Stu_id'];
			echo '<li><b>' . $value['Stu_id'] . '</b> ' . $value['Stu_name'] . '</li>';
			$db->Table = "Subject";
			$db->Where = "1";
			$Subject_Data = $db->Select();
			if ($Subject_Data) {
				// Subjects
				echo '<ul>';
				foreach ($Subject_Data as $value) {
					// Each subject
					$sub_id = $value['Sub_id'];
					echo '<li><b>' . $value['Sub_id'] . '</b> ' . $value['Sub_name'] . '</li>';
					$db->Table = "Topics";
					$db->Where = "Sub_id = '$value[Sub_id]'";
					$Top_Data = $db->Select();
					if ($Top_Data) {
						// Topics
						echo '<ul>';
						foreach ($Top_Data as $value) {
							// Each topic
							$top_id = $value['Top_id'];
							
							$db->Table = "Scoreboard";
							$db->Where = "Sub_id = '$sub_id' and Top_id = '$top_id' and Stu_id = '$stu_id'";
							//echo $db->Where;
							$score_Data = $db->Select1();
							if ($score_Data) {
								echo '<li>' . $value['Top_name'] . ' ';
								echo '[ ' . $score_Data['Score'] . ' / 5' . ' ]</li>';
							} else {
								echo '<li>' . $value['Top_name'] . ' [ ไม่ได้สอบ ]</li>';
							}
							
						}
						echo '</ul>';
					}
				}
				echo '</ul>';
			}
		}
		echo '</ul>';
	}

?>		</div>