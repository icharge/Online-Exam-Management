<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "ผลการสอบตามรายวิชา - " . $cfg['title'];
	
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
	<h1><span>ผลการสอบตามรายวิชา</span></h1>
	<div class="panel">
		<div class="row">
			<form id="searchfrm" method="get" action="">
				<div class="medium-12 columns">
					<label for="searchbox">ค้นหา</label>
					<div class="medium-9 columns">
						<input type="text" name="q" id="searchbox" placeholder="รหัส/ชื่อวิชา หมวด" value="<?php echo $q; ?>">
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
/* old
$db->Table = "subject su, student st, scoreboard sb";
	$db->Where = "sb.sub_id = su.sub_id AND sb.stu_id = st.stu_id ";
	if ($q) {
		$db->Where .= "and (su.sub_id like '".($q == "" ? "%" : "%".$q."%")."' 
		or su.sub_name like '".($q == "" ? "%" : "%".$q."%")."')";
		//echo $db->Where;
	}
*/
/* NEW SQL
SELECT su.Sub_id, Sub_name, t.Top_id, Top_name, st.Stu_id, Stu_name, Stu_major, Score 
FROM subject su 
LEFT JOIN topics t on (t.sub_id = su.sub_id)
LEFT JOIN scoreboard sb on (su.sub_id = sb.sub_id)
right JOIN student st on (st.stu_id = sb.stu_id)
WHERE sb.top_id = t.top_id
*/

	$db->Table = "subject su 
LEFT JOIN topics t on (t.sub_id = su.sub_id)
LEFT JOIN scoreboard sb on (su.sub_id = sb.sub_id)
right JOIN student st on (st.stu_id = sb.stu_id)";
	$db->Where = "sb.top_id = t.top_id ";
	if ($q) {
		$db->Where .= "and (su.sub_id like '".($q == "" ? "%" : "%".$q."%")."' 
		or su.sub_name like '".($q == "" ? "%" : "%".$q."%")."'
		or t.top_id like '".($q == "" ? "%" : "%".$q."%")."'
		or top_name like '".($q == "" ? "%" : "%".$q."%")."')";
		//echo $db->Where;
	}
	$Stu_Data = $db->Select("su.Sub_id, Sub_name, t.Top_id, Top_name, st.Stu_id, Stu_name, Stu_major, Score ", "Order by su.Sub_id");

	echo '			<table class="dc_table_s12" summary="Students list" style="width: 100%">
				<thead>
					<tr>
						<th scope="col" style="text-align: center;">รหัสวิชา</th>
						<th scope="col" style="text-align: center;">วิชา</th>
						<th scope="col" style="text-align: center;">หมวด</th>
						<th scope="col" style="text-align: center;">รหัสนิสิต</th>
						<th scope="col" style="text-align: center;">ชื่อ</th>
						<th scope="col" style="text-align: center;">สาขา</th>
						<th scope="col" style="text-align: center;">คะแนน</th>
					</tr>
				</thead>
				<tbody>';

	if ($Stu_Data) {
		// Students
		foreach ($Stu_Data as $value) {
			// Start Row
			echo '<tr>';

			echo '<th scope="row" style="text-align: center;"><a href="view-answer.php?stu='.$value['Stu_id'].'&sub='.$value['Sub_id'].'&top='.$value['Top_id'].'"><strong>'.$value['Sub_id'].'</strong></a></th>';
			echo '
			<td style="text-align: center;">'.$value['Sub_name'].'</td>
			<td style="text-align: center;">'.$value['Top_name'].'</td>
			<td style="text-align: center;">'.$value['Stu_id'].'</td>
			<td style="text-align: center;">'.$value['Stu_name'].'</td>
			<td style="text-align: center;">'.$value['Stu_major'].'</td>
			<td style="text-align: center;">'.$value['Score'].'</td>';

			// End Row
			echo '</tr>';
		}
	} else {
		echo '<td style="text-align: center;" colspan="7">ไม่พบรายการที่ค้นหา</td>';
	}

?>
				<tfoot>
					<tr>
						<td style="text-align: left" colspan="7">สมาชิกทั้งหมด <?php echo count($Stu_Data); ?> รายการ</td>
					</tr>
				</tfoot>
			</table>
		</div>
<?php include("footer.php");