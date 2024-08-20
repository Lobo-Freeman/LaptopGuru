<?php
require_once 'db_connect.php';

if(!isset($_GET['id'])){
    header('Location: users.php');
}

$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE user_id = $id";
$sqlAddress = "SELECT * FROM addresses WHERE user_id = $id";

$resultAddress = $conn->query($sqlAddress);
$result = $conn->query($sql);

$user = $result->fetch_assoc();
$address = $resultAddress->fetch_all(MYSQLI_ASSOC);




?>
<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <?php include 'css.php'; ?>
    </head>

    <body>
        <div class="container">
            <h1><?=$user['name']?>用戶資料</h1>
                <table class="table table-bordered">
                    <tr>
                        <th>用戶id</th>
                        <td><?=$user['user_id']?></td>
                    </tr>
                    <tr>
                        <th>用戶名稱</th>
                        <td><?=$user['name']?></td>
                    </tr>
                    <?php foreach($address as $row): ?>
                    <tr>
                        <th>地址</th>
                        <td>
                            <?=$row['country']?><?=$row['city']?><?=$row['district']?><?=$row['remained_address']?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
        </div>
    </body>
</html>
