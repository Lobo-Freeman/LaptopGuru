<?php
if (!isset($_FILES["model"])) {
    echo "請循正常管道進入此頁";
    exit;
}

require_once("../topics/db_connect.php");

$images = $_POST["images"];

$sql = "UPDATE rental SET images='$images'
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