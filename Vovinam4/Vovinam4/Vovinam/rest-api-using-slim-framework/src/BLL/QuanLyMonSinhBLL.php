<?php

require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');
require('../DTO/MonSinhDTO.php');
require('../DAL/MonSinhDAL.php');
// require('../DTO/AccountDTO.php');
// require('../DAL/AccountDAL.php');

class QuanLyMonSinhBLL
{
    private $QuanLyMonSinhDAL;
    function __construct()
    {
        $this->QuanLyMonSinhDAL = new MonSinhDAL();
    }
    // Xóa một đối tượng khi lấy được id của đối tượng
    function deleteByID($maMonSinh)
    {

        //lấy thông tin 
        $result = $this->QuanLyMonSinhDAL->deleteByID($maMonSinh);

        if ($result) {
            return array("mess" => "success");
        } else {
            return array("mess" => "Failed");
        }
    }

    //Lấy danh sách 
    function getList()
    {
        //mảng dữ liệu lấy được từ DAL

        $arr = $this->QuanLyMonSinhDAL->getListObj();
        // return array("mess" => "check");
        //mảng chứa các obj lấy được từ DAL ở trên
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $maMonSinh = $item->getMaMonSinh();
                $maThe = $item->getMaThe();
                $hoTen = $item->getHoTen();
                $gioiTinh = $item->getGioiTinh();
                $ngaySinh = $item->getNgaySinh();
                $chieuCao = $item->getChieuCao();
                $canNang = $item->getCanNang();
                $diaChi = $item->getDiaChi();
                $soDienThoai = $item->getSoDienThoai();
                $email = $item->getEmail();
                $cccd = $item->getCccd();
                $anhCCCD = $item->getAnhCCCD();
                $anh3x4 = $item->getAnh3x4();
                $ngayCapCCCD = $item->getNgayCapCCCD();
                $noiCapCCCD = $item->getNoiCapCCCD();
                $tenPhuHuynh = $item->getTenPhuHuynh();
                $sdtPhuHuynh = $item->getSdtPhuHuynh();
                $congViec = $item->getCongViec();
                $lichSuTapLuyen = $item->getLichSuTapLuyen();
                $lichSuThi = $item->getLichSuThi();
                $bangCap = $item->getBangCap();
                $trinhDoVanHoa = $item->getTrinhDoVanHoa();
                $khaNangNoiBat = $item->getKhaNangNoiBat();
                $trangThai = $item->getTrangThai();
                $maCapDai = $item->getMaCapDai();
                $tenCapDai = $item->getTenCapDai();
                $maCauLacBo = $item->getMaCauLacBo();
                $obj = array(
                    "maMonSinh" => $maMonSinh,
                    "maThe" => $maThe,
                    "hoTen" => $hoTen,
                    "gioiTinh" => $gioiTinh,
                    "ngaySinh" => $ngaySinh,
                    "chieuCao" => $chieuCao,
                    "canNang" => $canNang,
                    "diaChi" => $diaChi,
                    "soDienThoai" => $soDienThoai,
                    "email" => $email,
                    "cccd" => $cccd,
                    "anhCCCD" => $anhCCCD,
                    "anh3x4" => $anh3x4,
                    "ngayCapCCCD" => $ngayCapCCCD,
                    "noiCapCCCD" => $noiCapCCCD,
                    "tenPhuHuynh" => $tenPhuHuynh,
                    "sdtPhuHuynh" => $sdtPhuHuynh,
                    "congViec" => $congViec,
                    "lichSuTapLuyen" => $lichSuTapLuyen,
                    "lichSuThi" => $lichSuThi,
                    "bangCap" => $bangCap,
                    "trinhDoVanHoa" => $trinhDoVanHoa,
                    "khaNangNoiBat" => $khaNangNoiBat,
                    "trangThai" => $trangThai,
                    "maCapDai" => $maCapDai,
                    "tenCapDai" => $tenCapDai,
                    "maCauLacBo" => $maCauLacBo,
                    "mess" => "success"
                );
                array_push($result, $obj);
            }

