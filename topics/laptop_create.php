<?php
require_once("../topics/db_connect.php");
$sql = "SELECT * FROM rental WHERE state='available'";
// $sql = "SELECT id, images, model, brand, price, num, state, user_id, created_at FROM rental WHERE state='available'";
$result = $conn->query($sql);
$laptopCounts = $result->num_rows;
$row = $result->fetch_assoc(); //一筆資料



?>


<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
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
    <?php include("../topics/css.php") ?>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-3">新增資料</h2>

        <div class="py-3">
            <a class="btn btn-outline-secondary" href="rental_form.php" title="回租賃清單">
                <i class="fa-solid fa-circle-chevron-left"></i>
            </a>
        </div>


        <form action="do_creat_laptop.php" method="post">
            <div class="mb-2">
                <label class="form-label" for="model">型號</label>
                <input class="form-control" type="text" name="model">
            </div>

            <div class="mb-2">
                <label class="form-label" for="brand">品牌</label>
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
            </div>

            <div class="mb-2">
                <label class="form-label" for="price">價格</label>
                <input class="form-control" type="text" name="price">
            </div>
            <div class="mb-2">
                <label class="form-label" for="num">數量</label>
                <input class="form-control" type="text" name="num">
            </div>

            <div class="mb-2">
                <!-- <label class="form-label" for="num">images</label>
                <input class="form-control" type="file" id="formFile"> -->
            </div>
            <div class="mb-2">
                <img src="/topics/image/<?= $row['images'] ?>" alt="<?= $row['model'] ?>" width="100">
                <!-- 這裡的 name 屬性必須設置，PHP 才能接收到檔案 -->
                <input class="form-control" type="file" id="images" name="images">
            </div>
            <button type="submit" class="btn btn-outline-secondary rounded-pill">
                <i class="fa-solid fa-paper-plane me-2"></i>送出
            </button>
        </form>
    </div>
</body>

</html>
