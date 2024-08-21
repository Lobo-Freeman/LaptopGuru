<?php
require_once "db_connect.php";



$per_page = 5;
$page = 1;
$start_item = 0;

$now = date("Y-m-d H:i:s");
$sqlTimeCheck = "UPDATE coupon SET valid = 0 WHERE coupon_end_time < '$now' AND valid = 1";
$conn->query($sqlTimeCheck);

if(isset($_GET['valid'])){

$valid = $_GET["valid"];

switch ($valid) {
    case 1:
        $valid_clause = "valid=1";
        break;
    case 0:
        $valid_clause = "valid=0";
        break;
}
}else{
    $valid_clause = "valid=1";
}

$sqlAll = "SELECT *  FROM coupon WHERE $valid_clause";
$resultAll = $conn->query($sqlAll);
$rowsAll = $resultAll->fetch_all(MYSQLI_ASSOC);
$rowsCountAll = $resultAll->num_rows;

if (isset($_GET["search"])) {
    $type = $_GET["type"];
    $search = $_GET["search"];

    switch ($type) {
        case 1:
            $type_clause = "coupon_id";
            break;
        case 2:
            $type_clause = "coupon_code";
            break;
        case 3:
            $type_clause = "coupon_start_time";
            break;
        case 4:
            $type_clause = "coupon_end_time";
            break;
        default:
            header("Location: coupon-list.php?p=1&order=1&$valid_clause");
            break;
    }

    if (isset($_GET["valid"])) {
        $sql = "SELECT * FROM coupon WHERE $type_clause LIKE '%$search%' AND $valid_clause";
    } else {
        $sql = "SELECT * FROM coupon WHERE $type_clause LIKE '%$search%'";
    }

    // $sql = "SELECT * FROM coupon WHERE $type_clause LIKE '%$search%' AND $valid_clause";

    // LIKE 模糊搜尋
    // % 代表任意字元
    // _ 代表單一字元

} elseif (isset($_GET["p"]) && isset($_GET["order"])) {
    $page = $_GET["p"];
    $order = $_GET["order"];
    $start_item = ($page - 1) * $per_page;

    switch ($order) {
        case 1:
            $where_clause = "ORDER BY coupon_id ASC";
            break;

        case 2:
            $where_clause = "ORDER BY coupon_id DESC";
            break;
        case 3:
            $where_clause = "ORDER BY coupon_code ASC";
            break;
        case 4:
            $where_clause = "ORDER BY coupon_code DESC";
            break;
        default:
            header("Location: coupon-list.php?p=1&order=1&$valid_clause");
            break;
    }

    $sql = "SELECT * FROM coupon WHERE $valid_clause $where_clause LIMIT $start_item, $per_page ";
    // 整個語句有差別的地方只在ORDER BY id ASC/DESC
    // 所以用一個變數將ASC/DESC存起來，再用switch case判斷
    // 這樣就不用寫兩次SQL語句



} else {

    header("Location: coupon-list.php?p=1&order=1&valid=1");
    // 判斷是否有$_GET["p"]，若沒有就導向第一頁


    // $sql = "SELECT * FROM users WHERE valid = 1 LIMIT $start_item, $per_page";

    // 若沒有$_GET["p"]就只讀第一頁
}





$totalPage = ceil($rowsCountAll / $per_page);
// echo "total page: $totalPage";


$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

