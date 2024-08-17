<?php
// Xác định URL của trang hiện tại
$current_url = $_SERVER['REQUEST_URI'];
?>


<div class="side-bar">
    <a href="#!" class="brand-link">
        <img src="../../image/AdminLTELogo.png" alt="">
        <span>VOVINAM ADMIN</span>
    </a>
    <div class="bar-content">
        <div class="info" id="info">
            <img src="../../image/avt.jpg" alt="" class="avt">
            <span class="name">Nguyen Tri Dung</span>
        </div>
        <div class="sub-menu">
            <ul class="nav-sb">
                <li>
                    <a href="./Tongquan.php"
                        class="<?php echo (strpos($current_url, '/Tongquan.php') !== false) ? 'active' : ''; ?>"><span
                            class="box-cont"><i class="fas fa-tachometer-alt"></i></span><span>Tổng quan</span></a>
                </li>


                <li id="user-group-sidebar">
                    <a href="./TongquanQLNND.php"
                        class="<?php echo (strpos($current_url, '/TongquanQLNND.php') !== false || strpos($current_url, '/tongquanthemQLNND.php') !== false) ? 'active' : ''; ?>"><span
                            class="box-cont"><i class="fas fa-users"></i></span><span>Nhóm người dùng</span> <i
                            class="fas fa-angle-left"></i></a>
                    <!-- <ul class="ele-sub">
                        <li><a href="./tongquanQLNND.php"><span class="box-cont"><i
                                        class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                        <li><a href="./tongquanthemQLNND.php"><span class="box-cont"><i
                                        class="far fa-circle"></i></span><span>Thêm mới</span></a></li>
                    </ul> -->
                </li>


                <li id="user-management-sidebar">
                    <a href="./tongquanQLND.php"
                        class="<?php echo (strpos($current_url, '/tongquanQLND.php') !== false || strpos($current_url, '/tongquanthemQLND.php') !== false) ? 'active' : ''; ?>"><span
                            class="box-cont"><i class="fas fa-user"></i></span><span>Quản lý người dùng</span><i
                            class="fas fa-angle-left"></i></a>
                    <!-- <ul class="ele-sub">
                        <li><a href="./tongquanQLND.php"><span class="box-cont"><i
                                        class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                        <li id="add-user-management-sidebar"><a href="./tongquanQLND.php"><span class="box-cont"><i
                                        class="far fa-circle"></i></span><span>Thêm mới</span></a></li>
                    </ul> -->
                </li>
                <li id="monsinh-management-sidebar">
                    <a href="./QuanLyMonSinh.php"
                        class="<?php echo (strpos($current_url, '/QuanLyMonSinh.php') !== false || strpos($current_url, '/ThemMonSinh.php') !== false) ? 'active' : ''; ?>"><span
                            class="box-cont"><i class="fa-solid fa-person fa-2xl"></i></i></i></span><span>Quản lý môn
                            sinh</span><i class="fas fa-angle-left"></i></a>
                    <!-- <ul class="ele-sub">
                        <li><a href="./QuanLyMonSinh.php"><span class="box-cont"><i
                                        class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                        <li id="add-product-management-sidebar"><a href="./addproduct.php"><span class="box-cont"><i
                                        class="far fa-circle"></i></span><span>Thêm mới</span></a></li>
                        <li id="size-management-sidebar"><a href="./list-sizes.php"><span class="box-cont"><i
                                        class="far fa-circle"></i></span><span>Danh sách size</span></a></li>
                    </ul> -->
                </li>
                <li id="khoathi-management-sidebar">
                    <a href="./QuanLyKhoaThi.php"
                        class="<?php echo strpos($current_url, '/QuanLyKhoaThi.php') !== false || strpos($current_url, '/ThemKhoaThi.php') !== false ? 'active' : ''; ?>"><span
                            class="box-cont"><i class="fa-solid fa-warehouse"></i></span><span>Quản lý khóa thi</span><i
                            class="fas fa-angle-left"></i></a>
                    <!-- <ul class="ele-sub">
                        <li><a href="./QuanLyKhoaThi.php"><span class="box-cont"><i
                                        class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                        <li id="add-supplier-management-sidebar"><a href="./addsupplier.php"><span class="box-cont"><i
                                        class="far fa-circle"></i></span><span>Thêm mới</span></a></li>
                    </ul> -->
                </li>
                <li id="ketquathi-management-sidebar">
                    <a href="./QuanLyKetQuaThi.php"
                        class="<?php echo strpos($current_url, '/QuanLyKetQuaThi.php') !== false  || strpos($current_url, '/ThemMonSinhDangKyThi.php') !== false ? 'active' : ''; ?>"><span
                            class="box-cont"><i class="fa-solid fa-money-bill"></i></span><span>Danh sách kết
                            quả</span><i class="fas fa-angle-left"></i>
                    </a>
                    <!-- <ul class="ele-sub">
                        <li><a href="../admin/QuanLyKetQuaThi.php"><span class="box-cont"><i
                                        class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                        <li id="add-payment-management-sidebar"><a href="../admin/add-payment.php"><span
                                    class="box-cont"><i class="far fa-circle"></i></span><span>Thêm mới</span></a></li>
                    </ul> -->
                </li>
                <li id="chamthi-management-sidebar">
                    <a href="./GiamKhao.php"
                        class="<?php echo (strpos($current_url, '/GiamKhao.php') !== false) ? 'active' : ''; ?>"
                         class="box-cont"><i class="fa-solid fa-money-bill"></i></span>
                            <span>Danh sách chấm thi</span>
                            <i class="fas fa-angle-left"></i></a>
                </li>
                <li id="DSKQ-management-sidebar">
                    <a href="./DanhSachKetQuaView.php"
                        class="<?php echo (strpos($current_url, '/DanhSachKetQuaView.php') !== false) ? 'active' : ''; ?>"
                         class="box-cont"><i class="fa-solid fa-money-bill"></i></span>
                            <span>Danh sách kết quả thi</span>
                            <i class="fas fa-angle-left"></i></a>
                </li>
                <li id="monsinhDki-management-sidebar">
                    <a href="./MSinhDkiThi.php"
                        class="<?php echo (strpos($current_url, '/MSinhDkiThi.php') !== false) ? 'active' : ''; ?>"
                         class="box-cont"><i class="fa-solid fa-money-bill"></i></span>
                            <span>Môn Sinh đăng kí thi</span>
                            <i class="fas fa-angle-left"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>