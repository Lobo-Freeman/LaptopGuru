<!doctype html>
<html lang="en">

<head>
    <title>文章新增</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="mt-5">
            <div class="mb-3">
                <div class="mb-3">
                    <h1>新增文章</h1>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="article_manange.php" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-rotate-left"> 返回文章管理</i></a>
                </div>
            </div>
            <div class="">
                <!--------------------------------- 編輯中 ---------------------------------->
                <div>
                    <form action="doCreatArticle.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="article_id">文章ID</label>
                            <input
                                type="text"
                                class="form-control"
                                name="article_id"
                                id=""
                                maxlength="4"
                                pattern="\d{4}"
                                title="請輸入四位數字"
                                placeholder="請輸入文章id" />
                        </div>
                        <div class="mb-3">
                            <label for="form-label" name="article_created_time">文章創建時間</label>
                            <input
                                type="date"
                                class="form-control"
                                id=""
                                name="article_created_time"
                                placeholder="year-mt-da" />
                        </div>

                        <div class="mb-3">
                            <label for="article_brand">文章品牌</label>
                            <br>
                            <select name="article_brand" id="" for="article_brand" class="form-control">
                                <option selected>請選取文章品牌</option>
                                <option value="Acer">Acer</option>
                                <option value="Asus">Asus</option>
                                <option value="Dell">Dell</option>
                                <option value="MSI">MSI</option>
                                <option value="gigabyte">gigabyte</option>
                                <option value="HP">HP</option>
                                <option value="Razer">Razer</option>
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="article_type1">文章類別1</label>
                            <input
                                type="text"
                                class="form-control"
                                name="article_type1"
                                id=""
                                placeholder="請輸入文章類別1" />
                        </div>
                        <div class="mb-3">
                            <label for="article_type2">文章類別2</label>
                            <input
                                type="text"
                                class="form-control"
                                name="article_type2"
                                id=""
                                placeholder="請輸入文章類別2" />
                        </div>
                        <div class="mb-3">
                            <label for="article_type3">文章類別3</label>
                            <input
                                type="text"
                                class="form-control"
                                name="article_type3"
                                id=""
                                placeholder="請輸入文章類別3" />
                        </div>
                        <div class="mb-3">
                            <label for="form-label">文章類別4</label>
                            <input
                                type="text"
                                class="form-control"
                                name="article_type4"
                                id=""
                                placeholder="請輸入文章類別4" />
                        </div>
                        <div class="mb-3">
                            <label for="article_url_address">文章網址</label>
                            <input
                                type="url"
                                class="form-control"
                                name="article_url_address"
                                id=""
                                placeholder="請輸入文章網址" />
                        </div>

                        <div class="container mb-3">
                            <label for="article_introduction">文章介紹</label>
                            <div>
                                <textarea
                                    name="article_introduction"
                                    id=""
                                    placeholder="請輸入簡短的文章介紹"
                                    rows="10"
                                    class="form-control form-control-lg"
                                    type="text">
                </textarea>
                            </div>
                        </div>
                        <div class="container mb-4">
                            <label for="article_images_thumbnail" class="form-label">文章縮圖</label>
                            <input class="form-control" type="file" id="formFile" name="article_images_thumbnail" enctype="multipart/form-data">
                        </div>
                        <div class="container mb-4">
                            <label for="article_images_main" class="form-label">文章圖片(主要)</label>
                            <input class="form-control" type="file" id="formFile" name="article_images_main" enctype="multipart/form-data">
                        </div>
                        <div class="container mb-3">
                            <label for="article_video_title_url">文章影片網址</label>
                            <input

                                type="text"
                                class="form-control"
                                name="article_video_title_url"
                                id=""
                                placeholder="請輸入文章影片網址" />
                        </div>

                        <div class="container mb-4">
                            <label for="article_images_main" class="form-label">文章圖片(主要)</label>
                            <input class="form-control" type="file" id="formFile" name="article_images_main ">
                        </div>

                        <div class="container mb-4">
                            <label for="article_images_content_1" class="form-label">文章內文圖片1</label>
                            <input class="form-control" type="file" id="formFile" value="123" name="article_images_content_1" enctype="multipart/form-data">
                        </div>

                        <div class="container mb-4">
                            <label for="article_images_content_" class="form-label">文章內文圖片2</label>
                            <input class="form-control" type="file" id="formFile" name="article_images_content_2" enctype="multipart/form-data">
                        </div>

                        <div class="container mb-4">
                            <label for="article_images_content_3" class="form-label">文章內文圖片3</label>
                            <input class="form-control" type="file" id="formFile" name="article_images_content_3" enctype="multipart/form-data">
                        </div>
                        <div class="container mb-3">
                            <label for="article_text">文章內容</label>
                            <div>
                                <textarea
                                    name="article_text"
                                    id=""
                                    placeholder="請輸入文章內容"
                                    rows="10"
                                    class="form-control form-control-lg"
                                    type="text">
                </textarea>
                            </div>

                        </div>
                </div>
                <div class="container mb-5 mt-5">
                    <button
                        type="submit"
                        class="btn btn-outline-secondary me-5">
                        上傳
                    </button>
                    <!------------------------------d-none ------------------------------->
                    <!------------------------------d-none ------------------------------->
                    <!------------------------------d-none ------------------------------->
                    <button
                        type="button"
                        class="btn btn btn-outline-secondary d-none">
                        清除所有欄位
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>