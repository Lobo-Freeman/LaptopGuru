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
            <form action="update-product.php" method="post" enctype="multipart/form-data">
                <label for="product_name">商品圖片</label>

                <?php
                if (isset($row["product_img_path"])) {
                    if (is_array($row["product_img_path"])) {
                        foreach ($row["product_img_path"] as $i => $img) {
                            echo "<img id='oldimg[{$row["img_id"]}]' src='assets/$img'  class='product_img'/>";
                            // echo "<button type='button' class='btn btn-secondary delete_old_img' data-old_img='{$row["img_id"]}'>移除舊圖片</button>";
                        }
                    } else {
                        echo "<img id='oldimg[{$row['img_id']}]' src='assets/{$row["product_img_path"]}'class='product_img'/>";
                        // echo "<button type='button' class='btn btn-secondary delete_old_img' data-old_img='{$row["img_id"]}'>移除舊圖片</button>";
                    }
                }
                ?>
                <!-- <button type="button" class="btn btn-secondary" onclick="addImageFile()">+</button>
                <button type="button" class="btn btn-secondary" onclick="removeImageFile()">-</button>
                <div id="add_image">

                </div> -->
                <div class="mb-2">                  
                    <input type="file" name="pic" class="form-control" value="<?=$row['img_product_id']?>">
                    <input type="hidden" name="original_pic" value="<?=$row['img_product_id']?>">
                </div>


                <label for="product_id">商品id</label>
                <input type="text" class="form-control" id="product_id" value="<?php echo $row["product_id"]; ?>" readonly name="product_id">
                <label for="model">商品型號</label>
                <input type="text" class="form-control" id="model" value="<?php echo $row["model"]; ?>" name="model">
                <label for="product_brand">品牌</label>
                <input type="text" class="form-control" id="product_brand" value="<?php echo $row["product_brand"]; ?>" name="product_brand">
                <label for="list_price" class="form-label">商品售價</label>
                <input type="number" class="form-control" id="list_price" value="<?php echo $row["list_price"]; ?>" name="list_price">
                <label for="affordance" class="form-label">用途</label>
                <input type="text" class="form-control" id="affordance" value="<?php echo $row["affordance"]; ?>" name="affordance">
                <label for="product_color" class="form-label">商品顏色</label>
                <input type="text" class="form-control" id="product_color" value="<?php echo $row["product_color"]; ?>" name="product_color">
                <label for="product_size" class="form-label">商品尺寸</label>
                <input type="text" class="form-control" id="product_size" value="<?php echo $row["product_size"]; ?>" name="product_size">
                <label for="product_weight" class="form-label">商品重量</label>
                <input type="text" class="form-control" id="product_weight" value="<?php echo $row["product_weight"]; ?>" name="product_weight">
                <label for="product_CPU" class="form-label">處理器</label>
                <input type="text" class="form-control" id="product_CPU" value="<?php echo $row["product_CPU"]; ?>" name="product_CPU">
                <label for="product_RAM" class="form-label">記憶體</label>
                <input type="text" class="form-control" id="product_RAM" value="<?php echo $row["product_RAM"]; ?>" name="product_RAM">
                <label for="discrete_display_card" class="form-label">是否為獨顯</label>
                <input type="text" class="form-control" id="discrete_display_card" value="<?php echo $row["discrete_display_card"]; ?>" name="discrete_display_card">
                <label for="product_display_card" class="form-label">顯示晶片</label>
                <input type="text" class="form-control" id="product_display_card" value="<?php echo $row["product_display_card"]; ?>" name="product_display_card">
                <label for="product_hardisk_type" class="form-label">硬碟類型</label>
                <input type="text" class="form-control" id="product_hardisk_type" value="<?php echo $row["product_hardisk_type"]; ?>" name="product_hardisk_type">
                <label for="product_hardisk_volume" class="form-label">硬碟容量</label>
                <input type="text" class="form-control" id="product_hardisk_volume" value="<?php echo $row["product_hardisk_volume"]; ?>" name="product_hardisk_volume">
                <label for="product_I/O" class="form-label">I/O埠</label>
                <textarea type="text" class="form-control" id="product_I_O" required name="product_I_O" rows="5">
                
                <?php echo $row["product_I/O"]; ?></textarea>
                <!-- <button type="button" class="btn btn-primary" onclick="updateProduct();">更新</button> -->
                <button type="submit" class="btn btn-secondary">
                    送出
                </button>
            </form>
        </div>
    </div>



    <script>
        let image_count = 0;
        let delete_old_img_arr = [];

        document.addEventListener('DOMContentLoaded', function() {
            const delete_old_img = document.querySelectorAll('.delete_old_img');
            delete_old_img.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const old_img_index = btn.dataset.old_img;
                    const old_img = document.getElementById('oldimg[' + old_img_index + ']');
                    old_img.remove();
                    btn.remove();
                    delete_old_img_arr.push(old_img_index);
                });
            });
        });

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


        function updateProduct() {

            // 選取所有 class 為 add_image 的 input 元素
            const newImages = document.querySelectorAll('.add_image');
            const formData = new FormData();

            // 遍歷每個文件輸入元素
            newImages.forEach(function(input) {
                if (input.files.length > 0) {
                    // 將每個選擇的文件添加到 FormData
                    for (let i = 0; i < input.files.length; i++) {
                        formData.append('file[]', input.files[i]);
                    }
                }
            });

            // Create an object to store the updated product data
            var updatedProduct = {
                product_id: <?php echo $row["product_id"]; ?>,
                delete_old_img_arr: delete_old_img_arr,
                new_images: formData,
                model: document.getElementById("model").value,
                product_brand: document.getElementById("product_brand").value,
                list_price: document.getElementById("list_price").value,
                affordance: document.getElementById("affordance").value,
                product_color: document.getElementById("product_color").value,
                product_size: document.getElementById("product_size").value,
                product_weight: document.getElementById("product_weight").value,
                product_CPU: document.getElementById("product_CPU").value,
                product_RAM: document.getElementById("product_RAM").value,
                discrete_display_card: document.getElementById("discrete_display_card").value,
                product_display_card: document.getElementById("product_display_card").value,
                product_hardisk_type: document.getElementById("product_hardisk_type").value,
                product_hardisk_volume: document.getElementById("product_hardisk_volume").value,
                product_I_O: document.getElementById("product_I_O").value
            };
            console.log(formData);
            // Send the updated product data to the server using AJAX
            $.ajax({
                type: "POST",
                url: "update-product.php",
                data: updatedProduct,
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.status === 1) {
                        alert(result.message);
                        window.location.href = "product-list.php";
                    } else {
                        alert(result.message);
                    }
                }
            });
        }
    </script>
    <?php require_once("js.php"); ?>
</body>

</html>