            return $result;
            // return array("mess" => "success");
        } else {
            return array("mess" => "Failed");
        }
    }

    //Lấy một đối tượng bằng khóa chính của đối tượng đó
    function getObj($maMonSinh)
    {
        //Lấy kết quả từ DAL
        $result = $this->QuanLyMonSinhDAL->getobj($maMonSinh);
        if ($result != null) {

            $maMonSinh = $result->getMaMonSinh();
            $maThe = $result->getMaThe();
            $hoTen = $result->getHoTen();
            $gioiTinh = $result->getGioiTinh();
            $ngaySinh = $result->getNgaySinh();
            $chieuCao = $result->getChieuCao();
            $canNang = $result->getCanNang();
            $diaChi = $result->getDiaChi();
            $soDienThoai = $result->getSoDienThoai();
            $email = $result->getEmail();
            $cccd = $result->getCccd();
            $anhCCCD = $result->getAnhCCCD();
            $anh3x4 = $result->getAnh3x4();
            $ngayCapCCCD = $result->getNgayCapCCCD();
            $noiCapCCCD = $result->getNoiCapCCCD();
            $tenPhuHuynh = $result->getTenPhuHuynh();
            $sdtPhuHuynh = $result->getSdtPhuHuynh();
            $congViec = $result->getCongViec();
            $lichSuTapLuyen = $result->getLichSuTapLuyen();
            $lichSuThi = $result->getLichSuThi();
            $bangCap = $result->getBangCap();
            $trinhDoVanHoa = $result->getTrinhDoVanHoa();
            $khaNangNoiBat = $result->getKhaNangNoiBat();
            $maCapDai = $result->getMaCapDai();
            $tenCapDai = $result->getTenCapDai();
            $maCauLacBo = $result->getMaCauLacBo();

            $obj = array(
                "maMonSinh" => $maMonSinh,
                "maThe" => $maThe,
                "hoTen" => $hoTen,
                "gioiTinh" => $gioiTinh,
                "ngaySinh" => $ngaySinh,
                "chieuCao" => $chieuCao,
                "canNang" => $canNang,
                "diaChi" => $diaChi,
                "soDienThoai" => $soDienThoai,
                "email" => $email,
                "cccd" => $cccd,
                "anhCCCD" => $anhCCCD,
                "anh3x4" => $anh3x4,
                "ngayCapCCCD" => $ngayCapCCCD,
                "noiCapCCCD" => $noiCapCCCD,
                "tenPhuHuynh" => $tenPhuHuynh,
                "sdtPhuHuynh" => $sdtPhuHuynh,
                "congViec" => $congViec,
                "lichSuTapLuyen" => $lichSuTapLuyen,
                "lichSuThi" => $lichSuThi,
                "bangCap" => $bangCap,
                "trinhDoVanHoa" => $trinhDoVanHoa,
                "khaNangNoiBat" => $khaNangNoiBat,
                "maCapDai" => $maCapDai,
                "tenCapDai" => $tenCapDai,
                "maCauLacBo" => $maCauLacBo,
                "mess" => "success"
            );
            return $obj;
        } else {
            return array("mess" => "Failed");
        }
    }

    //Thêm vào đối tượng obj 
    function addObj($obj)

    {
        if ($obj != null) {

            //Lấy thông tin từ đối tượng 
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

            //Thực hiện thêm đối tượng vào Database
            $result = $this->QuanLyMonSinhDAL->addObj($obj);

            if ($result != null) {
                return  array(
                    "maMonSinh" => $maMonSinh,
                    "maThe" => $maThe,
                    "hoTen" => $hoTen,
                    "gioiTinh" => $gioiTinh,
                    "ngaySinh" => $ngaySinh,
                    "chieuCao" => $chieuCao,
                    "canNang" => $canNang,
                    "diaChi" => $diaChi,
                    "soDienThoai" => $soDienThoai,
                    "email" => $email,
                    "cccd" => $cccd,
                    "anhCCCD" => $anhCCCD,
                    "anh3x4" => $anh3x4,
                    "ngayCapCCCD" => $ngayCapCCCD,
                    "noiCapCCCD" => $noiCapCCCD,
                    "tenPhuHuynh" => $tenPhuHuynh,
                    "sdtPhuHuynh" => $sdtPhuHuynh,
                    "congViec" => $congViec,
                    "lichSuTapLuyen" => $lichSuTapLuyen,
                    "lichSuThi" => $lichSuThi,
                    "bangCap" => $bangCap,
                    "trinhDoVanHoa" => $trinhDoVanHoa,
                    "khaNangNoiBat" => $khaNangNoiBat,
                    "trangThai" => $trangThai,
                    "maCapDai" => $maCapDai,
                    "maCauLacBo" => $maCauLacBo,
                    "mess" => "success"
                );
            } else {
                return array("mess" => "failed");
            }
        } else {
            return array("mess" => "failed");
        }
    }


    //Cập nhật đối tượng 
    function updateObj($obj)
    {
        // return array("mess" => "check");
        $result = $this->QuanLyMonSinhDAL->updateObj($obj);
        if ($result) {
            // Lấy thông tin từ đối tượng cập nhật
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

            // Trả về mảng chứa thông báo thành công và thông tin cập nhật
            return array(
                "maMonSinh" => $maMonSinh,
                "maThe" => $maThe,
                "hoTen" => $hoTen,
                "gioiTinh" => $gioiTinh,
                "ngaySinh" => $ngaySinh,
                "chieuCao" => $chieuCao,
                "canNang" => $canNang,
                "diaChi" => $diaChi,
                "soDienThoai" => $soDienThoai,
                "email" => $email,
                "cccd" => $cccd,
                "anhCCCD" => $anhCCCD,
                "anh3x4" => $anh3x4,
                "ngayCapCCCD" => $ngayCapCCCD,
                "noiCapCCCD" => $noiCapCCCD,
                "tenPhuHuynh" => $tenPhuHuynh,
                "sdtPhuHuynh" => $sdtPhuHuynh,
                "congViec" => $congViec,
                "lichSuTapLuyen" => $lichSuTapLuyen,
                "lichSuThi" => $lichSuThi,
                "bangCap" => $bangCap,
                "trinhDoVanHoa" => $trinhDoVanHoa,
                "khaNangNoiBat" => $khaNangNoiBat,
                "trangThai" => $trangThai,
                "maCapDai" => $maCapDai,
                "maCauLacBo" => $maCauLacBo,
                "mess" => "success"
            );
        } else {
            return array("mess" => "Failed");
        }
    }


    // Tìm kiếm
    function searchMonSinh($str)
    {
        $arr = $this->QuanLyMonSinhDAL->getListobj();
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $maMonSinh = $item->getMaMonSinh();
                $maThe = $item->getMaThe();
                $hoTen = $item->getHoTen();
                $gioiTinh = $item->getGioiTinh();
                $ngaySinh = $item->getNgaySinh();
                $chieuCao = $item->getChieuCao();
                $canNang = $item->getCanNang();
                $diaChi = $item->getDiaChi();
                $soDienThoai = $item->getSoDienThoai();
                $email = $item->getEmail();
                $cccd = $item->getCccd();
                $anhCCCD = $item->getAnhCCCD();
                $anh3x4 = $item->getAnh3x4();
                $ngayCapCCCD = $item->getNgayCapCCCD();
                $noiCapCCCD = $item->getNoiCapCCCD();
                $tenPhuHuynh = $item->getTenPhuHuynh();
                $sdtPhuHuynh = $item->getSdtPhuHuynh();
                $congViec = $item->getCongViec();
                $lichSuTapLuyen = $item->getLichSuTapLuyen();
                $lichSuThi = $item->getLichSuThi();
                $bangCap = $item->getBangCap();
                $trinhDoVanHoa = $item->getTrinhDoVanHoa();
                $khaNangNoiBat = $item->getKhaNangNoiBat();
                $trangThai = $item->getTrangThai();
                $maCapDai = $item->getMaCapDai();
                $tenCapDai = $item->getTenCapDai();
                // $maCauLacBo = $item->maCauLacBo();
                // Kiểm tra nếu chuỗi $str xuất hiện trong bất kỳ trường nào của đối tượng
                if (
                    strpos(strtolower($maMonSinh), $str) !== false || strpos(strtolower($hoTen), $str) !== false  ||
                    strpos(strtolower($ngaySinh), $str) !== false || strpos(strtolower($soDienThoai), $str) !== false || strpos(strtolower($tenCapDai), $str) !== false || strpos(strtolower($diaChi), $str) !== false
                ) {
                    $obj = array(
                        "maMonSinh" => $maMonSinh,
                        "maThe" => $maThe,
                        "hoTen" => $hoTen,
                        "gioiTinh" => $gioiTinh,
                        "ngaySinh" => $ngaySinh,
                        "chieuCao" => $chieuCao,
                        "canNang" => $canNang,
                        "diaChi" => $diaChi,
                        "soDienThoai" => $soDienThoai,
                        "email" => $email,
                        "cccd" => $cccd,
                        "anhCCCD" => $anhCCCD,
                        "anh3x4" => $anh3x4,
                        "ngayCapCCCD" => $ngayCapCCCD,
                        "noiCapCCCD" => $noiCapCCCD,
                        "tenPhuHuynh" => $tenPhuHuynh,
                        "sdtPhuHuynh" => $sdtPhuHuynh,
                        "congViec" => $congViec,
                        "lichSuTapLuyen" => $lichSuTapLuyen,
                        "lichSuThi" => $lichSuThi,
                        "bangCap" => $bangCap,
                        "trinhDoVanHoa" => $trinhDoVanHoa,
                        "khaNangNoiBat" => $khaNangNoiBat,
                        "trangThai" => $trangThai,
                        "maCapDai" => $maCapDai,
                        "tenCapDai" => $tenCapDai,
                        // "maCauLacBo" => $maCauLacBo,
                        "mess" => "success"
                    );
                    array_push($result, $obj);
                }
            }
        }
        return $result;
    }
    function updateMonSinh($maMonSinh, $trangThai)
    {
        $result = $this->QuanLyMonSinhDAL->updateMonSinh($maMonSinh, $trangThai);
        if ($result) {
            return array("mess" => "success");
        } else {
            return array("mess" => "failed");
        }
    }

    // Lấy dữ liệu môn sinh chưa đăng ký thi
    function getListMonSinhChuaDangKy()
    {
        //mảng dữ liệu lấy được từ DAL

        $arr = $this->QuanLyMonSinhDAL->getListMonSinhChuaDangKy();
        // return array("mess" => "check");
        //mảng chứa các obj lấy được từ DAL ở trên
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $maMonSinh = $item->getMaMonSinh();
                $soDienThoai = $item->getSoDienThoai();
                $hoTen = $item->getHoTen();
                $ngaySinh = $item->getNgaySinh();
                $tenCapDai = $item->getTenCapDai();

                // $maMonSinh = $item->getMaMonSinh();
                // $maThe = $item->getMaThe();
                // $hoTen = $item->getHoTen();
                // $gioiTinh = $item->getGioiTinh();
                // $ngaySinh = $item->getNgaySinh();
                // $chieuCao = $item->getChieuCao();
                // $canNang = $item->getCanNang();
                // $diaChi = $item->getDiaChi();
                // $soDienThoai = $item->getSoDienThoai();
                // $email = $item->getEmail();
                // $cccd = $item->getCccd();
                // $anhCCCD = $item->getAnhCCCD();
                // $anh3x4 = $item->getAnh3x4();
                // $ngayCapCCCD = $item->getNgayCapCCCD();
                // $noiCapCCCD = $item->getNoiCapCCCD();
                // $tenPhuHuynh = $item->getTenPhuHuynh();
                // $sdtPhuHuynh = $item->getSdtPhuHuynh();
                // $congViec = $item->getCongViec();
                // $lichSuTapLuyen = $item->getLichSuTapLuyen();
                // $lichSuThi = $item->getLichSuThi();
                // $bangCap = $item->getBangCap();
                // $trinhDoVanHoa = $item->getTrinhDoVanHoa();
                // $khaNangNoiBat = $item->getKhaNangNoiBat();
                // $trangThai = $item->getTrangThai();
                // $maCapDai = $item->getMaCapDai();
                // $tenCapDai = $item->getTenCapDai();
                $obj = array(
                    "maMonSinh" => $maMonSinh,
                    "soDienThoai" => $soDienThoai,
                    "hoTen" => $hoTen,
                    "ngaySinh" => $ngaySinh,
                    "tenCapDai" => $tenCapDai,
                    "mess" => "success"

                    // "maMonSinh" => $maMonSinh,
                    // "maThe" => $maThe,
                    // "hoTen" => $hoTen,
                    // "gioiTinh" => $gioiTinh,
                    // "ngaySinh" => $ngaySinh,
                    // "chieuCao" => $chieuCao,
                    // "canNang" => $canNang,
                    // "diaChi" => $diaChi,
                    // "soDienThoai" => $soDienThoai,
                    // "email" => $email,
                    // "cccd" => $cccd,
                    // "anhCCCD" => $anhCCCD,
                    // "anh3x4" => $anh3x4,
                    // "ngayCapCCCD" => $ngayCapCCCD,
                    // "noiCapCCCD" => $noiCapCCCD,
                    // "tenPhuHuynh" => $tenPhuHuynh,
                    // "sdtPhuHuynh" => $sdtPhuHuynh,
                    // "congViec" => $congViec,
                    // "lichSuTapLuyen" => $lichSuTapLuyen,
                    // "lichSuThi" => $lichSuThi,
                    // "bangCap" => $bangCap,
                    // "trinhDoVanHoa" => $trinhDoVanHoa,
                    // "khaNangNoiBat" => $khaNangNoiBat,
                    // "trangThai" => $trangThai,
                    // "maCapDai" => $maCapDai,
                    // "tenCapDai" => $tenCapDai,
                    // "mess" => "success"
                );
                array_push($result, $obj);
            }

            return $result;
            // return array("mess" => "success");
        } else {
            return array("mess" => "Failed");
        }
    }
}


