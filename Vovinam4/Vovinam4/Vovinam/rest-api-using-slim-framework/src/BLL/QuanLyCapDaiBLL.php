<?php



require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');
require('../DTO/CapDaiDTO.php');
require('../DAL/CapDaiDAL.php');

class QuanLyCapDaiBLL
{
    private $QuanLyCapDaiDAL;
    function __construct()
    {
        $this->QuanLyCapDaiDAL = new CapDaiDAL();
    }
    // Xóa một đối tượng khi lấy được id của đối tượng
    // function deleteByID($code)
    // {

    //     //lấy thông tin 
    //     $result = $this->QuanLyCapDaiDAL->deleteByID($code);

    //     if ($result) {
    //         return array("mess" => "success");
    //     } else {
    //         return array("mess" => "Failed");
    //     }
    // }

    // Lấy danh sách
    function getList()
    {
        // Mảng dữ liệu lấy được từ DAL
        $arr = $this->QuanLyCapDaiDAL->getListObj();
        // return array("mess" => "check");
        // return array($arr);
        // Mảng chứa các obj lấy được từ DAL ở trên
        $result = array();

        if (count($arr) > 0) {
            foreach ($arr as $item) {
                // Lấy dữ liệu từ đối tượng KetQuaThiDTO
                $maCapDai = $item->getMaCapDai();
                $tenCapDai = $item->getTenCapDai();
                $obj = array(
                    "maCapDai" => $maCapDai,
                    "tenCapDai" => $tenCapDai,
                    "mess" => "success"
                );
                array_push($result, $obj);
            }
            return $result;
        } else {
            return array("mess" => "Failed");
        }
    }

    // // Lấy một đối tượng bằng khóa chính của đối tượng đó
    // function getObj($code)
    // {
    //     // Lấy kết quả từ DAL
    //     $result = $this->QuanLyCapDaiDAL->getObj($code);

    //     if ($result != null) {
    //         // Lấy dữ liệu từ đối tượng KetQuaThiDTO
    //         $maKetQuaThi = $result->getMaKetQuaThi();
    //         $tenMonSinh = $result->getTenMonSinh();
    //         $tenKhoaThi = $result->getTenKhoaThi();
    //         $capDaiHienTai = $result->getCapDaiHienTai();
    //         $capDaiDuThi = $result->getCapDaiDuThi();
    //         $ketQua = $result->getKetQua();
    //         $trangThaiHoSo = $result->getTrangThaiHoSo();
    //         $ghiChu = $result->getGhiChu();
    //         $ngayCham = $result->getNgayCham();

    //         $obj = array(
    //             "maKetQuaThi" => $maKetQuaThi,
    //             "tenMonSinh" => $tenMonSinh,
    //             "tenKhoaThi" => $tenKhoaThi,
    //             "capDaiHienTai" => $capDaiHienTai,
    //             "capDaiDuThi" => $capDaiDuThi,
    //             "ketQua" => $ketQua,
    //             "trangThaiHoSo" => $trangThaiHoSo,
    //             "ghiChu" => $ghiChu,
    //             "ngayCham" => $ngayCham,
    //             "mess" => "success"
    //         );

    //         return $obj;
    //     } else {
    //         return array("mess" => "Failed");
    //     }
    // }

    // //Thêm vào đối tượng obj 
    // function addObj($obj)
    // {
    //     if ($obj != null) {
    //         //Lấy thông tin từ đối tượng 
    //         $username = $obj->getUsername();
    //         $passWord = $obj->getPassword();
    //         $dateCreated = $obj->getDateCreate();
    //         $accountStatus = $obj->getAccountStatus();
    //         $name = $obj->getName();
    //         $address = $obj->getAddress();
    //         $email = $obj->getEmail();
    //         $phoneNumber = $obj->getPhoneNumber();
    //         $birth = $obj->getBirth();
    //         $sex = $obj->getSex();
    //         $codePermissions = $obj->getCodePermission();

    //         //Thực hiện thêm đối tượng vào Database
    //         $result = $this->QuanLyCapDaiDAL->addobj($obj);

    //         if ($result != null) {
    //             return  array(
    //                 "username" => $username,
    //                 "passWord" => $passWord,
    //                 "dateCreated" => $dateCreated,
    //                 "accountStatus" => $accountStatus,
    //                 "name" => $name,
    //                 "address" => $address,
    //                 "email" => $email,
    //                 "phoneNumber" => $phoneNumber,
    //                 "birth" => $birth,
    //                 "sex" => $sex,
    //                 "codePermissions" => $codePermissions,
    //                 "mess" => "success"
    //             );
    //         } else {
    //             return array("mess" => "failed");
    //         }
    //     } else {
    //         return array("mess" => "failed");
    //     }
    // }


    //Cập nhật đối tượng 
    // function updateObj($obj)
    // {
    //     $result = $this->QuanLyCapDaiDAL->updateObj($obj);
    //     if ($result) {
    //         // Lấy thông tin từ đối tượng cập nhật
    //         $username = $obj->getUsername();
    //         $passWord = $obj->getPassword();
    //         $dateCreated = $obj->getDateCreate();
    //         $accountStatus = $obj->getAccountStatus();
    //         $name = $obj->getName();
    //         $address = $obj->getAddress();
    //         $email = $obj->getEmail();
    //         $phoneNumber = $obj->getPhoneNumber();
    //         $birth = $obj->getBirth();
    //         $sex = $obj->getSex();
    //         $codePermissions = $obj->getCodePermission();

