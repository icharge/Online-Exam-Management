<?php
	// Login Module
	session_start();
	require_once("config.php");
	include("db.php");
	include("functions.php");

	$pageTitle = "เข้าสู่ระบบ - " . $cfg['title'];
	$errMsg = "";
	// Get User/Pass
	$tuser = (isset($_POST['auser']) ? addslashes($_POST['auser']) : "");
	$tpwd = (isset($_POST['apass']) ? addslashes($_POST['apass']) : "");
	if (isset($_REQUEST['logout'])) {
		session_destroy();
		//echo "Logged out.";
		header('Location: index.php');
	} else {
		if ($tuser != "" or $tpwd != "") {
			// Checking
			if (DoLoginT($tuser, $tpwd, $db)) {
				//echo "<br>OK";
				header('Location: index.php');
			} else {
				//echo "<br>Fail";
				$errMsg = "ชื่อหรือผู้ใช้ไม่ถูกต้อง";
			}
		}

		// Check Login
		if (checkLogin($db)) {
			header('Location: index.php');
		}

		// Login PAGE
		include("head.php");
		include("sidebar.php");
?>
<script type="text/javascript">
$(function(){
	$("#tUser").focus();
});
</script>
			<div id="content" class="large-8 medium-8 medium-pull-4 columns">
				<div class="row">
					<div class="medium-7 medium-centered columns" style="height:100%">
						<h1><span>เข้าสู่ระบบ (อาจารย์)</span></h1>
						<div class="loginbox">
							<img src="images/secure.png"><?php
	if ($errMsg != "") echo '<br><span class="label alert">' . $errMsg . '</span><br><br>';
?>
							<form name="loginf" method="post" action="">
								<input type="text" id="aUser" name="auser" placeholder="Username">
								<input type="Password" id="aPwd" name="apass" placeholder="Password">
								<button type="submit" class="liblue subjectbtn">Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
<?php
	}
	include("footer.php");
?>