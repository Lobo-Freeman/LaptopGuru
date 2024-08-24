<?php
session_start();

require_once("db_connect_article.php");

// echo $userCount;
// exit;

$article_created_time = $_POST["article_created_time"];
if (empty($article_created_time)) {
    $_SESSION["error"] = "文章創建時間不能為空";
    header("Location: article_add.php");
    exit;
}

$article_brand = $_POST["article_brand"];
if (empty($article_brand)) {
    $_SESSION["error"] =  "文章品牌不能為空";
    header("Location: article_add.php");

    exit;
}

$article_type1 = $_POST["article_type1"];
$article_type2 = $_POST["article_type2"];
$article_type3 = $_POST["article_type3"];
$article_type4 = $_POST["article_type4"];

$article_url_address = $_POST["article_url_address"];
if (empty($article_url_address)) {
    $_SESSION["error"] =  "文章網址不能為空";
    header("Location: article_add.php");

    exit;
}

$article_introduction = $_POST["article_introduction"];
if (empty($article_introduction)) {
    $_SESSION["error"] =  "文章介紹不能為空";
    header("Location: article_add.php");

    exit;
}


$article_text = $_POST["article_text"];


$article_images_thumbnail = $_FILES["article_images_thumbnail"];
$article_images_title = $_FILES["article_images_title"];
$article_video_title_url = $_POST["article_video_title_url"];
$article_images_main = $_FILES["article_images_main"];
$article_images_content_1 = $_FILES["article_images_content_1"];
$article_images_content_2 = $_FILES["article_images_content_2"];
$article_images_content_3 = $_FILES["article_images_content_3"];
$article_created_year = date("Y", strtotime($article_created_time));





// -------------------------------------------更改儲存圖片的名稱-------------------------------------------
// -------------------------------------------更改儲存圖片的名稱-------------------------------------------
// -------------------------------------------更改儲存圖片的名稱-------------------------------------------



if (isset($_FILES["article_images_thumbnail"]) && $_FILES["article_images_thumbnail"]["error"] == 0) {

    // article_images_thumbnail
    $originalFileName = $_FILES["article_images_thumbnail"]["name"];
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
    $timestamp = time();
    $formattedDate = date('Y-m-d', $timestamp);
    $newFileName = $baseFileName . "_" . $formattedDate . "." . $fileExtension;
    $target_dir = "article_images/";
    $target_file_thumbnail = $target_dir . $newFileName;

    if (move_uploaded_file($_FILES["article_images_thumbnail"]["tmp_name"], $target_file_thumbnail)) {
        echo "The file " . htmlspecialchars(basename($_FILES["article_images_thumbnail"]["name"])) . " has been uploaded.";
        $sql = "INSERT INTO article_management (article_created_time, article_created_year, article_brand, article_type1, article_type2, article_type3, article_type4, article_url_address, article_introduction, article_video_title_url, article_text, article_images_thumbnail) VALUES ('$article_created_time', '$article_created_year', '$article_brand','$article_type1','$article_type2','$article_type3','$article_type4', '$article_url_address', '$article_introduction', '$article_video_title_url', '$article_text','$target_file_thumbnail')";
    }

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "新資料輸入成功";
        echo '<br><br><a href="article_manange.php?page=1" class="btn btn-outline-secondary">返回主頁</a>';
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "INSERT INTO article_management (article_created_time, article_created_year, article_brand, article_type1, article_type2, article_type3, article_type4, article_url_address, article_introduction, article_video_title_url, article_text) VALUES ('$article_created_time', '$article_created_year', '$article_brand','$article_type1','$article_type2','$article_type3','$article_type4', '$article_url_address', '$article_introduction', '$article_video_title_url', '$article_text')";


    // echo $sql;
    // exit;

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "新資料輸入成功";
        echo '<br><br><a href="article_manange.php?page=1" class="btn btn-outline-secondary">返回主頁</a>';
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}

// if (isset($_FILES["article_images_title"]) && $_FILES["article_images_title"]["error"] == 0) {

//     // article_images_thumbnail
//     $originalFileName = $_FILES["article_images_title"]["name"];
//     $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//     $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//     $timestamp = time();
//     $formattedDate = date('Y-m-d', $timestamp);
//     $newFileName = $baseFileName . "_" . $formattedDate . "." . $fileExtension;
//     $target_dir = "article_images/";
//     $target_file_title = $target_dir . $newFileName;

//     if (move_uploaded_file($_FILES["article_images_title"]["tmp_name"], $target_file_title)) {


//         // $sql = "INSERT INTO article_images (article_images_title) VALUES ('$target_file_title')";
//         // $conn->query($sql);
//         echo "The file " . htmlspecialchars(basename($_FILES["article_images_title"]["name"])) . " has been uploaded.";
//     }
// }

// if (isset($_FILES["article_images_main"]) && $_FILES["article_images_main"]["error"] == 0) {

