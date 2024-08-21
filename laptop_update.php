<?php
if (!isset($_POST["model"])) {
    echo "請循正常管道進入此頁";
    exit;
}

require_once("../topics/db_connect.php");

$id = $_POST["id"];
$images=$_POST["images"];
$original_images=$_POST['original_images'];
$model = $_POST["model"];
$brand = $_POST["brand"];
$price = $_POST["price"];
$created_at= date('Y-m-d H:i:s');

if(!isset($_POST["images"])){
   $images = $original_images;
}


$sql = "UPDATE rental SET images='$images', model='$model', brand='$brand', price='$price' , created_at='$created_at'
where id = '$id' 
";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
   } else {
    echo "更新錯誤: " . $conn->error;
   }
   
header("location: laptop_edit.php?id=$id");

?>
<?php
$conn->close();
?>