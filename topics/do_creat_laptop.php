<?php

require_once("../topics/db_connect.php");

if(!isset($_POST["model"])){
    echo"請循正常管道進入此頁";
    exit;
}

$model = $_POST["model"];
$images=$_POST["images"];
$brand = $_POST["brand"];
$price = $_POST["price"];
$num = $_POST["num"];
$state=$_POST["state"];
$created_at= date('Y-m-d H:i:s');

$images = "";
if (isset($_FILES["images"]) && $_FILES["images"]["error"] == 0) {
    $target_dir = "../topics/image/";
    $target_file = $target_dir . basename($_FILES["images"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // 檢查檔案大小和類型
    if ($_FILES["images"]["size"] > 500000) {
        echo "檔案太大.";
        exit;
    }
    // 上傳檔案
    if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
        $images = basename($_FILES["images"]["name"]);
    } else {
        echo "檔案上傳錯誤.";
        exit;
    }
}


$sql = "INSERT INTO rental (model,images, brand, price, num, state, created_at)
VALUES ('$model', '$images', '$brand', '$price', '$num', 'available', '$created_at');";

// 檢查型號是否存在
$sqlCheck = "SELECT * FROM rental WHERE model = '$model'";
$result = $conn->query($sqlCheck);
$modelCount = $result->num_rows;

if($modelCount > 0){
   echo "此型號已存在";
   exit;
}
// 以上

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "創建成功";
   } else {
    echo "創建失敗: " . $conn->error;
   }


header("location: rental_form.php");
?>

<?php
$conn->close();
?>

