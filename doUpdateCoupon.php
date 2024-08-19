<?php
session_start();

if (!isset($_POST['coupon_id'])) {
    header("Location: coupon-list.php");
    exit;
}
require_once "db_connect.php";

$coupon_id = $_POST['coupon_id'];
$coupon_code = $_POST['coupon_code'];
$coupon_content = $_POST['coupon_content'];
$coupon_discount = $_POST['coupon_discount'];
$coupon_start_time = $_POST['coupon_start_time'];
$coupon_end_time = $_POST['coupon_end_time'];


$sql = "UPDATE coupon SET coupon_code = '$coupon_code', coupon_content = '$coupon_content', coupon_discount = '$coupon_discount', coupon_start_time = '$coupon_start_time', coupon_end_time = '$coupon_end_time' WHERE coupon_id = $coupon_id";


if ($conn->query($sql) === TRUE) {
    $_SESSION['update_message'] = "更新成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
};

header("Location: couponEdit.php?id=$coupon_id");

$conn->close();
