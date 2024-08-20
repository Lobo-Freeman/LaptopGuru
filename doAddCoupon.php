<?php
session_start();

require_once "db_connect.php";

if (empty($_POST['coupon_code'])) {
    $_SESSION['error'] = "請輸入優惠券代碼";
    header("Location: coupon-add.php");
    exit;
}

if(empty($_POST['discount_method'])){
    $_SESSION['error'] = "請選擇折扣種類";
    header("Location: coupon-add.php");
    exit;
}

if (empty($_POST['coupon_discount'])) {
    $_SESSION['error'] = "請輸入折扣範圍";
    header("Location: coupon-add.php");
    exit;
}

if (empty($_POST['coupon_start_time'])) {
    $_SESSION['error'] = "請輸入開始時間";
    header("Location: coupon-add.php");
    exit;
}

if (empty($_POST['coupon_end_time'])) {
    $_SESSION['error'] = "請輸入結束時間";
    header("Location: coupon-add.php");
    exit;
}

$coupon_code = $_POST['coupon_code'];
$coupon_content = $_POST['coupon_content'];
$discount_method = $_POST['discount_method'];
$coupon_discount = $_POST['coupon_discount'];
if ($coupon_discount < 0) {
    $_SESSION['error'] = "折扣範圍不可小於0";
    header("Location: coupon-add.php");
    exit;
}
$coupon_start_time = $_POST['coupon_start_time'];
$coupon_end_time = $_POST['coupon_end_time'];




$sql = "INSERT INTO coupon (coupon_code, coupon_content, discount_method, coupon_discount, coupon_start_time, coupon_end_time) VALUES ('$coupon_code', '$coupon_content', '$discount_method', '$coupon_discount', '$coupon_start_time', '$coupon_end_time')";

if ($conn->query($sql) === TRUE) {
    echo "新增成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: coupon-list.php");
