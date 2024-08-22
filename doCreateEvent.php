<?php

require_once ('db_connect.php');

if(!isset($_POST["event_name"])){
    echo "請循正常管道進入此頁";
    exit;
}

$event_name = $_POST['event_name'];
$event_type = $_POST['event_type'];
$event_content = $_POST['event_content'];
$event_platform = isset($_POST['event_platform']) ? $_POST['event_platform'] : null;
$individual_or_team = isset($_POST['individual_or_team']) ? $_POST['individual_or_team'] : null;
$apply_start_time = $_POST['apply_start_time'];
$apply_end_time = $_POST['apply_end_time'];
$event_start_time = $_POST['event_start_time'];
$maximum_people = $_POST['maximum_people'];

// Validate input fields
if(empty($event_name) || empty($event_type) || empty($event_content) || empty($event_platform) || empty($individual_or_team) || empty($apply_start_time) || empty($apply_end_time) || empty($event_start_time) || empty($maximum_people)) {
    echo "所有欄位皆為必填";
    exit;
}

$event_picture = '';
if ($_FILES["event_picture"]["error"] == 0) {
    $filename = $_FILES["event_picture"]["name"];
    $fileInfo = pathinfo($filename);
    $extension = $fileInfo["extension"];

    $newFileName = time() . ".$extension";

    if (move_uploaded_file($_FILES["event_picture"]["tmp_name"], "../event_images/" . $newFileName)) {
        $event_picture = $newFileName;
    } else {
        echo "上傳照片失敗";
        exit;
    }
} else {
    echo "活動照片不可為空";
    exit;
}

$now = date('Y-m-d H:i:s');

$sql = "INSERT INTO events (event_name, event_type, event_content, event_platform, individual_or_team, event_picture, apply_start_time, apply_end_time, event_start_time, maximum_people, created_at, valid) VALUES ('$event_name', '$event_type', '$event_content', '$event_platform', '$individual_or_team', '$event_picture', '$apply_start_time', '$apply_end_time', '$event_start_time', '$maximum_people', '$now', 1)";

if($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    // echo "新增活動成功, id為 $last_id";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("Location: events.php?event_id=$event_id");

$conn->close();

?>
