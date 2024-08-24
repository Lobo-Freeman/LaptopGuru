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
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php include("event_css.php");

    ?>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-8">
                <div class="event-card">
                    <?php if ($eventCount > 0) : ?>
                        <h1 class="event-title"><?= $row["event_name"] ?></h1>

                        <div class="row">
                            <div class="col-md-4">
                                <img src="../event_images/<?= $row['event_picture'] ?>" alt="<?= $row["event_name"] ?>" class="event-image">
                            </div>
                            <div class="col-md-8">
                                <div class="section-title">基本信息</div>
                                <div class="info-group">
                                    <span class="info-label">活動ID:</span>
                                    <span class="info-value"><?= $row["event_id"] ?></span>
                                </div>
                                <div class="info-group">
                                    <span class="info-label">活動種類:</span>
                                    <span class="info-value"><?= $row["event_type"] ?></span>
                                </div>
                                <div class="info-group">
                                    <span class="info-label">活動平台:</span>
                                    <span class="info-value"><?= $row["event_platform"] ?></span>
                                </div>
                                <div class="info-group">
                                    <span class="info-label">個人或團隊:</span>
                                    <span class="info-value"><?= $row["individual_or_team"] ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="section-title">時間信息</div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="info-group">
                                        <div class="info-label">報名開始時間</div>
                                    <div class="info-value"><?= $row["apply_start_time"] ?></div>
                                </div>
                                <div class="info-group">
                                    <div class="info-label">報名結束時間</div>
                                    <div class="info-value"><?= $row["apply_end_time"] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">活動開始時間</div>
                                    <div class="info-value"><?= $row["event_start_time"] ?></div>
                                </div>
                                <div class="info-group">
                                    <div class="info-label">發起時間</div>
                                    <div class="info-value"><?= $row["created_at"] ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="section-title">活動詳情</div>
                        <div class="info-group">
                            <div class="info-label">人數上限</div>
                            <div class="info-value"><?= $row["maximum_people"] ?></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">活動內容</div>
                            <div class="info-value"><?= nl2br($row["event_content"]) ?></div>
                        </div>

                        <div class="mt-4">
                            <a href="events.php" class="btn btn-secondary btn-action">
                                <i class="fa-solid fa-rotate-left"></i> 返回列表
                            </a>
                            <a href="event_edit.php?event_id=<?= $row["event_id"] ?>" class="btn btn-primary btn-action">
                                <i class="fa-solid fa-user-pen"></i> 編輯活動
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-warning">找不到活動</div>
                    <?php endif; ?>
                </div>

            <div class="col">
                <?php if ($eventCount > 0) : ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>活動Id</th>
                            <td><?= $row["event_id"] ?></td>
                        </tr>
                        <tr>
                            <th>活動名稱</th>
                            <td><?= $row["event_name"] ?></td>
                        </tr>
                        <tr>
                            <th>活動種類</th>
                            <td><?= $row["event_type"] ?></td>
                        </tr><tr>
                            <th>活動內容</th>
                            <td><?= $row["event_content"] ?></td>
                        </tr><tr>
                            <th>活動平台</th>
                            <td><?= $row["event_platform"] ?></td>
                        </tr><tr>
                            <th>個人or團隊</th>
                            <td><?= $row["individual_or_team"] ?></td>
                        </tr><tr>
                            <th>活動照片</th>
                            <td><img class="img-fluid" src="event_images/<?= $row['event_picture'] ?>" alt=""></td>
                        </tr><tr>
                            <th>報名開始時間</th>
                            <td><?= $row["apply_start_time"] ?></td>
                        </tr><tr>
                            <th>報名結束時間</th>
                            <td><?= $row["apply_end_time"] ?></td>
                        </tr><tr>
                            <th>活動開始時間</th>
                            <td><?= $row["event_start_time"] ?></td>
                        </tr>
                        </tr><tr>
                            <th>人數上限</th>
                            <td><?= $row["maximum_people"] ?></td>
                        </tr>
                        <tr>
                            <th>發起時間</th>
                            <td><?= $row["created_at"] ?></td>
                        </tr>
                    </table>
                    <div class="py-2">
                        <a href="event_edit.php?event_id=<?= $row["event_id"] ?>" class="btn btn-secondary">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>
                    </div>




                <?php else : ?>
                    找不到使用者
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>

</html>