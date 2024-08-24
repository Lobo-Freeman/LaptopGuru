<?php

//移除舊圖片
// if(isset($_POST["delete_old_img_arr"])){
//     $delete_old_img_arr = $_POST["delete_old_img_arr"];
//     foreach($delete_old_img_arr as $delete_old_img){
//         $sql = "DELETE FROM product_img WHERE img_id = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("i", $delete_old_img);
//         if($stmt->execute()){
//             echo json_encode(["status" => 1, "message" => "舊圖片刪除成功。"]);
//         } else {
//             echo json_encode(["status" => 0, "message" => "舊圖片刪除失敗。"]);
//         }
//         $stmt->close();
//     }
// }

// //新增新圖片
// if(isset($_FILES["new_images"])){
//     $new_images = $_POST["new_images"];
//     $product_id = $_POST["product_id"];
//     foreach($new_images as $add_img){
//         $sql = "INSERT INTO product_img (img_product_id, product_img_path) VALUES (?, ?)";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("i", $product_id, "s", $add_img);
//         if($stmt->execute()){
//             echo json_encode(["status" => 1, "message" => "新圖片新增成功。"]);
//         } else {
//             echo json_encode(["status" => 0, "message" => "新圖片新增失敗。"]);
//         }
//         $stmt->close();
//     }
    
    
// }else{
//     echo json_encode(["status" => 0, "message" => "無效的請求。"]);
// }


// $conn->close();



require_once("db_connect.php");

$product_id = $_POST["product_id"];
$model = $_POST["model"];
$product_brand = $_POST["product_brand"];
$list_price = $_POST["list_price"];
$affordance = $_POST["affordance"];
$product_color = $_POST["product_color"];
$product_size = $_POST["product_size"];
$product_weight = $_POST["product_weight"];
$product_CPU = $_POST["product_CPU"];
$product_RAM = $_POST["product_RAM"];
$discrete_display_card = $_POST["discrete_display_card"];
$product_display_card = $_POST["product_display_card"];
$product_hardisk_type = $_POST["product_hardisk_type"];
$product_hardisk_volume = $_POST["product_hardisk_volume"];
$product_I_O = $_POST["product_I_O"];
$pic = $_FILES["pic"];
$original_pic = $_POST["original_pic"];

var_dump($pic);







//echo $title;

// $pic = $_FILES["pic"];//取得上傳檔案的資訊
// var_dump($pic);

if($_FILES["pic"]["error"]==0){
    $filename=$_FILES["pic"]["name"];
    $fileinfo=pathinfo($filename);//取得檔案資訊
    $extention=$fileinfo["extension"];//取得副檔名
    // echo $extention;
    // exit;
    
    $newFilename=pathinfo($filename, PATHINFO_FILENAME)."_".time().".$extention";

    $Imgcheck = "SELECT * FROM product_img WHERE img_product_id = $product_id";
    $result = $conn->query($Imgcheck);
    $resultCount = $result->num_rows;

    if(move_uploaded_file($_FILES["pic"]["tmp_name"], "assets/".$newFilename)){//將檔案移動到指定位置
        

        if($resultCount > 0){
            $sqlImg = "UPDATE product_img SET product_img_path = '$newFilename' WHERE img_product_id = $product_id";
            if($conn->query($sqlImg)===true){
                echo "New record created successfully";
             }else{
                 echo "Error:".$sqlImg."<br>".$conn->error;
             }
        }else{
            $sqlImg = "INSERT INTO product_img(img_product_id,product_img_path) VALUES ('$product_id', '$newFilename' )";
            if($conn->query($sqlImg)===true){
               echo "New record created successfully";
            }else{
                echo "Error:".$sqlImg."<br>".$conn->error;
            }
        }
        

    }else{
        echo "Upload Fail";
    }

    


}

$sql = "UPDATE product SET model = ?, product_brand = ?, list_price = ?, affordance = ?, product_color = ?, product_size = ?, product_weight = ?, product_CPU = ?, product_RAM = ?, discrete_display_card = ?, product_display_card = ?, product_hardisk_type = ?, product_hardisk_volume = ?, `product_I/O` = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssssssssssssi", $model, $product_brand, $list_price, $affordance, $product_color, $product_size, $product_weight, $product_CPU, $product_RAM, $discrete_display_card, $product_display_card, $product_hardisk_type, $product_hardisk_volume, $product_I_O, $product_id);

    if($stmt->execute()){
        echo json_encode(["status" => 1, "message" => "商品更新成功。"]);
    } else {
        echo json_encode(["status" => 0, "message" => "商品更新失敗。"]);
    }



$stmt->close();

$conn->close();

    header("Location: product-list.php");


