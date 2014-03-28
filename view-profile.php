<?php
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");
	$pageTitle = "ข้อมูลส่วนตัว - " . $cfg['title'];
	include("head.php");
	include("sidebar.php");

	echo '		<div id="content" class="large-8 medium-8 medium-pull-4 columns">';
?>
			<h1><span>ข้อมูลส่วนตัว</span></h1>
			<div class="panel">
				<div class="row">
					<form id="profilefrm" method="post" action="">
						<div class="medium-6 columns">
							<img src="sdasd" width="444">
						</div>
						<div class="medium-6 columns">
							<label for="studentid">รหัสนิสิต</label>
							<input type="text" id="studentid" name="tstudentid">
							<label for="txt2">Text2</label>
							<input type="text" id="txt2" name="txt2">
							<label for="txt3">Text3</label>
							<input type="text" id="txt3" name="txt3">
							<label for="txt4">Text4</label>
							<input type="text" id="txt4" name="txt4">
							<label for="txt5">Text5</label>
							<input type="text" id="txt5" name="txt5">
							<label for="txt6">Text6</label>
							<input type="text" id="txt6" name="txt6">
						</div>
					</form>
				</div>
			</div>
<?php include("footer.php");