<?php
session_start();
require_once "db_connect.php";

if (!isset($_GET['id'])) {
    header("Location: coupon-list.php");
    exit;
}

$id = $_GET['id'];

$sql = "UPDATE coupon SET valid = 0 WHERE coupon_id = $id";

if ($conn->query($sql) === TRUE) {
    $_SESSION["update_message"] = "停用成功";
    header("Location:coupon.php?id=$id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
