<?php

if (!isset($_GET["article_id"])) {
    echo "請正確帶入 article_id 變數";
    exit;
}

$article_id = $_GET["article_id"];

require_once("db_connect_article.php");

if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$sql = "SELECT * FROM article_management
WHERE article_id = '$article_id'
";

// $sql = "SELECT * FROM article_management";


$result = $conn->query($sql);
$articleCount = $result->num_rows;
$rows = $result->fetch_assoc();


?>

<!doctype html>
<html lang="en">

<head>
    <title>article_detail</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        .article_text{
            text-align: justify;
        }
    </style>

</head>

<body>



    <header>
        <div class="container mt-5 mb-5">
            <h1>文章細節</h1>
        </div>
        <div class="container d-flex justify-content-between">
            <a href="article_manange.php" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-rotate-left"></i></a>
            <a href="article_edit.php?article_id=<?= $rows["article_id"] ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
        </div>

    </header>
    <div class="container mt-5">
        <table class="table table-bordered">
            <?php if ($articleCount > 0) : ?>
                <thead>
                    <tr>
                        <th>文章細節</th>
                    </tr>
                </thead>
                <tbody>
                    <!------------------------------- 欄位大小要注意 --------------------------------->

                    <tr>
                        <td class="col-auto">article_id</td>
                        <td><?= $rows["article_id"] ?></td>
                    </tr>
                    <tr>
                        <td>article_created_time</td>
                        <td><?= $rows["article_created_time"] ?></td>
                    </tr>
                    <tr>
                        <td>article_brand</td>
                        <td><?= $rows["article_brand"] ?></td>
                    </tr>
                    <tr>
                        <td>article_type1</td>
                        <td><?= $rows["article_type1"] ?></td>
                    </tr>
                    <tr>
                        <td>article_type2</td>
                        <td><?= $rows["article_type2"] ?></td>
                    </tr>
                    <tr>
                        <td>article_type3</td>
                        <td><?= $rows["article_type3"] ?></td>
                    </tr>
                    <tr>
                        <td>article_type4</td>
                        <td><?= $rows["article_type4"] ?></td>
                    </tr>
                    <tr>
                        <td>article_url_address</td>
                        <td><?= $rows["article_url_address"] ?></td>
                    </tr>
                    <tr>
                        <td>article_introduction</td>
                        <td><?= $rows["article_introduction"] ?></td>
                    </tr>
                    <tr>
                        <td>article_images_thumbnail</td>
                        <td>
                            <?= $rows["article_images_thumbnail"] ?>
                            <div class="container">
                                <img class="img-fluid" src="<?= $rows["article_images_thumbnail"] ?>" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>article_images_title</td>
                        <td>
                            <?= $rows["article_images_title"] ?>
                            <div class="container">
                                <img class="img-fluid" src="<?= $rows["article_images_title"] ?>" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>article_video_title_url</td>
                        <td><?= $rows["article_video_title_url"] ?></td>
                    </tr>
                    <tr>
                        <td>article_images_main</td>
                        <td>
                            <?= $rows["article_images_main"] ?>
                            <div class="container">
                                <img class="img-fluid" src="<?= $rows["article_images_main"] ?>" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>article_images_content_1</td>
                        <td>
                            <?= $rows["article_images_content_1"] ?>
                            <div class="container">
                                <img class="img-fluid" src="<?= $rows["article_images_content_1"] ?>" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>article_images_content_2</td>
                        <td>
                            <?= $rows["article_images_content_2"] ?>
                            <div class="container">
                                <img class="img-fluid" src="<?= $rows["article_images_content_2"] ?>" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>article_images_content_3</td>
                        <td>
                            <?= $rows["article_images_content_3"] ?>
                            <div class="container">
                                <img class="img-fluid" src="<?= $rows["article_images_content_3"] ?>" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>article_text</td>
                        <td class="article_text"><?= $rows["article_text"] ?></td>
                    </tr>
                    <tr>
                        <td>article_preview</td>
                        <td>
                            <a href=""><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>

                </tbody>
            <?php endif; ?>
        </table>

    </div>

</body>

</html>