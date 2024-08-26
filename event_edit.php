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
    <?php include("css.php"); ?>

    <?php include("event_css.php");
    include("js.php");
    ?>
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
                    <div class="py-4">
                        <a href="event.php?event_id=<?= $row["event_id"] ?>" class="btn btn-outline-secondary">
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
                                        <img class="img-fluid mt-2 image-preview" id="image_preview" src="../event_images/<?= $row['event_picture'] ?>" alt="Current Event Picture">
                                        <p class="mt-1">當前圖片: <?= $row['event_picture'] ?></p>
                                    <?php else: ?>
                                        <img class="img-fluid mt-2 image-preview" id="image_preview" src="" alt="Event Picture Preview" style="display: none;">
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
                                    <button type="submit" class="btn btn-outline-secondary">
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
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">取消</button>
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

    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">警告</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="alertModalBody">
                    <!-- 警告訊息將在這裡顯示 -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">確定</button>
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



<script>
    //圖片預覽
    document.getElementById('event_picture').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        var preview = document.getElementById('image_preview');

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            preview.style.display = 'none';
        }
    });

    // 獲取時間輸入元素
    const applyStartTime = document.getElementById('apply_start_time');
    const applyEndTime = document.getElementById('apply_end_time');
    const eventStartTime = document.getElementById('event_start_time');

    const alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
    const alertModalBody = document.getElementById('alertModalBody');

    // 顯示警告的函數
    function showAlert(message) {
        alertModalBody.textContent = message;
        alertModal.show();
    }

    document.querySelector('#alertModal .btn-close').addEventListener('click', function() {
        alertModal.hide();
    });

    // 為模態框的確定按鈕添加事件監聽器
    document.querySelector('#alertModal .modal-footer .btn-secondary').addEventListener('click', function() {
        alertModal.hide();
    });

    // 檢查報名結束時間
    applyEndTime.addEventListener('change', function() {
        if (applyStartTime.value && new Date(this.value) <= new Date(applyStartTime.value)) {
            showAlert('報名結束時間不能早於或等於報名開始時間');
            this.value = '';
        }
    });

    // 檢查活動開始時間
    eventStartTime.addEventListener('change', function() {
        if (applyEndTime.value && new Date(this.value) <= new Date(applyEndTime.value)) {
            showAlert('活動開始時間不能早於或等於報名結束時間');
            this.value = '';
        }
    });

    // 添加報名開始時間的檢查
    applyStartTime.addEventListener('change', function() {
        if (applyEndTime.value && new Date(applyEndTime.value) <= new Date(this.value)) {
            showAlert('報名開始時間不能晚於或等於報名結束時間');
            this.value = '';
        }
    });
</script>


</html>