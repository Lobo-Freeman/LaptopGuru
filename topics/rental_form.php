<?php
require_once("../topics/db_connect.php");

$sqlAll = "SELECT * FROM rental WHERE state='available'";
$resultAll = $conn->query($sqlAll);
$laptopCountAll = $resultAll->num_rows;


$page = 1;
$start_item = 0;
$per_page = 5;
// ceil 無條件進位
$total_page = ceil($laptopCountAll / $per_page);


if (isset($_GET["search"])) {
    $search = $_GET["search"];

    $sql = "SELECT * FROM rental WHERE model LIKE '%$search%' AND state='available'";
} elseif (isset($_GET["p"]) && isset($_GET["order"])) {
    $order = $_GET["order"];
    $page = $_GET["p"];
    $start_item = ($page - 1) * $per_page;


    switch ($order) {
        case 1:
            $where_clause = " ORDER BY id ASC";
            break;
        case 2:
            $where_clause = "ORDER BY id DESC";
            break;
        default:
            header("location: rental_form.php?p=1&order=1");
            break;
    }
    $sql = "SELECT * FROM rental WHERE state='available' $where_clause LIMIT $start_item, $per_page ";
} else {
    header("location: rental_form.php?p=1&order=1");
}


// $sql = "SELECT * FROM rental WHERE state='available'";
// $sql = "SELECT id, images, model, brand, price, num, state, user_id, created_at FROM rental WHERE state='available'";
$result = $conn->query($sql);

if (isset($_GET["search"])) {
    $laptopCount = $result->num_rows;
} else {
    $laptopCountAll = $resultAll->num_rows;
}


$laptopCount = $result->num_rows;

// 價格
if (isset($_GET["min"]) && isset($_GET["max"])) {
    $min = $_GET["min"];
    if ($min == null) {
        $min = 0;
    }
    $max = $_GET["max"];
    if ($max == null) {
        $max = 0;
    }

    $sql = "SELECT * FROM rental WHERE state='available' and price BETWEEN $min and $max ORDER BY id ASC ";
    $result = $conn->query($sql);
    $laptopCount = $result->num_rows;
} else {
    // $sql = "SELECT * FROM rental WHERE state='available' ORDER BY id ASC";
    $laptopCount = $result->num_rows;
}

?>

<style>
    .table img {
        max-width: 100px;
        /* 限制圖片的最大寬度 */
    }

    .table td,
    .table th {
        white-space: nowrap;
        /* 避免文字換行 */
        overflow: hidden;
        /* 隱藏超出範圍的內容 */
        text-overflow: ellipsis;
        /* 使用省略號顯示超出範圍的內容 */
    }
