<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "รายการสมาชิก - " . $cfg['title'];
	
	include("head.php");
	include("sidebar.php");
	
	// Set empty variable
	$sub_id = "";
	$top_id = "";
	$stu_id = "";
	$q = (isset($_GET['q']) ? $_GET['q'] : "");

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
	<div id="content" class="large-8 medium-8 medium-pull-4 columns">
		<h1><span>รายการสมาชิก</span></h1>
		<h3></h3>
		<div class="panel">
			<div class="row">
				<form id="searchfrm" method="get" action="">
					<div class="medium-12 columns">
						<label for="searchbox">ค้นหา</label>
						<div class="medium-9 columns">
							<input type="text" name="q" id="searchbox" placeholder="ค้นหาจากชื่อ" value="<?php echo $q; ?>">
						</div>
						<div class="medium-3 columns">
							<button type="submit" id="btnsearch" class="liblue smallbtn">ค้นหา</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
<?php

	// Set query
	$db->Table = "student ";
	$db->Where = "1 ";
	if ($q) {
		$db->Where .= "and (stu_id like '".($q == "" ? "%" : "%".$q."%")."' 
		or stu_name like '".($q == "" ? "%" : "%".$q."%")."')";
		//echo $db->Where;
	}
	$Stu_Data = $db->Select("", "Order by Stu_id");

	echo '			<table class="dc_table_s12" summary="Students list" style="width: 100%">
				<thead>
					<tr>
						<th scope="col" style="text-align: center;">รหัสสมาชิก</th>
						<th scope="col" style="text-align: center;">ชื่อ</th>
						<th scope="col" style="text-align: center;">เพศ</th>
						<th scope="col" style="text-align: center;">สาขา</th>
						<th scope="col" style="text-align: center;">อีเมล์</th>
					</tr>
				</thead>
				<tbody>';

	if ($Stu_Data) {
		// Students
		foreach ($Stu_Data as $value) {
			// Start Row
			echo '<tr>';

			echo '<th scope="row" style="text-align: center;"><a href="view-member.php?stu='.$value['Stu_id'].'"><strong>'.$value['Stu_id'].'</strong></a></th>';
			echo '<td style="text-align: center;">'.$value['Stu_name'].'</td>
			<td style="text-align: center;">'.($value['Stu_gender'] == "male" ? "ชาย" : ($value['Stu_gender'] == "female" ? "หญิง" : $value['Stu_gender'])) .'</td>
			<td style="text-align: center;">'.$value['Stu_major'].'</td>
			<td style="text-align: center;">'.$value['Stu_email'].'</td>';

			// End Row
			echo '</tr>';
		}
		
	} else {
		echo '<td style="text-align: center;" colspan="5">ไม่พบรายการที่ค้นหา</td>';
	}

?>
			<tfoot>
				<tr>
					<td style="text-align: left" colspan="5">สมาชิกทั้งหมด <?php echo count($Stu_Data); ?> รายการ</td>
				</tr>
			</tfoot>
		</table>
	</div>
<?php include("footer.php");