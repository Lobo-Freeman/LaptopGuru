<!doctype html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php include("css.php") ?>
</head>

<body>
    <div class="container">
        <form action="doCreateUser.php" id="signupForm" method="post">
            <h1>註冊帳號</h1>
            <!-- sign-in判斷這個帳號是管理員嗎?還有判斷這個帳號是否已經存在 -->
            <div class="mb-2">
                <label class="form-label" for="account"><span class="text-danger">*</span> Account</label>
                <input type="text" class="form-control" name="account" id="account" placeholder="請輸入英文與數字組合" required>
            </div>
            <div class="mb-2">
                <label class="form-label" for="password"><span class="text-danger">*</span> Password</label>
                <input type="password" class="form-control" id="password" placeholder="密碼不能小於6個字元" name="password" required>
            </div>
            <div class="mb-2">
                <label class="form-label" for="re-type"><span class="text-danger">*</span> Re-type Password</label>
                <input type="password" class="form-control" id="repassword" name="repassword" placeholder="請重新輸入密碼" required>
            </div>
            <div class="mb-2">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="請輸入真名">
            </div>
            <div class="mb-2">
                <label class="form-label" for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="請輸入手機號碼">
            </div>
            <div class="mb-2">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>

            <button class="btn btn-primary" type="submit" id="send">送出</button>
        </form>
    </div>
    <?php include("js.php") ?>
    <script>
        const account = document.querySelector("#account");
        const password = document.querySelector("#password")
        const repassword = document.querySelector("#repassword");
        const name = document.querySelector("#name")
        const phone = document.querySelector("#phone")
        const email = document.querySelector("#email")
        const send = document.querySelector("#send")


        // if (!email.includes('@')) {
        //     alert('Please enter a valid email address');
        //     event.preventDefault();
        // }

        send.addEventListener("click", function(event) {
            let accountVal = account.value;
            let passwordVal = password.value;
            let repasswordVal = repassword.value;
            let nameVal = name.value;
            let phoneVal = phone.value;
            let emailVal = email.value;
            
            console.log(nameVal.length);
            
            if (nameVal.length < 2 || nameVal.length > 15) {
                alert('Name must be between 3 and 15 characters');
                event.preventDefault(); // 阻止表單提交
            }
            if (passwordVal.length < 6) {
                alert('Password must be at least 6 characters long');
                event.preventDefault();
            }
            if (passwordVal.length < 6) {
                alert('Password must be at least 6 characters long');
                event.preventDefault();
            }

            window.location.href = "sign-in.php";


            // $.ajax({
            //         method: "POST",
            //         url: "/api/doCreateUser.php",
            //         dataType: "json",
            //         data: {
            //             account: accountVal,
            //             password: passwordVal,
            //             repassword: repasswordVal,
            //             name: nameVal,
            //             phone: phoneVal,
            //             email: emailVal
            //         } //如果需要
            //     })
            //     .done(function(response) {
            //         // console.log(response);
            //         let status = response.status;
            //         if (status == 0) {
            //             alert(response.message)
            //             return;
            //         }
            //         if (status == 1) {
            //             alert(response.message);
            //             return;
            //         }


            //     }).fail(function(jqXHR, textStatus) {
            //         console.log("Request failed: " + textStatus);
            //     });
        })
    </script>
</body>

</html>