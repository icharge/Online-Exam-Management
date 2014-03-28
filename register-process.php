<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "หน้าแรก - " . $cfg['title'];
	
	include("head.php");
	include("sidebar.php");
	echo '		<div id="content" class="large-8 medium-8 medium-pull-4 columns">';

	$tStu_id = trim(($_POST['student-id'] ? $_POST['student-id'] : ""));
	if (!is_numeric($tStu_id)) {
		echo (showwarn("รหัสนิสิตเป็นตัวเลขเท่านั้น"));
	} else {
		$tStu_name = trim(($_POST['student-name'] ? $_POST['student-name'] : "")) . " " . trim(($_POST['student-surn'] ? $_POST['student-surn'] : ""));
		$tStu_email = trim(($_POST['student-email'] ? $_POST['student-email'] : ""));
		$tStu_major = trim(($_POST['student-major'] ? $_POST['student-major'] : ""));
		$pwd = ($_POST['student-pwd'] ? $_POST['student-pwd'] : "");
		$pwdcfm = ($_POST['student-pwdcfm'] ? $_POST['student-pwdcfm'] : "");
		$tStu_pwd = ($pwd == $pwdcfm ? $pwd : "");
		$tStu_gender = ($_POST['student-gender'] ? $_POST['student-gender'] : "");

		// Check empty !
		if (!($tStu_id == "" or $tStu_name == "" or $tStu_email == "" or $tStu_major == "" or 
			$pwd == "" or $pwdcfm == "" or $tStu_gender == "")) {
			if ($pwd == $pwdcfm) {
				// OK
				$db->Table = "student";
				$db->Where = "Stu_id = '$tStu_id'";
				$checkuser = $db->Select1();
				if ($checkuser) {
					echo showwarn("ชื่อผู้ใช้นี้มีอยู่ในระบบแล้ว");
				} else {
					$db->Table = "student";
					$db->Field = "Stu_id, Stu_name, Stu_pwd, Stu_major, Stu_gender, Stu_email";
					$db->Value = "'$tStu_id', '$tStu_name', '$tStu_pwd', '$tStu_major', '$tStu_gender', '$tStu_email'";
					$db->Insert();

					echo showinfo("สมัครสมาชิกเรียบร้อย","ดำเนินต่อ","images/forward.png", 3, "login.php");
				}
			} else {
				// Not matched password
				echo showwarn("โปรดยืนยันรหัสผ่านใหม่อีกครั้ง");
			}
		
		} else {
			echo showwarn("กรอกข้อมูลไม่ครบ");
		}
	}
	echo '</div>';
	include("footer.php");