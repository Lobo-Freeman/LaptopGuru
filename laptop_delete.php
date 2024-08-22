<?php
require_once("db_connect.php");

if (!isset($_POST["id"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$id = $_POST["id"];

$sql = "DELETE FROM rental WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

header("Location: rental_form.php");
exit;

$conn->close();
?>
