<?php
if(!isset($_GET["id"])){
    echo "請帶入正確id變數";
    exit;
}

$id=$_GET["id"];

require_once("../topics/db_connect.php");
$sql = "SELECT id, images, model, brand, price, created_at FROM rental
where id = '$id'
";
$result = $conn->query($sql);
$laptopCounts = $result->num_rows;
// $rows = $result->fetch_all(MYSQLI_ASSOC);
$row = $result->fetch_assoc(); //一筆資料
var_dump($row);
?>
