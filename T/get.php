<?php
//輸入=======================================================
$id = $_GET['id'];

//最好檢查一下參數

//資料庫操作===================================================
try {
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	http_response_code(500);
	echo 'failed';
	//echo $err->getMessage(); //測試的時候用
	exit;
}

//查詢
$stmt = $db->prepare('select * from moneybook where m_id=?');
$stmt->execute([$id]);

//輸出=======================================================
$data = NULL;

if($row = $stmt->fetch()){  //只要一筆
	$data = (object)[
			'prod' => $row['name'],
			'price' => $row['cost'],
			'id' => $row['m_id']
		];
}else{
	http_response_code(404);
	echo 'no data';
	exit;
}

http_response_code(200);
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($data);              //把查詢資料回傳給用戶端