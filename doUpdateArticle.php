<?php

require_once("db_connect_article.php");

if (!isset($_POST["title"])) {
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


// echo "<pre>";
// print_r($_POST);
// print_r($_FILES);
// echo "</pre>";
// exit;


if (isset($_FILES["article_images_thumbnail"]) && $_FILES["article_images_thumbnail"]["error"] == 0) {
    $originalFileName = $_FILES["article_images_thumbnail"]["name"];
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
    $timestamp = time();
    $newFileName = $baseFileName . "_" . $timestamp . "." . $fileExtension;
    $target_dir = "article_images/";
    $target_file = $target_dir . $newFileName;

    if (move_uploaded_file($_FILES["article_images_thumbnail"]["tmp_name"], $target_file)) {
        $article_images_thumbnail = $_POST['article_images_thumbnail']; // 确保从 POST 中获取标题

        $sql = "INSERT INTO article_management (article_images_thumbnail) VALUES ($target_file)";
    }
echo "<pre>";
print_r($_FILES);
echo "</pre>";

// //pic要改喔對應 edit 的 name 
// if($_FILES["pic"]["error"]==0){
//     if(move_uploaded_file($_FILES["pic"]["tmp_name"], "article_images/" . $_FILES["pic"]["tmp_name"])){
//         $sql="UPDATE article_management (article_id, article_created_time, article_brand, article_type1, article_type2, article_type3, article_type4, article_url_address, article_introduction, article_images_thumbnail, article_images_title, article_video_title_url, article_images_main, article_images_content_1, article_images_content_2, article_images_content_3, article_text) VALUES ('$article_id', '$article_created_time', '$article_brand','$article_type1','$article_type2','$article_type3','$article_type4', '$article_url_address', '$article_introduction', '$article_images_thumbnail', '$article_images_title', '$article_video_title_url', '$article_images_main', '$article_images_content_1', '$article_images_content_2', '$article_images_content_3', '$article_text' WHERE article_id='$article_id')";

//         echo "upload success!";
//     }else{
//         echo "upload failed!";
//     }
// }



// $target_dir = "article_images/";
// $article_images_thumbnail = $article_images_title = $article_images_main = $article_images_content_1 = $article_images_content_2 = $article_images_content_3 = "";

// foreach (['article_images_thumbnail', 'article_images_title', 'article_images_main', 'article_images_content_1', 'article_images_content_2', 'article_images_content_3'] as $image_key) {
//     if (isset($_FILES[$image_key]) && $_FILES[$image_key]['error'] == UPLOAD_ERR_OK) {
//         $file_tmp_name = $_FILES[$image_key]['tmp_name'];
//         $file_name = basename($_FILES[$image_key]['name']);
//         $target_file = $target_dir . $file_name;

//         if (move_uploaded_file($file_tmp_name, $target_file)) {
//             $$image_key = $file_name;
//         } else {
//             echo "檔案上傳失敗: " . $_FILES[$image_key]['name'];
//             exit;
//         }
//     }
// }

// $sql = "UPDATE article_management SET 
// article_created_time='$article_created_time', 
// article_brand='$article_brand', 
// article_type1='$article_type1', 
// article_type2='$article_type2', 
// article_type3='$article_type3', 
// article_type4='$article_type4',  
// article_url_address='$article_url_address', 
// article_introduction='$article_introduction', 
// article_images_thumbnail='$article_images_thumbnail', 
// article_images_title='$article_images_title', 
// article_video_title_url='$article_video_title_url', 
// article_images_main='$article_images_main', 
// article_images_content_1='$article_images_content_1', 
// article_images_content_2='$article_images_content_2', 
// article_images_content_3='$article_images_content_3', 
// article_text='$article_text' 
// WHERE article_id='$article_id'";

// echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

// header("location: article_edit.php?article_id=$article_id");

$conn->close();
}