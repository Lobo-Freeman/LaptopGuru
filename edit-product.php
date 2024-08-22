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
    <style>
        .product_img {
            width: 200px;
            height: 200px;
        }
    </style>

</head>

<body>
    <div class="container">
        <h1>編輯商品</h1>

        <div class="form-group">
            <label for="product_name">商品圖片</label>

            <?php
            if (isset($row["product_img_path"])) {
                if (is_array($row["product_img_path"])) {
                    foreach ($row["product_img_path"] as $i => $img) {
                        echo "<img src='{$img}'  class='product_img'/>";
                        echo "<button type='button' class='btn btn-secondary'  onclick='deleteImage($i)'>移除舊圖片</button>";
                    }
                } else {
                    echo "<img src='{$row["product_img_path"]}'class='product_img'/>";
                    echo "<button type='button' class='btn btn-secondary' onclick='deleteImage(0)'>移除舊圖片</button>";
                }
            }
            ?>
            <button type="button" class="btn btn-secondary" onclick="addImageFile()">+</button>
            <button type="button" class="btn btn-secondary" onclick="removeImageFile()">-</button>
            <div id="add_image">

            </div>
        </div>

        <label for="product_id">商品id</label>
        <input type="text" class="form-control" id="product_id" name="product_id" value="<?php echo $row["product_id"]; ?>" readonly>
        <label for="product_name">商品型號</label>
        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $row["model"]; ?>" required>
        <label for="product_name">品牌</label>
        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $row["product_brand"]; ?>" required>
        <label for="list_price" class="form-label">商品售價</label>
        <input type="number" class="form-control" id="list_price" name="list_price" value="<?php echo $row["list_price"]; ?>" required>
        <label for="affordance" class="form-label">用途</label>
        <input type="text" class="form-control" id="affordance" name="affordance" value="<?php echo $row["affordance"]; ?>" required>
        <label for="product_color" class="form-label">商品顏色</label>
        <input type="text" class="form-control" id="product_color" name="product_color" value="<?php echo $row["product_color"]; ?>" required>
        <label for="product_size" class="form-label">商品尺寸</label>
        <input type="text" class="form-control" id="product_size" name="product_size" value="<?php echo $row["product_size"]; ?>" required>
        <label for="product_weight" class="form-label">商品重量</label>
        <input type="text" class="form-control" id="product_weight" name="product_weight" value="<?php echo $row["product_weight"]; ?>" required>
        <label for="product_CPU" class="form-label">處理器</label>
        <input type="text" class="form-control" id="product_CPU" name="product_CPU" value="<?php echo $row["product_CPU"]; ?>" required>
        <label for="product_RAM" class="form-label">記憶體</label>
        <input type="text" class="form-control" id="product_RAM" name="product_RAM" value="<?php echo $row["product_RAM"]; ?>" required>
        <label for="discrete_display_card" class="form-label">是否為獨顯</label>
        <input type="text" class="form-control" id="discrete_display_card" name="discrete_display_card" value="<?php echo $row["discrete_display_card"]; ?>" required>
        <label for="product_display_card" class="form-label">顯示晶片</label>
        <input type="text" class="form-control" id="product_display_card" name="product_display_card" value="<?php echo $row["product_display_card"]; ?>" required>
        <label for="product_hardisk_type" class="form-label">硬碟類型</label>
        <input type="text" class="form-control" id="product_hardisk_type" name="product_hardisk_type" value="<?php echo $row["product_hardisk_type"]; ?>" required>
        <label for="product_hardisk_volume" class="form-label">硬碟容量</label>
        <input type="text" class="form-control" id="product_hardisk_volume" name="product_hardisk_volume" value="<?php echo $row["product_hardisk_volume"]; ?>" required>
        <label for="product_I/O" class="form-label">I/O埠</label>
        <textarea type="text" class="form-control" id="product_I/O" name="product_I/O" required>
            <?php echo $row["product_I/O"]; ?></textarea>
        <button type="button" class="btn btn-primary">送出</button>

    </div>



    <script>
        let image_count = 0;

        function addImageFile() {
            image_count++;

            const container = document.createElement('div');
            container.className = 'image_input_container';

            const input = document.createElement('input');
            input.type = 'file';
            input.dataset.new_image = image_count;
            input.className = 'form-control add_image';
            input.setAttribute('onchange', 'previewImage(event)');
            input.required = true;

            const previewDiv = document.createElement('div');
            previewDiv.className = 'image_preview';

            container.appendChild(input);
            container.appendChild(previewDiv);

            document.getElementById('add_image').appendChild(container);
        }

        function removeImageFile() {
            image_count--;
            const add_image = document.getElementById('add_image');
            const last_image = add_image.lastElementChild;
            if (last_image) {
                add_image.removeChild(last_image);
            }
        }

        function previewImage(event) {
            const reader = new FileReader();
            const input = event.target;

            reader.onload = function() {
                const previewDiv = input.nextElementSibling; // 確保圖片預覽只顯示在對應的預覽區域
                previewDiv.innerHTML = '<img src="' + reader.result + '" class="product_img" />';
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <?php require_once("js.php"); ?>
</body>

</html>