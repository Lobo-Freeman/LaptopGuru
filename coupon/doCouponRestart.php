<?php
session_start();
require_once "db_connect.php";

if (!isset($_GET['id'])) {
    header("Location: coupon-list.php");
    exit;
}

$id = $_GET['id'];

$sql = "UPDATE coupon SET valid = 1 WHERE coupon_id = $id";

if ($conn->query($sql) === TRUE) {
    $_SESSION["update_message"] = "啟用成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header("Location:coupon.php?id=$id");
$conn->close();
