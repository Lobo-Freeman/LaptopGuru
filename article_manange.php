<?php

require_once("db_connect_article.php");

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


// ---------------------------------分頁功能---------------------------------

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
            object-fit: fill;
        }
    </style>
</head>

<body>
    <header>
        <div class="container mb-3 mt-5 ms-5">
            <h1>文章管理</h1>
        </div>
        <div class="container mb-3 d-flex justify-content-between ms-5">
            <p>共有 <?= $articleCount ?> 篇文章</p>
        </div>

        <div>

        </div>
    </header>
    <div class="container ms-5">
        <?php if ($articleCount > 0):
            $rows = $result->fetch_all(MYSQLI_ASSOC); ?>
            <div class="container mb-3 mt-3">
                <nav class="navbar navbar-light bg-light">
                    <div class="container-fluid">
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div>
            <!-- ---------------------------------分頁功能--------------------------------- -->
            <div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <!-- 有總頁數之後，把總頁數取下來做迴圈計算要顯示幾頁 -->
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php if ($_GET['page'] == $i) echo 'active' ?>"><a class="page-link" href="article_manange.php?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- ---------------------------------分頁功能--------------------------------- -->
            <table class="table table-bordered">
                <thead>
                    <th>article_id</th>
                    <th>article_created_time</th>
                    <th>article_brand</th>
                    <th>article_type1</th>
                    <th>article_type2</th>
                    <th>article_type3</th>
                    <th>article_type4</th>
                    <th>article_url_address</th>
                    <th>article_images_thumbnail</th>
                    <th>article_preview</th>
                </thead>
                <tbody>
                    <?php foreach ($rows as $article_id): ?>
                        <tr>
                            <td><?= $article_id["article_id"] ?></td>
                            <td><?= $article_id["article_created_time"] ?></td>
                            <td><?= $article_id["article_brand"] ?></td>
                            <td><?= $article_id["article_type1"] ?></td>
                            <td><?= $article_id["article_type2"] ?></td>
                            <td><?= $article_id["article_type3"] ?></td>
                            <td><?= $article_id["article_type4"] ?></td>
                            <td><?= $article_id["article_url_address"] ?></td>
                            <td>
                                <div class="container thumbnail">
                                    <img class="img-fluid" src="<?= $article_id["article_images_thumbnail"] ?>" alt="">
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-outline-secondary" href="article_detail.php?article_id=<?= $article_id["article_id"] ?>"><i class="fa-solid fa-eye"></i></a>
                                <a class="btn btn-outline-secondary" href="article_edit.php?article_id=<?= $article_id["article_id"] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        <?php else: ?>
            目前沒有使用者
        <?php endif; ?>
    </div>
</body>

</html>