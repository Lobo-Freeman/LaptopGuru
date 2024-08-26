<?php
if (!isset($_POST["model"])) {
    echo "請循正常管道進入此頁";
    exit;
}

require_once("../topics/db_connect.php");

$id = $_POST["id"];
$original_images = $_POST["original_images"];
$images=$_POST["images"]; //new
$model = $_POST["model"];
$brand = $_POST["brand"];
$price = $_POST["price"];
$num = $_POST["num"];
$created_at = date('Y-m-d H:i:s');



// 檢查是否上傳新圖片
if (isset($_FILES["images"]) && $_FILES["images"]["error"] == 0) {
    $filename = $_FILES["images"]["name"];
    $fileInfo = pathinfo($filename);
    $extension = $fileInfo["extension"];
    
    // 生成唯一文件名
    $newFileName = time() . ".$extension";
    
    // 確保上傳目錄存在
    // $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/topics/image/";
    $uploadDir = "../topics/image/";
    
    // 移動上傳的文件到指定目錄
    if (move_uploaded_file($_FILES["images"]["tmp_name"], $uploadDir . $newFileName)) {
        $event_picture = $newFileName; // 新上傳的圖片
        
    } else {
        echo "上傳照片失敗";
        exit;
    }
} else {
    // 沒有上傳新圖片，使用原本圖片
    $event_picture = $original_images;
}


echo "接收到的品牌是： " . $brand;


// SQL 更新語句
// $sql = "UPDATE rental SET images='$event_picture', model='$model', brand='$brand', price='$price', created_at='$created_at' WHERE id='$id'";

$sql = "UPDATE rental SET images='$event_picture', model='$model', brand='$brand', price='$price', num='$num', created_at='$created_at' WHERE id='$id'";


if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新錯誤: " . $conn->error;
}

header("location: laptop_edit.php?id=$id");

$conn->close();
?>
