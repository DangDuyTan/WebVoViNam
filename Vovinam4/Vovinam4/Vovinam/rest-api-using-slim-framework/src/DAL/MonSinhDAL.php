<?php

// // import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/MonSinhDTO.php');

class MonSinhDAL extends AbstractionDAL
{

    private $actionSQL = null;
    public function __construct()
    {
        parent::__construct();
        $this->actionSQL = parent::getConn();

        // if ($this->actionSQL != null) {
        //        echo 'thanh cong';
        // }
    }

    // xóa một đối tượng bởi mã đối tượng 
    function deleteByID($maMonSinh)
    {
        // do bảng ketquathi và ctphieudiem có tham chiếu khóa ngoại đến thuộc tính khóa maMonSinh của bảng monsinh
        // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa
        $check_data_KetQuaThi_1 = "SELECT * FROM ketquathi WHERE maMonSinh = '$maMonSinh'";
        $check_data_KetQuaThi_2 = "SELECT * FROM ctphieudiem WHERE maMonSinh = '$maMonSinh'";

        $result_1 = $this->actionSQL->query($check_data_KetQuaThi_1);
        $result_2 = $this->actionSQL->query($check_data_KetQuaThi_2);

        if ($result_1->num_rows < 1 && $result_2->num_rows < 1) {
            $string = "DELETE FROM monsinh WHERE maMonSinh = '$maMonSinh'";
            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }

    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
        if ($obj != null) {
            $maMonSinh = $obj->getMaMonSinh();
            // do bảng ketquathi và ctphieudiem có tham chiếu khóa ngoại đến thuộc tính khóa maMonSinh của bảng monsinh
            // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa

            $check_data_Orders = "SELECT * FROM ketquathi WHERE maMonSinh = '$maMonSinh' OR SELECT * FROM ctphieudiem WHERE maMonSinh = '$maMonSinh'";

            $result_1 = $this->actionSQL->query($check_data_Orders);

            if ($result_1->num_rows < 1) {
                $string = "DELETE FROM monsinh WHERE maMonSinh = '$maMonSinh'";

                return $this->actionSQL->query($string);
            } else {
                return false;
            }
        }
    }

    // lấy ra mảng các đối tượng
    // function getListObj()
    // {
    //     // Mảng để lưu trữ các đối tượng
    //     $array_list = array();

    //     // Câu lệnh truy vấn
    //     $string = 'SELECT * FROM monsinh';

    //     // Thực hiện truy vấn
    //     $result = $this->actionSQL->query($string);

    //     // Kiểm tra số hàng được trả về
    //     if ($result->num_rows > 0) {
    //         // Lặp qua các dòng kết quả và thêm vào mảng
    //         while ($data = $result->fetch_assoc()) {
    //             $maMonSinh = $data['maMonSinh'];
    //             $maThe = $data["maThe"];
    //             $hoTen = $data["hoTen"];
    //             $gioiTinh = $data["gioiTinh"];
    //             $ngaySinh = $data["ngaySinh"];
    //             $chieuCao = $data["chieuCao"];
    //             $canNang = $data["canNang"];
    //             $diaChi = $data["diaChi"];
    //             $soDienThoai = $data["soDienThoai"];
    //             $email = $data["email"];
    //             $cccd = $data["cccd"];
    //             $anhCCCD = $data["anhCCCD"];
    //             $anh3x4 = $data["anh3x4"];
    //             $ngayCapCCCD = $data["ngayCapCCCD"];
    //             $noiCapCCCD = $data["noiCapCCCD"];
    //             $tenPhuHuynh = $data["tenPhuHuynh"];
    //             $sdtPhuHuynh = $data["sdtPhuHuynh"];
    //             $congViec = $data["congViec"];
    //             $lichSuTapLuyen = $data["lichSuTapLuyen"];
    //             $lichSuThi = $data["lichSuThi"];
    //             $bangCap = $data["bangCap"];
    //             $trinhDoVanHoa = $data["trinhDoVanHoa"];
    //             $khaNangNoiBat = $data["khaNangNoiBat"];
    //             $maCapDai = $data["maCapDai"];

    //             // Tạo đối tượng MonSinhDTO và thêm vào mảng
    //             $monSinh = new MonSinhDTO($maMonSinh, $maThe, $hoTen, $gioiTinh, $ngaySinh, $chieuCao, $canNang, $diaChi, $soDienThoai, $email, $cccd, $anhCCCD, $anh3x4, $ngayCapCCCD, $noiCapCCCD, $tenPhuHuynh, $sdtPhuHuynh, $congViec, $lichSuTapLuyen, $lichSuThi, $bangCap, $trinhDoVanHoa, $khaNangNoiBat, $maCapDai);
    //             array_push($array_list, $monSinh);
    //         }
    //         return $array_list;
    //     } else {
    //         // Trường hợp không có dữ liệu trả về
    //         return null;
    //     }
    // }

