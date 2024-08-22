<?php

require_once("db_connect_article.php");

if(!isset($_POST["article_id"])){
    echo "請循正常管道進入此頁";
    exit;
};

$article_id=$_POST["article_id"];
if(empty($article_id)){
    echo "id不能為空";
    exit;
}

$sqlCheck="SELECT * FROM article_management WHERE article_id = '$article_id'";
$result=$conn->query($sqlCheck);
$userCount=$result->num_rows;

if($userCount>0){
    echo "該文章id已存在";
    exit;
}
// echo $userCount;
// exit;

$article_created_time=$_POST["article_created_time"];
if(empty($article_created_time)){
    echo "文章創建日期不能為空";
    exit;
}

$article_brand=$_POST["article_brand"];
if(empty($article_brand)){
    echo "文章品牌不能為空";
    exit;
}

$article_type1=$_POST["article_type1"];
$article_type2=$_POST["article_type2"];
$article_type3=$_POST["article_type3"];
$article_type4=$_POST["article_type4"];

$article_url_address=$_POST["article_url_address"];
if(empty($article_url_address)){
    echo "文章網址不能為空";
    exit;
}

$article_introduction=$_POST["article_introduction"];
if(empty($article_introduction)){
    echo "文章介紹不能為空";
    exit;
}

$article_images_thumbnail=$_FILES["article_images_thumbnail"];
$article_images_title=$_FILES["article_images_title"];
$article_video_title_url=$_POST["article_video_title_url"];
$article_images_main=$_FILES["article_images_main"];
$article_images_content_1=$_FILES["article_images_content_1"];
$article_images_content_2=$_FILES["article_images_content_2"];
$article_images_content_3=$_FILES["article_images_content_3"];


// -------------------------------------------更改儲存圖片的名稱-------------------------------------------
// -------------------------------------------更改儲存圖片的名稱-------------------------------------------
// -------------------------------------------更改儲存圖片的名稱-------------------------------------------


// -------------------------------------我寫的
// if($_FILES["article_images_thumbnail"]["error"]==0){
//     $filename=$_FILES["article_images_thumbnail"]["name"];
//     $fileInfo=pathinfo($filename);
//     $extension=$fileInfo["extension"];
//     // echo $extension;
//     // exit;

//     $newFilename=time().".$extension";

//     if(move_uploaded_file($_FILES["article_images_thumbnail"]["name"], "article_images/.$newFilename")){
//         $sql="INSERT INTO article_management (article_images_thumbnail) VALUES ('$newFilename')";
//         if ($conn->query($sql) === TRUE) {
//             header("location: file-upload.php");
//             exit;
//          } else {
//              echo "Error: " . $sql . "<br>" . $conn->error;
//          }
      
//          echo "upload succss!";
//      }else{
//          echo "upload fail!";
//      }
//     }
// -------------------------------------我寫的

// -------------------------------------chatgpt修正後-------------------------------------
if (isset($_FILES["article_images_thumbnail"]) && $_FILES["article_images_thumbnail"]["error"] == 0) {
    $filename = $_FILES["article_images_thumbnail"]["name"];
    $fileInfo = pathinfo($filename);
    $extension = isset($fileInfo["extension"]) ? $fileInfo["extension"] : 'unknown'; // 确保扩展名存在

    $newFilename = time() . ".$extension";
    $targetFile = "article_images/" . $newFilename;

    if (move_uploaded_file($_FILES["article_images_thumbnail"]["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO article_management (article_images_thumbnail) VALUES ('$newFilename')";


        if ($conn->query($sql) === TRUE) {
            header("Location: article_manange.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Upload failed!";
    }
} else {
    echo "File not uploaded or upload error!";
}
// -------------------------------------chatgpt修正後-------------------------------------

// -------------------------------------------更改儲存圖片的名稱-------------------------------------------
// -------------------------------------------更改儲存圖片的名稱-------------------------------------------
// -------------------------------------------更改儲存圖片的名稱-------------------------------------------



$article_text=$_POST["article_text"];
if(empty($article_text)){
    echo "文章內容不能為空";
    exit;
}

$sql="INSERT INTO article_management (article_id, article_created_time, article_brand, article_type1, article_type2, article_type3, article_type4, article_url_address, article_introduction, article_images_thumbnail, article_images_title, article_video_title_url, article_images_main, article_images_content_1, article_images_content_2, article_images_content_3, article_text) VALUES ('$article_id', '$article_created_time', '$article_brand','$article_type1','$article_type2','$article_type3','$article_type4', '$article_url_address', '$article_introduction', '$article_images_thumbnail', '$article_images_title', '$article_video_title_url', '$article_images_main', '$article_images_content_1', '$article_images_content_2', '$article_images_content_3', '$article_text')";

// echo $sql;
// exit;

if ($conn->query($sql) === TRUE){
    $last_id=$conn->insert_id;
    echo "新資料輸入成功";
}else {
    echo "Error:" . $sql . "<br>" . $conn->error;
}

$conn->close();
