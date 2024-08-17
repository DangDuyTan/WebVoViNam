<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/TaiKhoanDTO.php');

class TaiKhoanDAL extends AbstractionDAL
{
    private $actionSQL = null;

    public function __construct()
    {
        parent::__construct();
        $this->actionSQL = parent::getConn();

        // if ($this->actionSQL != null) {
        //     echo 'thanh cong';
        // }
    }

    // xóa một đối tượng bởi tên đăng nhập 
    function deleteByID($tenDangNhap)
    {
        // do bảng ctphieudiem có tham chiếu khóa ngoại đến thuộc tính khóa tenDangNhap của bảng taikhoan
        // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa
        $check_data_CTPhieuDiem = "SELECT * FROM ctphieudiem WHERE GiamKhaoCham = '$tenDangNhap'";
        $result_1 = $this->actionSQL->query($check_data_CTPhieuDiem);

        if ($result_1->num_rows < 1) {
            $string = "DELETE FROM taikhoan WHERE tenDangNhap = '$tenDangNhap'";
            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }

    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
        if ($obj != null) {
            $tenDangNhap = $obj->getTenDangNhap();
            // do bảng ctphieudiem có tham chiếu khóa ngoại đến thuộc tính khóa tenDangNhap của bảng taikhoan
            // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa
            $check_data_Orders = "SELECT * FROM ctphieudiem WHERE GiamKhaoCham = '$tenDangNhap'";
            $result_1 = $this->actionSQL->query($check_data_Orders);

            if ($result_1->num_rows < 1) {
                $string = "DELETE FROM taikhoan WHERE tenDangNhap = '$tenDangNhap'";
                return $this->actionSQL->query($string);
            } else {
                return false;
            }
        }
    }