//     // article_images_thumbnail
//     $originalFileName = $_FILES["article_images_main"]["name"];
//     $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//     $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//     $timestamp = time();
//     $formattedDate = date('Y-m-d', $timestamp);
//     $newFileName = $baseFileName . "_" . $formattedDate . "." . $fileExtension;
//     $target_dir = "article_images/";
//     $target_file_main = $target_dir . $newFileName;

//     if (move_uploaded_file($_FILES["article_images_main"]["tmp_name"], $target_file_main)) {


//         // $sql = "INSERT INTO article_images (article_images_main) VALUES ('$target_file_main')";
//         // $conn->query($sql);
//         echo "The file " . htmlspecialchars(basename($_FILES["article_images_main"]["name"])) . " has been uploaded.";
//     }
// }

// if (isset($_FILES["article_images_content1"]) && $_FILES["article_images_content1"]["error"] == 0) {

//     // article_images_thumbnail
//     $originalFileName = $_FILES["article_images_content1"]["name"];
//     $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//     $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//     $timestamp = time();
//     $formattedDate = date('Y-m-d', $timestamp);
//     $newFileName = $baseFileName . "_" . $formattedDate . "." . $fileExtension;
//     $target_dir = "article_images/";
//     $target_file_content1 = $target_dir . $newFileName;

//     if (move_uploaded_file($_FILES["article_images_content1"]["tmp_name"], $target_file_content1)) {


//         // $sql = "INSERT INTO article_images (article_images_content1) VALUES ('$target_file_content1')";
//         // $conn->query($sql);
//         echo "The file " . htmlspecialchars(basename($_FILES["article_images_content1"]["name"])) . " has been uploaded.";
//     }
// }

// if (isset($_FILES["article_images_content2"]) && $_FILES["article_images_content2"]["error"] == 0) {

//     // article_images_thumbnail
//     $originalFileName = $_FILES["article_images_content2"]["name"];
//     $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//     $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//     $timestamp = time();
//     $formattedDate = date('Y-m-d', $timestamp);
//     $newFileName = $baseFileName . "_" . $formattedDate . "." . $fileExtension;
//     $target_dir = "article_images/";
//     $target_file_content2 = $target_dir . $newFileName;

//     if (move_uploaded_file($_FILES["article_images_content2"]["tmp_name"], $target_file_content2)) {


//         // $sql = "INSERT INTO article_images (article_images_content2) VALUES ('$target_file_content2')";
//         // $conn->query($sql);
//         echo "The file " . htmlspecialchars(basename($_FILES["article_images_content2"]["name"])) . " has been uploaded.";
//     }
// }

// if (isset($_FILES["article_images_content3"]) && $_FILES["article_images_content1"]["error"] == 0) {

//     // article_images_thumbnail
//     $originalFileName = $_FILES["article_images_content3"]["name"];
//     $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//     $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//     $timestamp = time();
//     $formattedDate = date('Y-m-d', $timestamp);
//     $newFileName = $baseFileName . "_" . $formattedDate . "." . $fileExtension;
//     $target_dir = "article_images/";
//     $target_file_content3 = $target_dir . $newFileName;

//     if (move_uploaded_file($_FILES["article_images_content3"]["tmp_name"], $target_file_content3)) {


//         // $sql = "INSERT INTO article_images (article_images_content3) VALUES ('$target_file_content3')";
//         // $conn->query($sql);
//         echo "The file " . htmlspecialchars(basename($_FILES["article_images_content3"]["name"])) . " has been uploaded.";
//     }
// }


// function handleFileUpload($fileKey, $article_id, $conn) {
//     if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]["error"] == UPLOAD_ERR_OK) {
//         $originalFileName = $_FILES[$fileKey]["name"];
//         $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//         $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
//         $timestamp = time();
//         $formattedDate = date('Y-m-d', $timestamp);
//         $newFileName = $baseFileName . "_" . $formattedDate . "." . $fileExtension;
//         $target_dir = "article_images/";
//         $target_file = $target_dir . $newFileName;

//         if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $target_file)) {
//             // Use UPDATE to modify an existing record
//             $sql = "UPDATE article_management SET `$fileKey` = ? WHERE article_id = ?";

//             // Prepare statement
//             if ($stmt = $conn->prepare($sql)) {
//                 $stmt->bind_param("si", $target_file, $article_id);
//                 $stmt->execute();
//                 $stmt->close();
//             } else {
//                 echo "Error preparing statement: " . $conn->error;
//             }
//         }
//     }
// }

// // Call handleFileUpload for each file key
// $keys = [
//     "article_images_thumbnail",
//     "article_images_title",
//     "article_images_main",
//     "article_images_content1",
//     "article_images_content2",
//     "article_images_content3"
// ];

// foreach ($keys as $key) {
//     handleFileUpload($key, $article_id, $conn);
// }





header("Location: article_manange.php?page=1");

$conn->close();
