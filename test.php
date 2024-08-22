<?php
require_once("db_connect_article.php"); // 确保包含数据库连接

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


?>
