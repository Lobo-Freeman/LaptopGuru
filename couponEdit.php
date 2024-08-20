<?php
require_once "db_connect.php";
session_start();



if (!isset($_GET['id'])) {
    header("Location: coupon-list.php");
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM coupon WHERE coupon_id = $id";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    header("Location: coupon-list.php");
    exit;
}

str_replace('*', '', $row['coupon_discount']);

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
        <a href="coupon.php?id=<?= $row['coupon_id'] ?>" class="btn btn-primary mb-3">
            <i class="fa-solid fa-arrow-rotate-left"></i>回到優惠券內容
        </a>
        <?php include "modal.php"; ?>

        <form action="doUpdateCoupon.php" method="post">
            <table class="table table-bordered">
                <thead>
                    <input type="hidden" name="coupon_id" value="<?= $row['coupon_id'] ?>">
                    <tr>
                        <th>優惠券ID</th>
                        <td class="">
                            <?= $row['coupon_id'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>優惠券代碼</th>
                        <td>
                            <input type="text" class="form-control" name="coupon_code" value="<?= $row['coupon_code'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>優惠券內容</th>
                        <td>
                            <input type="text" class="form-control" name="coupon_content" value="<?= $row['coupon_content'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>折扣種類</th>
                        <td>
                            <div id="discountMethod">
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="discount_method" <?php if($row['discount_method']==0) echo "checked"?>>
                                    <label class="form-check-label" value="0">
                                        依售價百分比折扣
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="discount_method" <?php if($row['discount_method']==1) echo "checked"?>>
                                    <label class="form-check-label"  value="1">
                                        依優惠金額折扣
                                    </label>
                                </div>
                            </div>
                        </td>
                    <tr>
                        <th>折扣範圍</th>
                        <td>
                            <input type="text" class="form-control" name="coupon_discount" value="<?= $row['coupon_discount'] ?>">
                           
                        </td>
                    </tr>
                    <tr>
                        <th>開始時間</th>
                        <td>
                            <input type="datetime-local" class="form-control" name="coupon_start_time" value="<?= $row['coupon_start_time'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>到期時間</th>
                        <td>
                            <input type="datetime-local" class="form-control" name="coupon_end_time" value="<?= $row['coupon_end_time'] ?>">
                        </td>
                    </tr>
                </thead>
            </table>
            <button
                type="submit"
                class="btn btn-primary " id="confirm">
                <i class="fa-solid fa-check"></i>
                送出
            </button>
        </form>
    </div>

    <?php include "js.php"; ?>
    <script>
     
        const infoModal = new bootstrap.Modal(document.getElementById('infoModal', {
            keyboard: true
        }));
        const info = document.querySelector("#info");

        if ("<?= $_SESSION['update_message'] ?>") {
            // 上面的判斷是在判斷是否有訊息，如果有的話就顯示
            info.textContent = "<?= $_SESSION['update_message'] ?>";
            infoModal.show();
            <?php unset($_SESSION['update_message']); ?>
        }

    
    </script>

</body>

</html>