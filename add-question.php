<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "เพิ่มข้อสอบ - " . $cfg['title'];
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
						opt += '<option value="'+ resp[i].Top_id+'">'+resp[i].Top_name+'</option>';
					}
					$("#topics").html( opt );
				} 
		);
	});

})
</script>
<div id="content" class="large-8 medium-8 medium-pull-4 columns">
			<h1><span>เพิ่มข้อสอบ</span></h1>
			<div class="panel">
				<label>คุณต้องเลือกวิชา และหมวดที่ต้องการเพิ่มโจทย์</label>
				<form id="questfrm" method="post" action="add-question-proc.php">
					<div class="row">
							<div class="medium-6 columns">
								<select name="sub" id="subjects">
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
								<select name="top" id="topics">
									<option value="-1">เลือกหมวด</option>
								</select>
							</div>
					</div>
					<div class="row">
						<div class="medium-12 columns">
							<label for="question">โจทย์</label>
							<!--<input type="text" id="question" name="tquestion">
							<div class="row">
								<div class="medium-6 columns">
									<label for="choice1" class="choice">1) </label>
									<input type="text" id="choice1" name="tchoice1" class="choice">
								</div>
								<div class="medium-6 columns">
									<label for="choice2" class="choice">2) </label>
									<input type="text" id="choice2" name="tchoice2" class="choice">
								</div>
							</div>
							<div class="row">
								<div class="medium-6 columns">
									<label for="choice3" class="choice">3) </label>
									<input type="text" id="choice3" name="tchoice3" class="choice">
								</div>
								<div class="medium-6 columns">
									<label for="choice4" class="choice">4) </label>
									<input type="text" id="choice4" name="tchoice4" class="choice">
								</div>
							</div> -->
							<span class="question"><input type="text" id="question" name="tquestion"></span>
							<label for="">คลิกวงกลมหน้าตัวเลือก สำหรับตัวเลือกที่ถูกต้อง</label>
							<ul class="examcheck">
								<li>
									<input type="radio" name="correct" id="radio1" value="1" class="xcheckbox correct2">
									<label for="radio1" class="xcheckbox-label">1) </label>
									<div class="checkmark"></div>
									<input type="text" id="choice1" name="tchoice1" class="choice">
								</li>
								<li>
									<input type="radio" name="correct" id="radio2" value="2" class="xcheckbox correct2">
									<label for="radio2" class="xcheckbox-label">2) </label>
									<div class="checkmark"></div>
									<input type="text" id="choice2" name="tchoice2" class="choice">
								</li>
								<li>
									<input type="radio" name="correct" id="radio3" value="3" class="xcheckbox correct2">
									<label for="radio3" class="xcheckbox-label">3) </label>
									<div class="checkmark"></div>
									<input type="text" id="choice3" name="tchoice3" class="choice">
								</li>
								<li>
									<input type="radio" name="correct" id="radio4" value="4" class="xcheckbox correct2">
									<label for="radio4" class="xcheckbox-label">4) </label>
									<div class="checkmark"></div>
									<input type="text" id="choice4" name="tchoice4" class="choice">
								</li>
								<li style="display:none;">
									<input type="radio" name="correct" id="radio5" value="5" class="xcheckbox correct2">
									<label for="radio5" class="xcheckbox-label">5) </label>
									<div class="checkmark"></div>
									<input type="text" id="choice5" name="tchoice5" class="choice">
								</li>
							</ul>
							<button type="submit" class="liblue">บันทึกโจทย์</button>
						</div>
					</div>
				</form>
			</div>
		</div>
<?php
	include("footer.php");
