<script type="text/javascript">
$(function(){
	$("tr").click( function() {
		if ($(this).find('a').attr('href'))
		window.document.location = $(this).find('a').attr('href');
	});
});
</script>

		<div id="content" class="large-8 medium-8 medium-pull-4 columns">
			<h1><span>ยินดีต้อนรับ<?php
	if (isset($_SESSION['name'])) {
		echo " $_SESSION[name]";
	}
	 ?></span></h1>
			<p>ระบบทำข้อสอบออนไลน์ เป็นการทดสอบความรู้ความสามารถจากการเรียน การวัดผลคะแนน ประเมินประสิทธิภาพในการเรียน โดยมีการจัดการทดสอบ ในรายวิชาต่างๆ และมีหมวดต่างๆ ในรายวิชานั้นๆ สามารถเลือกที่จำทำในหมวดต่างๆได้ สามารถรู้ผลสอบได้ทันทีที่ทำการสอบเสร็จ</p>
			<p></p>
<?php
	if (checkLogin($db)) {
		if ($_SESSION['perm'] == "stu") {
			echo '<h1 id="exam"><span>ข้อสอบ</span></h1>
			<p>ข้อสอบที่สามารถเลือกทำได้ มีดังนี้</p>';
			$db->Table = "subject s LEFT JOIN topics t ON ( s.sub_id = t.sub_id ) ";
			$db->Where = "1 ";
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

					echo '<th scope="row" style="text-align: center;"><a href="exam.php?top='.$value['Top_id'].'"><strong>'.$value['Sub_id'].'</strong></a></th>';
					echo '
				<td style="text-align: center;">'.$value['Sub_name'].'</td>
				<td style="text-align: center;">'.$value['Top_name'].'</td>';

					// End Row
					echo '</tr>';
				}
			} else {
				echo '<td style="text-align: center;" colspan="3">ไม่พบรายการวิชา</td>';
			}
?>
				<tfoot>
					<tr>
						<td style="text-align: left" colspan="3">ทั้งหมด <?php echo count($Stu_Data); ?> รายการ</td>
					</tr>
				</tfoot>
			</table>
<?php
		} elseif ($_SESSION['perm'] == "tea") {

		} else {
			echo '<p>คุณต้องเข้าสู่ระบบก่อนที่จะสอบ</p>';
		}
	} else {
		
	}
?>		</div>