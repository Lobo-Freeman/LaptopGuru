<?php
    require_once "db_connect.php";
    $sql = "SELECT * FROM coupon WHERE valid = 1";

    $result = $conn->query($sql);
    
    $rows = $result->fetch_all(MYSQLI_ASSOC);    
    $rowsCount = $result->num_rows;

    


?>
<!doctype html>
<html lang="en">
    <head>
        <title>優惠券列表</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <?php include "css.php"; ?>
    </head>

    <body>
       <div class="container">
            <h1>優惠券</h1>
            <a href="coupon-add.php" class="btn btn-primary mb-3"><i class="fa-solid fa-plus"></i>新增優惠券</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>優惠券ID</th>
                        <th>優惠券代碼</th>
                        <th>開始時間</th>
                        <th>到期時間</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($rowsCount>0): ?>
                        <?php foreach($rows as $row): ?>
                            <tr>
                                <td><?php echo $row['coupon_id']; ?></td>
                                <td><?php echo $row['coupon_code']; ?></td>
                                <td><?php echo $row['coupon_start_time']; ?></td>
                                <td><?php echo $row['coupon_end_time']; ?></td>
                                <td>
                                    <a href="coupon.php?id=<?php echo $row['coupon_id']; ?>" class="btn btn-primary">
                                        <i class="fa-solid fa-eye"></i>優惠券內容
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h2>沒有優惠券</h2>
                    <?php endif; ?>
                </tbody>
            </table>
       </div>
        
    </body>




    <script>
       

    </script>
</html>