    // Lấy ra mảng các đối tượng MonSinhDTO với thông tin cấp đai
    function getListObj()
    {
        // Mảng để lưu trữ các đối tượng
        $array_list = array();

        // Câu lệnh truy vấn với phép nối giữa bảng monsinh và capdai
        $string = 'SELECT monsinh.*, capdai.tenCapDai FROM monsinh 
                   JOIN capdai ON monsinh.maCapDai = capdai.maCapDai';

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            // Lặp qua các dòng kết quả và thêm vào mảng
            while ($data = $result->fetch_assoc()) {
                $maMonSinh = $data['maMonSinh'];
                $maThe = $data["maThe"];
                $hoTen = $data["hoTen"];
                $gioiTinh = $data["gioiTinh"];
                $ngaySinh = $data["ngaySinh"];
                $chieuCao = $data["chieuCao"];
                $canNang = $data["canNang"];
                $diaChi = $data["diaChi"];
                $soDienThoai = $data["soDienThoai"];
                $email = $data["email"];
                $cccd = $data["cccd"];
                $anhCCCD = $data["anhCCCD"];
                $anh3x4 = $data["anh3x4"];
                $ngayCapCCCD = $data["ngayCapCCCD"];
                $noiCapCCCD = $data["noiCapCCCD"];
                $tenPhuHuynh = $data["tenPhuHuynh"];
                $sdtPhuHuynh = $data["sdtPhuHuynh"];
                $congViec = $data["congViec"];
                $lichSuTapLuyen = $data["lichSuTapLuyen"];
                $lichSuThi = $data["lichSuThi"];
                $bangCap = $data["bangCap"];
                $trinhDoVanHoa = $data["trinhDoVanHoa"];
                $khaNangNoiBat = $data["khaNangNoiBat"];
                $trangThai = $data["trangThai"];
                $maCapDai = $data["maCapDai"];
                $tenCapDai = $data["tenCapDai"];
                $maCauLacBo = $data["maCauLacBo"];

                // Tạo đối tượng MonSinhDTO và thêm vào mảng
                $monSinh = new MonSinhDTO($maMonSinh, $maThe, $hoTen, $gioiTinh, $ngaySinh, $chieuCao, $canNang, $diaChi, $soDienThoai, $email, $cccd, $anhCCCD, $anh3x4, $ngayCapCCCD, $noiCapCCCD, $tenPhuHuynh, $sdtPhuHuynh, $congViec, $lichSuTapLuyen, $lichSuThi, $bangCap, $trinhDoVanHoa, $khaNangNoiBat, $trangThai, $maCapDai, $tenCapDai, $maCauLacBo);
                array_push($array_list, $monSinh);
            }
            return $array_list;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // lấy ra một đối tượng dựa theo mã đối tượng
    function getObj($maMonSinh)
    {
        // Câu lệnh truy vấn
        $string = "SELECT * FROM monsinh WHERE maMonSinh = '$maMonSinh'";

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $maMonSinh = $data['maMonSinh'];
            $maThe = $data["maThe"];
            $hoTen = $data["hoTen"];
            $gioiTinh = $data["gioiTinh"];
            $ngaySinh = $data["ngaySinh"];
            $chieuCao = $data["chieuCao"];
            $canNang = $data["canNang"];
            $diaChi = $data["diaChi"];
            $soDienThoai = $data["soDienThoai"];
            $email = $data["email"];
            $cccd = $data["cccd"];
            $anhCCCD = $data["anhCCCD"];
            $anh3x4 = $data["anh3x4"];
            $ngayCapCCCD = $data["ngayCapCCCD"];
            $noiCapCCCD = $data["noiCapCCCD"];
            $tenPhuHuynh = $data["tenPhuHuynh"];
            $sdtPhuHuynh = $data["sdtPhuHuynh"];
            $congViec = $data["congViec"];
            $lichSuTapLuyen = $data["lichSuTapLuyen"];
            $lichSuThi = $data["lichSuThi"];
            $bangCap = $data["bangCap"];
            $trinhDoVanHoa = $data["trinhDoVanHoa"];
            $trangThai = $data["trangThai"];
            $khaNangNoiBat = $data["khaNangNoiBat"];
            $maCapDai = $data["maCapDai"];
            $tenCapDai = $data["tenCapDai"];
            $maCauLacBo = $data["maCauLacBo"];
            // Tạo đối tượng MonSinhDTO và trả về
            $monSinh = new MonSinhDTO($maMonSinh, $maThe, $hoTen, $gioiTinh, $ngaySinh, $chieuCao, $canNang, $diaChi, $soDienThoai, $email, $cccd, $anhCCCD, $anh3x4, $ngayCapCCCD, $noiCapCCCD, $tenPhuHuynh, $sdtPhuHuynh, $congViec, $lichSuTapLuyen, $lichSuThi, $bangCap, $trinhDoVanHoa, $khaNangNoiBat, $trangThai, $maCapDai, $tenCapDai, $maCauLacBo);
            return $monSinh;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }
    // thêm một đối tượng 
    function addObj($obj)
    {
        if ($obj != null) {
            $maMonSinh = $obj->getMaMonSinh();
            // Kiểm tra xem có bị trùng thuộc tính khóa không
            $check = "SELECT * FROM monsinh WHERE maMonSinh = '$maMonSinh'";
            $resultCheck = $this->actionSQL->query($check);

            if ($resultCheck->num_rows < 1) {
                // Lấy mã Câu Lạc Bộ từ đối tượng
                $maCauLacBo = $obj->getMaCauLacBo();

                // Kiểm tra xem maCauLacBo có tồn tại trong bảng caulacbo không
                $checkCLB = "SELECT * FROM caulacbo WHERE maCauLacBo = '$maCauLacBo'";
                $resultCheckCLB = $this->actionSQL->query($checkCLB);

                if ($resultCheckCLB->num_rows < 1) {
                    // Nếu không tìm thấy maCauLacBo trong bảng caulacbo, trả về false
                    return false;
                }

                // Lấy dữ liệu từ đối tượng
                $maThe = $obj->getMaThe();
                $hoTen = $obj->getHoTen();
                $gioiTinh = $obj->getGioiTinh();
                $ngaySinh = $obj->getNgaySinh();
                $chieuCao = $obj->getChieuCao();
                $canNang = $obj->getCanNang();
                $diaChi = $obj->getDiaChi();
                $soDienThoai = $obj->getSoDienThoai();
                $email = $obj->getEmail();
                $cccd = $obj->getCccd();
                $anhCCCD = $obj->getAnhCCCD();
                $anh3x4 = $obj->getAnh3x4();
                $ngayCapCCCD = $obj->getNgayCapCCCD();
                $noiCapCCCD = $obj->getNoiCapCCCD();
                $tenPhuHuynh = $obj->getTenPhuHuynh();
                $sdtPhuHuynh = $obj->getSdtPhuHuynh();
                $congViec = $obj->getCongViec();
                $lichSuTapLuyen = $obj->getLichSuTapLuyen();
                $lichSuThi = $obj->getLichSuThi();
                $bangCap = $obj->getBangCap();
                $trinhDoVanHoa = $obj->getTrinhDoVanHoa();
                $khaNangNoiBat = $obj->getKhaNangNoiBat();
                $trangThai = $obj->getTrangThai();
                $maCapDai = $obj->getMaCapDai();
                // Câu lệnh truy vấn INSERT
                $string = "INSERT INTO monsinh (
                maMonSinh, maThe, hoTen, gioiTinh, ngaySinh, chieuCao, canNang, diaChi, soDienThoai, email, cccd, 
                anhCCCD, anh3x4, ngayCapCCCD, noiCapCCCD, tenPhuHuynh, sdtPhuHuynh, congViec, lichSuTapLuyen, 
                lichSuThi, bangCap, trinhDoVanHoa, khaNangNoiBat, trangThai, maCapDai, maCauLacBo
            ) VALUES (
                '$maMonSinh', '$maThe', '$hoTen', '$gioiTinh', '$ngaySinh', '$chieuCao', '$canNang', '$diaChi', '$soDienThoai', '$email', '$cccd', 
                '$anhCCCD', '$anh3x4', '$ngayCapCCCD', '$noiCapCCCD', '$tenPhuHuynh', '$sdtPhuHuynh', '$congViec', '$lichSuTapLuyen', 
                '$lichSuThi', '$bangCap', '$trinhDoVanHoa', '$khaNangNoiBat', '$trangThai', '$maCapDai', '$maCauLacBo'
            )";

                // Thực hiện câu lệnh INSERT
                return $this->actionSQL->query($string);
            } else {
                // Đối tượng đã tồn tại
                return false;
            }
        } else {
            // Đối tượng không hợp lệ
            return false;
        }
    }


