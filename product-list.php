<?php

require_once("db_connect.php");

if (isset($_GET["valid"])) {
    $valid = $_GET["valid"];
} else {
    $valid = 1;
}
if (isset($_GET["search"]) && isset($_GET["search_type"])) {
    $search = $_GET["search"];
    $search_type = $_GET["search_type"];
    $search_type_name = "";
    switch ($search_type) {
        case 1:
            $search_type_name = "model";
            break;
        case 2:
            $search_type_name = "product_brand";
            break;
        case 3:
            $search_type_name = "product_CPU";
            break;
        case 4:
            $search_type_name = "product_display_card";
            break;
        default:
            $search_type_name = "model";
            break;
    }

    $sql = "SELECT * FROM product LEFT JOIN product_img ON product_id = img_product_id WHERE $search_type_name LIKE '%$search%'  AND valid = $valid ";
} else {
    $sql = "SELECT * FROM product LEFT JOIN product_img ON product_id = img_product_id WHERE valid = $valid ";
}
$resultAll = $conn->query($sql);
$productCount = $resultAll->num_rows;

$per_page = 10;
$page = 1;
$start_item = 0;

$totlapage = ceil($productCount / $per_page);
// echo "total page:".$totlap
if (isset($_GET["order"])) {
    $order = $_GET["order"];
} else {
    $order = 0;
}

switch ($order) {
    case 0:
        $where_clause = "ORDER BY product_id DESC";
        break;
    case 1:
        $where_clause = "ORDER BY model ASC";
        break;
    case 2:
        $where_clause = "ORDER BY product_brand ASC";
        break;
    case 3:
        $where_clause = "ORDER BY list_price ASC";
        break;
    case 4:
        $where_clause = "ORDER BY affordance ASC";
        break;
    case 5:
        $where_clause = "ORDER BY product_color ASC";
        break;
    case 6:
        $where_clause = "ORDER BY product_size ASC";
        break;
    case 7:
        $where_clause = "ORDER BY product_weight ASC";
        break;
    case 8:
        $where_clause = "ORDER BY product_CPU ASC";
        break;
    case 9:
        $where_clause = "ORDER BY product_RAM ASC";
        break;
    case 10:
        $where_clause = "ORDER BY product_display_card ASC";
        break;

    default:
        header("location:product-list.php?p=1&order=0");
        break;
}
$sql .=  $where_clause;


if (isset($_GET["p"])) {

    $page = $_GET["p"];
} else {
    $page = 1;
}
$start_item = ($page - 1) * $per_page;
$sql .= " LIMIT $start_item, $per_page";

$result = $conn->query($sql);


?>
<!doctype html>
<html lang="en">

