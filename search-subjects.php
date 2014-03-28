<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "ค้นหาข้อสอบ - " . $cfg['title'];
	
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
	<h1><span>ค้นหาข้อสอบ</span></h1>
	<div class="panel">
		<div class="row">
			<form id="searchfrm" method="get" action="">
				<div class="medium-12 columns">
					<label for="searchbox">ค้นหา</label>
					<div class="medium-9 columns">
						<input type="text" name="q" id="searchbox" placeholder="ค้นหาจาก รหัสหรือชื่อวิชา" value="<?php echo $q; ?>">
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

	// Set query
	/*
	SELECT * FROM subject s LEFT JOIN topics t on (s.sub_id = t.sub_id) 
	WHERE s.sub_id like '%'	and s.sub_name like '%คณิต%' and t.top_name like '%ตรร%'
	*/

	$db->Table = "subject s LEFT JOIN topics t ON ( s.sub_id = t.sub_id ) ";
	$db->Where = "1 ";
	if ($q) {
		$db->Where .= "and s.sub_id like '".($q == "" ? "%" : "%".$q."%")."' 
		or s.sub_name like '".($q == "" ? "%" : "%".$q."%")."' 
		or t.top_name like '".($q == "" ? "%" : "%".$q."%")."'";
		//echo $db->Where;
	}
	$Stu_Data = $db->Select();

	echo '			<table class="dc_table_s12" summary="Subjects list" style="width: 100%">
				<thead>
					<tr>
						<th scope="col" style="text-align: center;">รหัสวิชา</th>
						<th scope="col" style="text-align: center;">วิชา</th>
						<th scope="col" style="text-align: center;">หมวด</th>
					</tr>
				</thead>
				<tbody>';

	if ($Stu_Data) {
		// Students
		foreach ($Stu_Data as $value) {
			// Start Row
			echo '<tr>';

			echo '<th scope="row" style="text-align: center;"><a href="view-question.php?sub='.$value['Sub_id'].'&top='.$value['Top_id'].'"><strong>'.$value['Sub_id'].'</strong></a></th>';
			echo '
			<td style="text-align: center;">'.$value['Sub_name'].'</td>
			<td style="text-align: center;">'.$value['Top_name'].'</td>';

			// End Row
			echo '</tr>';
		}
	} else {
		echo '<td style="text-align: center;" colspan="3">ไม่พบรายการที่ค้นหา</td>';
	}

?>
				<tfoot>
					<tr>
						<td style="text-align: left" colspan="3">วิชาทั้งหมด <?php echo count($Stu_Data); ?> รายการ</td>
					</tr>
				</tfoot>
			</table>
		</div>
<?php include("footer.php");