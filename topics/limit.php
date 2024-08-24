<?php

$per_page=3;
$page=1;
$start_item=($page-1)*$per_page;

require_once("../topics/db_connect.php");

$sql="SELECT * FROM rental WHERE valid=1 LIMIT $start_item, $per_page";

$result = $conn->query($sql);
$rows=$result->fetch_all(MYSQLI_ASSOC);

var_dump($rows);


$conn->close();