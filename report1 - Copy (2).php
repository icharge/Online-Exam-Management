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

	/*$db->Table = "Student";
	$db->Where = "1";
	$Stu_Data = $db->Select();*/
	$db->Table = "student s, scoreboard sb";
	$db->Where = "s.stu_id = sb.stu_id";
	$Stus_Data = $db->Select("DISTINCT s.Stu_id, Stu_name, Stu_major", "Order by s.Stu_id");

	/*$db->Table = "Subject";
	$db->Where = "1";
	$Subject_Data = $db->Select();*/

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


	if ($Stus_Data) {
		// Students
		//echo '';
		foreach ($Stus_Data as $value) {
			// Each student
			$stu_id = $value['Stu_id'];
			
			$db->Table = "student s, scoreboard sb";
			$db->Where = "s.stu_id = sb.stu_id and sb.stu_id = '$stu_id'";
			$Stu_Data = $db->Select("s.Stu_id, Stu_name, Stu_major, Sub_id, Top_id, Score");
			$rowspan = count($Stu_Data);

			echo '<tr><th scope="row" style="text-align: center;" rowspan="'.$rowspan.'"><b>' . $Stu_Data[0]['Stu_id'] . '</b></th><td style="text-align: center;" rowspan="'.$rowspan.'">' . $Stu_Data[0]['Stu_name'] . '</td><td style="text-align: center;" rowspan="'.$rowspan.'">' . $Stu_Data[0]['Stu_major'] . '</td>';
			if ($Stu_Data) {
				// Student
				//echo '<ul>';
				//foreach ($Stu_Data as $value) {
					// Each subject
					$db->Table = "Subject";
					$db->Where = "Sub_id = '". $Stu_Data[0][Sub_id] ."'";
					$Sub_Data = $db->Select1("Sub_name");
					$topnum = 2;
					$sub_id = $Stu_Data[0]['Sub_id'];
					echo '<td style="text-align: center;" rowspan="'.$topnum.'"><b>' . $Stu_Data[0]['Sub_id'] . '</b> ' . $Sub_Data['Sub_name'] . '</td>';

					$db->Table = "student s, scoreboard sb";
					$db->Where = "s.stu_id = sb.stu_id and sb.stu_id = '$stu_id' and sb.sub_id = '$sub_id'";
					$Top_Data = $db->Select("s.Stu_id, Stu_name, Stu_major, Sub_id, Top_id, Score");
					if ($Top_Data) {
						// Topics
						//echo '<ul>';
						foreach ($Top_Data as $value) {
							// Each topic
							$top_id = $value['Top_id'];
							$db->Table = "Topics";
							$db->Where = "top_id = '$value[Top_id]'";
							$Topn_Data = $db->Select1("Top_name");
							// Score
							$db->Table = "Scoreboard";
							$db->Where = "Sub_id = '$sub_id' and Top_id = '$top_id' and Stu_id = '$stu_id'";
							//echo $db->Where;
							$score_Data = $db->Select1();
							echo '<td style="text-align: center;">' . $Topn_Data['Top_name'] . '</td>';
							if ($score_Data) {
								echo '<td style="text-align: center;">' . $score_Data['Score'] . ' / 5' . '</td>';
							} else {
								echo '<td style="text-align: center;">ไม่ได้สอบ</td>';
							}
							echo '</tr>';
						}
					}
				//}
				//echo '</ul>';
			}
		}
		//echo '</ul>';
	}

?>
				<tfoot>
					<tr>
						<td style="text-align: left" colspan="6">สมาชิกทั้งหมด <?php echo count($Stus_Data); ?> รายการ</td>
					</tr>
				</tfoot>
			</table>
		</div>