$rowsCount = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LaptopGuru</title>

    <!-- Custom fonts for this template-->
    <!-- Custom styles for this template-->
    <?php include "css.php"; ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

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
                        <a class="collapse-item" href="buttons.html">使用者列表</a>
                        <a class="collapse-item" href="cards.html">新增使用者</a>
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
                        <a class="collapse-item" href="utilities-color.html">商品列表</a>
                        <a class="collapse-item" href="utilities-border.html">新增商品</a>
                        <a class="collapse-item" href="utilities-animation.html">已下架商品列表</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
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
                        <a class="collapse-item" href="login.html">租賃列表</a>
                        <a class="collapse-item" href="register.html">新增可租賃筆電</a>
                        <a class="collapse-item" href="forgot-password.html">已下架租賃列表</a>                        
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
                        <a class="collapse-item" href="login.html">文章列表</a>
                        <a class="collapse-item" href="register.html">新增文章</a>                                             
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
                        <a class="collapse-item" href="login.html">活動列表</a>
                        <a class="collapse-item" href="register.html">新增活動</a>                                             
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
                                            <button class="btn btn-secondary" type="button">
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
                    <h1>優惠券</h1>
                    <a href="coupon-add.php" class="btn btn-secondary mb-3"><i class="fa-solid fa-plus"></i>新增優惠券</a>
                    <div class="py-2">
                        <form action="">
                            <div class="input-group mb-3">
                                <div>
                                    <select class="form-select" aria-label=".form-select-sm example" name="type">
                                        <option value="1" <?php echo isset($_GET["type"]) && $_GET["type"] == 1 ? "selected" : ""; ?> <?php if (!isset($_GET['type'])) echo "selected" ?>>優惠券ID</option>
                                        <option value="2" <?php echo isset($_GET["type"]) && $_GET["type"] == 2 ? "selected" : ""; ?>>優惠券代碼</option>
                                        <option value="3" <?php echo isset($_GET["type"]) && $_GET["type"] == 3 ? "selected" : ""; ?>>開始時間</option>
                                        <option value="4" <?php echo isset($_GET["type"]) && $_GET["type"] == 4 ? "selected" : ""; ?>> 到期時間</option>
                                    </select>
                                </div>
                                <input type="search" class="form-control" name="search" placeholder="搜尋優惠券" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : ""; ?>">
                                <!-- <input type="hidden" name="valid" value="<?php echo isset($_GET["valid"]) ? $_GET["valid"] : "1"; ?>"> -->
                                <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="py-2 d-flex justify-content-between">
                        <?php if (isset($_GET["search"])) : ?>
                            <div class="btn-grup">
                                <a class="btn btn-secondary <?php if(!isset($_GET['valid'])) echo 'active'?>" href="coupon-list.php?type=<?= $type ?>&search=<?= $search ?>">
                                <i class="fa-solid fa-globe"></i>全部
                                </a>
                                <a class="btn btn-success <?php if ($valid == 1) echo "active" ?>" href="coupon-list.php?type=<?= $type ?>&search=<?= $search ?>&valid=1">
                                    <i class="fa-solid fa-check"></i>有效中
                                </a>
                                <a class="btn btn-danger <?php if ($valid == 0) echo "active" ?>" href="coupon-list.php?type=<?= $type ?>&search=<?= $search ?>&valid=0">
                                    <i class="fa-solid fa-xmark"></i>停用中
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="btn-group">
                                <a class="btn btn-success <?php if ($valid == 1) echo "active" ?>" href="coupon-list.php?p=1&order=1&valid=1">
                                    <i class="fa-solid fa-check"></i>有效中
                                </a>
                                <a class="btn btn-danger <?php if ($valid == 0) echo "active" ?>" href="coupon-list.php?p=1&order=1&valid=0">
                                    <i class="fa-solid fa-xmark"></i>停用中
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_GET["p"])) : ?>
                            <div class="btn-group ">
                                <a class="btn btn-secondary <?php if ($order == 1) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=1&valid=<?= $valid ?>">
                                    <i class="fa-solid fa-arrow-down-1-9"></i>
                                </a>

                                <a class="btn btn-secondary <?php if ($order == 2) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=2&valid=<?= $valid ?>">
                                    <i class="fa-solid fa-arrow-down-9-1"></i>
                                </a>
                                <a class="btn btn-secondary <?php if ($order == 3) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=3&valid=<?= $valid ?>">
                                    <i class="fa-solid fa-arrow-down-a-z"></i>
                                </a>
                                <a class="btn btn-secondary <?php if ($order == 4) echo "active" ?>" href="coupon-list.php?p=<?= $page ?>&order=4&valid=<?= $valid ?>">
                                    <i class="fa-solid fa-arrow-down-z-a"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (isset($_GET["search"])) : ?>
                        <a href="coupon-list.php" class="btn btn-secondary mb-3">
                            <i class="fa-solid fa-arrow-rotate-left"></i>回到列表
                        </a>
                        <div class="alert alert-secondary" role="alert">
                            搜尋結果：<?php echo $rowsCount; ?>筆
                        </div>
                    <?php endif; ?>
                    <?php if ($rowsCount > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>優惠券ID</th>
                                    <th>優惠券代碼</th>
                                    <th>開始時間</th>
                                    <th>到期時間</th>
                                    <th>狀態</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <td><?php echo $row['coupon_id']; ?></td>
                                        <td><?php echo $row['coupon_code']; ?></td>
                                        <td><?php echo $row['coupon_start_time']; ?></td>
                                        <td><?php echo $row['coupon_end_time']; ?></td>
                                        <td>
                                            <?php if ($row['valid'] == 1): ?>
                                                有效
                                            <?php elseif ($row['valid'] == 0): ?>
                                                停用
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="coupon.php?id=<?= $row['coupon_id']; ?>" class="btn btn-secondary">
                                                <i class="fa-solid fa-eye"></i>優惠券內容
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if ($totalPage > 1 && !isset($_GET['search'])): ?>
                            <nav aria-label="Page navigation example">

                                <ul class="pagination justify-content-center">
                                    <li class="page-item">
                                        <a href="coupon-list.php?p=1&order=<?= $order ?>&valid=<?= $valid ?>" class="page-link">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                                        <?php if (($i >= $page - 1 && $i <= $page + 1)) : // 當前頁的前一頁和後一頁 
                                        ?>
                                            <li class="page-item <?php if ($i == $page) echo "active"; ?>">

                                                <a class="page-link" href="coupon-list.php?p=<?= $i ?>&order=<?= $order ?>&valid=<?= $valid ?>"><?= $i ?></a>

                                            </li>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <li class="page-item">
                                        <a href="coupon-list.php?p=<?= $totalPage ?>&order=<?= $order ?>&valid=<?= $valid ?>" class="page-link">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>

                            </nav>
                        <?php endif; ?>
                    <?php else: ?>
                        <h2>目前沒有優惠券</h2>
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
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-secondary" href="login.html">Logout</a>
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

</html>