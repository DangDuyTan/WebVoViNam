<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    // require('../../css/admin/danhsachnguoidung2.css');
    require('../../css/admin/QLND.css');

    ?>
    </style>
    <style>
    .selected-row {
        background-color: #f0f8ff;
        /* Màu nền cho hàng được chọn */
    }
    </style>
</head>

<body>
    <div class="container-sb">
        <div class="side-bar"><?php require('./sidebar.php'); ?></div>
        <div class="content">
            <div class="header">
                <?php require('./header_admin.php'); ?>
            </div>
            <div class="content-page">
                <div>
                    <h1>THÊM MÔN SINH VÀO KHÓA THI</h1>
                    <div class="form-group">
                        <!-- <label for="sizeCode" class="form-label">mã khóa thi</label> -->
                        <input type="hidden" class="form-control" id="maKetQuaThi" name="maKetQuaThi">
                    </div>

                    <div class="form-group">
                        <label for="maKhoaThi">Chọn khóa thi:</label>
                        <select id="maKhoaThi" name="maKhoaThi">
                            <option value="">Chọn khóa thi</option>
                            <option value="1">Quản trị viên</option>
                            <option value="2">Nhân viên</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="capDaiDuThi">Chọn cấp đai:</label>
                        <select id="capDaiDuThi" name="capDaiDuThi">
                            <option value="">Chọn cấp đai</option>
                            <option value="1">Quản trị viên</option>
                            <option value="2">Nhân viên</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="anhCCCD" class="form-label">Upload file dự thi</label>
                        <input type="file" class="form-control" id="anhCCCD" name="anhCCCD"
                            accept=".doc,.docx,.xls,.xlsx,.pdf" multiple placeholder="Upload file đăng ký dự thi">
                        <div id="filePreview" style="padding-top:2px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ghiChu" class="form-label">Ghi chú</label>
                    <input type="text" class="form-control" id="ghiChu" name="ghiChu" placeholder="nhập ghi chú">
                </div>
                <div class="form-group">
                    <!-- <label for="ghiChu" class="form-label">Ngày chấm</label> -->
                    <input type="hidden" class="form-control" id="ngayCham" name="ngayCham" placeholder="nhập ghi chú">
                </div>
                <div class="tim-kiem">
                    <form action="ThemMonSinhDangKyThi.php" method="get">
                        <input type="text" name="tenTimKiem" id="input-search-account"
                            placeholder="Nhập dữ liệu tìm kiếm môn sinh">
                        <button class="search" type="submit">Tìm kiếm</button>
                    </form>
                </div>
                <table class="danh-sach">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="select-row-checkbox" id="selectAllCheckbox"></th>
                            <th>STT</th>
                            <th>Mã môn sinh</th>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th>Ngày sinh</th>
                            <th>Tên cấp đai</th>
                        </tr>
                    </thead>
                    <tbody id="danhsachUser-monsinhdangkythi">
                        <!-- <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td> -->
                        <!-- <td><a class="edit-button"><i class="fa fa-edit"></i>Sửa</a></td> -->
                        <!-- <td> <a href="#" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteUser"><i class="fa fa-trash"></i></a><td>
                        </tr> -->
                    </tbody>
                </table>
                <!-- <div class="phan-trang">
                    <a href="#">&laquo;</a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">&raquo;</a>
                </div> -->

                <a href="#" onclick="addObj(event)" class="add-new"><i class="fa fa-plus"></i> Xác nhận thêm môn sinh
                    vào
                    khóa thi</a>
            </div>
            <ul class="pagination pagination-sm justify-content-end" id="Pagination"
                style="cursor:pointer; margin-right:1rem;">
                <!-- <li class="page-item"><a class="page-link">Previous</a></li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">3</a></li>
                    <li class="page-item"><a class="page-link">Next</a></li> -->
            </ul>

            <div class="footer">
                <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <!-- Sửa người dùng -->


    <!--  Xóa nhómm người dùng -->



    <!-- <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script> -->
    <!-- <script src="../../Js/admin/usermanager.js?v=<?php echo $version ?>"></script> -->
    <script src="../../Js/admin/ThemMonSinhDangKyThi.js?v=<?php echo $version ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>