<?php



require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');
require('../DTO/KhoaThiDTO.php');
require('../DAL/KhoaThiDAL.php');

class QuanLyKhoaThiBLL
{
    private $QuanLyKhoaThiDAL;
    function __construct()
    {
        $this->QuanLyKhoaThiDAL = new KhoaThiDAL();
    }
    // Xóa một đối tượng khi lấy được id của đối tượng
    function deleteByID($code)
    {

        //lấy thông tin 
        $result = $this->QuanLyKhoaThiDAL->deleteByID($code);

        if ($result) {
            return array("mess" => "success");
        } else {
            return array("mess" => "Failed");
        }
    }

    // Hàm lấy danh sách các khóa thi với thông tin cấp đai
    function getList()
    {
        // Mảng dữ liệu lấy được từ DAL
        $arr = $this->QuanLyKhoaThiDAL->getListObj();
        // return array($arr);
        // return array("mess" => "check");
        // Mảng chứa các obj lấy được từ DAL ở trên
        $result = array();

        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $maKhoaThi = $item->getMaKhoaThi();
                $tenKhoaThi = $item->getTenKhoaThi();
                $ngayThi = $item->getNgayThi();
                $ngayKetThuc = $item->getNgayKetThuc();
                $hienThi = $item->getHienThi();
                $ghiChu = $item->getGhiChu();
                $dsCapDaiThi = $item->getDsCapDaiThi();

                $obj = array(
                    "maKhoaThi" => $maKhoaThi,
                    "tenKhoaThi" => $tenKhoaThi,
                    "ngayThi" => $ngayThi,
                    "ngayKetThuc" => $ngayKetThuc,
                    "hienThi" => $hienThi,
                    "ghiChu" => $ghiChu,
                    "dsCapDaiThi" => $dsCapDaiThi,
                    "mess" => "success"
                );
                array_push($result, $obj);
            }
            return $result;
        } else {
            return array("mess" => "Failed");
        }
    }


    function getObj($code)
    {
        // Lấy kết quả từ DAL
        $result = $this->QuanLyKhoaThiDAL->getObj($code);

        if ($result !== null) {
            $obj = array(
                "maKhoaThi" => $result->getMaKhoaThi(),
                "tenKhoaThi" => $result->getTenKhoaThi(),
                "ngayThi" => $result->getNgayThi(),
                "ngayKetThuc" => $result->getNgayKetThuc(),
                "hienThi" => $result->getHienThi(),
                "ghiChu" => $result->getGhiChu(),
                "dsCapDaiThi" => $result->getDsCapDaiThi(),
                "mess" => "success"
            );
        } else {
            $obj = array("mess" => "Failed");
        }

        return $obj;
    }



    //Thêm vào đối tượng obj 
    function addObj($obj)
    {
        if ($obj != null) {
            //Lấy thông tin từ đối tượng 
            $maKhoaThi = $obj->getMaKhoaThi();
            $tenKhoaThi = $obj->getTenKhoaThi();
            $ngayThi = $obj->getNgayThi();
            $ngayKetThuc = $obj->getNgayKetThuc();
            $hienThi = $obj->getHienThi();
            $ghiChu = $obj->getGhiChu();
            $dsCapDaiThi = $obj->getDsCapDaiThi();

            //Thực hiện thêm đối tượng vào Database
            $result = $this->QuanLyKhoaThiDAL->addObj($obj);
            // return array("mess" => "check");
            // return array($result);
            if ($result != null) {
                return  array(
                    "maKhoaThi" => $maKhoaThi,
                    "tenKhoaThi" => $tenKhoaThi,
                    "ngayThi" => $ngayThi,
                    "ngayKetThuc" => $ngayKetThuc,
                    "hienThi" => $hienThi,
                    "ghiChu" => $ghiChu,
                    "dsCapDaiThi" => $dsCapDaiThi,
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
        $result = $this->QuanLyKhoaThiDAL->updateObj($obj);
        if ($result) {
            // Lấy thông tin từ đối tượng cập nhật
            $maKhoaThi = $obj->getMaKhoaThi();
            $tenKhoaThi = $obj->getTenKhoaThi();
            $ngayThi = $obj->getNgayThi();
            $ngayKetThuc = $obj->getNgayKetThuc();
            $hienThi = $obj->getHienThi();
            $ghiChu = $obj->getGhiChu();
            // $dsCapDaiThi = $obj->getDsCapDaiThi();

            // Trả về mảng chứa thông báo thành công và thông tin cập nhật
            return array(
                "maKhoaThi" => $maKhoaThi,
                "tenKhoaThi" => $tenKhoaThi,
                "ngayThi" => $ngayThi,
                "ngayKetThuc" => $ngayKetThuc,
                "hienThi" => $hienThi,
                "ghiChu" => $ghiChu,
                // "dsCapDaiThi" => $dsCapDaiThi,
                "mess" => "success"
            );
        } else {
            return array("mess" => "Failed");
        }
    }


    // Tìm kiếm
    function searchAccount($str)
    {
        $arr = $this->QuanLyKhoaThiDAL->getListobj();
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $maKhoaThi = $item->getMaKhoaThi();
                $tenKhoaThi = $item->getTenKhoaThi();
                $ngayThi = $item->getNgayThi();
                $ngayKetThuc = $item->getNgayKetThuc();
                $hienThi = $item->getHienThi();
                $ghiChu = $item->getGhiChu();
                $dsCapDaiThi = $item->getDsCapDaiThi();
                // Kiểm tra nếu chuỗi $str xuất hiện trong bất kỳ trường nào của đối tượng
                if (
                    strpos(strtolower($maKhoaThi), $str) !== false || strpos(strtolower($tenKhoaThi), $str) !== false  ||
                    strpos(strtolower($ngayThi), $str) !== false || strpos(strtolower($ngayKetThuc), $str) !== false || strpos(strtolower($ghiChu), $str) !== false || strpos(strtolower($dsCapDaiThi), $str) !== false
                ) {
                    $obj = array(
                        "maKhoaThi" => $maKhoaThi,
                        "tenKhoaThi" => $tenKhoaThi,
                        "ngayThi" => $ngayThi,
                        "ngayKetThuc" => $ngayKetThuc,
                        "hienThi" => $hienThi,
                        "ghiChu" => $ghiChu,
                        "dsCapDaiThi" => $dsCapDaiThi,
                        "mess" => "success"
                    );
                    array_push($result, $obj);
                }
            }
        }
        return $result;
    }
    // function updateStateUser($userName, $accountStatus)
    // {
    //     $result = $this->QuanLyKhoaThiDAL->updateStateUser($userName, $accountStatus);
    //     if ($result) {
    //         return array("mess" => "success");
    //     } else {
    //         return array("mess" => "failed");
    //     }
    // }
}


