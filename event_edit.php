<?php

if (!isset($_GET["event_id"])) {
    echo "請輸入正確的id";
    exit();
}
$event_id = $_GET["event_id"];

require_once("db_connect.php");

$sql = "SELECT * FROM events WHERE event_id = $event_id AND valid = 1";
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

    <?php include("event_css.php");
    include("js.php");
    ?>
</head>

<body>
    <div class="container">
        <div class="py-4">
            <a href="event.php?event_id=<?= $row["event_id"] ?>" class="btn btn-secondary">
                <i class="fa-solid fa-rotate-left"></i> 返回
            </a>
        </div>
        <div class="form-container">
            <h1 class="mb-4">修改活動資料</h1>
            <?php if ($eventCount > 0) : ?>
                <form action="doUpdateEvent.php" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="event_id" value="<?= $row["event_id"] ?>">

                    <div class="form-group">
                        <label for="event_name">活動名稱</label>
                        <input type="text" class="form-control" id="event_name" name="event_name" value="<?= $row["event_name"] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="event_type">活動種類</label>
                        <input type="text" class="form-control" id="event_type" name="event_type" value="<?= $row["event_type"] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="event_content">活動內容</label>
                        <textarea class="form-control" id="event_content" name="event_content" rows="6" required><?= $row["event_content"] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="event_platform">活動平台</label>
                        <input type="text" class="form-control" id="event_platform" name="event_platform" value="<?= $row["event_platform"] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="individual_or_team">個人或團隊</label>
                        <select class="form-control" id="individual_or_team" name="individual_or_team" required>
                            <option value="個人" <?= $row["individual_or_team"] == "個人" ? "selected" : "" ?>>個人</option>
                            <option value="團隊" <?= $row["individual_or_team"] == "團隊" ? "selected" : "" ?>>團隊</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="event_picture">活動照片</label>
                        <input type="file" class="form-control" id="event_picture" name="event_picture" accept="image/*">
                        <input type="hidden" name="original_event_picture" value="<?= $row['event_picture'] ?? '' ?>">
                        <?php if (!empty($row["event_picture"])): ?>
                            <img class="img-fluid mt-2 image-preview" src="../event_images/<?= $row['event_picture'] ?>" alt="Current Event Picture">
                            <p class="mt-1">當前圖片: <?= $row['event_picture'] ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="apply_start_time">報名開始時間</label>
                        <input type="text" class="form-control flatpickr" id="apply_start_time" name="apply_start_time" value="<?= date('Y-m-d H:i', strtotime($row["apply_start_time"])) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="apply_end_time">報名結束時間</label>
                        <input type="text" class="form-control flatpickr" id="apply_end_time" name="apply_end_time" value="<?= date('Y-m-d H:i', strtotime($row["apply_end_time"])) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="event_start_time">活動開始時間</label>
                        <input type="text" class="form-control flatpickr" id="event_start_time" name="event_start_time" value="<?= date('Y-m-d H:i', strtotime($row["event_start_time"])) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="maximum_people">人數上限</label>
                        <input type="number" class="form-control" id="maximum_people" name="maximum_people" value="<?= $row["maximum_people"] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>發起時間</label>
                        <p class="form-control-static"><?= $row["created_at"] ?></p>
                    </div>

                    <!-- Button trigger modal -->
                    <div class="btn-group">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa-solid fa-floppy-disk"></i> 儲存
                        </button>
                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-trash"></i> 刪除
                        </a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">是否確定刪除 ! ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    刪了就沒了喔 ! ! !
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                    <a href="doDeleteEvent.php?event_id=<?= $row["event_id"] ?>" class="btn btn-danger">
                                        刪除
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php else : ?>
                <p class="alert alert-warning">找不到活動</p>
            <?php endif; ?>
        </div>
    </div>
    <script>
    flatpickr(".flatpickr", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
</script>
</body>

</html>