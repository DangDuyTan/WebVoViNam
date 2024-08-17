<?php

require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');
require('../DTO/TaiKhoanDTO.php');
require('../DAL/TaiKhoanDAL.php');
// require('../DTO/AccountDTO.php');
// require('../DAL/AccountDAL.php');

class QuanLyNguoiDungBLL
{
    private $QuanLyNguoiDungDAL;
    function __construct()
    {
        $this->QuanLyNguoiDungDAL = new TaiKhoanDAL();
    }
    // Xóa một đối tượng khi lấy được id của đối tượng
    function deleteByID($code)
    {

        //lấy thông tin 
        $result = $this->QuanLyNguoiDungDAL->deleteByID($code);

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

        $arr = $this->QuanLyNguoiDungDAL->getListobj();
        //mảng chứa các obj lấy được từ DAL ở trên
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {

                $tenDangNhap = $item->getTenDangNhap();
                $ho = $item->getHo();
                $ten = $item->getTen();
                $matKhau = $item->getMatKhau();
                $anhDaiDien = $item->getAnhDaiDien();
                $loai = $item->getLoai();
                $thoiGianTao = $item->getThoiGianTao();
                $thoiGianSua = $item->getThoiGianSua();
                $kichHoat = $item->getKichHoat();
                $soDienThoai = $item->getSoDienThoai();
                $maQuyen = $item->getMaQuyen();
                $obj = array(
                    "tenDangNhap" => $tenDangNhap,
                    "ho" => $ho,
                    "ten" => $ten,
                    "matKhau" => $matKhau,
                    "anhDaiDien" => $anhDaiDien,
                    "loai" => $loai,
                    "thoiGianTao" => $thoiGianTao,
                    "thoiGianSua" => $thoiGianSua,
                    "kichHoat" => $kichHoat,
                    "soDienThoai" => $soDienThoai,
                    "maQuyen" => $maQuyen,
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
    function getObj($code)
    {
        //Lấy kết quả từ DAL
        $result = $this->QuanLyNguoiDungDAL->getobj($code);
        if ($result != null) {
            $tenDangNhap = $result->getTenDangNhap();
            $ho = $result->getHo();
            $ten = $result->getTen();
            $matKhau = $result->getMatKhau();
            $anhDaiDien = $result->getAnhDaiDien();
            $loai = $result->getLoai();
            $thoiGianTao = $result->getThoiGianTao();
            $thoiGianSua = $result->getThoiGianSua();
            $kichHoat = $result->getKichHoat();
            $soDienThoai = $result->getSoDienThoai();
            $maQuyen = $result->getMaQuyen();
            $obj = array(
                "tenDangNhap" => $tenDangNhap,
                "ho" => $ho,
                "ten" => $ten,
                "matKhau" => $matKhau,
                "anhDaiDien" => $anhDaiDien,
                "loai" => $loai,
                "thoiGianTao" => $thoiGianTao,
                "thoiGianSua" => $thoiGianSua,
                "kichHoat" => $kichHoat,
                "soDienThoai" => $soDienThoai,
                "maQuyen" => $maQuyen,
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

            //Thực hiện thêm đối tượng vào Database
            $result = $this->QuanLyNguoiDungDAL->addobj($obj);

            if ($result != null) {
                return  array(
                    "tenDangNhap" => $tenDangNhap,
                    "ho" => $ho,
                    "ten" => $ten,
                    "matKhau" => $matKhau,
                    "anhDaiDien" => $anhDaiDien,
                    "loai" => $loai,
                    "thoiGianTao" => $thoiGianTao,
                    "thoiGianSua" => $thoiGianSua,
                    "kichHoat" => $kichHoat,
                    "soDienThoai" => $soDienThoai,
                    "maQuyen" => $maQuyen,
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
        $result = $this->QuanLyNguoiDungDAL->updateObj($obj);
        // return array("mess" => "check");
        if ($result) {
            // Lấy thông tin từ đối tượng cập nhật
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

            // Trả về mảng chứa thông báo thành công và thông tin cập nhật
            return array(
                "tenDangNhap" => $tenDangNhap,
                "ho" => $ho,
                "ten" => $ten,
                "matKhau" => $matKhau,
                "anhDaiDien" => $anhDaiDien,
                "loai" => $loai,
                "thoiGianTao" => $thoiGianTao,
                "thoiGianSua" => $thoiGianSua,
                "kichHoat" => $kichHoat,
                "soDienThoai" => $soDienThoai,
                "maQuyen" => $maQuyen,
                "mess" => "success"
            );
        } else {
            return array("mess" => "Failed");
        }
    }


    // Tìm kiếm
    function searchAccount($str)
    {
        $arr = $this->QuanLyNguoiDungDAL->getListobj();
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $tenDangNhap = $item->getTenDangNhap();
                $ho = $item->getHo();
                $ten = $item->getTen();
                $matKhau = $item->getMatKhau();
                $anhDaiDien = $item->getAnhDaiDien();
                $loai = $item->getLoai();
                $thoiGianTao = $item->getThoiGianTao();
                $thoiGianSua = $item->getThoiGianSua();
                $kichHoat = $item->getKichHoat();
                $soDienThoai = $item->getSoDienThoai();
                $maQuyen = $item->getMaQuyen();
                // Kiểm tra nếu chuỗi $str xuất hiện trong bất kỳ trường nào của đối tượng
                if (
                    strpos(strtolower($tenDangNhap), $str) !== false || strpos(strtolower($ho), $str) !== false  ||
                    strpos(strtolower($ten), $str) !== false || strpos(strtolower($soDienThoai), $str) !== false || strpos(strtolower($loai), $str) !== false || strpos(strtolower($kichHoat), $str) !== false
                ) {
                    $obj = array(
                        "tenDangNhap" => $tenDangNhap,
                        "ho" => $ho,
                        "ten" => $ten,
                        "matKhau" => $matKhau,
                        "anhDaiDien" => $anhDaiDien,
                        "loai" => $loai,
                        "thoiGianTao" => $thoiGianTao,
                        "thoiGianSua" => $thoiGianSua,
                        "kichHoat" => $kichHoat,
                        "soDienThoai" => $soDienThoai,
                        "maQuyen" => $maQuyen,
                        "mess" => "success"
                    );
                    array_push($result, $obj);
                }
            }
        }
        return $result;
    }
    function updateStateUser($tenDangNhap, $kichHoat)
    {
        $result = $this->QuanLyNguoiDungDAL->updateStateUser($tenDangNhap, $kichHoat);
        if ($result) {
            return array("mess" => "success");
        } else {
            return array("mess" => "failed");
        }
    }
}


header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check = new QuanLyNguoiDungBLL();

    $function = $_POST['function'];
    // checkLogin
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;
        case 'getObj':
            $username = $_POST['username'];
            $temp = $check->getObj($username);
            echo json_encode($temp);
            break;
        case 'deleteByID':
            $tenDangNhap = $_POST['tenDangNhap'];
            $temp = $check->deleteByID($tenDangNhap);
            echo json_encode($temp);
            break;
        case 'addObj':
            // Lấy dữ liệu đối tượng từ POST request
            $tenDangNhap = $_POST['tenDangNhap'];
            $ho = $_POST['ho'];
            $ten = $_POST['ten'];
            $matKhau = $_POST['matKhau'];
            $anhDaiDien = $_POST['anhDaiDien'];
            $loai = $_POST['loai'];
            $thoiGianTao = $_POST['thoiGianTao'];
            $thoiGianSua = $_POST['thoiGianSua'];
            $kichHoat = $_POST['kichHoat'];
            $soDienThoai = $_POST['soDienThoai'];
            $maQuyen = $_POST['maQuyen'];
            // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            $obj = new TaiKhoanDTO(
                $tenDangNhap,
                $ho,
                $ten,
                $matKhau,
                $anhDaiDien,
                $loai,
                $thoiGianTao,
                $thoiGianSua,
                $kichHoat,
                $soDienThoai,
                $maQuyen
            );
            $temp = $check->addObj($obj);
            echo json_encode($temp);
            break;
        case 'updateObj':
            // Lấy dữ liệu đối tượng từ POST request
            $tenDangNhap = $_POST['tenDangNhap'];
            $ho = $_POST['ho'];
            $ten = $_POST['ten'];
            $matKhau = $_POST['matKhau'];
            $anhDaiDien = $_POST['anhDaiDien'];
            $loai = $_POST['loai'];
            $thoiGianTao = $_POST['thoiGianTao'];
            $thoiGianSua = $_POST['thoiGianSua'];
            $kichHoat = $_POST['kichHoat'];
            $soDienThoai = $_POST['soDienThoai'];
            $maQuyen = $_POST['maQuyen'];
            // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            $obj = new TaiKhoanDTO(
                $tenDangNhap,
                $ho,
                $ten,
                $matKhau,
                $anhDaiDien,
                $loai,
                $thoiGianTao,
                $thoiGianSua,
                $kichHoat,
                $soDienThoai,
                $maQuyen
            );
            $temp = $check->updateObj($obj);
            echo json_encode($temp);
            break;
        case 'searchAccount':
            // Lấy dữ liệu đối tượng từ POST request
            $str = $_POST['str'];
            $temp = $check->searchAccount($str);
            echo json_encode($temp);
            break;
        case 'updateStateUser':
            $tenDangNhap = $_POST['tenDangNhap'];
            $kichHoat = $_POST['kichHoat'];
            $temp = $check->updateStateUser($tenDangNhap, $kichHoat);
            echo json_encode($temp);
            break;
    }
}
