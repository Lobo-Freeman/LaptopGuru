<?php

require_once("db_connect_article.php");

if (!isset($_GET['page'])) {
    header("Location:article_manange.php?page=1");
    exit;
}

$sql = "SELECT * FROM article_management";
$result = $conn->query($sql);
$articleCount = $result->num_rows;


// ---------------------------------分頁功能---------------------------------
$records_per_page = 10;
$sql_total_records = "SELECT COUNT(*) as total FROM article_management";
$result_total = $conn->query($sql_total_records);
$row_total = $result_total->fetch_assoc();
$total_records = $row_total['total'];
// ceil 會取整數，用來取頁數
$total_pages = ceil($total_records / $records_per_page);
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($current_page - 1) * $records_per_page;
// 取頁數 LIMIT 起始筆數->結束筆數
$sql = "SELECT * FROM article_management LIMIT $start_from, $records_per_page";
$result = $conn->query($sql);

// 1. 設定每頁有幾筆資料
// 2. 設定變數儲存 sql 查詢到的資料筆數
// 3. 將結果取出來做關聯式陣列
// 4. 獲取當前頁數，設置頁數，如果沒有就將頁數設為 1 $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
// 5. 計算起始紀錄位置
// 6. 查詢當前頁面的紀錄

$prev_page = $current_page - 1;
$next_page = $current_page + 1;

if ($next_page > $total_pages) {
    $next_page = $total_pages;
}

if ($prev_page < 1) {
    $prev_page = 1;
}


// ---------------------------------分頁功能---------------------------------


// ---------------------------------搜尋功能---------------------------------


// 檢查是否設置了 'Search' 參數
$searchOutput = ''; // 用來存儲搜尋結果的變數

if (isset($_GET['Search'])) {
    $searchResult = $_GET['Search'];
    // 防止 SQL 注入攻擊
    $searchTerm = $conn->real_escape_string($searchResult);

    // 正確的 SQL 語句
    $sql = "SELECT * FROM article_management WHERE article_id LIKE '$searchTerm%' OR article_type1 LIKE '$searchTerm%' OR title LIKE '__$searchTerm%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 使用變數來儲存結果
        while ($row = $result->fetch_assoc()) {
            $searchOutput .= "<p>Title: " . htmlspecialchars($row['title']) . "</p>";
            // 你可以在這裡繼續添加其他字段
        }
    } else {
        $searchOutput = "<p>No results found.</p>";
    }
}

// ---------------------------------搜尋功能---------------------------------


$conn->close();
?>


<!doctype html>
<html lang="en">

<head>
    <title>article_management</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        .thumbnail {
            max-width: 7rem;
            max-height: 7rem;
        }

        .thumbnail-deteil {
            width: 6rem;
        }

        .table th,
        .table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
            /* 根據需要調整寬度 */
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="m-5 d-flex justify-content-center">
            <h1>文章管理</h1>
        </div>
        <div class="mb-3 d-flex justify-content-between ms-5">
            <p>共有 <?= $articleCount ?> 篇文章</p>
            <a href="article_add.php" class="btn btn-outline-secondary"><i class="fa-solid fa-newspaper"></i><span class="text-dark"> 新增文章</span></i></a>

            </button>

        </div>

        <div>

        </div>

        <div class=" ms-5">
            <?php if ($articleCount > 0):
                $rows = $result->fetch_all(MYSQLI_ASSOC); ?>
                <!-- 沒做出功能就先 d-none -->
                <!-- 沒做出功能就先 d-none -->
                <!-- 沒做出功能就先 d-none -->
                <div class=" mb-3 mt-3 d-none">
                    <nav class="navbar navbar-light bg-light">
                        <div class="">
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" method="post">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </nav>
                </div>
                <!-- ---------------------------------分頁功能--------------------------------- -->
                <div>
                    <nav aria-label="Page navigation example" class=" text-secondary">
                        <ul class="pagination justify-content-center text-secondary">
                            <li class="page-item text-secondary">
                                <a class="page-link" href="article_manange.php?page=<?= $prev_page ?>" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <!-- 有總頁數之後，把總頁數取下來做迴圈計算要顯示幾頁 -->
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item text-secondary <?php if ($_GET['page'] == $i) echo 'active' ?>"><a class="page-link" href="article_manange.php?page=<?= $i ?>"><?= $i ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item text-secondary">
                                <a class="page-link" href="article_manange.php?page=<?= $next_page ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- ---------------------------------分頁功能--------------------------------- -->
                <table class="table table-bordered text-center ">
                    <thead class="col">
                        <th class="text-nowrap">文章 ID</th>
                        <th class="text-nowrap">原文文章建立時間</th>
                        <th class="text-nowrap">文章品牌</th>
                        <th class="text-nowrap">文章類型1</th>
                        <th class="text-nowrap">文章類型2</th>
                        <th class="text-nowrap">文章類型3</th>
                        <th class="text-nowrap">文章類型4</th>
                        <th class="text-nowrap">原文網址</th>
                        <th class="text-nowrap">文章縮圖</th>
                        <th class="text-nowrap">文章預覽</th>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $article_id): ?>
                            <tr>
                                <td class="align-middle"><?= $article_id["article_id"] ?></td>
                                <td class="align-middle"><?= $article_id["article_created_time"] ?></td>
                                <td class="align-middle text-nowrap"><?= $article_id["article_brand"] ?></td>
                                <td class="align-middle text-nowrap"><?= $article_id["article_type1"] ?></td>
                                <td class="align-middle text-nowrap"><?= $article_id["article_type2"] ?></td>
                                <td class="align-middle text-nowrap"><?= $article_id["article_type3"] ?></td>
                                <td class="align-middle text-nowrap"><?= $article_id["article_type4"] ?></td>
                                <td class="align-middle"><?= $article_id["article_url_address"] ?></td>
                                <td class="align-middle">
                                    <div class=" thumbnail">
                                        <img class="thumbnail-deteil" src="<?= $article_id["article_images_thumbnail"] ?>" alt="">
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <a class="btn btn-outline-secondary mb-1" href="article_detail.php?article_id=<?= $article_id["article_id"] ?>"><i class="fa-solid fa-eye"></i></a>

                                    <a class="btn btn-outline-secondary" href="article_edit.php?article_id=<?= $article_id["article_id"] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                <!-- </div> -->
            <?php else: ?>
                目前沒有使用者
            <?php endif; ?>
        </div>
    </div>
</body>

</html>