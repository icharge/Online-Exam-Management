<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "ผลการสอบของสมาชิก - " . $cfg['title'];
	
	include("head.php");
	include("sidebar.php");
?>
<script type="text/javascript">
$(function(){

	$("#searchbox").focus();
	$("tr").click( function() {
		if ($(this).find('a').attr('href'))
		window.document.location = $(this).find('a').attr('href');
	});
});
</script>

<?php
	// Get q
	$q = (isset($_GET['q']) ? $_GET['q'] : "");

?>
	<div id="content" class="large-8 medium-8 medium-pull-4 columns">
		<h1><span>ผลการสอบของสมาชิก</span></h1>
		<div class="panel">
			<div class="row">
				<form id="searchfrm" method="get" action="">
					<div class="medium-12 columns">
						<label for="searchbox">ค้นหา</label>
						<div class="medium-9 columns">
							<input type="text" name="q" id="searchbox" placeholder="รหัส/ชื่อสมาชิก" value="<?php echo $q; ?>">
						</div>
						<div class="medium-3 columns">
							<button type="submit" id="btnsearch" class="liblue smallbtn">ค้นหา</button>
						</div>
					</div>
				</form>
			</div>
		</div>

<?php

	// Set empty variable
	$sub_id = "";
	$top_id = "";
	$stu_id = "";

	// Set query
	/* NEW SQL for sum score
select s.Stu_id, Stu_name, Stu_major, Sub_id, Top_id, getSubject(Sub_id) as Sub_name, 
getTopic(Top_id) as Top_name, sum(Score) as TotalScore from student s, 
scoreboard sb where s.stu_id = sb.stu_id group by s.Stu_id, top_name 
Order by s.Stu_id, sub_id, top_id
	*/
	//Old s
	$db->Table = "student s, scoreboard sb";
	$db->Where = "s.stu_id = sb.stu_id ";
	if ($q) {
		$db->Where .= "and (s.stu_id like '".($q == "" ? "%" : "%".$q."%")."' 
		or s.stu_name like '".($q == "" ? "%" : "%".$q."%")."')";
		//echo $db->Where;
	}
	$Stu_Data = $db->Select("s.Stu_id, Stu_name, Stu_major, Sub_id, Top_id, getSubject(Sub_id) as Sub_name, getTopic(Top_id) as Top_name, Score", "Order by s.Stu_id, sub_id, top_id");
	
	/* New 
	$db->Table = "student s, scoreboard sb";
	$db->Where = "s.stu_id = sb.stu_id ";
	if ($q) {
		$db->Where .= "and (s.stu_id like '".($q == "" ? "%" : "%".$q."%")."' 
		or s.stu_name like '".($q == "" ? "%" : "%".$q."%")."')";
		//echo $db->Where;
	}
	$db->Where .= " group by s.Stu_id, top_name";
	$Stu_Data = $db->Select("s.Stu_id, Stu_name, Stu_major, Sub_id, Top_id, getSubject(Sub_id) as Sub_name, 
getTopic(Top_id) as Top_name, sum(Score) as Score", "Order by s.Stu_id, sub_id, top_id");
	*/

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
		foreach ($Stu_Data as $value) {
			// Start Row
			echo '<tr>';

			echo '<th scope="row" style="text-align: center;"><a href="view-answer.php?stu='.$value['Stu_id'].'&sub='.$value['Sub_id'].'&top='.$value['Top_id'].'"><strong>'.$value['Stu_id'].'</strong></a></th>';
			echo '<td style="text-align: center;">'.$value['Stu_name'].'</td>
			<td style="text-align: center;">'.$value['Stu_major'].'</td>
			<td style="text-align: center;">'.$value['Sub_name'].'</td>
			<td style="text-align: center;">'.$value['Top_name'].'</td>
			<td style="text-align: center;">'.$value['Score'].'</td>';

			// End Row
			echo '</tr>';
		}
		
	} else {
		echo '<td style="text-align: center;" colspan="6">ไม่พบรายการที่ค้นหา</td>';
	}

?>
			<tfoot>
				<tr>
					<td style="text-align: left" colspan="6">สมาชิกทั้งหมด <?php echo count($Stu_Data); ?> รายการ</td>
				</tr>
			</tfoot>
		</table>
	</div>
<?php include("footer.php");