<?php

require_once("db_connect_article.php");

if(!isset($_GET["article_id"])){
    echo "請循正常管道進入此頁";
    exit;
}
$article_id=$_GET["article_id"];

$sql="DELETE FROM article_management WHERE article_id = $article_id";

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();

header("location: article_manange.php");