    // sửa một đối tượng
    function updateObj($obj)
    {
        if ($obj != null) {
            $maMonSinh = $obj->getMaMonSinh();
            $maThe = $obj->getMaThe();
            $hoTen = $obj->getHoTen();
            $gioiTinh = $obj->getGioiTinh();
            $ngaySinh = $obj->getNgaySinh();
            $chieuCao = $obj->getChieuCao();
            $canNang = $obj->getCanNang();
            $diaChi = $obj->getDiaChi();
            $soDienThoai = $obj->getSoDienThoai();
            $email = $obj->getEmail();
            $cccd = $obj->getCccd();
            $anhCCCD = $obj->getAnhCCCD();
            $anh3x4 = $obj->getAnh3x4();
            $ngayCapCCCD = $obj->getNgayCapCCCD();
            $noiCapCCCD = $obj->getNoiCapCCCD();
            $tenPhuHuynh = $obj->getTenPhuHuynh();
            $sdtPhuHuynh = $obj->getSdtPhuHuynh();
            $congViec = $obj->getCongViec();
            $lichSuTapLuyen = $obj->getLichSuTapLuyen();
            $lichSuThi = $obj->getLichSuThi();
            $bangCap = $obj->getBangCap();
            $trinhDoVanHoa = $obj->getTrinhDoVanHoa();
            $khaNangNoiBat = $obj->getKhaNangNoiBat();
            $trangThai = $obj->getTrangThai();
            $maCapDai = $obj->getMaCapDai();
            $maCauLacBo = $obj->getMaCauLacBo();

            // Chuyển đổi ngày tháng sang định dạng phù hợp với SQL
            // $ngaySinh = date('Y-m-d', strtotime($ngaySinh));
            // $ngayCapCCCD = date('Y-m-d', strtotime($ngayCapCCCD));

            // Câu lệnh UPDATE
            $string = "UPDATE monsinh 
                   SET maThe = '$maThe', 
                       hoTen = '$hoTen', 
                       gioiTinh = $gioiTinh, 
                       ngaySinh = '$ngaySinh', 
                       chieuCao = $chieuCao, 
                       canNang = $canNang, 
                       diaChi = '$diaChi', 
                       soDienThoai = '$soDienThoai', 
                       email = '$email', 
                       cccd = '$cccd', 
                       anhCCCD = '$anhCCCD', 
                       anh3x4 = '$anh3x4', 
                       ngayCapCCCD = '$ngayCapCCCD', 
                       noiCapCCCD = '$noiCapCCCD', 
                       tenPhuHuynh = '$tenPhuHuynh', 
                       sdtPhuHuynh = '$sdtPhuHuynh', 
                       congViec = '$congViec', 
                       lichSuTapLuyen = '$lichSuTapLuyen', 
                       lichSuThi = '$lichSuThi', 
                       bangCap = '$bangCap', 
                       trinhDoVanHoa = '$trinhDoVanHoa', 
                       khaNangNoiBat = '$khaNangNoiBat', 
                       trangThai = $trangThai, 
                       maCapDai = $maCapDai,
                       maCauLacBo = $maCauLacBo                 
                   WHERE maMonSinh = $maMonSinh";

            // Thực hiện câu lệnh
            return $this->actionSQL->query($string);
        } else {
            // Đối tượng không hợp lệ
            return false;
        }
    }

