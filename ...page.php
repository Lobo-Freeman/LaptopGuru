<?php
// 連接資料庫
require_once("db_connect_article.php");

// 設定每頁顯示的筆數
$records_per_page = 10;

// 獲取資料總筆數
$sql_total_records = "SELECT COUNT(*) as total FROM article_management";
$result_total = $conn->query($sql_total_records);
$row_total = $result_total->fetch_assoc();
$total_records = $row_total['total'];

// 計算總頁數
$total_pages = ceil($total_records / $records_per_page);

// 獲取當前頁數
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// 計算 LIMIT 起始值
$start_from = ($current_page - 1) * $records_per_page;

// 查詢當前頁面要顯示的資料
$sql = "SELECT * FROM article_management LIMIT $start_from, $records_per_page";
$result = $conn->query($sql);

// 顯示資料（省略部分代碼）

// 顯示分頁
echo '<nav aria-label="Page navigation example">';
echo '<ul class="pagination justify-content-center">';

// 顯示 "Previous" 按鈕
if ($current_page > 1) {
    echo '<li class="page-item">';
    echo '<a class="page-link" href="your_page.php?page='.($current_page - 1).'" tabindex="-1">Previous</a>';
    echo '</li>';
} else {
    echo '<li class="page-item disabled">';
    echo '<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>';
    echo '</li>';
}

// 顯示頁數按鈕
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $current_page) {
        echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
    } else {
        echo '<li class="page-item"><a class="page-link" href="your_page.php?page='.$i.'">'.$i.'</a></li>';
    }
}

// 顯示 "Next" 按鈕
if ($current_page < $total_pages) {
    echo '<li class="page-item">';
    echo '<a class="page-link" href="your_page.php?page='.($current_page + 1).'">Next</a>';
    echo '</li>';
} else {
    echo '<li class="page-item disabled">';
    echo '<a class="page-link" href="#" aria-disabled="true">Next</a>';
    echo '</li>';
}

echo '</ul>';
echo '</nav>';
?>
