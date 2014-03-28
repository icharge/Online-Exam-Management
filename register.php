<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "ลงทะเบียน - " . $cfg['title'];
	
	include("head.php");
	include("sidebar.php");
/*
<label for="student-id">รหัสนิสิต</label>
						<input type="text" name="student-id">
						<div class="row">
							<div class="medium-6 columns">
								<label for="student-name">ชื่อ</label>
								<input type="text" name="student-name">
							</div>
							<div class="medium-6 columns">
								<label for="student-surn">สกุล</label>
								<input type="text" name="student-surn">
							</div>
						</div>
						
						<label for="student-email">อีเมล์</label>
						<input type="text" name="sutdent-email">
						<label for="student-pwd">รหัสผ่าน</label>
						<input type="password" name="student-pwd">
						<label for="student-pwdcfm">ยืนยันรหัสผ่าน</label>
						<input type="password" name="student-pwdcfm">
						<label for="student-gender">เพศ</label>
						<select name="student-gender" id="student-gender">
							<option value="male">ชาย</option>
							<option value="female">หญิง</option>
						</select>
*/


?>
	<script type="text/javascript">
	$(function(){
		$.validator.addMethod("usernameNotExists", function(username) {
        var result = $.ajax({
            url: getUrl("checkuser.php"),
            data: {username: username},
            async: false,
            type: "GET"
        }).responseText;
        return result == '1';
    }, "ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว");
	});

	$('#stuid_warn').validate({
        onkeyup: false,
        onchange: true,
        rules: {
            username: {
                required: true,
                usernameNotExists: true
            }
        },
        messages: {
            username: {
                required: "กรุณากรอกชือผู้ใช้"
            }
        }
    });
	</script>
		<div id="content" class="large-8 medium-8 medium-pull-4 columns">
			<h1><span>ลงทะเบียน</span></h1>
			<p>แบบฟอร์มลงทะเบียน</p>
			<form id="register" autocomplete="on" method="post" action="register-process.php">
				<div class="row">
					<div class="medium-7 columns">
						<input type="text" id="student-id" name="student-id" placeholder="รหัสนิสิต">
						<div id="stuid_warn" class="hidden" style="top: 19px;">มีผู้ใช้นี้แล้ว</div>
						<div class="row">
							<div class="medium-6 columns">
								<input type="text" name="student-name" placeholder="ชื่อ">
							</div>
							<div class="medium-6 columns">
								<input type="text" name="student-surn" placeholder="สกุล">
							</div>
						</div>
						<input type="email" id="student-email" name="student-email" placeholder="อีเมล์">
						<input type="password" name="student-pwd" placeholder="รหัสผ่าน">
						<input type="password" name="student-pwdcfm" placeholder="ยืนยันรหัสผ่าน">
						<input type="text" name="student-major" placeholder="สาขา">
						<input type="radio" name="student-gender" id="student-g-male" value="male"><label for="student-g-male">ชาย</label>
						<input type="radio" name="student-gender" id="student-g-female" value="female"><label for="student-g-female">หญิง</label>
					</div>
				</div>
				<div class="row">
					<div class="medium-7 columns">
						<button type="submit" id="btnsubmit" class="liblue">สมัครสมาชิก</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php include("footer.php");