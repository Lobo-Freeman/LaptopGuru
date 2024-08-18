<?php
session_start();



?>

<!doctype html>
<html lang="en">

<head>
    <title>新增優惠券</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <?php include "css.php"; ?>
</head>

<body>
    <div class="container">
        <?php include "modal.php"; ?>
        <h1>新增優惠券</h1>
        <a href="coupon-list.php" class="btn btn-primary mb-3">
            <i class="fa-solid fa-arrow-rotate-left"></i>回到列表
        </a>
        <form action="doAddCoupon.php" method="post">
            <div class="mb-3">
                <label class="form-label" for="coupon_code">優惠券代碼</label>
                <input type="text" class="form-control" name="coupon_code" value="" id="coupon_code">
                <div>
                    <small class="text-muted">請輸入6~20位數字或英文</small>
                </div>
                <button type="button" class="btn btn-primary mt-2" id="random">隨機產生優惠券代碼</button>
            </div>
            <div class="mb-3">
                <label class="form-label" for="coupon_content">優惠券內容</label>
                <input type="text" class="form-control" name="coupon_content">
            </div>
            <div class="mb-3" id="discountMethod">
                <label class="form-label" for="discount_method">折扣種類</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="discount_method" checked>
                    <label class="form-check-label" value="0">
                        依售價百分比折扣
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="discount_method">
                    <label class="form-check-label" value="1">
                        依優惠金額折扣
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="coupon_discount">折扣範圍</label>
                <input type="text" class="form-control" name="coupon_discount">
                <div class="text-end" id="quantifier">%</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="coupon_start_time">開始時間</label>
                <input type="datetime-local" class="form-control" name="coupon_start_time" id="coupon_start_time">
            </div>
            <div class="mb-3">
                <label class="form-label" for="coupon_end_time">結束時間</label>
                <input type="datetime-local" class="form-control" name="coupon_end_time" id="coupon_end_time">
            </div>
            <button
                type="submit"
                class="btn btn-primary">
                送出
            </button>
        </form>
    </div>

    <?php include "js.php"; ?>
    <script>
        const randomKeyIn = document.querySelector("#random");
        const coupon_code = document.querySelector("#coupon_code");
        const discountMethod = document.querySelector("#discountMethod");
        const quantifier = document.querySelector("#quantifier");
        const coupon_start_time = document.querySelector("#coupon_start_time");
        const coupon_end_time = document.querySelector("#coupon_end_time");
        const infoModal = new bootstrap.Modal(document.getElementById('infoModal', {
            keyboard: true
        }));
        const info = document.querySelector("#info");

        <?php if (isset($_SESSION["error"])): ?>
            info.textContent = "<?php echo $_SESSION["error"]; ?>";
            infoModal.show();
            <?php unset($_SESSION["error"]); ?>
        <?php endif; ?>

        randomKeyIn.addEventListener("click", function() {
            let randomCode = Math.random().toString(36).substr(2, 12);
            coupon_code.value = randomCode;
        });

        discountMethod.addEventListener("change", function() {
            if (quantifier.textContent === "%") {
                quantifier.textContent = "元";
            } else {
                quantifier.textContent = "%";
            }

        });

        coupon_end_time.addEventListener("change", function() {
            if (coupon_start_time.value > coupon_end_time.value) {
                info.textContent = "開始時間不可以比結束時間晚";
                coupon_end_time.value = "";
                infoModal.show();
            }
        });
    </script>
</body>

</html>