    function updateMonSinh($maMonSinh, $trangThai)
    {
        // $tenDangNhap_encode = base64_encode($tenDangNhap);
        // Câu lệnh UPDATE
        if ($trangThai == '1') {
            $string = "UPDATE monsinh 
                                SET 
                                trangThai = '0'
                                WHERE maMonSinh = '$maMonSinh'";
        } else {
            $string = "UPDATE monsinh 
                                SET 
                                trangThai = '1'
                                WHERE maMonSinh = '$maMonSinh'";
        }

        return $this->actionSQL->query($string);
    }

    function getListMonSinhChuaDangKy()
    {
        // Mảng để lưu trữ các đối tượng
        $array_list = array();

        // Câu lệnh truy vấn với phép nối giữa bảng monsinh và capdai, và điều kiện trạng thái bằng 0
        $string = 'SELECT *
               FROM monsinh 
               JOIN capdai ON monsinh.maCapDai = capdai.maCapDai 
               WHERE monsinh.trangThai = 0';

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            // Lặp qua các dòng kết quả và thêm vào mảng
            while ($data = $result->fetch_assoc()) {
                $maMonSinh = $data['maMonSinh'];
                $maThe = $data["maThe"];
                $hoTen = $data["hoTen"];
                $gioiTinh = $data["gioiTinh"];
                $ngaySinh = $data["ngaySinh"];
                $chieuCao = $data["chieuCao"];
                $canNang = $data["canNang"];
                $diaChi = $data["diaChi"];
                $soDienThoai = $data["soDienThoai"];
                $email = $data["email"];
                $cccd = $data["cccd"];
                $anhCCCD = $data["anhCCCD"];
                $anh3x4 = $data["anh3x4"];
                $ngayCapCCCD = $data["ngayCapCCCD"];
                $noiCapCCCD = $data["noiCapCCCD"];
                $tenPhuHuynh = $data["tenPhuHuynh"];
                $sdtPhuHuynh = $data["sdtPhuHuynh"];
                $congViec = $data["congViec"];
                $lichSuTapLuyen = $data["lichSuTapLuyen"];
                $lichSuThi = $data["lichSuThi"];
                $bangCap = $data["bangCap"];
                $trinhDoVanHoa = $data["trinhDoVanHoa"];
                $khaNangNoiBat = $data["khaNangNoiBat"];
                $trangThai = $data["trangThai"];
                $maCapDai = $data["maCapDai"];
                $tenCapDai = $data["tenCapDai"];
                $maCauLacBo = $data["maCauLacBo"];
                // Tạo đối tượng MonSinhDTO và thêm vào mảng
                $monSinh = new MonSinhDTO($maMonSinh, $maThe, $hoTen, $gioiTinh, $ngaySinh, $chieuCao, $canNang, $diaChi, $soDienThoai, $email, $cccd, $anhCCCD, $anh3x4, $ngayCapCCCD, $noiCapCCCD, $tenPhuHuynh, $sdtPhuHuynh, $congViec, $lichSuTapLuyen, $lichSuThi, $bangCap, $trinhDoVanHoa, $khaNangNoiBat, $trangThai, $maCapDai, $tenCapDai, $maCauLacBo);
                array_push($array_list, $monSinh);
            }
            return $array_list;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }
}


