<?php


$records_per_page = 10;
$sql_total_records = "SELECT COUNT(*) as total FROM article_management";
$result_total = $conn->query($sql_total_records);
$row_total = $result_total->fetch_assoc();
$total_records = $row_total['total'];
$total_pages = ceil($total_records / $records_per_page);
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($current_page - 1) * $records_per_page;
$sql = "SELECT * FROM article_management LIMIT $start_from, $records_per_page";
$result = $conn->query($sql);

// 顯示資料（省略部分代碼）



// 顯示分頁
echo '<nav aria-label="Page navigation example">';
echo '<ul class="pagination justify-content-center">';


if ($current_page > 1) {
    echo '<li class="page-item">';
    echo '<a class="page-link" href="your_page.php?page='.($current_page - 1).'" tabindex="-1">Previous</a>';
    echo '</li>';
} else {
    echo '<li class="page-item disabled">';
    echo '<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>';
    echo '</li>';
}

for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $current_page) {
        echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
    } else {
        echo '<li class="page-item"><a class="page-link" href="your_page.php?page='.$i.'">'.$i.'</a></li>';
    }
}


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
