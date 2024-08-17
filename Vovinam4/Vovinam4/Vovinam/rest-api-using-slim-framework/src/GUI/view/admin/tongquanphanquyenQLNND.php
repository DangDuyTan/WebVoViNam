<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        <?php require('../../css/admin/sidebar.css');
        require('../../css/admin/header_admin.css');
        require('../../css/admin/footer_admin.css');
        require('../../css/admin/phanquyen.css');
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

                <h1 class="title-phanquyen">Phân quyền</h1>
                <form action="update_permission.php" method="post">
                    <table>
                        <thead>
                            <tr>
                                <th>Tên Chức Năng</th>
                                <th>Thêm</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                                <th>Tìm Kiếm</th>
                                <th>Đơn Luyện</th>
                                <th>Song Luyện</th>
                                <th>Căn Bản</th>
                                <th>Đối Kháng</th>
                                <th>Thể Lực</th>
                                <th>Lý Thuyết</th>
                            </tr>
                        </thead>
                        <tbody id="content-data-table">

                            <tr>
                                <!-- <td><input type="checkbox" name="" value=""></td>
                                <td><input type="checkbox" name="" value=""></td>
                                <td><input type="checkbox" name="" value=""></td>
                                <td><input type="checkbox" name="" value=""></td>
                                <td><input type="checkbox" name="" value=""></td>
                                <td><input type="checkbox" name="" value=""></td>
                                <td><input type="checkbox" name="" value=""></td>
                                <td><input type="checkbox" name="" value=""></td>
                                <td><input type="checkbox" name="" value=""></td>
                                <td><input type="checkbox" name="" value=""></td>
                                <td><input type="checkbox" name="" value=""></td> -->
                            </tr>

                        </tbody>
                    </table>
                    <input type="button" onclick="huyTatCa()" value="Hủy">
                    <input type="button" onclick="PhanQuyen()" value="Phân quyền">
                    <a href="TongquanQLNND.php">Quay lại</a>
                </form>
                <!-- <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script> -->
                <script src="../../Js/admin/TongquanphanquyenQLNND.js?v=<?php echo $version ?>"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
</body>

</html>