<!doctype html>
<html lang="en">

<head>
    <title>Create Event</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <?php include("css.php"); ?>
    <?php include("js.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="mb-4">
            <a href="events.php" class="btn btn-secondary">
                <i class="fa-solid fa-left-long"></i> 返回活動列表
            </a>
        </div>
        <h1 class="h2 mb-4">建立活動</h1>
        <!-- 添加 enctype 属性 -->
        <form action="doCreateEvent.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label" for="event_name">活動名稱</label>
                <input type="text" class="form-control" name="event_name" id="event_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="event_type">活動類別</label>
                <input type="text" class="form-control" name="event_type" id="event_type" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="event_content">活動內容</label>
                <textarea class="form-control" name="event_content" id="event_content" rows="6" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="event_platform">平台</label>
                <select class="form-select" name="event_platform" id="event_platform" required>
                    <option value="" disabled selected>請選擇平台</option>
                    <option value="pc">PC</option>
                    <option value="mobile">Mobile</option>
                    <option value="switch">Switch</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="individual_or_team">個人or團隊</label>
                <select class="form-select" name="individual_or_team" id="individual_or_team" required>
                    <option value="" disabled selected>請選擇</option>
                    <option value="個人">個人</option>
                    <option value="團隊">團隊</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="event_picture">活動照片</label>
                <input type="file" class="form-control" id="event_picture" name="event_picture" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="apply_start_time">報名開始時間</label>
                <input type="datetime-local" class="form-control" id="apply_start_time" name="apply_start_time" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="apply_end_time">報名結束時間</label>
                <input type="datetime-local" class="form-control" id="apply_end_time" name="apply_end_time" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="event_start_time">活動開始時間</label>
                <input type="datetime-local" class="form-control" id="event_start_time" name="event_start_time" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="maximum_people">人數上限</label>
                <input type="number" class="form-control" name="maximum_people" id="maximum_people" required>
            </div>
            <button type="submit" class="btn btn-secondary">送出</button>
        </form>
    </div>

</body>

</html>
