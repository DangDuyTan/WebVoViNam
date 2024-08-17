<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm khóa thi mới</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
    <?php require('../../css/admin/sidebar.css');
    require('../../css/admin/header_admin.css');
    require('../../css/admin/footer_admin.css');
    ?>
    </style>
</head>

<body>
    <div class="container-sb">
        <div class="side-bar"><?php require('./sidebar.php'); ?></div>
        <div class="content">
            <div class="header">
                <?php require('./header_admin.php'); ?>
            </div>
            <div class="content-page-sb">
                <div>
                    <h2 style="text-align:center;">THÊM KHÓA THI MỚI</h2>
                    <div class="container-fluid">
                        <form id="addForm">
                            <div class="mb-3">
                                <!-- <label for="sizeCode" class="form-label">mã khóa thi</label> -->
                                <input type="hidden" class="form-control" id="maKhoaThi" name="maKhoaThi">
                            </div>
                            <div class="mb-3">
                                <label for="tenKhoaThi" class="form-label">Tên khóa thi</label>
                                <input type="text" class="form-control" id="tenKhoaThi" name="tenKhoaThi">
                            </div>
                            <div class="mb-3">
                                <label for="ngayThi" class="form-label">Ngày thi</label>
                                <input type="date" class="form-control" id="ngayThi" name="ngayThi">
                            </div>
                            <div class="mb-3">
                                <label for="ngayKetThuc" class="form-label">Ngày kết thúc</label>
                                <input type="date" class="form-control" id="ngayKetThuc" name="ngayKetThuc">
                            </div>
                            <div class="mb-3">
                                <label for="capDai" class="form-label">Cấp đai</label>
                                <div id="dsCapDaiThi"></div>
                            </div>
                            <div class="mb-3">
                                <label for="ghiChu" class="form-label">Ghi chú</label>
                                <input type="text" class="form-control" id="ghiChu" name="ghiChu">
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="hienThi" name="hienThi">
                            </div>
                            <div class="group-btn d-flex" style="justify-content: space-between;">
                                <div class="button-back">
                                    <button class="btn btn-secondary"><a href="./QuanLyKhoaThi.php"
                                            style="text-decoration:none;" class="text-white">Quay lại</a></button>
                                </div>
                                <div class="button-add" style=" margin-bottom: 2rem;">
                                    <button type="submit" class="btn btn-primary" onclick="addObj(event)">Thêm khóa
                                        thi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="footer">
                <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <script src="../../Js/admin/ThemKhoaThi.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>