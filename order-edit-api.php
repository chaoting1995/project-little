<?php
require __DIR__ . '/parts/__connect_db.php';
// require __DIR__ . '/parts/__admin_required.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

// TODO: 檢查資料格式
// email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
// mobile_pattern = /^09\d{2}-?\d{3}-?\d{3}$/;

// if (empty($_POST['sid'])) {
//     $output['code'] = 405;
//     $output['error'] = '沒有 sid';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }

// if (mb_strlen($_POST['name']) < 2) {
//     $output['code'] = 410;
//     $output['error'] = '姓名長度要大於 2';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }

// if (!preg_match('/^09\d{2}-?\d{3}-?\d{3}$/', $_POST['mobile'])) {
//     $output['code'] = 420;
//     $output['error'] = '手機號碼格式錯誤';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }


$sql = "UPDATE `order_manage` SET 
    `name`=?,
    `email`=?,
    `mobile`=?,
    `birthday`=?,
    `order_time`=?,
    `order_price`=?,
    `take_date`=?,
    `take_time`=?,
    `order_address`=?
    WHERE `sid`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['name'],
    $_POST['email'],
    $_POST['mobile'],
    $_POST['birthday'],
    $_POST['order_time'],
    $_POST['order_price'],
    $_POST['take_date'],
    $_POST['take_time'],
    $_POST['order_address'],
    $_POST['sid'],

]);

if ($stmt->rowCount()) {
    $output['success'] = true;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