    // lấy ra mảng các đối tượng
    function getListObj()
    {
        // Mảng để lưu trữ các đối tượng
        $array_list = array();

        // Câu lệnh truy vấn
        $string = 'SELECT * FROM taikhoan';

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            // Lặp qua các dòng kết quả và thêm vào mảng
            while ($data = $result->fetch_assoc()) {
                $tenDangNhap = $data['tenDangNhap'];
                $ho = $data["ho"];
                $ten = $data["ten"];
                $matKhau = $data["matKhau"];
                $anhDaiDien = $data["anhDaiDien"];
                $loai = $data["loai"];
                $thoiGianTao = $data["thoiGianTao"];
                $thoiGianSua = $data["thoiGianSua"];
                $kichHoat = $data["kichHoat"];
                $soDienThoai = $data["soDienThoai"];
                $maQuyen = $data["maQuyen"];

                // Tạo đối tượng TaiKhoanDTO và thêm vào mảng
                $taiKhoan = new TaiKhoanDTO($tenDangNhap, $ho, $ten, $matKhau, $anhDaiDien, $loai, $thoiGianTao, $thoiGianSua, $kichHoat, $soDienThoai, $maQuyen);
                array_push($array_list, $taiKhoan);
            }
            return $array_list;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // lấy ra một đối tượng dựa theo tên đăng nhập
    function getObj($tenDangNhap)
    {
        // Câu lệnh truy vấn
        $string = "SELECT * FROM taikhoan WHERE tenDangNhap = '$tenDangNhap'";

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $tenDangNhap = $data['tenDangNhap'];
            $ho = $data["ho"];
            $ten = $data["ten"];
            $matKhau = $data["matKhau"];
            $anhDaiDien = $data["anhDaiDien"];
            $loai = $data["loai"];
            $thoiGianTao = $data["thoiGianTao"];
            $thoiGianSua = $data["thoiGianSua"];
            $kichHoat = $data["kichHoat"];
            $soDienThoai = $data["soDienThoai"];
            $maQuyen = $data["maQuyen"];

            // Tạo đối tượng TaiKhoanDTO và trả về
            $taiKhoan = new TaiKhoanDTO($tenDangNhap, $ho, $ten, $matKhau, $anhDaiDien, $loai, $thoiGianTao, $thoiGianSua, $kichHoat, $soDienThoai, $maQuyen);
            return $taiKhoan;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // thêm một đối tượng 
    function addObj($obj)
    {
        if ($obj != null) {
            $tenDangNhap = $obj->getTenDangNhap();
            // Kiểm tra xem có bị trùng thuộc tính khóa không
            $check = "SELECT * FROM taikhoan WHERE tenDangNhap = '$tenDangNhap'";
            $resultCheck = $this->actionSQL->query($check);

            if ($resultCheck->num_rows < 1) {
                $ho = $obj->getHo();
                $ten = $obj->getTen();
                $matKhau = $obj->getMatKhau();
                $anhDaiDien = $obj->getAnhDaiDien();
                $loai = $obj->getLoai();
                $thoiGianTao = $obj->getThoiGianTao();
                $thoiGianSua = $obj->getThoiGianSua();
                $kichHoat = $obj->getKichHoat();
                $soDienThoai = $obj->getSoDienThoai();
                $maQuyen = $obj->getMaQuyen();

                // Câu lệnh truy vấn
                $string = "INSERT INTO taikhoan (tenDangNhap, ho, ten, matKhau, anhDaiDien, loai, thoiGianTao, thoiGianSua, kichHoat, soDienThoai, maQuyen) 
                           VALUES ('$tenDangNhap', '$ho', '$ten', '$matKhau', '$anhDaiDien', '$loai', '$thoiGianTao', '$thoiGianSua', $kichHoat, '$soDienThoai', '$maQuyen')";

                return $this->actionSQL->query($string);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // sửa một đối tượng
    function updateObj($obj)
    {
        if ($obj != null) {
            $tenDangNhap = $obj->getTenDangNhap();
            $ho = $obj->getHo();
            $ten = $obj->getTen();
            $matKhau = $obj->getMatKhau();
            $anhDaiDien = $obj->getAnhDaiDien();
            $loai = $obj->getLoai();
            $thoiGianTao = $obj->getThoiGianTao();
            $thoiGianSua = $obj->getThoiGianSua();
            $kichHoat = $obj->getKichHoat();
            $soDienThoai = $obj->getSoDienThoai();
            $maQuyen = $obj->getMaQuyen();

            // Câu lệnh UPDATE
            $string = "UPDATE taikhoan 
                       SET ho = '$ho', 
                           ten = '$ten', 
                           matKhau = '$matKhau', 
                           anhDaiDien = '$anhDaiDien', 
                           loai = '$loai', 
                           thoiGianTao = '$thoiGianTao',
                           thoiGianSua = '$thoiGianSua',
                           kichHoat = $kichHoat, 
                           soDienThoai = '$soDienThoai', 
                           maQuyen = '$maQuyen' 
                       WHERE tenDangNhap = '$tenDangNhap'";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }

    function updateStateUser($tenDangNhap, $kichHoat)
    {
        // $tenDangNhap_encode = base64_encode($tenDangNhap);
        // Câu lệnh UPDATE
        if ($kichHoat == '1') {
            $string = "UPDATE taikhoan 
                                SET 
                                kichHoat = '0'
                                WHERE tenDangNhap = '$tenDangNhap'";
        } else {
            $string = "UPDATE taikhoan 
                                SET 
                                kichHoat = '1'
                                WHERE tenDangNhap = '$tenDangNhap'";
        }

        return $this->actionSQL->query($string);
    }
}


// check

// $check = new TaiKhoanDAL();
// $data = $check->getListobj();

// print_r($data);
// foreach ($data as $obj) {
//     echo $obj . "<br>";
// }

// $dataobj = $check->getobj('PhucApuTruong');
// echo $dataobj;

// $account = new AccountDTO(
//        'username123',
//        'password111',
//        '2024-03-08',
//        'active',
//        'John Doe',
//        '123 Main St',
//        'john@example.com',
//        '0823072871',
//        '1990-01-01',
//        'Male',
//        'admin'
// );
// echo $check->addobj($account);
// echo $check->updateobj($account);

// echo $check->deleteByID('JohnDoe');

// echo $check->delete($account);




// Tạo đối tượng để test
// $testObj = new TaiKhoanDTO(
//     'user123',         // tenDangNhap
//     'Nguyen',          // ho
//     'Van A',           // ten
//     'newpassword',     // matKhau
//     'avatar.jpg',      // anhDaiDien
//     'standard',        // loai
//     '2024-01-01',      // thoiGianTao
//     '2024-08-01',      // thoiGianSua
//     1,                 // kichHoat (1 = active, 0 = inactive)
//     '0123456789',      // soDienThoai
//     'quantri'            // maQuyen
// );

// // Giả sử lớp chứa hàm updateObj là TaiKhoanDAL và đã được khởi tạo
// $taiKhoanDAL = new TaiKhoanDAL();

// // Gọi hàm updateObj để test
// $result = $taiKhoanDAL->addObj($testObj);

// // Kiểm tra kết quả
// if ($result) {
//     echo "Cập nhật thành công!";
// } else {
//     echo "Cập nhật thất bại.";
// }