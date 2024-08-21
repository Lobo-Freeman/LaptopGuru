<?php
require_once("../topics/db_connect.php");

$sqlAll = "SELECT * FROM rental WHERE state='available'";
$resultAll = $conn->query($sqlAll);
$laptopCountAll = $resultAll->num_rows;


$page = 1;
$start_item = 0;
$per_page = 5;
// ceil 無條件進位
$total_page = ceil($laptopCountAll / $per_page);


if (isset($_GET["search"])) {
    $search = $_GET["search"];

    $sql = "SELECT * FROM rental WHERE model LIKE '%$search%' AND state='available'";
} elseif (isset($_GET["p"]) && isset($_GET["order"])) {
    $order = $_GET["order"];
    $page = $_GET["p"];
    $start_item = ($page - 1) * $per_page;


    switch ($order) {
        case 1:
            $where_clause = " ORDER BY id ASC";
            break;
        case 2:
            $where_clause = "ORDER BY id DESC";
            break;
        default:
            header("location: rental_form.php?p=1&order=1");
            break;
    }
    $sql = "SELECT * FROM rental WHERE state='available' $where_clause LIMIT $start_item, $per_page ";
} else {
    header("location: rental_form.php?p=1&order=1");
}


// $sql = "SELECT * FROM rental WHERE state='available'";
// $sql = "SELECT id, images, model, brand, price, num, state, user_id, created_at FROM rental WHERE state='available'";
$result = $conn->query($sql);

if (isset($_GET["search"])) {
    $laptopCount = $result->num_rows;
} else {
    $laptopCountAll = $resultAll->num_rows;
}


$laptopCount = $result->num_rows;

// 價格
if (isset($_GET["min"]) && isset($_GET["max"])) {
    $min = $_GET["min"];
    $max = $_GET["max"];

    $sql = "SELECT * FROM rental WHERE state='available' and price BETWEEN $min and $max ORDER BY id ASC ";
    $result = $conn->query($sql);
    $laptopCount = $result->num_rows;
} else {
    // $sql = "SELECT * FROM rental WHERE state='available' ORDER BY id ASC";
    $laptopCount = $result->num_rows;
}

?>

<style>
    .table img {
        max-width: 100px;
        /* 限制圖片的最大寬度 */
    }

    .table td,
    .table th {
        white-space: nowrap;
        /* 避免文字換行 */
        overflow: hidden;
        /* 隱藏超出範圍的內容 */
        text-overflow: ellipsis;
        /* 使用省略號顯示超出範圍的內容 */
    }
