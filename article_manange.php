<?php

require_once("db_connect_article.php");

if (!isset($_GET['page'])) {
    header("Location:article_manange.php?page=1");
    exit;
}

$sql = "SELECT * FROM article_management";
$result = $conn->query($sql);
$articleCount = $result->num_rows;


// ---------------------------------分頁功能---------------------------------
$records_per_page = 10;
$sql_total_records = "SELECT COUNT(*) as total FROM article_management";
$result_total = $conn->query($sql_total_records);
$row_total = $result_total->fetch_assoc();
$total_records = $row_total['total'];
// ceil 會取整數，用來取頁數
$total_pages = ceil($total_records / $records_per_page);
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($current_page - 1) * $records_per_page;
// 取頁數 LIMIT 起始筆數->結束筆數
$sql = "SELECT * FROM article_management LIMIT $start_from, $records_per_page";
$result = $conn->query($sql);

// 1. 設定每頁有幾筆資料
// 2. 設定變數儲存 sql 查詢到的資料筆數
// 3. 將結果取出來做關聯式陣列
// 4. 獲取當前頁數，設置頁數，如果沒有就將頁數設為 1 $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
// 5. 計算起始紀錄位置
// 6. 查詢當前頁面的紀錄

$prev_page = $current_page - 1;
$next_page = $current_page + 1;

if ($next_page > $total_pages) {
    $next_page = $total_pages;
}

if ($prev_page < 1) {
    $prev_page = 1;
}


// ---------------------------------分頁功能---------------------------------


// ---------------------------------搜尋功能---------------------------------


// 檢查是否設置了 'Search' 參數
$searchOutput = ''; // 用來存儲搜尋結果的變數

if (isset($_GET['Search'])) {
    $searchResult = $_GET['Search'];
    // 防止 SQL 注入攻擊
    $searchTerm = $conn->real_escape_string($searchResult);

    // 正確的 SQL 語句
    $sql = "SELECT * FROM article_management WHERE article_id LIKE '$searchTerm%' OR article_type1 LIKE '$searchTerm%' OR title LIKE '__$searchTerm%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 使用變數來儲存結果
        while ($row = $result->fetch_assoc()) {
            $searchOutput .= "<p>Title: " . htmlspecialchars($row['title']) . "</p>";
            // 你可以在這裡繼續添加其他字段
        }
    } else {
        $searchOutput = "<p>No results found.</p>";
    }
}

// ---------------------------------搜尋功能---------------------------------


$conn->close();
?>


<!doctype html>
<html lang="en">

<head>
    <title>article_management</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <?php include("css.php"); ?>

    <style>
        .thumbnail {
            max-width: 7rem;
            max-height: 7rem;
        }

        .thumbnail-deteil {
            width: 6rem;
        }

        .table th,
        .table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
            /* 根據需要調整寬度 */
        }
    </style>
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
                    <div class="m-5 d-flex justify-content-center">
                        <h1>文章管理</h1>
                    </div>
                    <div class="mb-3 d-flex justify-content-between ms-5">
                        <p>共有 <?= $articleCount ?> 篇文章</p>
                        <a href="article_add.php" class="btn btn-outline-secondary"><i class="fa-solid fa-newspaper"></i><span class="text-dark"> 新增文章</span></i></a>

                        </button>

                    </div>

                    <div>

                    </div>

                    <div class=" ms-5">
                        <?php if ($articleCount > 0):
                            $rows = $result->fetch_all(MYSQLI_ASSOC); ?>
                            <!-- 沒做出功能就先 d-none -->
                            <!-- 沒做出功能就先 d-none -->
                            <!-- 沒做出功能就先 d-none -->
                            <div class=" mb-3 mt-3 d-none">
                                <nav class="navbar navbar-light bg-light">
                                    <div class="">
                                        <form class="d-flex">
                                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" method="post">
                                            <button class="btn btn-outline-success" type="submit">Search</button>
                                        </form>
                                    </div>
                                </nav>
                            </div>
                            <!-- ---------------------------------分頁功能--------------------------------- -->
                            <div>
                                <nav aria-label="Page navigation example" class=" text-secondary">
                                    <ul class="pagination justify-content-center text-secondary">
                                        <li class="page-item">
                                            <a href="article_manange.php?page=1" class="page-link">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li class="page-item text-secondary">
                                            <a class="page-link" href="article_manange.php?page=<?= $prev_page ?>" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                        <!-- 有總頁數之後，把總頁數取下來做迴圈計算要顯示幾頁 -->
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <?php if (($i >= $current_page - 1 && $i <= $current_page + 1)) : // 當前頁的前一頁和後一頁 
                                            ?>
                                                <li class="page-item text-secondary <?php if ($_GET['page'] == $i) echo 'active' ?>"><a class="page-link" href="article_manange.php?page=<?= $i ?>"><?= $i ?></a></li>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <li class="page-item text-secondary">
                                            <a class="page-link" href="article_manange.php?page=<?= $next_page ?>">Next</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="article_manange.php?page=<?= $total_pages ?>" class="page-link">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- ---------------------------------分頁功能--------------------------------- -->
                            <table class="table table-bordered text-center ">
                                <thead class="col">
                                    <th class="text-nowrap">文章 ID</th>
                                    <th class="text-nowrap">原文文章建立時間</th>
                                    <th class="text-nowrap">文章品牌</th>
                                    <th class="text-nowrap">文章類型1</th>
                                    <th class="text-nowrap">文章類型2</th>
                                    <th class="text-nowrap">文章類型3</th>
                                    <th class="text-nowrap">文章類型4</th>
                                    <th class="text-nowrap">原文網址</th>
                                    <th class="text-nowrap">文章縮圖</th>
                                    <th class="text-nowrap">文章預覽</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($rows as $article_id): ?>
                                        <tr>
                                            <td class="align-middle"><?= $article_id["article_id"] ?></td>
                                            <td class="align-middle"><?= $article_id["article_created_time"] ?></td>
                                            <td class="align-middle text-nowrap"><?= $article_id["article_brand"] ?></td>
                                            <td class="align-middle text-nowrap"><?= $article_id["article_type1"] ?></td>
                                            <td class="align-middle text-nowrap"><?= $article_id["article_type2"] ?></td>
                                            <td class="align-middle text-nowrap"><?= $article_id["article_type3"] ?></td>
                                            <td class="align-middle text-nowrap"><?= $article_id["article_type4"] ?></td>
                                            <td class="align-middle"><?= $article_id["article_url_address"] ?></td>
                                            <td class="align-middle">
                                                <div class=" thumbnail">
                                                    <img class="thumbnail-deteil" src="<?= $article_id["article_images_thumbnail"] ?>" alt="">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <a class="btn btn-outline-secondary mb-1" href="article_detail.php?article_id=<?= $article_id["article_id"] ?>"><i class="fa-solid fa-eye"></i></a>

                                                <a class="btn btn-outline-secondary" href="article_edit.php?article_id=<?= $article_id["article_id"] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                            <!-- </div> -->
                        <?php else: ?>
                            目前沒有使用者
                        <?php endif; ?>
                    </div>


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