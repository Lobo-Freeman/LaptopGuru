<?php
require_once("db_connect_article.php"); // 确保包含数据库连接

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['pic']) && $_FILES['pic']['error'] == UPLOAD_ERR_OK) {
        $originalFileName = $_FILES['pic']['name'];
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $baseFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
        $timestamp = time();
        $newFileName = $baseFileName . "_" . $timestamp . "." . $fileExtension;
        $target_dir = "article_images/";
        $target_file = $target_dir . $newFileName;

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['pic']['tmp_name'], $target_file)) {
            $now = date('Y-m-d H:i:s'); // Use a full datetime format
            $title = $_POST['title'];
            $article_images_thumbnail = $_POST['article_images_thumbnail']; // 从 POST 获取值

            // Prepare and execute SQL query
            $sql = "INSERT INTO images (title, name, created_at, thumbnail) VALUES (?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('ssss', $title, $newFileName, $now, $article_images_thumbnail);

                if ($stmt->execute()) {
                    echo "上传成功!";
                } else {
                    echo "执行 SQL 错误: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "准备 SQL 错误: " . $conn->error;
            }
        } else {
            echo "文件上传失败!";
        }
    } else {
        echo "没有文件上传或文件上传错误!";
    }

    $conn->close();
}
?>
