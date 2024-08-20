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
$address = $resultAddress->fetch_assoc();




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
            <form action="doUpdateUser.php" method="post">
                <table class="table table-bordered ">
                    <input type="hidden" value="<?=$user['user_id']?>" name="user_id">
                    <tr>
                        <th>用戶id</th>
                        <td><?=$user['user_id']?></td>
                    </tr>
                    <tr>
                        <th>用戶名稱</th>
                        <td>
                            <input type="text" value="<?=$user['name']?>" name="name">
                        </td>
                    </tr>
                    <?php if(isset($address)):?>               
                    <tr>
                        <th>地址</th>
                        <td>
                            <input type="text" value="<?=$address['country']?>" name="country">
                            <input type="text" value="<?=$address['city']?>" name="city">
                            <input type="text" value="<?=$address['district']?>" name="district">
                            <input type="text" value="<?=$address['remained_address']?>" name="remained_address">                            
                        </td>
                    </tr>
                    <?php endif; ?> 
                </table>
                <button class="btn btn-secondary mb-3" type="submit">送出</button>
            </form>
            <?php if(!isset($address['user_id'])):?>
                <form action="doCreateAddress.php" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <th>地址</th>
                            <td>
                                <input type="hidden" value="<?=$user['user_id']?>" name="user_id">
                                <input type="text" placeholder="國家"  name="country">
                                <input type="text" placeholder="縣市" name="city">
                                <input type="text" placeholder="行政區" name="district">
                                <input type="text" placeholder="地址"  name="remained_address">                            
                            </td>
                        </tr>
                    </table>
                    <button class="btn btn-secondary mb-3" type="submit">送出</button>
                </form>
            <?php endif; ?>                    
        </div>
    </body>
</html>
