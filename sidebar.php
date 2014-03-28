<?php 
	include("thaidate.php"); ?>
		<div id="sidebar" class="large-4 medium-4 medium-push-8 columns">
			<h2><span>เมนู</span></h2>
			<p>
				<ul class="menu">
					<li><a href="index.php">หน้าแรก</a></li>
<?php
	if (checkLogin($db)) {
		echo '<li><a href="#">แก้ไขข้อมูลส่วนตัว</a></li>';

		if ($_SESSION['perm'] == "stu") {
			echo '<li><a href="index.php#exam">เลือกข้อสอบ</a></li>';
		} elseif ($_SESSION['perm'] == "tea") {
			echo '<li><a href="members-list.php">รายชื่อสมาชิก</a></li>
					<li><a href="search-by-student.php">ผลการสอบของสมาชิก</a></li>
					<li><a href="search-by-subject.php">ผลการสอบตามรายวิชา</a></li>
					<li><a href="search-subjects.php">แสดงข้อสอบ</a></li>
					<li><a href="add-question.php">เพิ่มข้อสอบ</a></li>';
		}
		echo '<li><a href="login.php?logout">ออกจากระบบ</a></li>';
	} else {
		echo '<li><a href="login.php">เข้าสู่ระบบ</a></li>
			<li><a href="register.php">ลงทะเบียน</a></li>';
	}
?>
				</ul>
			</p>
		</div>