<?php
require_once "db_connect.php";
$sqlAll = "SELECT * FROM coupon";

$resultAll = $conn->query($sqlAll);
$rowsAll = $resultAll->fetch_all(MYSQLI_ASSOC);
$rowsCountAll = $resultAll->num_rows;

$per_page = 5;
$page = 1;
$start_item = 0;

$totalPage = ceil($rowsCountAll / $per_page);
// echo "total page: $totalPage";

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM coupon WHERE coupon_code LIKE '%$search%' OR coupon_content LIKE '%$search%' OR coupon_discount LIKE '%$search%' OR coupon_start_time LIKE '%$search%' OR coupon_end_time LIKE '%$search%' LIMIT $start_item, $per_page";

    // LIKE 模糊搜尋
    // % 代表任意字元
    // _ 代表單一字元

} elseif (isset($_GET["p"]) && isset($_GET["order"])) {
    $page = $_GET["p"];
    $order = $_GET["order"];
    $start_item = ($page - 1) * $per_page;

    switch ($order) {
        case 1:
            $where_clause = "ORDER BY coupon_id ASC";
            break;

        case 2:
            $where_clause = "ORDER BY coupon_id DESC";
            break;
        case 3:
            $where_clause = "ORDER BY coupon_code ASC";
            break;
        case 4:
            $where_clause = "ORDER BY coupon_code DESC";
            break;
        default:
            header("Location: coupon-list.php?p=1&order=1");
            break;
    }

    $sql = "SELECT * FROM coupon $where_clause LIMIT $start_item, $per_page ";
    // 整個語句有差別的地方只在ORDER BY id ASC/DESC
    // 所以用一個變數將ASC/DESC存起來，再用switch case判斷
    // 這樣就不用寫兩次SQL語句



} else {

    header("Location: coupon-list.php?p=1&order=1");
    // 判斷是否有$_GET["p"]，若沒有就導向第一頁


    // $sql = "SELECT * FROM users WHERE valid = 1 LIMIT $start_item, $per_page";

    // 若沒有$_GET["p"]就只讀第一頁
}


$result = $conn->query($sql);
// query() 執行SQL語法
// if (isset($_GET["search"])) {
// } else {
//     $userCount = $userCountAll;
// }

$rowsCount = $result->num_rows;




?>
<!doctype html>
<html lang="en">

<head>
    <title>優惠券列表</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <?php include "css.php"; ?>
</head>

<body>
    <div class="container">
        <h1>優惠券</h1>
        <a href="coupon-add.php" class="btn btn-primary mb-3"><i class="fa-solid fa-plus"></i>新增優惠券</a>
        <div class="py-2">
            <form action="">
                <div class="input-group mb-3">
                    <input type="search" class="form-control" name="search" placeholder="搜尋優惠券" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : ""; ?>">
                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        <?php if (isset($_GET["p"])) : ?>
            <div class="py-2 d-flex justify-content-end">
                <div class="btn-group ">
                    <a class="btn btn-primary <?php if ($order == 1) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=1">
                        <i class="fa-solid fa-arrow-down-1-9"></i>
                    </a>

                    <a class="btn btn-primary <?php if ($order == 2) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=2">
                        <i class="fa-solid fa-arrow-down-9-1"></i>
                    </a>
                    <a class="btn btn-primary <?php if ($order == 3) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=3">
                        <i class="fa-solid fa-arrow-down-a-z"></i>
                    </a>
                    <a class="btn btn-primary <?php if ($order == 4) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=4">
                        <i class="fa-solid fa-arrow-down-z-a"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($rowsCount > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>優惠券ID</th>
                        <th>優惠券代碼</th>
                        <th>開始時間</th>
                        <th>到期時間</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rowsAll as $row): ?>
                        <tr>
                            <td><?php echo $row['coupon_id']; ?></td>
                            <td><?php echo $row['coupon_code']; ?></td>
                            <td><?php echo $row['coupon_start_time']; ?></td>
                            <td><?php echo $row['coupon_end_time']; ?></td>
                            <td class="text-center">
                                <a href="coupon.php?id=<?php echo $row['coupon_id']; ?>" class="btn btn-primary">
                                    <i class="fa-solid fa-eye"></i>優惠券內容
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if (!isset($_GET["search"])) : ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a href="" class="page-link">
                                <i class="fa-solid fa-angles-left"></i>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                            <?php if ($i == 1 || $i == $totalPage || ($i >= $page - 2 && $i <= $page + 2)) : ?>
                                <li class="page-item <?php if ($i == $page) echo "active"; ?>">

                                    <a class="page-link" href="coupon-list.php?p=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>

                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a href="" class="page-link">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        <?php else: ?>
            <h2>目前沒有優惠券</h2>
        <?php endif; ?>
    </div>

</body>




<script>


</script>

</html>