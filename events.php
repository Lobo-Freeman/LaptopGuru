<?php
require_once("db_connect.php");
include("css.php");

$sqlAll = "SELECT * FROM events WHERE valid = 1";
$resultAll = $conn->query($sqlAll);
$eventCountAll = $resultAll->num_rows;

$per_page = 5;
$page = 1;
$start_item = 0;
$totalPage = ceil($eventCountAll / $per_page);


if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM events WHERE event_name LIKE '%$search%' AND valid = 1";
} elseif (isset($_GET["p"]) && isset($_GET["order"])) {
    $page = $_GET["p"];
    $order = $_GET["order"];
    $start_item = ($page - 1) * $per_page;

    switch ($order) {
        case 1:
            $where_clause = "ORDER BY event_id ASC";
            break;
        case 2:
            $where_clause = "ORDER BY event_id DESC";
            break;
        case 3:
            $where_clause = "ORDER BY event_start_time ASC";
            break;
        case 4:
            $where_clause = "ORDER BY event_start_time DESC";
            break;
        default:
            header("Location: events.php?p=1&order=1");
            exit();
    }

    $sql = "SELECT * FROM events WHERE valid = 1 $where_clause LIMIT $start_item, $per_page";
} else {
    header("Location: events.php?p=1&order=1");
    exit();
}

$result = $conn->query($sql);
$eventCount = $result->num_rows;

?>

<!doctype html>
<html lang="en">

<head>
    <title>events</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php include("css.php"); ?>
</head>

<body>
    <div class="container">
        <h1>活動列表</h1>
        <div class="py-2">
            <?php if (isset($_GET["search"])) : ?>
                <a href="events.php" class="btn btn-secondary">
                    <i class="fa-solid fa-rotate-left"></i>
                    活動列表
                </a>
            <?php endif; ?>
            <a href="create_event.php" class="btn btn-secondary">
                <i class="fa-solid fa-user-plus fa-fw"></i>
                新增活動
            </a>
        </div>
        <div class="py-2">
            <form action="">
                <div class="input-group mb-3">
                    <input type="search" class="form-control" name="search" placeholder="搜尋活動" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : ""; ?>">
                    <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        <?php if (isset($_GET["p"])) : ?>
            <div class="py-2 d-flex justify-content-end">
                <div class="btn-group">
                    <a class="btn btn-secondary <?php if ($order == 1) echo "active" ?>" href="events.php?p=<?= $page ?>&order=1">
                        ID &nbsp; <i class="fa-solid fa-arrow-down"></i>
                    </a>

                    <a class="btn btn-secondary <?php if ($order == 2) echo "active" ?>" href="events.php?p=<?= $page ?>&order=2">
                        ID &nbsp; <i class="fa-solid fa-arrow-up"></i>
                    </a>
                    <a class="btn btn-secondary <?php if ($order == 3) echo "active" ?>" href="events.php?p=<?= $page ?>&order=3">
                        時間 &nbsp; <i class="fa-solid fa-arrow-down"></i>
                    </a>
                    <a class="btn btn-secondary <?php if ($order == 4) echo "active" ?>" href="events.php?p=<?= $page ?>&order=4">
                        時間 &nbsp; <i class="fa-solid fa-arrow-up"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($eventCount > 0) : ?>
            共有<?= $eventCountAll ?>項活動
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>活動名稱</th>
                        <th>活動種類</th>
                        <th>活動平台</th>
                        <th>個人 <br> or <br> 團隊</th>
                        <th>活動圖片</th>
                        <th>報名<br>開始時間</th>
                        <th>報名<br>結束時間</th>
                        <th>活動<br>開始時間</th>
                        <th>人數<br>上限</th>
                        <th>備註</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($event = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $event["event_id"] ?></td>
                            <td><?= $event["event_name"] ?></td>
                            <td><?= $event["event_type"] ?></td>
                            <td><?= $event["event_platform"] ?></td>
                            <td><?= $event["individual_or_team"] ?></td>
                            <td><img class="img-fluid" src="event_images/<?= $event["event_picture"] ?>" alt=""></td>
                            <td><?= $event["apply_start_time"] ?></td>
                            <td><?= $event["apply_end_time"] ?></td>
                            <td><?= $event["event_start_time"] ?></td>
                            <td><?= $event["maximum_people"] ?></td>
                            <td>
                                <a href="event.php?event_id=<?= $event["event_id"] ?>" class="btn btn-secondary d-block mb-2">
                                    <i class="fa-solid fa-eye fa-fw"></i>
                                </a>
                                <a href="event_edit.php?event_id=<?= $event["event_id"] ?>" class="btn btn-secondary d-block">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php if (!isset($_GET["search"])) : ?>
                <nav aria-label="Page navigation example">

                    <ul class="pagination justify-content-end">
                        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                            <a class="page-link" href="?p=<?php echo max(1, $page - 1); ?>&order=<?php echo htmlspecialchars($order); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPage; $i++) : ?>

                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="events.php?p=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a></li>

                        <?php endfor; ?>
                        
                        <li class="page-item <?php if ($page >= $totalPage) echo 'disabled'; ?>">
                            <a class="page-link" href="?p=<?php echo min($totalPage, $page + 1); ?>&order=<?php echo htmlspecialchars($order); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        <?php else : ?>
            目前沒有活動
        <?php endif; ?>
    </div>
</body>
<?php $conn->close(); ?>

</html>