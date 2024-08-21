<?php

require_once ("db_connect.php");

$id = $_POST['user_id'];
$country = $_POST['country'];
$city = $_POST['city'];
$district = $_POST['district'];
$remained_address = $_POST['remained_address'];

$sql = "INSERT INTO addresses (user_id, country, city, district, remained_address) VALUES ($id, '$country', '$city', '$district', '$remained_address')";

if($conn->query($sql) === TRUE){
    echo '地址新增成功';
}else{
    echo '新增失敗';
}