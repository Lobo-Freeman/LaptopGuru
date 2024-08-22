<?php

require_once("db_connect.php");

if (!isset($_GET["id"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$id = $_GET["id"];
$sql = "SELECT id, images, model, brand, price, num, created_at FROM rental
where id = '$id' and state='available'
";
$sql = "UPDATE rental SET state = 'No' WHERE id=$id";


if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
   } else {
    echo "刪除錯誤: " . $conn->error;
   }

header("location: rental_form.php");

?>

<?php
$conn->close();
?>
