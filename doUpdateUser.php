<?php

require_once("db_connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入此頁";
    exit;
}

$id=$_POST["user_id"];
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];

if(isset($_POST["gender"])){
    $gender=$_POST["gender"];
};

$country=$_POST["country"];
$city=$_POST["city"];
$district=$_POST["district"];
$remained_address=$_POST["remained_address"];


$sql="UPDATE users SET name='$name', phone='$phone', email='$email',gender='$gender' WHERE user_id=$id";

$sqlAddress="INSERT INTO `addresses` ( `user_id`, `country`, `city`, `district`, `remained_address`) VALUES ('$id', '$country', '$city', '$district', '$remained_address');";




if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

header("location: user.php?id=$id");

$conn->close();