header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check = new QuanLyKhoaThiBLL();

    $function = $_POST['function'];
    // checkLogin
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;
        case 'getObj':
            $maKhoaThi = $_POST['maKhoaThi'];
            $temp = $check->getObj($maKhoaThi);
            echo json_encode($temp);
            break;
        case 'deleteByID':
            $maKhoaThi = $_POST['maKhoaThi'];
            $temp = $check->deleteByID($maKhoaThi);
            echo json_encode($temp);
            break;
        case 'addObj':
            // Lấy dữ liệu đối tượng từ POST request
            $maKhoaThi = $_POST['maKhoaThi'];
            $tenKhoaThi = $_POST["tenKhoaThi"];
            $ngayThi = $_POST["ngayThi"];
            $ngayKetThuc = $_POST["ngayKetThuc"]; // lấy giá trị từ cột ngayKetThuc
            $hienThi = $_POST["hienThi"];
            $ghiChu = $_POST["ghiChu"];
            $dsCapDaiThi = $_POST["dsCapDaiThi"];
            // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            $obj = new KhoaThiDTO(
                $maKhoaThi,
                $tenKhoaThi,
                $ngayThi,
                $ngayKetThuc,
                $hienThi,
                $ghiChu,
                $dsCapDaiThi
            );
            $temp = $check->addObj($obj);
            echo json_encode($temp);
            break;
        case 'updateObj':
            // Lấy dữ liệu đối tượng từ POST request
            $maKhoaThi = $_POST['maKhoaThi'];
            $tenKhoaThi = $_POST["tenKhoaThi"];
            $ngayThi = $_POST["ngayThi"];
            $ngayKetThuc = $_POST["ngayKetThuc"]; // lấy giá trị từ cột ngayKetThuc
            $hienThi = $_POST["hienThi"];
            $ghiChu = $_POST["ghiChu"];
            // $dsCapDaiThi = $_POST["dsCapDaiThi"];
            // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            $obj = new KhoaThiDTO(
                $maKhoaThi,
                $tenKhoaThi,
                $ngayThi,
                $ngayKetThuc,
                $hienThi,
                $ghiChu,
                // $dsCapDaiThi
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
            // $userName = $_POST['userName'];
            // $accountStatus = $_POST['accountStatus'];
            // $temp = $check->updateStateUser($userName, $accountStatus);
            // echo json_encode($temp);
            break;
    }
}
