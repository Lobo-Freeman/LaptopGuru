
<?php
// 確保已經包含資料庫連線
require_once("db_connect.php");

// 檢查是否有設定 restore_id
if(isset($_POST["restore_id"])){
    // 使用 intval() 函數來過濾輸入，避免 SQL 注入攻擊
    $restore_id = intval($_POST["restore_id"]);
    
    // 準備 SQL 查詢
    $sql = "UPDATE product SET valid = 1 WHERE product_id = ?";
    
    // 預備陳述式
    $stmt = $conn->prepare($sql);
    
    // 綁定參數
    $stmt->bind_param("i", $restore_id);
    
    // 執行陳述式
    if($stmt->execute()){
        // 返回 JSON 格式的成功訊息
        echo json_encode(["status" => 1, "message" => "商品上架成功。"]);
    } else {
        // 返回 JSON 格式的失敗訊息
        echo json_encode(["status" => 0, "message" => "刪除商品失敗。"]);
    }

    // 關閉陳述式
    $stmt->close();
} else {
    // 如果沒有設定 delete_id，返回錯誤訊息
    echo json_encode(["status" => 0, "message" => "無效的請求。"]);
}

// 關閉資料庫連線
$conn->close();
?>