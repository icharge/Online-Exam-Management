<?php
// FUNCTIONS
	error_reporting (E_ALL ^ E_NOTICE);
	function DoLogin($u, $p, $db)
	{
		if (isset($u) && isset($p))
		{
			// Login
			$db->Table = "student";
			$db->Where = "Stu_id like binary '$u' and Stu_pwd like binary '$p'";
			$LoginData = $db->Select1();
			if ($LoginData)
			{
				// OK
				//echo "Login successful";
				$_SESSION['user'] = $u;
				$_SESSION['name'] = $LoginData['Stu_name'];
				$_SESSION['pwd'] = $LoginData['Stu_pwd'];
				$_SESSION['major'] = $LoginData['Stu_major'];
				$_SESSION['perm'] = "stu";
				//echo "<br>$_SESSION[user] $_SESSION[name]";
				return true;
			}
			else
			{
				// Wrong
				//echo "Wrong user or password !";
				return false;
			}
		}
		else
		{
			// No u/p
			echo "Please enter user and password.";
			return false;
		}
	}

	function DoLoginT($u, $p, $db)
	{
		if (isset($u) && isset($p))
		{
			// Login
			$db->Table = "teacher";
			$db->Where = "Tea_id like binary '$u' and Tea_pwd like binary '$p'";
			$LoginData = $db->Select1();
			if ($LoginData)
			{
				// OK
				//echo "Login successful";
				$_SESSION['user'] = $u;
				$_SESSION['name'] = $LoginData['Tea_name'];
				$_SESSION['pwd'] = $LoginData['Tea_pwd'];
				$_SESSION['perm'] = "tea";
				//echo "<br>$_SESSION[user] $_SESSION[name]";
				return true;
			}
			else
			{
				// Wrong
				//echo "Wrong user or password !";
				return false;
			}
		}
		else
		{
			// No u/p
			echo "Please enter user and password.";
			return false;
		}
	}

	function checkLogin($db) {
		if ($_SESSION['perm'] == "stu") {
			if (isset($_SESSION['user']) and isset($_SESSION['pwd'])) {
				$db->Table = "student";
				$db->Where = "Stu_id = '$_SESSION[user]' and Stu_pwd = '$_SESSION[pwd]'";
				$data = $db->Select1();
				if ($data) {
					return true;
				} else {
					//header("Location: login.php");
					return false;
				}
			} else {
				//header("Location: login.php");
				return false;
			}
		} elseif ($_SESSION['perm'] == "tea") {
			if (isset($_SESSION['user']) and isset($_SESSION['pwd'])) {
				$db->Table = "teacher";
				$db->Where = "Tea_id = '$_SESSION[user]' and Tea_pwd = '$_SESSION[pwd]'";
				$data = $db->Select1();
				if ($data) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}

	function getTopics($sub_id, $db) {
		require_once('mysql2json.class.php');
		$db->Table = "Topics";
		$db->Where = "Sub_id = '$sub_id'";
		$result = $db->RawSelect($numr);
		$json = new mysql2json();
		$ret = $json->getJSON($result, 2);
		return $ret;
	}

	function showinfo($desc, $btn = "กลับ", $btnimg = "images/back.png", $timeout = -1, $link = "javascript:history.go(-1)") {
		
		$html = '<div class="content">
	<div class="row">
		<div class="large-8 medium-10 medium-centered columns">
			<div class="panel panel2">
				<div style="text-align: center;">
					<img src="images/check.png">
					<h3>'.$desc.'</h3>
					<p></p>
				</div>
			</div>
			<div class="row" style="text-align: center">
				'.($btn != "" ? '<a href="'.$link.'" class="button liblue smallbtn"><img src="'.$btnimg.'" width="16">&nbsp;'.$btn.'</a>' : "").'
			</div>
		</div>
	</div>
</div>';

	if ($timeout >= 0) $html .= '<meta http-equiv="refresh" content="'.$timeout.';'.$link.'">';
	return $html;
}
	function showwarn($desc) {
		$html = <<<EOD
<div class="content">
	<div class="row">
		<div class="large-8 medium-10 medium-centered columns">
			<div class="panel panel2">
				<div style="text-align: center;">
					<img src="images/error.png">
					<h3>$desc</h3>
					<p></p>
				</div>
			</div>
			<div class="row" style="text-align: center">
				<a href="javascript:history.go(-1)" class="button liblue smallbtn"><img src="images/back.png" width="16">&nbsp;กลับ</a>
			</div>
		</div>
	</div>
</div>
EOD;
	return $html;
}
?>