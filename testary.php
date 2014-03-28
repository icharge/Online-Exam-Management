<?php
	$ary = array(
		'test' => 'TesT');
	echo $ary['test'];
	if (!isset($ary['aa'])) $ary['aa'] = "AA";
	var_dump($ary);
?>