</style>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <title>Rental_Form</title>
    <?php include("../topics/css.php") ?>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-3">租賃清單</h2>
        <?php if ($laptopCount > 0) :
            $rows = $result->fetch_all(MYSQLI_ASSOC);
        ?>
            <div class="py-2">
                <?php if (isset($_GET["search"])) : ?>
                    <a class="btn btn-outline-secondary" href="rental_form.php" title="回租賃清單">
                        <i class="fa-solid fa-circle-chevron-left"></i>
                    </a>
                <?php endif; ?>
            </div>

            <div class="py-2">
                <form action=""> <!-- 不寫可以直接帶入當前搜尋 -->
                    <div class="input-group">
                        <input type="search" class="form-control me-2" placeholder="搜尋型號" name="search" value="<?= isset($_GET["search"]) ? $_GET["search"] : "" ?>">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>

            <div class="row d-flex align-items-center">
                <div class="col-6 d-flex justify-content-start align-items-center">
                    <p class="mt-3 mb-3">共 <?= $laptopCount ?>台筆電</p>
                </div>
                <!-- 價格篩選 -->
                <div class="col-6 d-flex justify-content-end align-items-center">
                    <form action="" method="GET" class="d-flex align-items-center">

                        <?php if (isset($_GET["min"])) : ?>
                            <a class="btn btn-outline-secondary" href="rental_form.php" title="回租賃清單">
                                <i class="fa-solid fa-circle-chevron-left"></i>
                            </a>
                        <?php endif; ?>

                        <!-- 包含當前的 search, p 和 order 參數，避免被覆蓋 -->
                        <?php if (isset($_GET["search"])) : ?>
                            <input type="hidden" name="search" value="<?= $_GET["search"] ?>">
                        <?php endif; ?>
                        <?php if (isset($_GET["p"])) : ?>
                            <input type="hidden" name="p" value="<?= $_GET["p"] ?>">
                        <?php endif; ?>
                        <?php if (isset($_GET["order"])) : ?>
                            <input type="hidden" name="order" value="<?= $_GET["order"] ?>">
                        <?php endif; ?>

                        <div class="col-auto">
                            <label class="ms-2" for="">價格</label>
                        </div>
                        <div class="col-auto ms-2">
                            <input type="number" class="form-control text-end price-input" name="min"
                                value="<?php $min = isset($_GET["min"]) ? $_GET["min"] : 0;
                                echo $min ?>">
                        </div>
                        <div class="col-auto ms-2">
                            ~
                        </div>
                        <div class="col-auto ms-2">
                            <input type="number" class="form-control text-end price-input" name="max"
                                value="<?php $max = isset($_GET["max"]) ? $_GET["max"] : 0;
                                echo $max ?>">
                        </div>

                        <button
                            type="submit"
                            class="btn btn-outline-secondary ms-2">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="row d-flex align-items-center mb-3">
                <div class="col-6 d-flex justify-content-start ">
                    <?php if (isset($_GET["p"])) : ?>

                        <div class="btn-group">
                            <a class="btn btn-outline-secondary <?php if ($order == 1) echo "active" ?> " href="rental_form.php?p=1&order=1" title="小到大">
                                <i class="fa-solid fa-up-long"></i>
                            </a>
                            <a class="btn btn-outline-secondary <?php if ($order == 2) echo "active" ?>" href="rental_form.php?p=1&order=2" title="大到小">
                                <i class="fa-solid fa-down-long"></i>
                            </a>
                        </div>
                </div>

                <div class="col-6 d-flex justify-content-end ">
                    <a class="btn btn-outline-secondary" href="laptop_create.php" title="新增資料">
                        <i class="fa-solid fa-square-plus"></i>
                    </a>
                    <a class="btn btn-outline-secondary ms-2" href="laptop_soft_delete_list.php" title="刪除資料">
                        <i class="fa-solid fa-square-minus"></i>
                    </a>
                </div>
            <?php endif; ?>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>圖片</th>
                        <th>型號</th>
                        <th>品牌</th>
                        <th>價格</th>
                        <th>數量</th>
                        <th>狀態</th>
                        <th>租借者數量</th>
                        <th>時間</th>
                        <th>修改</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $laptop) : ?>
                        <tr>
                            <td><?= $laptop["id"] ?></td>
                            <td><img src="/topics/image/<?= $laptop['images'] ?>" alt="<?= $laptop['model'] ?>" width="100"></td>
                            <td><?= $laptop["model"] ?></td>
                            <td><?= $laptop["brand"] ?></td>
                            <td><?= $laptop["price"] ?></td>
                            <td><?= $laptop["num"] ?></td>
                            <td><?= $laptop["state"] ?></td>
                            <td><?= $laptop["user_id"] ?></td>
                            <td><?= $laptop["created_at"] ?></td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a class="btn btn-outline-secondary mb-2" href="laptop_content.php?id=<?= $laptop["id"] ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <a class="btn btn-outline-secondary" href="laptop_soft_delete.php?id=<?= $laptop["id"] ?>">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <?php if (isset($_GET["p"]) && !isset($_GET["min"]) && !isset($_GET["max"])): ?>
                <div>
                    <ul class="pagination d-flex justify-content-center">
                        
                        <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                            <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                                <a class="page-link" href="rental_form.php?p=<?= $i ?>&order=<?= $order ?>" > <?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                    </ul>
                </div>
            <?php endif; ?>
        <?php else : ?>
            沒有找到符合條件的筆電
        <?php endif; ?>
    </div>
</body>
<?php
$conn->close();
?>

</html>