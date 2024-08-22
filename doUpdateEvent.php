<?php
include("css.php"); 

require_once("db_connect.php");

if(!isset($_POST["event_id"])){
    echo "請循正常管道進入";
    exit();
}




$event_id = $_POST['event_id'];
$event_name = $_POST['event_name'];
$event_type = $_POST['event_type'];
$event_content = $_POST['event_content'];
$event_platform = $_POST['event_platform'];
$individual_or_team = $_POST['individual_or_team'];
$event_picture = $_POST['event_picture'];
$apply_start_time = $_POST['apply_start_time'];
$apply_end_time = $_POST['apply_end_time'];
$event_start_time = $_POST['event_start_time'];
$maximum_people = $_POST['maximum_people'];


if (isset($_FILES["event_picture"]) && $_FILES["event_picture"]["error"] == 0) {
    $filename = $_FILES["event_picture"]["name"];
    $fileInfo = pathinfo($filename);
    $extension = $fileInfo["extension"];
    
    // 生成唯一文件名
    $newFileName = time() . ".$extension";
    
    // 移動上傳的文件到指定目錄
    if (move_uploaded_file($_FILES["event_picture"]["tmp_name"], "../event_images/" . $newFileName)) {
        $event_picture = $newFileName;
    } else {
        echo "上傳照片失敗";
        exit;
    }
} else {
    // 如果沒有上傳新照片，保持原有照片
    $event_picture = $_POST['original_event_picture'] ?? '';  // 使用原來的照片路徑，若無則為空
}


$sql = "UPDATE events SET event_name = '$event_name', event_type = '$event_type', event_content = '$event_content', event_platform = '$event_platform', individual_or_team = '$individual_or_team', event_picture = '$event_picture', apply_start_time = '$apply_start_time', apply_end_time = '$apply_end_time', event_start_time = '$event_start_time', maximum_people = '$maximum_people' WHERE event_id = $event_id";

if($conn->query($sql) === TRUE){
    echo "更新成功 ";
}else{
    echo "更新失敗" . $conn->error;
}

header("Location: event.php?event_id=$event_id");

$conn->close();

?>
