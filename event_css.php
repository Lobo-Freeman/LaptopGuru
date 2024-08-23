<!-- Bootstrap CSS v5.2.1 -->
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<link rel="stylesheet" href="/CSS/style.css?t=<?= time() ?>">
<!-- 將引入的css檔案加一個time()變數，避免瀏覽器暫存讓引入的css檔案無法更新 -->
<!-- 當css撰寫完成後再把變數取消掉 -->
<style>
    .table td {
        white-space: normal;
        word-wrap: break-word;
        max-width: 200px;
    }

    .table img {
        min-width: 100px;
        max-width: 100%;
        height: auto;
    }

    .table th {
        background-color: #f0f0f0;
        font-weight: bold;
        text-align: center;
        white-space: nowrap;
        background-color: #f0f0f0;
        font-weight: bold;
        text-align: center;
        padding: 10px;
    }

    .table td {
        vertical-align: middle;
        height: 100px;
        max-height: 100px;
        vertical-align: middle;
        padding: 10px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, .05);
    }

    .table td.text-right {
        text-align: right;
    }

    .table td.text-center {
        text-align: center;
    }

    .table img {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        max-width: 100px;
        max-height: 80px;
        object-fit: cover;
    }

    .table .btn-icon {
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: .2rem;
    }

    .table .text-truncate {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .pagination .page-item.active .page-link {
        background-color: #6c757d;

        color: white;

        border-color: #6c757d;

    }

    .pagination .page-link {
        color: #6c757d;
    }

    .pagination .page-link:hover {
        background-color: #0056b3;

        color: white;

        border-color: #6c757d;

    }

    /* ---------------------event_edit----------------------- */
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .image-preview {
        max-width: 300px;
        margin-top: 10px;
    }

    /* ---------------------event----------------------- */
    body {
        background-color: #f8f9fa;
    }

    .event-card {
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-top: 30px;
    }

    .event-image {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .event-title {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #333;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #007bff;
    }

    .info-group {
        margin-bottom: 15px;
    }

    .info-label {
        font-weight: bold;
        color: #555;
    }

    .info-value {
        color: #333;
    }

    .btn-action {
        margin-right: 10px;
    }
</style>