</style>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <title>Rental_Form</title>
    <?php include("css.php") ?>
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
                        <a class="collapse-item" href="../users.php">使用者列表</a>
                        <a class="collapse-item" href="../create-user.php">新增使用者</a>
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
                        <a class="collapse-item" href="../product-list.php?valid=1">商品列表</a>
                        <a class="collapse-item" href="../create-product.php">新增商品</a>
                        <a class="collapse-item" href="../product-list.php?valid=0">已下架商品列表</a>
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
                        <a class="collapse-item" href="rental_form.php">租賃列表</a>
                        <a class="collapse-item" href="laptop_create.php">新增可租賃筆電</a>
                        <a class="collapse-item" href="laptop_soft_delete_list.php">已下架租賃列表</a>
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
                        <a class="collapse-item" href="../coupon-list.php">優惠券列表</a>
                        <a class="collapse-item" href="../coupon-list.php?p=1&order=1&valid=0">停用中優惠券</a>
                        <a class="collapse-item" href="../coupon-add.php">新增優惠券</a>
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
                        <a class="collapse-item" href="../article_manange.php">文章列表</a>
                        <a class="collapse-item" href="../article_add.php">新增文章</a>
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
                        <a class="collapse-item" href="../events.php">活動列表</a>
                        <a class="collapse-item" href="../create_event.php">新增活動</a>
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
                    <h2 class="text-center mt-3">租賃清單</h2>
                    <?php if ($laptopCount > 0) :
                        $rows = $result->fetch_all(MYSQLI_ASSOC);
                    ?>
                        <div class="py-2">
                            <?php if (isset($_GET["search"])) : ?>
                                <a class="btn btn-outline-secondary" href="rental_form.php" title="回租賃清單">
                                    <i class="fa-solid fa-circle-chevron-left"></i>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="py-2">
                            <form action=""> <!-- 不寫可以直接帶入當前搜尋 -->
                                <div class="input-group">
                                    <input type="search" class="form-control me-2" placeholder="搜尋型號" name="search" value="<?= isset($_GET["search"]) ? $_GET["search"] : "" ?>">
                                    <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>

                        <div class="row d-flex align-items-center">
                            <div class="col-6 d-flex justify-content-start align-items-center">
                                <p class="mt-3 mb-3">共 <?= $laptopCount ?>台筆電</p>
                            </div>
                            <!-- 價格篩選 -->
                            <div class="col-6 d-flex justify-content-end align-items-center">
                                <form action="" method="GET" class="d-flex align-items-center">

                                    <?php if (isset($_GET["min"])) : ?>
                                        <a class="btn btn-outline-secondary" href="rental_form.php" title="回租賃清單">
                                            <i class="fa-solid fa-circle-chevron-left"></i>
                                        </a>
                                    <?php endif; ?>

                                    <!-- 包含當前的 search, p 和 order 參數，避免被覆蓋 -->
                                    <?php if (isset($_GET["search"])) : ?>
                                        <input type="hidden" name="search" value="<?= $_GET["search"] ?>">
                                    <?php endif; ?>
                                    <?php if (isset($_GET["p"])) : ?>
                                        <input type="hidden" name="p" value="<?= $_GET["p"] ?>">
                                    <?php endif; ?>
                                    <?php if (isset($_GET["order"])) : ?>
                                        <input type="hidden" name="order" value="<?= $_GET["order"] ?>">
                                    <?php endif; ?>

                                    <div class="col-auto">
                                        <label class="ms-2" for="">價格</label>
                                    </div>
                                    <div class="col-auto ms-2">
                                        <input type="number" class="form-control text-end price-input" name="min"
                                            value="<?php $min = isset($_GET["min"]) ? $_GET["min"] : 0;
                                                    echo $min ?>">
                                    </div>
                                    <div class="col-auto ms-2">
                                        ~
                                    </div>
                                    <div class="col-auto ms-2">
                                        <input type="number" class="form-control text-end price-input" name="max"
                                            value="<?php $max = isset($_GET["max"]) ? $_GET["max"] : 0;
                                                    echo $max ?>">
                                    </div>

                                    <button
                                        type="submit"
                                        class="btn btn-outline-secondary ms-2">
                                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row d-flex align-items-center mb-3">
                            <div class="col-6 d-flex justify-content-start ">
                                <?php if (isset($_GET["p"])) : ?>

                                    <div class="btn-group">
                                        <a class="btn btn-outline-secondary <?php if ($order == 1) echo "active" ?> " href="rental_form.php?p=1&order=1" title="小到大">
                                            <i class="fa-solid fa-up-long"></i>
                                        </a>
                                        <a class="btn btn-outline-secondary <?php if ($order == 2) echo "active" ?>" href="rental_form.php?p=1&order=2" title="大到小">
                                            <i class="fa-solid fa-down-long"></i>
                                        </a>
                                    </div>
                            </div>

                            <div class="col-6 d-flex justify-content-end ">
                                <a class="btn btn-outline-secondary" href="laptop_create.php" title="新增資料">
                                    <i class="fa-solid fa-square-plus"></i>
                                </a>
                                <a class="btn btn-outline-secondary ms-2" href="laptop_soft_delete_list.php" title="刪除資料">
                                    <i class="fa-solid fa-square-minus"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>圖片</th>
                                    <th>型號</th>
                                    <th>品牌</th>
                                    <th>價格/天</th>
                                    <th>數量</th>
                                    <th>狀態</th>
                                    <th>租借者數量</th>
                                    <th>時間</th>
                                    <th>修改</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $laptop) : ?>
                                    <tr>
                                        <td><?= $laptop["id"] ?></td>
                                        <td><img src="image/<?= $laptop['images'] ?>" alt="<?= $laptop['model'] ?>" width="100"></td>
                                        <td><?= $laptop["model"] ?></td>
                                        <td><?= $laptop["brand"] ?></td>
                                        <td><?= $laptop["price"] ?></td>
                                        <td><?= $laptop["num"] ?></td>
                                        <td>
                                            <?php if ($laptop["state"] == "available") : ?>
                                                <span class="badge badge-success">上架中</span>
                                            <?php else : ?>
                                                <span class="badge badge-danger">已下架</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $laptop["user_id"] ?></td>
                                        <td><?= $laptop["created_at"] ?></td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a class="btn btn-outline-secondary mb-2" href="laptop_content.php?id=<?= $laptop["id"] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <a class="btn btn-outline-secondary" href="laptop_soft_delete.php?id=<?= $laptop["id"] ?>">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?php if (isset($_GET["p"]) && !isset($_GET["min"]) && !isset($_GET["max"])): ?>
                            <!-- <div>
                    <ul class="pagination d-flex justify-content-center">
                        
                        <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                            <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                                <a class="page-link" href="rental_form.php?p=<?= $i ?>&order=<?= $order ?>" > <?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                    </ul>
                </div> -->


                            <?php
                            // 控制顯示頁碼的範圍
                            $start_page = max(1, $page - 1);  // 當前頁碼的前一頁
                            $end_page = min($total_page, $page + 1);  // 當前頁碼的後一頁
                            ?>

                            <div>
                                <ul class="pagination d-flex justify-content-center">

                                    <!-- 顯示第一頁 -->

                                    <li class="page-item">
                                        <a class="page-link" href="rental_form.php?p=1&order=<?= $order ?>">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>


                                    <!-- 動態顯示當前頁碼的前後頁 -->
                                    <?php for ($i = $start_page; $i <= $end_page; $i++) : ?>
                                        <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                                            <a class="page-link" href="rental_form.php?p=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <!-- 顯示最後一頁 -->
                                    <li class="page-item">
                                        <a class="page-link" href="rental_form.php?p=<?= $total_page ?>&order=<?= $order ?>">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>



                        <?php endif; ?>
                    <?php else : ?>
                        沒有找到符合條件的筆電
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

<?php
$conn->close();
?>

</html>