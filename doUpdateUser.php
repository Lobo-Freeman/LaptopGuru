<?php

require_once 'db_connect.php';

$id = $_POST['user_id'];

$name = $_POST['name'];

$country = $_POST['country'];
$city = $_POST['city'];
$district = $_POST['district'];
$remained_address = $_POST['remained_address'];

$sql = "UPDATE users SET name = '$name' WHERE user_id = $id";
$sqlAddress = "UPDATE addresses SET country = '$country', city = '$city', district = '$district', remained_address = '$remained_address' WHERE user_id = $id";

if($conn->query($sql) === TRUE){
    echo '用戶更新成功';
}else{
    echo '更新失敗';
}

if($conn->query($sqlAddress) === TRUE){
    echo '地址更新成功';
}else{
    echo '更新失敗';
}

