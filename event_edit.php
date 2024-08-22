<?php

if (!isset($_GET["event_id"])) {
    echo "請輸入正確的id";
    exit();
}
$id = $_GET["event_id"];

require_once("db_connect.php");

$sql = "SELECT * FROM events WHERE event_id = $id AND valid = 1";
$result = $conn->query($sql);
$eventCount = $result->num_rows;
$row = $result->fetch_assoc();





if ($eventCount > 0) {
    $title = $row["event_name"];
} else {
    $title = "找不到活動";
}

?>

<!doctype html>
<html lang="en">

<head>
    <title><?= $title ?></title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php include("css.php");

    ?>
</head>

<body>
    <div class="container">
        <div class="py-2">
            <a href="event.php?event_id=<?= $row["event_id"] ?>" class="btn btn-secondary">
                <i class="fa-solid fa-rotate-left"></i>
            </a>
        </div>
        <h1>修改活動資料</h1>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <?php if ($eventCount > 0) : ?>
                    <form action="doUpdateEvent.php" enctype="multipart/form-data" method="post">
                        <table class="table table-bordered">
                            <input type="hidden" name="event_id" value="<?= $row["event_id"] ?>">
                            <tr>
                                <th>活動Id</th>
                                <td><?= $row["event_id"] ?></td>
                            </tr>
                            <tr>
                                <th>活動名稱</th>
                                <td>
                                    <input type="text" class="form-control" name="event_name" value="<?= $row["event_name"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>活動種類</th>
                                <td>
                                    <input type="text" class="form-control" name="event_type" value="<?= $row["event_type"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>活動內容</th>
                                <td>
                                    <textarea class="form-control" name="event_content"><?= $row["event_content"] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>活動平台</th>
                                <td>
                                    <input type="text" class="form-control" name="event_platform" value="<?= $row["event_platform"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>個人or團隊</th>
                                <td>
                                    <input type="text" class="form-control" name="individual_or_team" value="<?= $row["individual_or_team"] ?>">
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <th>活動照片</th>
                                <td>
                                    <!-- 隱藏輸入欄位用於保存原有圖片路徑 -->
                                    <input type="hidden" name="original_event_picture" value="<?= $row['event_picture'] ?? '' ?>">

                                    <!-- 文件上傳輸入欄位 -->
                                    <input type="file" class="form-control" name="event_picture" id="event_picture" accept="image/*">

                                    <!-- 顯示當前圖片（如果存在） -->
                                    <?php if (!empty($row["event_picture"])): ?>
                                        <img class="img-fluid mt-2" src="../event_images/<?= $row['event_picture'] ?>" alt="Current Event Picture" style="max-width: 200px;">
                                        <p class="mt-1">當前圖片: <?= $row['event_picture'] ?></p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>報名開始時間</th>
                                <td>
                                    <input type="text" class="form-control" name="apply_start_time" value="<?= date('Y-m-d H:i', strtotime($row["apply_start_time"])) ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>報名結束時間</th>
                                <td>
                                    <input type="text" class="form-control" name="apply_end_time" value="<?= date('Y-m-d H:i', strtotime($row["apply_end_time"])) ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>活動開始時間</th>
                                <td>
                                    <input type="text" class="form-control" name="event_start_time" value="<?= date('Y-m-d H:i', strtotime($row["event_start_time"])) ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>人數上限</th>
                                <td>
                                    <input type="text" class="form-control" name="maximum_people" value="<?= $row["maximum_people"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>發起時間</th>
                                <td><?= $row["created_at"] ?></td>
                            </tr>
                        </table>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-secondary">
                                <i class="fa-solid fa-floppy-disk"></i>
                                儲存
                            </button>
                            <a href="doDeleteEvent.php?event_id=<?= $row["event_id"] ?>" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                                刪除
                            </a>
                        </div>
                    </form>

                <?php else : ?>
                    找不到使用者
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>