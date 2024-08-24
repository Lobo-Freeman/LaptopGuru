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

$sql = "SELECT id, images, model, brand, price, num, state, user_id, created_at FROM rental";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_all()) {
    // Construct the full image path
    $imagePath = "/topics/image/" . $row["images"];
    echo "id: " . $row["id"]. " - <img src='" . $imagePath . "' alt='" . $row["model"] . "' style='width:100px;height:auto;'> " . $row["model"] . "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>