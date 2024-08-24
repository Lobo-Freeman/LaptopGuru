<!doctype html>
<html lang="en">

<head>
    <title>編輯商品</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php require_once("css.php"); ?>
    <style>
        .product_img {
            width: 200px;
            height: 200px;
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
                    <div class="container">
                        <h1 class="text-center">新增商品</h1>
                        <div class="py-2">
                            <a class="btn btn-outline-secondary" href="product-list.php"><i class="fa-solid fa-arrow-left" title="回商品列表"></i></a>
                        </div>


                        <div class="form-group">
                            <form action="do-create-product.php" method="post" enctype="multipart/form-data">
                                <label for="product_name">商品圖片</label>


                                <!-- <button type="button" class="btn btn-outline-secondary" onclick="addImageFile()">+</button>
                <button type="button" class="btn btn-outline-secondary" onclick="removeImageFile()">-</button>
                <div id="add_image">

                </div> -->
                                <div class="mb-2">
                                    <input type="file" name="pic" class="form-control">
                                    <input type="hidden" name="original_pic">
                                </div>


                                <label for="model">商品型號</label>
                                <input type="text" class="form-control" id="model" name="model" required>
                                <label for="product_brand">品牌</label>
                                <input type="text" class="form-control" id="product_brand" name="product_brand" required>
                                <label for="list_price" class="form-label">商品售價</label>
                                <input type="number" class="form-control" id="list_price" name="list_price" required>
                                <label for="affordance" class="form-label">用途</label>
                                <input type="text" class="form-control" id="affordance" name="affordance" required>
                                <label for="product_color" class="form-label">商品顏色</label>
                                <input type="text" class="form-control" id="product_color" name="product_color" required>
                                <label for="product_size" class="form-label">商品尺寸</label>
                                <input type="text" class="form-control" id="product_size" name="product_size" required>
                                <label for="product_weight" class="form-label">商品重量</label>
                                <input type="text" class="form-control" id="product_weight" name="product_weight" required>
                                <label for="product_CPU" class="form-label">處理器</label>
                                <input type="text" class="form-control" id="product_CPU" name="product_CPU" required>
                                <label for="product_RAM" class="form-label">記憶體</label>
                                <input type="text" class="form-control" id="product_RAM" name="product_RAM" required>
                                <label for="discrete_display_card" class="form-label">是否為獨顯</label>
                                <input type="text" class="form-control" id="discrete_display_card" name="discrete_display_card" required>
                                <label for="product_display_card" class="form-label">顯示晶片</label>
                                <input type="text" class="form-control" id="product_display_card" name="product_display_card" required>
                                <label for="product_hardisk_type" class="form-label">硬碟類型</label>
                                <input type="text" class="form-control" id="product_hardisk_type" name="product_hardisk_type" required>
                                <label for="product_hardisk_volume" class="form-label">硬碟容量</label>
                                <input type="text" class="form-control" id="product_hardisk_volume" name="product_hardisk_volume" required>
                                <label for="product_I/O" class="form-label">I/O埠</label>
                                <textarea type="text" class="form-control" id="product_I_O" name="product_I_O" rows="5"></textarea>

                                <!-- <button type="button" class="btn btn-primary" onclick="updateProduct();">更新</button> -->
                                <button type="submit" class="btn btn-outline-secondary">
                                    送出
                                </button>
                            </form>
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


    <script>
        let image_count = 0;
        let delete_old_img_arr = [];

        document.addEventListener('DOMContentLoaded', function() {
            const delete_old_img = document.querySelectorAll('.delete_old_img');
            delete_old_img.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const old_img_index = btn.dataset.old_img;
                    const old_img = document.getElementById('oldimg[' + old_img_index + ']');
                    old_img.remove();
                    btn.remove();
                    delete_old_img_arr.push(old_img_index);
                });
            });
        });

        function addImageFile() {
            image_count++;

            const container = document.createElement('div');
            container.className = 'image_input_container';

            const input = document.createElement('input');
            input.type = 'file';
            input.dataset.new_image = image_count;
            input.className = 'form-control add_image';
            input.setAttribute('onchange', 'previewImage(event)');
            input.required = true;

            const previewDiv = document.createElement('div');
            previewDiv.className = 'image_preview';

            container.appendChild(input);
            container.appendChild(previewDiv);

            document.getElementById('add_image').appendChild(container);
        }

        function removeImageFile() {
            image_count--;
            const add_image = document.getElementById('add_image');
            const last_image = add_image.lastElementChild;
            if (last_image) {
                add_image.removeChild(last_image);
            }
        }

        function previewImage(event) {
            const reader = new FileReader();
            const input = event.target;

            reader.onload = function() {
                const previewDiv = input.nextElementSibling; // 確保圖片預覽只顯示在對應的預覽區域
                previewDiv.innerHTML = '<img src="' + reader.result + '" class="product_img" />';
            }

            reader.readAsDataURL(event.target.files[0]);
        }


        function updateProduct() {

            // 選取所有 class 為 add_image 的 input 元素
            const newImages = document.querySelectorAll('.add_image');
            const formData = new FormData();

            // 遍歷每個文件輸入元素
            newImages.forEach(function(input) {
                if (input.files.length > 0) {
                    // 將每個選擇的文件添加到 FormData
                    for (let i = 0; i < input.files.length; i++) {
                        formData.append('file[]', input.files[i]);
                    }
                }
            });

            // Create an object to store the updated product data
            var updatedProduct = {
                product_id: <?php echo $row["product_id"]; ?>,
                delete_old_img_arr: delete_old_img_arr,
                new_images: formData,
                model: document.getElementById("model").value,
                product_brand: document.getElementById("product_brand").value,
                list_price: document.getElementById("list_price").value,
                affordance: document.getElementById("affordance").value,
                product_color: document.getElementById("product_color").value,
                product_size: document.getElementById("product_size").value,
                product_weight: document.getElementById("product_weight").value,
                product_CPU: document.getElementById("product_CPU").value,
                product_RAM: document.getElementById("product_RAM").value,
                discrete_display_card: document.getElementById("discrete_display_card").value,
                product_display_card: document.getElementById("product_display_card").value,
                product_hardisk_type: document.getElementById("product_hardisk_type").value,
                product_hardisk_volume: document.getElementById("product_hardisk_volume").value,
                product_I_O: document.getElementById("product_I_O").value
            };
            console.log(formData);
            // Send the updated product data to the server using AJAX
            $.ajax({
                type: "POST",
                url: "update-product.php",
                data: updatedProduct,
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.status === 1) {
                        alert(result.message);
                        window.location.href = "product-list.php";
                    } else {
                        alert(result.message);
                    }
                }
            });
        }
    </script>
    <?php require_once("js.php"); ?>
</body>

</html>