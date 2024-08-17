<?php
require_once "db_connect.php";

if (!isset($_GET['id'])) {
    header("Location: coupon-list.php");
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM coupon WHERE valid = 1 AND coupon_id = $id";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    header("Location: coupon-list.php");
    exit;
}

str_replace('*', '', $row['coupon_discount']);
// 這個函式是用來將字串中的某個字元取代成另一個字元
// 第一個參數是要取代的字元
// 第二個參數是取代成的字元
// 第三個參數是要取代的字串
// 如果有多個字元要取代，可以用陣列的方式傳入
// str_replace(['*', '-'], '', $row['coupon_discount']);

?>

<!doctype html>
<html lang="en">

<head>
    <title><?= $row["coupon_code"] ?></title>
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
        <a href="coupon-list.php" class="btn btn-primary mb-3">
            <i class="fa-solid fa-arrow-rotate-left"></i>回到列表
        </a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>優惠券ID</th>
                    <td class="">
                        <?= $row['coupon_id'] ?>
                    </td>
                </tr>
                <tr>
                    <th>優惠券代碼</th>
                    <td>
                        <?= $row['coupon_code'] ?>
                    </td>
                </tr>
                <tr>
                    <th>優惠券內容</th>
                    <td>
                        <?= $row['coupon_content'] ?>
                    </td>
                </tr>
                <tr>
                    <th>折扣範圍</th>
                    <td>
                        <?php if ($row['discount_method'] == '0'): ?>
                            折扣<?= $row['coupon_discount'] ?>%
                        <?php elseif ($row['discount_method'] == '1'): ?>
                            折扣<?= $row['coupon_discount'] ?>元
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>開始時間</th>
                    <td>
                        <?= $row['coupon_start_time'] ?>
                    </td>
                </tr>
                <tr>
                    <th>到期時間</th>
                    <td>
                        <?= $row['coupon_end_time'] ?>
                    </td>
                </tr>
            </thead>
        </table>
        <a href="couponEdit.php?id=<?= $row["coupon_id"] ?>" class="btn btn-primary">
            <i class="fa-solid fa-pen"></i>
            編輯
        </a>
    </div>
</body>

</html>