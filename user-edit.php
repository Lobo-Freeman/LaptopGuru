<?php
if (!isset($_GET["id"])) {
    echo "請正確帶入 get id 變數";
    exit;
}

$id = $_GET["id"];

require_once("db_connect.php");

$sql = "SELECT * FROM users
WHERE user_id = '$id' AND valid=1
";
$result = $conn->query($sql);
$userCount = $result->num_rows;
$user = $result->fetch_assoc();

$sqlAddress = "SELECT * FROM addresses WHERE user_id = $id";
$resultAddress = $conn->query($sqlAddress);

$address = $resultAddress->fetch_assoc();


if ($userCount > 0) {
    $title = $user["name"];
} else {
    $title = "使用者不存在";
}

?>
<!doctype html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php include("css.php") ?>
</head>

<body>
    <div class="container">
        <div class="pt-5 pb-3">
            <a class="btn btn-secondary mb-3" href="user.php?id=<?= $user["user_id"] ?>" title="回使用者"><i class="fa-solid fa-left-long"></i></a>
        </div>
        <div class="row ">

            <h1>修改資料</h1>
            <?php if ($userCount > 0) : ?>
                <form action="doUpdateUser.php" method="post" id="user_info">
                    <table class="table table-bordered">
                        <input type="hidden" name="user_id" value="<?= $user["user_id"] ?>">
                        <tr>
                            <th>id</th>
                            <td><?= $user["user_id"] ?></td>
                        </tr>
                        <tr>
                            <th>Account</th>
                            <td><?= $user["account"] ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>
                                <input type="text" class="form-control" name="name" value="<?= $user["name"] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                <input type="text" class="form-control" name="email" value="<?= $user["email"] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>
                                <input type="text" class="form-control" name="phone" value="<?= $user["phone"] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="">Gender</label>
                            </th>
                            <td>
                                <div class="mb-2">
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if ($user['gender'] == 'male') echo "checked" ?>>

                                            <label class="form-check-label" for="male">male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if ($user['gender'] == 'female') echo "checked" ?>>
                                            <label class="form-check-label" for="female">female</label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <form action="doUpdateUser.php">
                            <?php if (isset($address)): ?>
                                <tr>
                                    <th>Address 1</th>
                                    <td>
                                        <input type="text" value="<?= $address["country"] ?>" name="country">
                                        <input type="text" value="<?= $address["city"] ?>" name="city">
                                        <input type="text" value="<?= $address["district"] ?>" name="district">
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <input type="text" value="<?= $address["remained_address"] ?>" name="remained_address">
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tr>
                        </form>
                    </table>

                    <a class="btn btn-danger" href="doDeleteUser.php?id=<?= $user["user_id"] ?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                    <button class="btn btn-primary" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i>
                    </button>


                </form>

                <?php if (!isset($address['user_id'])): ?>
                    <form action="doCreateAddress.php" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th>Add Address</th>
                                <td>
                                    <input type="hidden" value="<?= $user['user_id'] ?>" name="user_id">
                                    <input type="text" placeholder="國家" name="country">
                                    <input type="text" placeholder="縣市" name="city">
                                    <input type="text" placeholder="行政區" name="district">
                                    <input type="text" placeholder="地址" name="remained_address">
                                </td>
                            </tr>
                        </table>
                        <button class="btn btn-secondary mb-3" type="submit">送出</button>
                    </form>
                <?php endif; ?>
        </div>
        </table>


        </form>
    <?php else : ?>
        使用者不存在
    <?php endif; ?>
    </div>
    </div>
    </div>
    </div>
    <script>
        const user_info = document.querySelector("#user_info");

        user_info.addEventListener('submit', function(event) {
            // 檢查是否有選中任何一個選項
            if (!document.querySelector('input[name="gender"]:checked')) {
                alert('請選擇性別');
                event.preventDefault(); // 阻止表單提交
            }
        });
    </script>
</body>

</html>