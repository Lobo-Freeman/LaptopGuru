<?php
if (!isset($_GET["id"])) {
    echo "請帶入正確id變數";
    exit;
}

$id = $_GET["id"];

require_once("db_connect.php");
$sql = "SELECT id, images, model, brand, price, num, created_at FROM rental
where id = '$id' and state='available'
";
$result = $conn->query($sql);
$laptopCounts = $result->num_rows;
$row = $result->fetch_assoc(); //一筆資料

if($laptopCounts>0){
    $title=$row["model"];
}else{
    $title="筆電不存在";
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>租賃商品內容</title>
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
        <?php include("css.php")?>

</head>

<body>
    <div class="container ">
        <h2 class="text-center mt-3">租賃商品內容</h2>
            <div class="py-3">
                <a class="btn btn-secondary" href="rental_form.php?=<?=$row["id"]?>" title="回租賃清單">
                <i class="fa-solid fa-circle-chevron-left"></i>
                </a>
            </div>
                <?php if ($laptopCounts > 0) : ?>
                    <table class="table table-bordered">
                        <tr>
                            <td>id</td>
                            <td><?=$row["id"]?></td>
                        </tr>
                        <tr>
                            <td>圖片</td>
                            <td><img src="/topics/image/<?=$row['images']?>" alt="<?=$row['model']?>" width="100"></td>
                        </tr>
                        <tr>
                            <td>型號</td>
                            <td><?=$row["model"]?></td>
                        </tr>
                        <tr>
                            <td>品牌</td>
                            <td><?=$row["brand"]?></td>
                        </tr>
                        <tr>
                            <td>價格</td>
                            <td><?=$row["price"]?></td>
                        </tr>
                        <tr>
                            <td>數量</td>
                            <td><?=$row["num"]?></td>
                        </tr>
                        <tr>
                            <td>時間</td>
                            <td><?=$row["created_at"]?></td>
                        </tr>
                    </table>

                    <div class="py-2">
                        <a class="btn btn-secondary" href="laptop_edit.php?id=<?=$row["id"]?>" title="資料修改">
                        <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                    </div>

                <?php else : ?>
                    筆電不存在
                <?php endif; ?>
    </div>
</body>

</html>