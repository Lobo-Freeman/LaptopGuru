<?php
$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "my_test_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
if ($conn->connect_error) {
 die("連線失敗: " . $conn->connect_error);
}else{
    // echo "連線成功";
}


// require_once("../topics/rental_connect.php");
$sql = "SELECT id, images, model, brand, price, num, state, user_id, created_at FROM rental where state='available' ";//and
$result = $conn->query($sql);

$data = array();

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         $data[] = $row;
//     }
// } 

if ($result->num_rows > 0) {
    $data = $result->fetch_all(MYSQLI_ASSOC); // 直接使用 fetch_all 並指定返回關聯數組
}


// 將數據以 JSON 格式輸出
header('Content-Type: application/json');
echo json_encode($data);
?>

<?php
$conn->close();
?>