<?php

require_once("../topics/db_connect.php");

$sql = "SELECT * FROM rental WHERE state='available' and price BETWEEN 500 and 2000";
$result = $conn->query($sql);
$laptopModel = $result->fetch_all(MYSQLI_ASSOC);

var_dump($laptopModel);

?>


<?php
$conn->close();
?>
