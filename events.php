<?php
require_once("db_connect.php");
include("event_css.php");

$sqlAll = "SELECT * FROM events WHERE valid = 1";
$resultAll = $conn->query($sqlAll);
$eventCountAll = $resultAll->num_rows;
$totalEventsAll = $eventCountAll;

$per_page = 5;
$page = 1;
$start_item = 0;

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM events WHERE event_name LIKE '%$search%' AND valid = 1";

    $countSql = "SELECT COUNT(*) as total FROM events WHERE event_name LIKE '%$search%' AND valid = 1";
    $countResult = $conn->query($countSql);
    $totalEventsFiltered = $countResult->fetch_assoc()['total'];
} elseif (isset($_GET["p"]) && isset($_GET["order"])) {
    $page = $_GET["p"];
    $order = $_GET["order"];
    $start_item = ($page - 1) * $per_page;

    $where_clause = "WHERE valid = 1";
    $order_clause = "";
    switch ($order) {
        case 1:
            $order_clause = "ORDER BY event_id ASC";
            break;
        case 2:
            $order_clause = "ORDER BY event_id DESC";
            break;
        case 3:
            $order_clause = "ORDER BY event_start_time ASC";
            break;
        case 4:
            $order_clause = "ORDER BY event_start_time DESC";
            break;
        default:
            header("Location: events.php?p=1&order=1");
            exit();
    }

    $filter = isset($_GET["filter"]) ? $_GET["filter"] : "";
    if ($filter == "individual") {
        $where_clause .= " AND individual_or_team = '個人'";
    } elseif ($filter == "team") {
        $where_clause .= " AND individual_or_team = '團隊'";
    }

    // 計算總頁數
    $countSql = "SELECT COUNT(*) as total FROM events $where_clause";
    $countResult = $conn->query($countSql);
    $totalEvents = $countResult->fetch_assoc()['total'];
    $totalPage = ceil($totalEvents / $per_page);

    // 確保頁數在有效範圍內
    if ($page < 1) $page = 1;
    if ($page > $totalPage) $page = $totalPage;
    $start_item = ($page - 1) * $per_page;

    $sql = "SELECT * FROM events $where_clause $order_clause LIMIT $start_item, $per_page";

    // 計算篩選後的總數
    $countSql = "SELECT COUNT(*) as total FROM events $where_clause";
    $countResult = $conn->query($countSql);
    $totalEventsFiltered = $countResult->fetch_assoc()['total'];
} else {
    header("Location: events.php?p=1&order=1");
    exit();
}
if (!isset($totalEventsFiltered)) {
    $totalEventsFiltered = $totalEventsAll;
}


$result = $conn->query($sql);
if (!$result) {
    die("查詢錯誤: " . $conn->error);
}
$eventCount = $result->num_rows;

?>

<!doctype html>
<html lang="en">

