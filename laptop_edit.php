<?php
if (!isset($_GET["id"])) {
    echo "請帶入正確id變數";
    exit;
}

$id = $_GET["id"];

require_once("db_connect.php");
$sql = "SELECT * FROM rental
where id = '$id' and state='available'
";
$result = $conn->query($sql);
$laptopCounts = $result->num_rows;
$row = $result->fetch_assoc(); //一筆資料

if ($laptopCounts > 0) {
    $title = $row["model"];
} else {
    $title = "筆電不存在";
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>資料修改</title>
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
    <?php include("css.php") ?>
</head>

<body>
    <div class="container ">
        <h2 class="text-center mt-3">資料修改</h2>
        <div class="py-3">
            <a class="btn btn-outline-secondary" href="laptop_content.php?id=<?= $row["id"] ?>" title="回租賃商品內容">
                <i class="fa-solid fa-circle-chevron-left"></i>
            </a>
        </div>
        <?php if ($laptopCounts > 0) : ?>

            <!--action 表單提交時，數據應該發送到哪裡
                    表單提交時使用的 HTTP 方法。 GET(拿東西) 或 POST(傳東西)-->
            <form action="laptop_update.php" method="post" enctype="multipart/form-data">

                <table class="table table-bordered">
                    <!--將筆電的 ID 值隨表單一同提交-->
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <tr>
                        <td>id</td>
                        <td>
                            <?= $row["id"] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>型號</td>
                        <td>
                            <input type="text" class="form-control" name="model" value="<?= $row["model"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>品牌</td>
                        <td>
                            <select class="form-select" name="brand" id="brand">
                                <option value="MSI">MSI</option>
                                <option value="ROG">ROG</option>
                                <option value="HP">HP</option>
                                <option value="技嘉">技嘉</option>
                                <option value="ASUS">ASUS</option>
                                <option value="Acer">Acer</option>
                                <option value="DELL">DELL</option>
                                <option value="Razer">Razer</option>
                            </select>
                        </td>
                    </tr>

                    <?php if (isset($_GET)) ?>
                    <tr>
                        <td>價格</td>
                        <td>
                            <input type="text" class="form-control" name="price" value="<?= $row["price"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>數量</td>
                        <td>
                            <input type="text" class="form-control" name="num" value="<?= $row["num"] ?>">
                        </td>
                    </tr>
                    <input type="hidden" name="created_at" value="<?= $row["created_at"] ?>">
                    <tr>
                        <td>時間</td>
                        <td>
                            <?= $row["created_at"] ?>
                        </td>
                    </tr>



                    <tr>
                        <td>圖片</td>
                        <td>
                            <img src="/topics/image/<?= $row['images'] ?>" alt="<?= $row['model'] ?>" width="100">
                            <input type="hidden" name="original_images" value="<?= $row['images'] ?>">
                            <input class="form-control" type="file" id="images" name="images">

                            <!-- 顯示當前圖片（如果存在） -->
                            <?php if (!empty($row["images"])): ?>
                                <img class="img-fluid mt-2" src="/topics/image/<?= $row['images'] ?>" alt="Current Event Picture" style="max-width: 200px;">
                                <p class="mt-1">當前圖片: <?= $row['images'] ?></p>
                            <?php endif; ?>
                        </td>
                    </tr>



                    <tr>
                        <td colspan="2">
                            <!-- 上傳按鈕 -->
                            <button type="submit" class="btn btn-outline-secondary rounded-pill">
                                <i class="fa-solid fa-floppy-disk me-2"></i>儲存
                            </button>
                        </td>
                    </tr>
                </table>
            </form>




            <!-- <div class="py-2">
                    <button type="submit" class="btn btn-outline-secondary rounded-pill">
                        <i class="fa-solid fa-floppy-disk me-2"></i>儲存
                    </button>
                </div> -->

            </form>
        <?php else : ?>
            筆電不存在
        <?php endif; ?>
    </div>
    <?php
    $conn->close();
    ?>
</body>

</html>