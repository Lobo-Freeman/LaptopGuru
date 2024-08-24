<?php

require_once("db_connect.php");

if (!isset($_GET['id'])) {
    header("Location: rental_form.php");
}

$id = $_GET['id'];
$sql = "UPDATE rental SET state = 'available' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: laptop_content.php?id=$id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
