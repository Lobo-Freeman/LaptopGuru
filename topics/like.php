<?php

require_once("../topics/db_connect.php");

$sql = "SELECT * FROM rental WHERE model LIKE '%Vector%'";
$result = $conn->query($sql);
$laptopModel = $result->fetch_all(MYSQLI_ASSOC);

var_dump($laptopModel);
?>


<?php
$conn->close();
?>
