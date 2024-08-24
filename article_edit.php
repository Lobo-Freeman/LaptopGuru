<?php
if (!isset($_GET["article_id"])) {
    echo "請正確帶入 article_id 變數";
    exit;
}

$article_id = $_GET["article_id"];

require_once("db_connect_article.php");

$sql = "SELECT * FROM article_management
WHERE article_id = '$article_id'
";

$result = $conn->query($sql);
$articleCount = $result->num_rows;
$rows = $result->fetch_assoc();

if ($articleCount > 0) {
    $title = $rows["article_id"];
} else {
    $title = "使用者不存在";
}

?>

<head>
    <title><?= $title ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <?php include("css.php"); ?>
    <style>
        .table-form-control {
            width: 50rem;
        }

        .table-form-control-td {
            width: 80rem;
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
                    <div class="row mt-3">
                        <div class="col-lg-4">
                            <h1>修改資料</h1>
                            <div class="py-2 mt-5">
                                <a class="btn btn-outline-secondary" href="article_detail.php?article_id=<?= $rows["article_id"] ?>" title="回文章列表"><i class="fa-solid fa-left-long"></i></a>
                            </div>
                            <?php if ($articleCount > 0) : ?>
                                <form action="doUpdateArticle.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="article_id" value="<?= $rows["article_id"] ?>">
                                    <table class="table table-bordered table-form-control mt-5">
                                        <tr>
                                            <th class="text-nowrap">文章ID</th>
                                            <td class="table-form-control-td" type="hidden"><?= $rows["article_id"] ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">原文文章建立時間</th>
                                            <td class="table-form-control-td">
                                                <p>Please enter the date in the format: YYYY-MM-DD</p>
                                                <input type="text" class="form-control" name="article_created_time" value="<?= $rows["article_created_time"] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章品牌</th>
                                            <td class="table-form-control-td">
                                                <input type="text" class="form-control" name="article_brand" value="<?= $rows["article_brand"] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章類型1</th>
                                            <td class="table-form-control-td">
                                                <input type="text" class="form-control" name="article_type1" value="<?= $rows["article_type1"] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章類型2</th>
                                            <td class="table-form-control-td">
                                                <input type="text" class="form-control" name="article_type2" value="<?= $rows["article_type2"] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章類型3</th>
                                            <td class="table-form-control-td">
                                                <input type="text" class="form-control" name="article_type3" value="<?= $rows["article_type3"] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章類型4</th>
                                            <td class="table-form-control-td">
                                                <input type="text" class="form-control" name="article_type4" value="<?= $rows["article_type4"] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">原文網址</th>
                                            <td class="table-form-control-td">
                                                <input type="text" class="form-control" name="article_url_address" value="<?= $rows["article_url_address"] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章短介紹</th>
                                            <td class="table-form-control-td">
                                                <input type="text" class="form-control" name="article_introduction" value="<?= $rows["article_introduction"] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章縮圖</th>
                                            <td class="table-form-control-td">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label"></label>
                                                    <input class="form-control" type="file" name="article_images_thumbnail" value="<?= $rows["article_images_thumbnail"] ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章圖片(標題)</th>
                                            <td class="table-form-control-td">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label"></label>
                                                    <input class="form-control" type="file" name="article_images_title" value="<?= $rows["article_images_title"] ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章影片網址</th>
                                            <td class="table-form-control-td">
                                                <input type="text" class="form-control" name="article_video_title_url" value="<?= $rows["article_video_title_url"] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章圖片(主要)</th>
                                            <td class="table-form-control-td">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label"></label>
                                                    <input class="form-control" type="file" name="article_images_main" value="<?= $rows["article_images_main"] ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章圖片 (內文1)</th>
                                            <td class="table-form-control-td">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label"></label>
                                                    <input class="form-control" type="file" name="article_images_content_1" value="<?= $rows["article_images_content_1"] ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章圖片 (內文2)</th>
                                            <td class="table-form-control-td">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label"></label>
                                                    <input class="form-control" type="file" name="article_images_content_2" value="<?= $rows["article_images_content_2"] ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章圖片 (內文3)</th>
                                            <td class="table-form-control-td">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label"></label>
                                                    <input class="form-control" type="file" name="article_images_content_3" value="<?= $rows["article_images_content_3"] ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">文章內容</th>
                                            <td class="table-form-control-td">
                                                <textarea
                                                    type="text"
                                                    class="form-control"
                                                    name="article_text"
                                                    value="<?= $rows["article_text"] ?>"
                                                    id=""
                                                    placeholder="<?= $rows["article_text"] ?>"
                                                    rows="10">
                                </textarea>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa-solid fa-floppy-disk"></i> 送出
                                        </button>
                                        <a href="doDeleteArticle.php?article_id=<?= $rows["article_id"] ?>" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i> 刪除
                                        </a>
                                    </div>
                                </form>
                            <?php else : ?>
                                文章不存在
                            <?php endif; ?>
                        </div>
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