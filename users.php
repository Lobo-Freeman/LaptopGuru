<?php
require_once("db_connect.php");

$sqlAll = "SELECT * FROM users WHERE valid=1";
$resultAll = $conn->query($sqlAll);
$userCountAll = $resultAll->num_rows;

$page = 1;
$start_item = 0;
$per_page = 6;

$total_page = ceil($userCountAll / $per_page);
// echo "total page: $total_page";

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM users WHERE account LIKE '%$search%' AND valid=1";
} elseif (isset($_GET["p"]) && isset($_GET["order"])) {
    $order = $_GET["order"];
    $page = $_GET["p"];
    $start_item = ($page - 1) * $per_page;

    switch ($order) {
        case 1:
            $where_clause = "ORDER BY user_id ASC";
            break;
        case 2:
            $where_clause = "ORDER BY user_id DESC";
            break;
        case 3:
            $where_clause = "ORDER BY account ASC";
            break;
        case 4:
            $where_clause = "ORDER BY account DESC";
            break;
        default: 
            header("location: users.php?p=1&order=1");
            break;
    }

    $sql = "SELECT * FROM users WHERE valid=1 $where_clause LIMIT $start_item, $per_page";

    // $sql = "SELECT * FROM users WHERE valid=1 LIMIT $start_item, $per_page";
} else {

    header("location: users.php?p=1&order=1");
    // $sql = "SELECT * FROM users WHERE valid=1 LIMIT $start_item, $per_page";
}

$result = $conn->query($sql);

if (isset($_GET["search"])) {
    $userCount = $result->num_rows;
} else {
    $userCount = $userCountAll;
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Users</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php include("css.php") ?>

</head>

<body>
    <div class="container">
        <h1>使用者列表</h1>
        <div class="py-2">
            <?php if (isset($_GET["search"])) : ?>
                <a class="btn btn-secondary mb-3" href="users.php" title="回使用者列表"><i class="fa-solid fa-left-long"></i></a>
            <?php endif; ?>
            <a class="btn btn-primary" href="create-user.php"><i class="fa-solid fa-user-plus"></i></a>
        </div>
        <div class="py-2">
            <form action="">
                <div class="input-group">
                    <input type="search" class="form-control" name="search" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : "" ?>" placeholder="用account搜尋使用者">
                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        <?php if (isset($_GET["p"])) : ?>
            <div class="py-2 d-flex justify-content-end">
                <div class="btn-group">
                    <a class="btn btn-primary 
                    <?php if ($order == 1) echo "active" ?>" href="users.php?p=<?= $page ?>&order=1">
                        <i class="fa-solid fa-arrow-down-1-9"></i>
                    </a>
                    <a class="btn btn-primary
                    <?php if ($order == 2) echo "active" ?>
                    " href="users.php?p=<?= $page ?>&order=2">
                        <i class="fa-solid fa-arrow-down-9-1"></i>
                    </a>
                    <a class="btn btn-primary
                    <?php if ($order == 3) echo "active" ?>
                    " href="users.php?p=<?= $page ?>&order=3">
                        <i class="fa-solid fa-arrow-down-a-z"></i>
                    </a>
                    <a class="btn btn-primary
                    <?php if ($order == 4) echo "active" ?>
                    " href="users.php?p=<?= $page ?>&order=4">
                        <i class="fa-solid fa-arrow-down-z-a"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($userCount > 0) :
            $rows = $result->fetch_all(MYSQLI_ASSOC);
        ?>
            共有 <?= $userCount ?> 個使用者
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Account</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>View Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $user) : ?>
                        <tr>
                            <td><?= $user["user_id"] ?></td>
                            <td><?= $user["account"] ?></td>
                            <td><?= $user["name"] ?></td>
                            <td><?= $user["email"] ?></td>
                            <td><?= $user["phone"] ?></td>
                            <td>
                                <a class="btn btn-primary" href="user.php?id=<?= $user["user_id"] ?>"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if (isset($_GET["p"])) : ?>
                <nav aria-label="Page navigation example ">
                    <ul class="pagination">
                        <!-- Previous Button -->
                        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                            <a class="page-link" href="users.php?p=1&order=<?= $order ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <?php
                        // 控制显示的页码数量，例如最多显示 5 个页码
                        $start = max(1, $page - 2);
                        $end = min($total_page, $page + 2);

                        for ($i = $start; $i <= $end; $i++) : ?>
                            <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                                <a class="page-link" href="users.php?p=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Next Button -->
                        <li class="page-item <?php if ($page >= $total_page) echo 'disabled'; ?>">
                            <a class="page-link" href="users.php?p=<?=$total_page ?>&order=<?= $order ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        <?php else : ?>
            目前沒有使用者
        <?php endif; ?>
    </div>
</body>
<?php $conn->close(); ?>

</html>