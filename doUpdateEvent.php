<?php

require_once("db_connect.php");

if(!isset($_POST["event_id"])){
    die("請循正常管道進入");
}

$event_id = $_POST['event_id'];
$event_name = $_POST['event_name'];
$event_type = $_POST['event_type'];
$event_content = $_POST['event_content'];
$event_platform = $_POST['event_platform'];
$individual_or_team = $_POST['individual_or_team'];
$apply_start_time = $_POST['apply_start_time'];
$apply_end_time = $_POST['apply_end_time'];
$event_start_time = $_POST['event_start_time'];
$maximum_people = $_POST['maximum_people'];

// 處理圖片上傳
if (isset($_FILES["event_picture"]) && $_FILES["event_picture"]["error"] == 0) {
    $filename = $_FILES["event_picture"]["name"];
    $fileInfo = pathinfo($filename);
    $extension = $fileInfo["extension"];
    
    $newFileName = time() . ".$extension";
    
    if (move_uploaded_file($_FILES["event_picture"]["tmp_name"], "../event_images/" . $newFileName)) {
        $event_picture = $newFileName;
    } else {
        die("上傳照片失敗");
    }
} else {
    $event_picture = $_POST['original_event_picture'] ?? '';
}

$sql = "UPDATE events SET 
event_name = ?, event_type = ?, event_content = ?, event_platform = ?, 
individual_or_team = ?, event_picture = ?, apply_start_time = ?, 
apply_end_time = ?, event_start_time = ?, maximum_people = ? 
WHERE event_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssii", $event_name, $event_type, $event_content, 
    $event_platform, $individual_or_team, $event_picture, 
    $apply_start_time, $apply_end_time, $event_start_time, 
    $maximum_people, $event_id);

if ($stmt->execute()) {
    header("Location: event.php?event_id=$event_id");
    exit;
} else {
    die("更新失敗: " . htmlspecialchars($stmt->error));
}

$stmt->close();
$conn->close();
?>