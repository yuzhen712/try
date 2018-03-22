<?php
if( !isset($_GET['aa'])
	|| !isset($_GET['bb'])
	|| !is_numeric($_GET['aa'])
	|| !is_numeric($_GET['bb']) ){
	echo "參數不正確";
	exit;
	
}

$x = $_GET['aa'];
$y = $_GET['bb'];
$z = $x+$y;
echo $y;