//check
// $check = new MonSinhDAL();
// // $data = $check->getListMonSinhChuaDangKy();
// // print_r($data);
// // foreach ($data as $obj) {
// //     echo $obj . "<br>";
// // }

// $check->deleteByID(10);
// if ($check) echo 'thanh cong';
// else
//     echo "thất bại";




// Tạo một đối tượng MonSinhDTO mới
// $monSinhMoi = new MonSinhDTO(
//     20, // maMonSinh
//     20, // maThe
//     'Nguyen Van A', // hoTen
//     1, // gioiTinh
//     '1990-01-01', // ngaySinh
//     170, // chieuCao
//     65, // canNang
//     '123 Nguyen Trai, Ha Noi', // diaChi
//     '0909123456', // soDienThoai
//     'email@gmail.com', // email
//     '123456789', // cccd
//     'path/to/cccd/image', // anhCCCD
//     'path/to/3x4/image', // anh3x4
//     '2010-01-01', // ngayCapCCCD
//     'Ha Noi', // noiCapCCCD
//     'Nguyen Van B', // tenPhuHuynh
//     '0909876543', // sdtPhuHuynh
//     'Giang vien', // congViec
//     'Lich su tap luyen', // lichSuTapLuyen
//     'Lich su thi', // lichSuThi
//     'Bang cap', // bangCap
//     'Dai hoc', // trinhDoVanHoa
//     'Kha nang noi bat', // khaNangNoiBat
//     0, // trangThai
//     3, // maCapDai
//     null,
//     2
// );

// // // // Thêm đối tượng mới vào database
// $monSinhDAL = new MonSinhDAL();
// $add = $monSinhDAL->addObj($monSinhMoi);
// if ($add) {
//     echo "Thêm thành công!";
// } else {
//     echo "Thêm thất bại!";
// }
// // Cập nhật thông tin của đối tượng MonSinhDTO
// $monSinhMoi->setHoTen('Nguyen Van B');
// $monSinhMoi->setChieuCao(180);
// $monSinhMoi->setCanNang(70);
// $monSinhMoi->setDiaChi('456 Tran Phu, Ha Noi');
// $monSinhMoi->setTrangThai(1);

// // Gọi hàm updateObj để cập nhật đối tượng trong database
// $updateResult = $monSinhDAL->updateObj($monSinhMoi);

// if ($updateResult) {
//     echo "Cập nhật thành công!";
// } else {
//     echo "Cập nhật thất bại!";
// }