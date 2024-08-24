<?php


require_once("db_connect_article.php");

if (!isset($_POST["article_id"])) {
    header("location: article_edit.php");
    exit;
}


$article_id = $_POST["article_id"];
$article_created_time = $_POST["article_created_time"];
$article_brand = $_POST["article_brand"];
$article_type1 = $_POST["article_type1"];
$article_type2 = $_POST["article_type2"];
$article_type3 = $_POST["article_type3"];
$article_type4 = $_POST["article_type4"];
$article_url_address = $_POST["article_url_address"];
$article_introduction = $_POST["article_introduction"];
$article_images_thumbnail = $_FILES["article_images_thumbnail"];
$article_images_title = $_FILES["article_images_title"];
$article_video_title_url = $_POST["article_video_title_url"];
$article_images_main = $_FILES["article_images_main"];
$article_images_content_1 = $_FILES["article_images_content_1"];
$article_images_content_2 = $_FILES["article_images_content_2"];
$article_images_content_3 = $_FILES["article_images_content_3"];
$article_text = $_POST["article_text"];

// -----------------------------------------------------------------原始圖片改名+儲存 code-----------------------------------------------------------------


// if (isset($_FILES["article_images_thumbnail"]) && $_FILES["article_images_thumbnail"]["error"] == 0) {

//     // article_images_thumbnail
//     $originalFileName = $_FILES["article_images_thumbnail"]["name"];
//     $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//     $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//     $timestamp = time();
//     $newFileName = $baseFileName . "_" . $timestamp . "." . $fileExtension;
//     $target_dir = "article_images/";
//     $target_file = $target_dir . $newFileName;

//     if (move_uploaded_file($_FILES["article_images_thumbnail"]["tmp_name"], $target_file)) {


//         $sql = "UPDATE article_management SET `article_images_thumbnail` = '$target_file' Where article_id = '$article_id'";
//     }
//     $conn->query($sql);
// }

// if (isset($_FILES["article_images_title"]) && $_FILES["article_images_title"]["error"] == 0) {

//     // article_images_thumbnail
//     $originalFileName = $_FILES["article_images_title"]["name"];
//     $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//     $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//     $timestamp = time();
//     $newFileName = $baseFileName . "_" . $timestamp . "." . $fileExtension;
//     $target_dir = "article_images/";
//     $target_file = $target_dir . $newFileName;

//     if (move_uploaded_file($_FILES["article_images_title"]["tmp_name"], $target_file)) {


//         $sql = "UPDATE article_management SET `article_images_title` = '$target_file' Where article_id = '$article_id'";
//     }
//     $conn->query($sql);
// }

// if (isset($_FILES["article_images_main"]) && $_FILES["article_images_main"]["error"] == 0) {

//     // article_images_thumbnail
//     $originalFileName = $_FILES["article_images_main"]["name"];
//     $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//     $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//     $timestamp = time();
//     $newFileName = $baseFileName . "_" . $timestamp . "." . $fileExtension;
//     $target_dir = "article_images/";
//     $target_file = $target_dir . $newFileName;

//     if (move_uploaded_file($_FILES["article_images_main"]["tmp_name"], $target_file)) {

//         $sql = "UPDATE article_management SET `article_images_main` = '$target_file' Where article_id = '$article_id'";
//     }
//     $conn->query($sql);
// }

// if (isset($_FILES["article_images_content_1"]) && $_FILES["article_images_content_1"]["error"] == 0) {

//     // article_images_thumbnail
//     $originalFileName = $_FILES["article_images_content_1"]["name"];
//     $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//     $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//     $timestamp = time();
//     $newFileName = $baseFileName . "_" . $timestamp . "." . $fileExtension;
//     $target_dir = "article_images/";
//     $target_file = $target_dir . $newFileName;

//     if (move_uploaded_file($_FILES["article_images_content_1"]["tmp_name"], $target_file)) {

//         $sql = "UPDATE article_management SET `article_images_content_1` = '$target_file' Where article_id = '$article_id'";
//     }
//     $conn->query($sql);
// }

// if (isset($_FILES["article_images_content_2"]) && $_FILES["article_images_content_2"]["error"] == 0) {

//     // article_images_thumbnail
//     $originalFileName = $_FILES["article_images_content_2"]["name"];
//     $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//     $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//     $timestamp = time();
//     $newFileName = $baseFileName . "_" . $timestamp . "." . $fileExtension;
//     $target_dir = "article_images/";
//     $target_file = $target_dir . $newFileName;

//     if (move_uploaded_file($_FILES["article_images_content_2"]["tmp_name"], $target_file)) {


//         $sql = "UPDATE article_management SET `article_images_content_2` = '$target_file' Where article_id = '$article_id'";
//     }
//     $conn->query($sql);
// }

// if (isset($_FILES["article_images_content_3"]) && $_FILES["article_images_content_3"]["error"] == 0) {

//     // article_images_thumbnail
//     $originalFileName = $_FILES["article_images_content_3"]["name"];
//     $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//     $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//     $timestamp = time();
//     $newFileName = $baseFileName . "_" . $timestamp . "." . $fileExtension;
//     $target_dir = "article_images/";
//     $target_file = $target_dir . $newFileName;

//     if (move_uploaded_file($_FILES["article_images_content_3"]["tmp_name"], $target_file)) {


//         $sql = "UPDATE article_management SET `article_images_content_3` = '$target_file' Where article_id = '$article_id'";
//     }
//     $conn->query($sql);
// }




// if ($conn->query($sql) === TRUE) {
//     echo "更新成功";
// } else {
//     echo "更新資料錯誤: " . $conn->error;
// }

// header("location: article_edit.php?article_id=$article_id");

// -----------------------------------------------------------------原始圖片改名+儲存 code-----------------------------------------------------------------

// -----------------------------------------------------------------更改後的-----------------------------------------------------------------

function handleFileUpload($fileKey, $article_id, $conn)
{
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]["error"] == 0) {
        $originalFileName = $_FILES[$fileKey]["name"];
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
        $timestamp = time();
        $formattedDate = date('Y-m-d', $timestamp);
        $newFileName = $baseFileName . "_" . $formattedDate . "." . $fileExtension;
        $target_dir = "article_images/";
        $target_file = $target_dir . $newFileName;

        if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $target_file)) {
            $sql = "UPDATE article_management SET `$fileKey` = '$target_file' WHERE article_id = '$article_id'";
            $conn->query($sql);
        }
    }
}

$article_id = $_POST["article_id"] ?? null; // 或根据实际情况初始化

// 处理各个上传文件
$uploadKeys = [
    "article_images_thumbnail",
    "article_images_title",
    "article_images_main",
    "article_images_content_1",
    "article_images_content_2",
    "article_images_content_3"
];

foreach ($uploadKeys as $key) {
    handleFileUpload($key, $article_id, $conn);
}

header("location: article_edit.php?article_id=$article_id");
// -----------------------------------------------------------------更改後的-----------------------------------------------------------------

$conn->close();
