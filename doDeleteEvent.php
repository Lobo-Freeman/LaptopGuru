<?php

require_once("db_connect.php");

if(!isset($_GET["event_id"])){
    echo "請從正確的管道進入";
    exit();
}

$id = $_GET["event_id"];

$sql = "UPDATE events SET valid = 0 WHERE event_id = $id";

$conn->query($sql);

$conn->close();

header("Location: events.php");
