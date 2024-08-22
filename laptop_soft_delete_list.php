<?php
require_once("../topics/db_connect.php");

$sql = "SELECT * FROM rental WHERE state='No'";
$result = $conn->query($sql);

// 確認有資料再繼續
if ($result->num_rows > 0) {
    // 取得所有資料，MYSQLI_ASSOC 代表以關聯陣列的形式取得資料
    $rows = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $rows = []; // 沒有資料時設為空陣列
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>租賃商品內容</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <?php include("../topics/css.php") ?>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-3">刪除清單</h2>
        <div class="py-3">
            <a class="btn btn-outline-secondary" href="rental_form.php" title="回租賃清單">
                <i class="fa-solid fa-circle-chevron-left"></i>
            </a>
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
                    <th>刪除</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rows)) : ?>
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

                            <!-- <form action="laptop_delete.php" method="post">
                            <td class="d-flex align-items-center justify-content-center">
                            <a class="btn btn-outline-secondary" href="rental_form.php" title="回租賃清單">
                            <i class="fa-solid fa-trash"></i>
                            </a></td>
                            </form> -->

                            <form action="laptop_delete.php" method="post">
                                <td class="d-flex align-items-center justify-content-center">
                                <input type="hidden" name="id" value="<?= $laptop['id'] ?>">
                                    <button type="submit" class="btn btn-outline-danger" title="刪除">
                                    <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </form>


                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9" class="text-center">無可顯示的資料</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>