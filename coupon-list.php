<?php
require_once "db_connect.php";



$per_page = 5;
$page = 1;
$start_item = 0;

$now = date("Y-m-d H:i:s");
$sqlTimeCheck = "UPDATE coupon SET valid = 0 WHERE coupon_end_time < '$now' AND valid = 1";
$conn->query($sqlTimeCheck);

if(isset($_GET['valid'])){

$valid = $_GET["valid"];

switch ($valid) {
    case 1:
        $valid_clause = "valid=1";
        break;
    case 0:
        $valid_clause = "valid=0";
        break;
}
}else{
    $valid_clause = "valid=1";
}

$sqlAll = "SELECT *  FROM coupon WHERE $valid_clause";
$resultAll = $conn->query($sqlAll);
$rowsAll = $resultAll->fetch_all(MYSQLI_ASSOC);
$rowsCountAll = $resultAll->num_rows;

if (isset($_GET["search"])) {
    $type = $_GET["type"];
    $search = $_GET["search"];

    switch ($type) {
        case 1:
            $type_clause = "coupon_id";
            break;
        case 2:
            $type_clause = "coupon_code";
            break;
        case 3:
            $type_clause = "coupon_start_time";
            break;
        case 4:
            $type_clause = "coupon_end_time";
            break;
        default:
            header("Location: coupon-list.php?p=1&order=1&$valid_clause");
            break;
    }

    if (isset($_GET["valid"])) {
        $sql = "SELECT * FROM coupon WHERE $type_clause LIKE '%$search%' AND $valid_clause";
    } else {
        $sql = "SELECT * FROM coupon WHERE $type_clause LIKE '%$search%'";
    }

    // $sql = "SELECT * FROM coupon WHERE $type_clause LIKE '%$search%' AND $valid_clause";

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
            header("Location: coupon-list.php?p=1&order=1&$valid_clause");
            break;
    }

    $sql = "SELECT * FROM coupon WHERE $valid_clause $where_clause LIMIT $start_item, $per_page ";
    // 整個語句有差別的地方只在ORDER BY id ASC/DESC
    // 所以用一個變數將ASC/DESC存起來，再用switch case判斷
    // 這樣就不用寫兩次SQL語句



} else {

    header("Location: coupon-list.php?p=1&order=1&valid=1");
    // 判斷是否有$_GET["p"]，若沒有就導向第一頁


    // $sql = "SELECT * FROM users WHERE valid = 1 LIMIT $start_item, $per_page";

    // 若沒有$_GET["p"]就只讀第一頁
}





$totalPage = ceil($rowsCountAll / $per_page);
// echo "total page: $totalPage";


$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

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
                    <div>
                        <select class="form-select" aria-label=".form-select-sm example" name="type">
                            <option value="1" <?php echo isset($_GET["type"]) && $_GET["type"] == 1 ? "selected" : ""; ?> <?php if (!isset($_GET['type'])) echo "selected" ?>>優惠券ID</option>
                            <option value="2" <?php echo isset($_GET["type"]) && $_GET["type"] == 2 ? "selected" : ""; ?>>優惠券代碼</option>
                            <option value="3" <?php echo isset($_GET["type"]) && $_GET["type"] == 3 ? "selected" : ""; ?>>開始時間</option>
                            <option value="4" <?php echo isset($_GET["type"]) && $_GET["type"] == 4 ? "selected" : ""; ?>> 到期時間</option>
                        </select>
                    </div>
                    <input type="search" class="form-control" name="search" placeholder="搜尋優惠券" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : ""; ?>">
                    <!-- <input type="hidden" name="valid" value="<?php echo isset($_GET["valid"]) ? $_GET["valid"] : "1"; ?>"> -->
                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        <div class="py-2 d-flex justify-content-between">
            <?php if (isset($_GET["search"])) : ?>
                <div class="btn-grup">
                    <a class="btn btn-secondary <?php if(!isset($_GET['valid'])) echo 'active'?>" href="coupon-list.php?type=<?= $type ?>&search=<?= $search ?>">
                    <i class="fa-solid fa-globe"></i>全部
                    </a>
                    <a class="btn btn-success <?php if ($valid == 1) echo "active" ?>" href="coupon-list.php?type=<?= $type ?>&search=<?= $search ?>&valid=1">
                        <i class="fa-solid fa-check"></i>有效中
                    </a>
                    <a class="btn btn-danger <?php if ($valid == 0) echo "active" ?>" href="coupon-list.php?type=<?= $type ?>&search=<?= $search ?>&valid=0">
                        <i class="fa-solid fa-xmark"></i>停用中
                    </a>
                </div>
            <?php else: ?>
                <div class="btn-group">
                    <a class="btn btn-success <?php if ($valid == 1) echo "active" ?>" href="coupon-list.php?p=1&order=1&valid=1">
                        <i class="fa-solid fa-check"></i>有效中
                    </a>
                    <a class="btn btn-danger <?php if ($valid == 0) echo "active" ?>" href="coupon-list.php?p=1&order=1&valid=0">
                        <i class="fa-solid fa-xmark"></i>停用中
                    </a>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET["p"])) : ?>
                <div class="btn-group ">
                    <a class="btn btn-primary <?php if ($order == 1) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=1&valid=<?= $valid ?>">
                        <i class="fa-solid fa-arrow-down-1-9"></i>
                    </a>

                    <a class="btn btn-primary <?php if ($order == 2) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=2&valid=<?= $valid ?>">
                        <i class="fa-solid fa-arrow-down-9-1"></i>
                    </a>
                    <a class="btn btn-primary <?php if ($order == 3) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=3&valid=<?= $valid ?>">
                        <i class="fa-solid fa-arrow-down-a-z"></i>
                    </a>
                    <a class="btn btn-primary <?php if ($order == 4) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=4&valid=<?= $valid ?>">
                        <i class="fa-solid fa-arrow-down-z-a"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <?php if (isset($_GET["search"])) : ?>
            <a href="coupon-list.php" class="btn btn-primary mb-3">
                <i class="fa-solid fa-arrow-rotate-left"></i>回到列表
            </a>
            <div class="alert alert-primary" role="alert">
                搜尋結果：<?php echo $rowsCount; ?>筆
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
                        <th>狀態</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?php echo $row['coupon_id']; ?></td>
                            <td><?php echo $row['coupon_code']; ?></td>
                            <td><?php echo $row['coupon_start_time']; ?></td>
                            <td><?php echo $row['coupon_end_time']; ?></td>
                            <td>
                                <?php if ($row['valid'] == 1): ?>
                                    有效
                                <?php elseif ($row['valid'] == 0): ?>
                                    停用
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="coupon.php?id=<?= $row['coupon_id']; ?>" class="btn btn-primary">
                                    <i class="fa-solid fa-eye"></i>優惠券內容
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if ($totalPage > 1 && !isset($_GET['search'])): ?>
                <nav aria-label="Page navigation example">

                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a href="coupon-list.php?p=1&order=<?= $order ?>&valid=<?= $valid ?>" class="page-link">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                            <?php if (($i >= $page - 1 && $i <= $page + 1)) : // 當前頁的前一頁和後一頁 
                            ?>
                                <li class="page-item <?php if ($i == $page) echo "active"; ?>">

                                    <a class="page-link" href="coupon-list.php?p=<?= $i ?>&order=<?= $order ?>&valid=<?= $valid ?>"><?= $i ?></a>

                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a href="coupon-list.php?p=<?= $totalPage ?>&order=<?= $order ?>&valid=<?= $valid ?>" class="page-link">
                                <span aria-hidden="true">&raquo;</span>
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