<!doctype html>
<html lang="en">
    <head>
        <title>新增優惠券</title>
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
            <h1>新增優惠券</h1>
            <a href="coupon-list.php" class="btn btn-primary mb-3">
                <i class="fa-solid fa-arrow-rotate-left"></i>回到列表
            </a>
            <form action="doAddCoupon.php" method="post">
                <div class="mb-3">
                    <label class="form-label" for="coupon_code">優惠券代碼</label>
                    <input type="text" class="form-control" name="coupon_code">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="coupon_content">優惠券內容</label>
                    <input type="" class="form-control" name="coupon_content">
                </div>
                <div class="mb-3">
                    <label for="coupon_discount">折扣範圍</label>
                   <input type="text" class="form-control" name="coupon_discount">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="coupon_start_time">開始時間</label>
                    <input type="datetime-local" class="form-control" name="coupon_start_time">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="coupon_end_time">結束時間</label>
                    <input type="datetime-local" class="form-control" name="coupon_end_time">
                </div>
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    送出
                </button>                
            </form>
        </div>
    </body>
</html>