    //         // Trả về mảng chứa thông báo thành công và thông tin cập nhật
    //         return array(
    //             "username" => $username,
    //             "passWord" => $passWord,
    //             "dateCreated" => $dateCreated,
    //             "accountStatus" => $accountStatus,
    //             "name" => $name,
    //             "address" => $address,
    //             "email" => $email,
    //             "phoneNumber" => $phoneNumber,
    //             "birth" => $birth,
    //             "sex" => $sex,
    //             "codePermissions" => $codePermissions,
    //             "mess" => "success"
    //         );
    //     } else {
    //         return array("mess" => "Failed");
    //     }
    // }


    // Tìm kiếm
    // function searchAccount($str)
    // {
    //     $arr = $this->QuanLyCapDaiDAL->getListObj();
    //     // return array("mess" => "check");
    //     // return array($arr);
    //     $result = array();
    //     if (count($arr) > 0) {
    //         foreach ($arr as $item) {
    //             $maKetQuaThi = $item->getMaKetQuaThi();
    //             $tenMonSinh = $item->getTenMonSinh();
    //             $tenKhoaThi = $item->getTenKhoaThi();
    //             $capDaiHienTai = $item->getCapDaiHienTai();
    //             $capDaiDuThi = $item->getCapDaiDuThi();
    //             $ketQua = $item->getKetQua();
    //             $trangThaiHoSo = $item->getTrangThaiHoSo();
    //             $ghiChu = $item->getGhiChu();
    //             $ngayCham = $item->getNgayCham();
    //             // Kiểm tra nếu chuỗi $str xuất hiện trong bất kỳ trường nào của đối tượng
    //             if (
    //                 strpos(strtolower($maKetQuaThi), $str) !== false || strpos(strtolower($tenMonSinh), $str) !== false  ||
    //                 strpos(strtolower($tenKhoaThi), $str) !== false || strpos(strtolower($capDaiHienTai), $str) !== false || strpos(strtolower($capDaiDuThi), $str) !== false || strpos(strtolower($ketQua), $str) !== false
    //             ) {
    //                 $obj = array(
    //                     "maKetQuaThi" => $maKetQuaThi,
    //                     "tenMonSinh" => $tenMonSinh,
    //                     "tenKhoaThi" => $tenKhoaThi,
    //                     "capDaiHienTai" => $capDaiHienTai,
    //                     "capDaiDuThi" => $capDaiDuThi,
    //                     "ketQua" => $ketQua,
    //                     "trangThaiHoSo" => $trangThaiHoSo,
    //                     "ghiChu" => $ghiChu,
    //                     "ngayCham" => $ngayCham,
    //                     "mess" => "success"
    //                 );
    //                 array_push($result, $obj);
    //             }
    //         }
    //     }
    //     return $result;
    // }
}


header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check = new QuanLyCapDaiBLL();

    $function = $_POST['function'];
    // checkLogin
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;
            // case 'getObj':
            //     $username = $_POST['username'];
            //     $temp = $check->getObj($username);
            //     echo json_encode($temp);
            //     break;
            // case 'deleteByID':
            //     $maKhoaThi = $_POST['maKhoaThi'];
            //     $temp = $check->deleteByID($maKhoaThi);
            //     echo json_encode($temp);
            //     break;
            // case 'addObj':
            //     // Lấy dữ liệu đối tượng từ POST request
            //     $username = $_POST['username'];
            //     $passWord = $_POST['passWord'];
            //     $dateCreated = $_POST['dateCreated'];
            //     $accountStatus = $_POST['accountStatus'];
            //     $name = $_POST['name'];
            //     $address = $_POST['address'];
            //     $email = $_POST['email'];
            //     $phoneNumber = $_POST['phoneNumber'];
            //     $birth = $_POST['birth'];
            //     $sex = $_POST['sex'];
            //     $codePermissions = $_POST['codePermissions'];
            //     // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            //     $obj = new AccountDTO(
            //         $username,
            //         $passWord,
            //         $dateCreated,
            //         $accountStatus,
            //         $name,
            //         $address,
            //         $email,
            //         $phoneNumber,
            //         $birth,
            //         $sex,
            //         $codePermissions
            //     );
            //     $temp = $check->addObj($obj);
            //     echo json_encode($temp);
            //     break;
            // case 'updateObj':
            //     // Lấy dữ liệu đối tượng từ POST request
            //     $username = $_POST['username'];
            //     $passWord = $_POST['passWord'];
            //     $dateCreated = $_POST['dateCreated'];
            //     $accountStatus = $_POST['accountStatus'];
            //     $name = $_POST['name'];
            //     $address = $_POST['address'];
            //     $email = $_POST['email'];
            //     $phoneNumber = $_POST['phoneNumber'];
            //     $birth = $_POST['birth'];
            //     $sex = $_POST['sex'];
            //     $codePermissions = $_POST['codePermissions'];
            //     // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            //     $obj = new AccountDTO(
            //         $username,
            //         $passWord,
            //         $dateCreated,
            //         $accountStatus,
            //         $name,
            //         $address,
            //         $email,
            //         $phoneNumber,
            //         $birth,
            //         $sex,
            //         $codePermissions
            //     );
            //     $temp = $check->updateObj($obj);
            //     echo json_encode($temp);
            //     break;
            // case 'searchAccount':
            //     // Lấy dữ liệu đối tượng từ POST request
            //     $str = $_POST['str'];
            //     $temp = $check->searchAccount($str);
            //     echo json_encode($temp);
            //     break;
    }
}
