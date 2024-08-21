<?php
require_once("db_connect.php");
if (isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];
    $sql = "SELECT * FROM product LEFT JOIN product_img ON product_id = img_product_id WHERE product.product_id = $product_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: product-list.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>編輯商品</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php require_once("css.php"); ?>


</head>

<body>
    <div class="container">
        <h1>編輯商品</h1>
        <form action="update-product.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>" />
            <div class="form-group">
                <div>
                <label for="product_name">商品圖片</label>
                <?php
                if (isset($row["product_img_path"])) {
                    if(is_array($row["product_img_path"]))
                    {
                        foreach ($row["product_img_path"] as $i => $img) {
                            echo "<img src='{$img}'  style='width: 200px;'/>";
                        }
                    }
                    else
                    {
                        echo "<img src='{$row["product_img_path"]}'style='width: 200px;'/>";
                    }
                } else {
                    echo "<img src='https://via.placeholder.com/200'style='width: 200px;' />";
                }
                ?>
                </div>
                <label for="product_name">商品型號</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $row["model"]; ?>" required>
                <label for="product_name">品牌</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $row["product_brand"]; ?>" required>
                

            </div>

        </form>

        <?php require_once("js.php"); ?>
</body>

</html>