header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check = new QuanLyMonSinhBLL();

    $function = $_POST['function'];
    // checkLogin
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;
        case 'getListMonSinhChuaDangKy':
            $temp = $check->getListMonSinhChuaDangKy();
            echo json_encode($temp);
            break;
        case 'getObj':
            $maMonSinh = $_POST['maMonSinh'];
            $temp = $check->getObj($maMonSinh);
            echo json_encode($temp);
            break;
        case 'deleteByID':
            $maMonSinh = $_POST['maMonSinh'];
            $temp = $check->deleteByID($maMonSinh);
            echo json_encode($temp);
            break;
        case 'addObj':
            // Lấy dữ liệu đối tượng từ POST request
            $maMonSinh = $_POST['maMonSinh'];
            $maThe = $_POST["maThe"];
            $hoTen = $_POST["hoTen"];
            $gioiTinh = $_POST["gioiTinh"];
            $ngaySinh = $_POST["ngaySinh"];
            $chieuCao = $_POST["chieuCao"];
            $canNang = $_POST["canNang"];
            $diaChi = $_POST["diaChi"];
            $soDienThoai = $_POST["soDienThoai"];
            $email = $_POST["email"];
            $cccd = $_POST["cccd"];
            $anhCCCD = $_POST["anhCCCD"];
            $anh3x4 = $_POST["anh3x4"];
            $ngayCapCCCD = $_POST["ngayCapCCCD"];
            $noiCapCCCD = $_POST["noiCapCCCD"];
            $tenPhuHuynh = $_POST["tenPhuHuynh"];
            $sdtPhuHuynh = $_POST["sdtPhuHuynh"];
            $congViec = $_POST["congViec"];
            $lichSuTapLuyen = $_POST["lichSuTapLuyen"];
            $lichSuThi = $_POST["lichSuThi"];
            $bangCap = $_POST["bangCap"];
            $trinhDoVanHoa = $_POST["trinhDoVanHoa"];
            $khaNangNoiBat = $_POST["khaNangNoiBat"];
            $trangThai = $_POST["trangThai"];
            $maCapDai = $_POST["maCapDai"];
            $maCauLacBo = $_POST["maCauLacBo"];
            // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            $obj = new MonSinhDTO(
                $maMonSinh,
                $maThe,
                $hoTen,
                $gioiTinh,
                $ngaySinh,
                $chieuCao,
                $canNang,
                $diaChi,
                $soDienThoai,
                $email,
                $cccd,
                $anhCCCD,
                $anh3x4,
                $ngayCapCCCD,
                $noiCapCCCD,
                $tenPhuHuynh,
                $sdtPhuHuynh,
                $congViec,
                $lichSuTapLuyen,
                $lichSuThi,
                $bangCap,
                $trinhDoVanHoa,
                $khaNangNoiBat,
                $trangThai,
                $maCapDai,
                null,
                $maCauLacBo
            );
            $temp = $check->addObj($obj);
            echo json_encode($temp);
            break;
        case 'updateObj':
            // Lấy dữ liệu đối tượng từ POST request
            $maMonSinh = $_POST['maMonSinh'];
            $maThe = $_POST["maThe"];
            $hoTen = $_POST["hoTen"];
            $gioiTinh = $_POST["gioiTinh"];
            $ngaySinh = $_POST["ngaySinh"];
            $chieuCao = $_POST["chieuCao"];
            $canNang = $_POST["canNang"];
            $diaChi = $_POST["diaChi"];
            $soDienThoai = $_POST["soDienThoai"];
            $email = $_POST["email"];
            $cccd = $_POST["cccd"];
            $anhCCCD = $_POST["anhCCCD"];
            $anh3x4 = $_POST["anh3x4"];
            $ngayCapCCCD = $_POST["ngayCapCCCD"];
            $noiCapCCCD = $_POST["noiCapCCCD"];
            $tenPhuHuynh = $_POST["tenPhuHuynh"];
            $sdtPhuHuynh = $_POST["sdtPhuHuynh"];
            $congViec = $_POST["congViec"];
            $lichSuTapLuyen = $_POST["lichSuTapLuyen"];
            $lichSuThi = $_POST["lichSuThi"];
            $bangCap = $_POST["bangCap"];
            $trinhDoVanHoa = $_POST["trinhDoVanHoa"];
            $khaNangNoiBat = $_POST["khaNangNoiBat"];
            $trangThai = $_POST["trangThai"];
            $maCapDai = $_POST["maCapDai"];
            $maCauLacBo = $_POST["maCauLacBo"];
            // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            $obj = new MonSinhDTO(
                $maMonSinh,
                $maThe,
                $hoTen,
                $gioiTinh,
                $ngaySinh,
                $chieuCao,
                $canNang,
                $diaChi,
                $soDienThoai,
                $email,
                $cccd,
                $anhCCCD,
                $anh3x4,
                $ngayCapCCCD,
                $noiCapCCCD,
                $tenPhuHuynh,
                $sdtPhuHuynh,
                $congViec,
                $lichSuTapLuyen,
                $lichSuThi,
                $bangCap,
                $trinhDoVanHoa,
                $khaNangNoiBat,
                $trangThai,
                $maCapDai,
                null,
                $maCauLacBo
            );
            $temp = $check->updateObj($obj);
            echo json_encode($temp);
            break;
        case 'searchMonSinh':
            // Lấy dữ liệu đối tượng từ POST request
            $str = $_POST['str'];
            $temp = $check->searchMonSinh($str);
            echo json_encode($temp);
            break;
        case 'updateMonSinh':
            $maMonSinh = $_POST['maMonSinh'];
            $trangThai = $_POST['trangThai'];
            $temp = $check->updateMonSinh($maMonSinh, $trangThai);
            echo json_encode($temp);
            break;
    }
}