<head>
    <title>events</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php include("css.php"); ?>
    <?php include("event_css.php"); ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-main sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="front.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">LaptopGuru</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="front.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>首頁</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-user fa-fw fas"></i>
                    <span>Users</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">使用者管理:</h6>
                        <a class="collapse-item" href="users.php">使用者列表</a>
                        <a class="collapse-item" href="create-user.php">新增使用者</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-shop fa-fw fas"></i>
                    <span>Products</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">商品管理:</h6>
                        <a class="collapse-item" href="product-list.php?valid=1">商品列表</a>
                        <a class="collapse-item" href="create-product.php">新增商品</a>
                        <a class="collapse-item" href="product-list.php?valid=0">已下架商品列表</a>
                    </div>
                </div>
            </li>



            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-laptop fa-solid"></i>
                    <span>Rental</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">租賃管理:</h6>
                        <a class="collapse-item" href="topics/rental_form.php">租賃列表</a>
                        <a class="collapse-item" href="topics/laptop_create.php">新增可租賃筆電</a>
                        <a class="collapse-item" href="topics/laptop_soft_delete_list.php">已下架租賃列表</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCoupon"
                    aria-expanded="true" aria-controls="collapseCoupon">
                    <i class="fa-solid fa-ticket fas fa-fw"></i>
                    <span>Coupon</span>
                </a>
                <div id="collapseCoupon" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">優惠券管理:</h6>
                        <a class="collapse-item" href="coupon-list.php">優惠券列表</a>
                        <a class="collapse-item" href="coupon-list.php?p=1&order=1&valid=0">停用中優惠券</a>
                        <a class="collapse-item" href="coupon-add.php">新增優惠券</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArticle"
                    aria-expanded="true" aria-controls="collapseArticle">
                    <i class="fa-solid fa-book fas fa-fw"></i>
                    <span>Article</span>
                </a>
                <div id="collapseArticle" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">文章管理:</h6>
                        <a class="collapse-item" href="article_manange.php">文章列表</a>
                        <a class="collapse-item" href="article_add.php">新增文章</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvent"
                    aria-expanded="true" aria-controls="collapseEvent">
                    <i class="fa-solid fa-calendar-days fas fa-fw"></i>
                    <span>Event</span>
                </a>
                <div id="collapseEvent" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">活動管理:</h6>
                        <a class="collapse-item" href="events.php">活動列表</a>
                        <a class="collapse-item" href="create_event.php">新增活動</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>




                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- 主要頁面 -->
                <div class="container-fluid">
                    <h1>活動列表</h1>
                    <div class="py-2">
                        <?php if (isset($_GET["search"])) : ?>
                            <a href="events.php" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-rotate-left"></i>
                                活動列表
                            </a>
                        <?php endif; ?>
                        <a href="create_event.php" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-user-plus fa-fw"></i>
                            新增活動
                        </a>
                    </div>
                    <div class="py-2">
                        <form action="">
                            <div class="input-group mb-3">
                                <input type="search" class="form-control" name="search" placeholder="搜尋活動" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : ""; ?>">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <?php if (isset($_GET["p"])) : ?>
                        <div class="py-2 d-flex justify-content-between">
                            <div class="btn-group">
                                <a class="btn btn-outline-secondary <?php echo (!isset($_GET["filter"]) || $_GET["filter"] == "") ? "active" : ""; ?>" href="events.php?p=<?= $page ?>&order=<?= $order ?>">
                                    全部
                                </a>
                                <a class="btn btn-outline-secondary <?php echo (isset($_GET["filter"]) && $_GET["filter"] == "individual") ? "active" : ""; ?>" href="events.php?p=<?= $page ?>&order=<?= $order ?>&filter=individual">
                                    個人
                                </a>
                                <a class="btn btn-outline-secondary <?php echo (isset($_GET["filter"]) && $_GET["filter"] == "team") ? "active" : ""; ?>" href="events.php?p=<?= $page ?>&order=<?= $order ?>&filter=team">
                                    團隊
                                </a>
                            </div>
                            <div class="btn-group">
                                <a class="btn btn-outline-secondary <?php if ($order == 1) echo "active" ?>" href="events.php?p=<?= $page ?>&order=1">
                                    ID &nbsp; <i class="fa-solid fa-arrow-down"></i>
                                </a>

                                <a class="btn btn-outline-secondary <?php if ($order == 2) echo "active" ?>" href="events.php?p=<?= $page ?>&order=2">
                                    ID &nbsp; <i class="fa-solid fa-arrow-up"></i>
                                </a>
                                <a class="btn btn-outline-secondary <?php if ($order == 3) echo "active" ?>" href="events.php?p=<?= $page ?>&order=3">
                                    時間 &nbsp; <i class="fa-solid fa-arrow-down"></i>
                                </a>
                                <a class="btn btn-outline-secondary <?php if ($order == 4) echo "active" ?>" href="events.php?p=<?= $page ?>&order=4">
                                    時間 &nbsp; <i class="fa-solid fa-arrow-up"></i>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($eventCount > 0) : ?>
                        共有<?= $totalEventsFiltered ?>項活動
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>活動名稱</th>
                                    <th>活動種類</th>
                                    <th>活動平台</th>
                                    <th>個人/團隊</th>
                                    <th>活動圖片</th>
                                    <th>報名期間</th>
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
                                        <td><?= $event["apply_start_time"] ?><br><?= $event["apply_end_time"] ?></td>



                                        <td><?= $event["event_start_time"] ?></td>
                                        <td><?= $event["maximum_people"] ?></td>
                                        <td>
                                            <a href="event.php?event_id=<?= $event["event_id"] ?>" class="btn btn-outline-secondary d-block mb-2">
                                                <i class="fa-solid fa-eye fa-fw"></i>
                                            </a>
                                            <a href="event_edit.php?event_id=<?= $event["event_id"] ?>" class="btn btn-outline-secondary d-block">
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
                                        <a class="page-link" href="?p=<?php echo max(1, $page - 1); ?>&order=<?php echo htmlspecialchars($order); ?>&filter=<?php echo htmlspecialchars($filter ?? ''); ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>

                                        <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="events.php?p=<?= $i ?>&order=<?= $order ?>&filter=<?php echo htmlspecialchars($filter ?? ''); ?>"><?= $i ?></a></li>

                                    <?php endfor; ?>

                                    <li class="page-item <?php if ($page >= $totalPage) echo 'disabled'; ?>">
                                        <a class="page-link" href="?p=<?php echo min($totalPage, $page + 1); ?>&order=<?php echo htmlspecialchars($order); ?>&filter=<?php echo htmlspecialchars($filter ?? ''); ?>" aria-label="Next">
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-outline-secondary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <?php include "js.php"; ?>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>






<?php $conn->close(); ?>

</html>