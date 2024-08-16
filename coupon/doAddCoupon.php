<?php

require_once "db_connect.php";

if(!isset($_POST['coupon_code'])){
    echo "請輸入優惠券代碼";
    exit;
}

if(!isset($_POST['coupon_discount'])){
    echo "請輸入折扣金額";
    exit;
}
if(!isset($_POST['coupon_start_time'])){
    echo "請輸入開始時間";
    exit;
}
if(!isset($_POST['coupon_end_time'])){
    echo "請輸入結束時間";
    exit;
}

$coupon_code = $_POST['coupon_code'];
$coupon_content = $_POST['coupon_content'];
$coupon_discount = $_POST['coupon_discount'];
$coupon_start_time = $_POST['coupon_start_time'];
$coupon_end_time = $_POST['coupon_end_time'];



$sql = "INSERT INTO coupon (coupon_code, coupon_content, coupon_discount, coupon_start_time, coupon_end_time) VALUES ('$coupon_code', '$coupon_content', '$coupon_discount', '$coupon_start_time', '$coupon_end_time')";

if ($conn->query($sql) === TRUE) {
    echo "新增成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: coupon-list.php");