<?php
//error_reporting(0);
//�ק� php \ php.ini �� 702 ��
// always_populate_raw_post_data = -1
// �i�H���� $HTTP_RAW_POST_DATA ���ΰT��
// �O�o�n�������}php�κ������A��

//��J=======================================================
//�w�����쪺��Ʈ榡  { prod:"�ӫ~���W��", price:"�� }
$data = json_decode(file_get_contents('php://input'));

//�ˬd�A�����. �Ȯɬٲ�

//��Ʈw�ާ@===================================================
try {
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	http_response_code(500);
	echo 'failed';
	//echo $err->getMessage(); //���ժ��ɭԥ�
	exit;
}

$stmt = $db->prepare('insert into moneybook (name,cost) values (?,?)');
$stmt->execute( [ $data->{"prod"}, $data->{"price"} ] );

//��X=======================================================
$data->{"id"} = $db->lastInsertId();  //���o�e�@�� insert �� id

http_response_code(201);
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($data);              //��insert����ƦA�^�ǵ��Τ��