<head>
    <title>商品列表</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php
    require_once "css.php";
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

                    <h1 class="text-center">商品列表</h1>
                    <div class="py-2">
                        <?php if (isset($_GET["search"])) : ?>
                            <a class="btn btn-secondary" href="product-list.php" title="回商品列表"><i class="fa-solid fa-arrow-left" title="回商品列表"></i></a>
                        <?php endif; ?>
                        <a class="btn btn-secondary" href="create-product.php" title="新增商品"><i class="fa-solid fa-square-plus"></i></i></a>
                    </div>
                    <form>
                        <div class="input-group">
                            <div>
                                <select class="form-select" name="order" id="order_select" title="排序">
                                    <option value="0" <?= isset($_GET["order"]) && $_GET["order"] == 0 ? "selected" : ""; ?>>按id排序</option>
                                    <option value="1" <?= isset($_GET["order"]) && $_GET["order"] == 1 ? "selected" : ""; ?>>按型號排序</option>
                                    <option value="2" <?= isset($_GET["order"]) && $_GET["order"] == 2 ? "selected" : ""; ?>>按廠牌排序</option>
                                    <option value="3" <?= isset($_GET["order"]) && $_GET["order"] == 3 ? "selected" : ""; ?>>按定價排序</option>
                                    <option value="4" <?= isset($_GET["order"]) && $_GET["order"] == 4 ? "selected" : ""; ?>>按用途排序</option>
                                    <option value="5" <?= isset($_GET["order"]) && $_GET["order"] == 5 ? "selected" : ""; ?>>按顏色排序</option>
                                    <option value="6" <?= isset($_GET["order"]) && $_GET["order"] == 6 ? "selected" : ""; ?>>按尺寸排序</option>
                                    <option value="7" <?= isset($_GET["order"]) && $_GET["order"] == 7 ? "selected" : ""; ?>>按重量排序</option>
                                    <option value="8" <?= isset($_GET["order"]) && $_GET["order"] == 8 ? "selected" : ""; ?>>按處理器排序</option>
                                    <option value="9" <?= isset($_GET["order"]) && $_GET["order"] == 9 ? "selected" : ""; ?>>按記憶體排序</option>
                                    <option value="10" <?= isset($_GET["order"]) && $_GET["order"] == 10 ? "selected" : ""; ?>>按顯示晶片排序</option>
                                </select>
                            </div>
                            <div>
                                <select class="form-select" name="search_type">
                                    <option value="1" <?= isset($_GET["search_type"]) && $_GET["search_type"] == 1 ? "selected" : ""; ?>>搜尋商品型號</option>
                                    <option value="2" <?= isset($_GET["search_type"]) && $_GET["search_type"] == 2 ? "selected" : ""; ?>>搜尋廠牌</option>
                                    <option value="3" <?= isset($_GET["search_type"]) && $_GET["search_type"] == 3 ? "selected" : ""; ?>>搜尋處理器</option>
                                    <option value="4" <?= isset($_GET["search_type"]) && $_GET["search_type"] == 4 ? "selected" : ""; ?>>搜尋顯示晶片</option>
                                </select>
                            </div>
                            <input type="search" class="form-control" name="search" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : "" ?>">
                            <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-search"></i></button>
                        </div>

                    </form>


                    <?php $rows = $result->fetch_all(MYSQLI_ASSOC); ?>
                    共有<?= $productCount ?> 筆商品

                    <table class="table table-bordered ">
                        <thead class="text-nowrap">
                            <tr>
                                <th>id</th>
                                <th>圖片</th>
                                <th>型號</th>
                                <th>廠牌</th>
                                <th>定價</th>
                                <th>用途</th>
                                <th>顏色</th>
                                <th>尺寸</th>
                                <th>重量</th>
                                <th>處理器</th>
                                <th>記憶體</th>
                                <th>獨顯</th>
                                <th>顯示晶片</th>
                                <th>編輯</th>
                                <?php if ($valid == 0) : ?>
                                    <th>重新上架</th>
                                    <th>永久刪除</th>
                                <?php else : ?>
                                    <th>下架</th>
                                <?php endif; ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($productCount > 0) {

                                foreach ($rows as $row) {
                            ?>
                                    <tr>

                                        <td><?= $row["product_id"] ?></td>
                                        <?php if (isset($row["product_img_path"])): ?>
                                            <td><img src="assets/<?= $row["product_img_path"] ?>" alt="" style="width: 100px;"></td>
                                        <?php else: ?>
                                            <td><img src="" alt="" style="width: 100px;"></td>
                                        <?php endif; ?>
                                        <td><?= $row["model"] ?></td>
                                        <td><?= $row["product_brand"] ?></td>
                                        <td><?= $row["list_price"] ?></td>
                                        <td><?= $row["affordance"] ?></td>
                                        <td><?= $row["product_color"] ?></td>
                                        <td><?= $row["product_size"] ?></td>
                                        <td><?= $row["product_weight"] ?></td>
                                        <td><?= $row["product_CPU"] ?></td>
                                        <td><?= $row["product_RAM"] ?></td>
                                        <td><?= $row["discrete_display_card"] ?></td>
                                        <td><?= $row["product_display_card"] ?></td>
                                        <td><a class="text-secondary" href="edit-product.php?product_id=<?= $row["product_id"] ?>"><i class="fa-solid fa-pencil"></i></a></td>
                                        <?php if ($valid == 0) : ?>
                                            <td><a class="text-secondary restore_product" data-restore_id="<?= $row["product_id"] ?>"><i class="fa-solid fa-arrow-up"></i></a></td>
                                            <td><a class="text-secondary hard_delete_product" data-hard_delete_id="<?= $row["product_id"] ?>" class="delete_product"><i class="fa-solid fa-trash"></i></a></td>
                                        <?php else : ?>
                                            <td><a class="text-secondary delete_product" data-delete_id="<?= $row["product_id"] ?>" class="delete_product"><i class="fa-solid fa-trash"></i></a></td>

                                        <?php endif; ?>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="13">查無資料</td>
                                </tr>
                            <?php
                            }
                            ?>

                    </table>
                    <ul class="pagination justify-content-center">
                        <!-- 頁數 -->
                        <li class="page-item">
                            <?php
                            if (isset($_GET["search"])) {
                                $search = $_GET["search"];
                            ?>
                                <a class="page-link" href="?p=1&order=<?= $order ?>&search=<?= $search ?>&search_type=<?= $search_type ?>"><span aria-hidden="true">&laquo;</span></a>
                            <?php
                            } else {
                            ?>
                                <a class="page-link" href="?p=1&order=<?= $order ?>"><span aria-hidden="true">&laquo;</span></a>
                            <?php
                            }
                            ?>
                        </li>
                        <?php
                        if (isset($_GET["p"])) {
                            $lastpage = $_GET["p"] + 5;
                            if ($lastpage > $totlapage) {
                                $lastpage = $totlapage;
                            }
                        } else {
                            $lastpage = 10;
                        }
                        if ($lastpage - 9 < 1) {
                            $lastpage = 10;
                        }

                        for ($i = $lastpage - 9; $i <= $totlapage  && $i <= ($lastpage); $i++) : ?>
                            <li class="page-item <?php if ($page == $i) echo "active"; ?>">
                                <?php
                                if (isset($_GET["search"])) {
                                    $search = $_GET["search"];
                                ?>
                                    <a class="page-link" href="?p=<?= $i ?>&order=<?= $order ?>&search=<?= $search ?>&search_type=<?= $search_type ?>"><?= $i ?></a>
                                <?php
                                } else {
                                ?>
                                    <a class="page-link" href="?p=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                                <?php
                                }
                                ?>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <?php
                            if (isset($_GET["search"])) {
                                $search = $_GET["search"];
                            ?>
                                <a class="page-link" href="?p=<?= $totlapage ?>&order=<?= $order ?>&search=<?= $search ?>&search_type=<?= $search_type ?>">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            <?php
                            } else {
                            ?>
                                <a class="page-link" href="?p=<?= $totlapage ?>&order=<?= $order ?>">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            <?php
                            }
                            ?>
                        </li>

                    </ul>





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
    <?php
    require_once "js.php";
    ?>

    <script>
        var delete_id = document.querySelectorAll(".delete_product");
        var hard_delete_id = document.querySelectorAll(".hard_delete_product");
        var restore_id = document.querySelectorAll(".restore_product");
        var order_select = document.querySelector("#order_select");
        // 排序
        order_select.addEventListener("change", function() {
            var order = this.value; //取得選擇的值
            var url = new URL(location.href); //取得當前網址
            url.searchParams.set("order", order); //設定參數
            location.href = url.href; //導向網址
        });
        // 刪除商品
        delete_id.forEach(function(item) {
            item.addEventListener("click", function() {
                var delete_id = this.dataset.delete_id;
                if (confirm("確定要刪除商品編號" + delete_id + "嗎?")) {
                    $.ajax({
                        url: "delete-product.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            delete_id: delete_id
                        }
                    }).done(function(response) {
                        if (response.status == 1) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    }).fail(function(jqxhr, textStatus) {
                        console.log("Request failed: " + textStatus);
                    });
                }
            });
        });
        // 永久刪除商品
        hard_delete_id.forEach(function(item) {
            item.addEventListener("click", function() {
                var hard_delete_id = this.dataset.hard_delete_id;
                if (confirm("確定要永久刪除商品編號" + hard_delete_id + "嗎?")) {
                    $.ajax({
                        url: "hard-delete-product.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            hard_delete_id: hard_delete_id
                        }
                    }).done(function(response) {
                        if (response.status == 1) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    }).fail(function(jqxhr, textStatus) {
                        console.log("Request failed: " + textStatus);
                    });
                }
            });
        });
        // 重新上架商品
        restore_id.forEach(function(item) {
            item.addEventListener("click", function() {
                var restore_id = this.dataset.restore_id;
                if (confirm("確定要重新上架商品編號" + restore_id + "嗎?")) {
                    $.ajax({
                        url: "restore-product.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            restore_id: restore_id
                        }
                    }).done(function(response) {
                        if (response.status == 1) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    }).fail(function(jqxhr, textStatus) {
                        console.log("Request failed: " + textStatus);
                    });
                }
            });
        });
    </script>
    <?php
    $conn->close();
    ?>
</body>



</html>