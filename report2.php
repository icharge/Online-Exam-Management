<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "แสดงคำตอบของนิสิต - " . $cfg['title'];
	
	include("head.php");
	include("sidebar.php");
?>
<script type="text/javascript">
$(function(){
	
	$("#subjects").change(function(){
		$("#topics").html('<option value="-1">. . . กำลังโหลด . . .</option>');
		var url = "gettopics.php?sub_id="+$(this).val() ;

		$.getJSON(
				url ,
				function(resp){
					var opt = '<option value="-1">เลือกหมวด</option>';
					
					for(var i=0;i<resp.length;i++){
						opt += '<option value="'+ resp[i].Top_id+'">'+resp[i].Top_id+' '+resp[i].Top_name+'</option>';
					}
					$("#topics").html( opt );
				} 
		);
	});
	$(".stulist table tbody tr td button.liblue.smallbtn").click(function(e) {
		e.preventDefault();
		if ($("#subjects").val() >= 0 || $("#topics").val() >= 0) {
			$("#student").val(this.id);
			$("#stuform").submit();
		} else {
			alert('ต้องเลือกวิชาและหมวด');
		}
	});

})
</script>
		<div id="content" class="large-8 medium-8 medium-pull-4 columns">
			<h1><span>แสดงคำตอบของนิสิต</span></h1>
			<h2>รายการนิสิต</h2>
			<div class="row">
				<form name="stuform" id="stuform" method="post" action="view-answer.php">
					<div class="medium-6 columns">
						<input type="hidden" name="stu_id" id="student" value="-1">
						<select name="sub_id" id="subjects">
							<option value="-1">เลือกวิชา</option>
<?php
	$db->Table = "Subject";
	$db->Where = "1";
	$result = $db->Select();
	if ($result) {
		foreach ($result as $value) {
			echo '<option value="' . $value['Sub_id'] . '"">' . $value['Sub_id'] . ' ' . $value['Sub_name'] . '</option>';
		}
	}
?>
						</select>
					</div>
					<div class="medium-6 columns">
						<select name="top_id" id="topics">
							<option value="-1">เลือกหมวด</option>
						</select>
					</div>
				</form>
			</div>
			<div class="row stulist">
			<table class="dc_table_s12" summary="Students list" style="width: 100%">
				<thead>
					<tr>
						<th scope="col" style="text-align: center;">รหัสนิสิต</th>
						<th scope="col" style="text-align: center;">ชื่อ</th>
						<th scope="col" style="text-align: center;">สาขา</th>
						<th scope="col" style="text-align: center;">เพศ</th>
						<th scope="col" style="text-align: center;">อีเมล์</th>
						<th scope="col" style="text-align: center;">ดูคำตอบ</th>
					</tr>
				</thead>
				<tbody>
<?php
	$nCount = 0;
	$db->Table = "Student";
	$db->Where = "1";
	$Stu_Data = $db->Select();
	if (count($Stu_Data)) {
		foreach ($Stu_Data as $value) {
?>
					<tr<?php if ($nCount % 2 == 0) echo " class=\"odd\"";?>>
						<th scope="row" style="text-align: center;"><?php echo $value['Stu_id']; ?></th>
						<td style="text-align: center;"><?php echo $value['Stu_name']; ?></td>
						<td style="text-align: center;"><?php echo $value['Stu_major']; ?></td>
						<td style="text-align: center;"><?php echo ($value['Stu_gender'] == "male" ? "ชาย" : ($value['Stu_gender'] == "female" ? "หญิง" : $value['Stu_gender'])); ?></td>
						<td style="text-align: center;"><?php echo $value['Stu_email']; ?></td>
						<td style="text-align: center;"><?php echo "<button id=\"$value[Stu_id]\" class=\"liblue smallbtn\">เลือก</a>"; ?></td>
					</tr>
				</tbody>
<?php
		}
	} else {
		echo '<tr><td colspan="6" style="text-align: center;">ไม่พบรายการนิสิต</td></tr>';
	}
?>
				<tfoot>
					<tr>
						<td style="text-align: left" colspan="6">ทั้งหมด <?php echo count($Stu_Data); ?> รายการ</td>
					</tr>
				</tfoot>
			</table>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#subjects').prop('selectedIndex',0);
			$('#topics').prop('selectedIndex',0);
		});
	</script>