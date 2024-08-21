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
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .table-form-control {
            width: 50rem;
        }

        .table-form-control-td {
            width: 80rem;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-primary" href="article_detail.php?article_id=<?= $rows["article_id"] ?>" title="回文章列表"><i class="fa-solid fa-left-long"></i></a>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h1>修改資料</h1>
                <?php if ($articleCount > 0) : ?>
                    <form action="doUpdateArticle.php" method="post">
                        <input type="hidden" name="article_id" value="<?= $rows["article_id"] ?>">
                        <table class="table table-bordered table-form-control">
                            <tr>
                                <th>article_id</th>
                                <td class="table-form-control-td" type="hidden"><?= $rows["article_id"] ?></td>
                            </tr>
                            <tr>
                                <th>article_created_time</th>
                                <td class="table-form-control-td">
                                    <p>Please enter the date in the format: YYYY-MM-DD</p>
                                    <input type="text" class="form-control" name="article_created_time" value="<?= $rows["article_created_time"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>article_brand</th>
                                <td class="table-form-control-td">
                                    <input type="text" class="form-control" name="article_brand" value="<?= $rows["article_brand"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>article_type1</th>
                                <td class="table-form-control-td">
                                    <input type="text" class="form-control" name="article_type1" value="<?= $rows["article_type1"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>article_type2</th>
                                <td class="table-form-control-td">
                                    <input type="text" class="form-control" name="article_type2" value="<?= $rows["article_type2"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>article_type3</th>
                                <td class="table-form-control-td">
                                    <input type="text" class="form-control" name="article_type3" value="<?= $rows["article_type3"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>article_type4</th>
                                <td class="table-form-control-td">
                                    <input type="text" class="form-control" name="article_type4" value="<?= $rows["article_type4"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>article_url_address</th>
                                <td class="table-form-control-td">
                                    <input type="text" class="form-control" name="article_url_address" value="<?= $rows["article_url_address"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>article_introduction</th>
                                <td class="table-form-control-td">
                                    <input type="text" class="form-control" name="article_introduction" value="<?= $rows["article_introduction"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>article_images_thumbnail</th>
                                <td class="table-form-control-td">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label"></label>
                                        <input class="form-control" type="file" id="formFile" name="article_images_thumbnail" enctype="multipart/form-data" value="<?= $rows["article_images_thumbnail"] ?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>article_images_title</th>
                                <td class="table-form-control-td">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label"></label>
                                        <input class="form-control" type="file" id="formFile" name="article_images_title" enctype="multipart/form-data" value="<?= $rows["article_images_title"] ?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>article_video_title_url</th>
                                <td class="table-form-control-td">
                                    <input type="text" class="form-control" name="article_video_title_url" value="<?= $rows["article_video_title_url"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>article_images_main</th>
                                <td class="table-form-control-td">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label"></label>
                                        <input class="form-control" type="file" id="formFile" name="article_images_main" enctype="multipart/form-data" value="<?= $rows["article_images_main"] ?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>article_images_content_1</th>
                                <td class="table-form-control-td">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label"></label>
                                        <input class="form-control" type="file" id="formFile" name="article_images_content_1" enctype="multipart/form-data" value="<?= $rows["article_images_content_1"] ?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>article_images_content_2</th>
                                <td class="table-form-control-td">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label"></label>
                                        <input class="form-control" type="file" id="formFile" name="article_images_content_2" enctype="multipart/form-data" value="<?= $rows["article_images_content_2"] ?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>article_images_content_3</th>
                                <td class="table-form-control-td">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label"></label>
                                        <input class="form-control" type="file" id="formFile" name="article_images_content_3" enctype="multipart/form-data" value="<?= $rows["article_images_content_3"] ?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>article_text</th>
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
                                    <i class="fa-solid fa-floppy-disk"></i>送出
                            </button>
                            <a href="doDeleteArticle.php?article_id=<?= $rows["article_id"] ?>" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>刪除
                            </a>                           
                        </div>
                        

                    </form>

                    

                <?php else : ?>
                    文章不存在
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>