<?php
if( !isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id']) )
{
	echo '不對';
	echo '<a href="list.php">回到列表</a>';
	exit;
}

try {
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	echo "ERROR:";
	echo $err->getMessage(); 
	echo '<a href="list.php">回到列表</a>';
	exit;
}

$stmt = $db->prepare('delete from moneybook where m_id=?');
$stmt->execute([$_GET['id']]);

header('Location: list.php',TRUE,303);