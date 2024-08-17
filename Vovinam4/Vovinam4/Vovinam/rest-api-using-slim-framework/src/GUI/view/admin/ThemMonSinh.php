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
    require('../../css/admin/QLND.css');
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
            <div class="content-page">
                <h1>THÊM MÔN SINH</h1>
                <form action="" id="addFormBag">
                    <div class="form-container">
                        <div class="inputtotal">
                            <div class="input1">
                                <div class=" form-group">
                                    <!-- <label for="maMonSinh">mã môn sinh</label> -->
                                    <input type="hidden" id="maMonSinh" name="maMonSinh">
                                </div>
                                <div class=" form-group">
                                    <!-- <label for="maMonSinh">mã môn sinh</label> -->
                                    <input type="hidden" id="maThe" name="maThe">
                                </div>
                                <div class="form-group">
                                    <label for="hoTen">Họ và tên</label>
                                    <input type="text" id="hoTen" name="hoTen" placeholder="Nhập họ và tên">
                                </div>
                                <div class="form-group">
                                    <label for="gioiTinh">Giới tính:</label>
                                    <select id="gioiTinh" name="gioiTinh">
                                        <option value="">Chọn giới tính</option>
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ngaySinh">Ngày sinh</label>
                                    <input type="date" id="ngaySinh" name="ngaySinh" placeholder="Nhập ngày sinh">
                                </div>
                                <div class="form-group">
                                    <label for="chieuCao">Chiều cao</label>
                                    <input type="number" id="chieuCao" name="chieuCao" placeholder="Nhập chiều cao">
                                </div>
                                <div class="form-group">
                                    <label for="canNang">Cân nặng</label>
                                    <input type="number" id="canNang" name="canNang" placeholder="Nhập cân nặng">
                                </div>
                                <div class="form-group">
                                    <label for="diaChi">Địa chỉ</label>
                                    <input type="text" id="diaChi" name="diaChi" placeholder="Nhập địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label for="soDienThoai">Số điện thoại</label>
                                    <input type="number" id="soDienThoai" name="soDienThoai"
                                        placeholder="Nhập số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Nhập email">
                                </div>
                                <div class="form-group">
                                    <label for="anh3x4" class="form-label">Ảnh 3x4</label>
                                    <input type="file" class="form-control" id="anh3x4" name="anh3x4"
                                        accept="image/jpeg, image/png" multiple placeholder="Nhập file ảnh 3x4">
                                    <div id="imagePreviewB" style="padding-top:2px;"></div>
                                </div>

                                <div class="form-group">
                                    <label for="cccd">CCCD</label>
                                    <input type="number" id="cccd" name="cccd" placeholder="Nhập số cccd">
                                </div>
                                <div class="form-group">
                                    <label for="anhCCCD" class="form-label">Ảnh CCCD</label>
                                    <input type="file" class="form-control" id="anhCCCD" name="anhCCCD"
                                        accept="image/jpeg, image/png" multiple placeholder="Nhập file ảnh cccd">
                                    <div id="imagePreviewC" style="padding-top:2px;"></div>
                                </div>
                                <div class="form-group">
                                    <label for="ngayCapCCCD">Ngày cấp CCCD</label>
                                    <input type="date" id="ngayCapCCCD" name="ngayCapCCCD"
                                        placeholder="Nhập ngày cấp cccd">
                                </div>
                                <div class="form-group">
                                    <label for="noiCapCCCD">Nơi cấp CCCD</label>
                                    <input type="text" id="noiCapCCCD" name="noiCapCCCD"
                                        placeholder="Nhập nơi cấp cccd">
                                </div>
                                <!-- <input type="hidden" id="thoiGianTao" name="thoiGianTao">
                                <input type="hidden" id="thoiGianSua" name="thoiGianSua">
                                <div class="form-group">
                                    <label for="so_dien_thoai">Số điện thoại:</label>
                                    <input type="number" id="soDienThoai" name="soDienThoai"
                                        placeholder="Nhập số điện thoại">
                                </div> -->
                            </div>
                            <div class="input2">
                                <div class="form-group">
                                    <label for="tenPhuHuynh">Tên phụ huynh</label>
                                    <input type="text" id="tenPhuHuynh" name="tenPhuHuynh"
                                        placeholder="Nhập tên phụ huynh">
                                </div>
                                <div class="form-group">
                                    <label for="sdtPhuHuynh">Sdt phụ huynh</label>
                                    <input type="number" id="sdtPhuHuynh" name="sdtPhuHuynh"
                                        placeholder="Nhập sdt phụ huynh">
                                </div>
                                <div class="form-group">
                                    <label for="congViec">Công việc phụ huynh</label>
                                    <input type="text" id="congViec" name="congViec"
                                        placeholder="Nhập công việc phụ huynh">
                                </div>
                                <div class="form-group">
                                    <label for="lichSuTapLuyen">Lịch sử tập</label>
                                    <input type="text" id="lichSuTapLuyen" name="lichSuTapLuyen"
                                        placeholder="Nhập lịch sử tập">
                                </div>
                                <div class="form-group">
                                    <label for="lichSuThi">Lịch sử thi</label>
                                    <input type="text" id="lichSuThi" name="lichSuThi" placeholder="Nhập lịch sử thi">
                                </div>
                                <div class="form-group">
                                    <label for="bangCap">Bằng cấp</label>
                                    <input type="text" id="bangCap" name="bangCap" placeholder="Nhập bằng cấp">
                                </div>
                                <div class="form-group">
                                    <label for="trinhDoVanHoa">Trình độ VH</label>
                                    <input type="text" id="trinhDoVanHoa" name="trinhDoVanHoa"
                                        placeholder="Nhập trình độ VH">
                                </div>

                                <div class="form-group">
                                    <label for="khaNangNoiBat">Khả năng nổi bật</label>
                                    <input type="text" id="khaNangNoiBat" name="khaNangNoiBat"
                                        placeholder="loại tài khoản">
                                </div>
                                <div class="form-group">
                                    <label for="trangThai">Trạng thái môn sinh:</label>
                                    <select id="trangThai" name="trangThai">
                                        <option value="">Chọn trạng thái môn sinh</option>
                                        <option value="1">Đang tập luyện</option>
                                        <option value="0">Chờ thi đấu</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="maCapDai">Cấp đai</label>
                                    <select id="maCapDai" name="maCapDai">
                                        <option value="">Chọn cấp đai</option>
                                        <option value="1">Quản trị viên</option>
                                        <option value="2">Nhân viên</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="maCauLacBo">Câu lạc bộ</label>
                                    <select id="maCauLacBo" name="maCauLacBo">
                                        <option value="">Chọn câu lạc bộ</option>
                                        <option value="1">Quản trị viên</option>
                                        <option value="2">Nhân viên</option>
                                    </select>
                                </div>


                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="addObj(event)">Thêm môn sinh</button>
                        <a href="./QuanLyMonSinh.php" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>

        </div>
        <div class="footer">
            <?php require('./footer_admin.php'); ?>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Load hình ảnh cho input anh3x4
        $("#anh3x4").change(function() {
            const files = $(this)[0].files;
            const imagePreview = $("#imagePreviewB");
            imagePreview.empty();

            if (files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = $("<img>")
                            .attr("src", e.target.result)
                            .addClass("img-thumbnail");
                        imagePreview.append(img);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        // Load hình ảnh cho input anhCCCD
        $("#anhCCCD").change(function() {
            const files = $(this)[0].files;
            const imagePreview = $("#imagePreviewC");
            imagePreview.empty();

            if (files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = $("<img>")
                            .attr("src", e.target.result)
                            .addClass("img-thumbnail");
                        imagePreview.append(img);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    });
    </script>
    <!-- <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script> -->
    <script src="../../Js/admin/ThemMonSinh.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>