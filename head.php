<?php
	error_reporting (E_ALL ^ E_NOTICE);
?><html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/styles.css" type="text/css" />
	<link rel="stylesheet" href="css/jquery-tool.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.10.3.custom.css">
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/jquery.tools.min.js"></script>
	<title><?php echo $pageTitle; ?></title>
</head>
<body>
	<div class="row rowhead">
		<div class="row" style="max-width: 62.5rem; margin: 0 auto;">
			<div id="wheader" class="large-12 columns">
				<div class="large-12">
					<div class="row">
						<div class="large-12 columns"> 
							<div class="large-8 medium-8 columns">
								<a href="index.php">
									<span class="htxt"><?php echo $cfg['title']; ?></span>
									<span class="stxt"><?php echo $cfg['subtitle']; ?></span>
								</a>
							</div>
							<div class="large-4 medium-4 columns">
<?php
	if (checkLogin($db)) {
?>
								<div class="profile">
									<div class="small-3 columns">
										<img src="images/who.jpg">
									</div>
									<div class="small-9 columns">
										<?php echo $_SESSION['name'] . '<br>' . (isset($_SESSION['major']) ? $_SESSION['major'] : ""); ?>
									</div>
								</div>
<?php 
	}
?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
