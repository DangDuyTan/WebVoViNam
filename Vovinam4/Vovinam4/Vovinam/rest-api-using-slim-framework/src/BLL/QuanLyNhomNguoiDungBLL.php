<?php
// Hiển thị lỗi PHP


require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');

require('../DTO/QuyenDTO.php');
require('../DTO/ChiTietQuyenDTO.php');
require('../DTO/ChucNangDTO.php');

require('../DAL/QuyenDAL.php');
require('../DAL/ChiTietQuyenDAL.php');
require('../DAL/ChucNangDAL.php');


class QuanLyNhomNguoiDungBLL
{
    private $QuyenDAL;
    private $ChiTietQuyenDAL;
    private $ChucNangDAL;
    function __construct()
    {
        $this->QuyenDAL = new QuyenDAL();
        $this->ChiTietQuyenDAL = new ChiTietQuyenDAL();
        $this->ChucNangDAL = new ChucNangDAL();
    }
    // Xóa một đối tượng khi lấy được id của đối tượng
    function deleteByID($ma)
    {

        //lấy thông tin 
        $result = $this->QuyenDAL->deleteByID($ma);

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

        $arr = $this->QuyenDAL->getListObj();
        // return array("mess" => "check");
        //mảng chứa các obj lấy được từ DAL ở trên
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $maQuyen = $item->getMaQuyen();
                $tenQuyen = $item->getTenQuyen();
                $obj = array(
                    "maQuyen" => $maQuyen,
                    "tenQuyen" => $tenQuyen,
                );
                array_push($result, $obj);
            }
            return $result;
        } else {
            return array("mess" => "Failed");
        }
    }

    //Lấy một đối tượng bằng khóa chính của đối tượng đó
    function getObj($ma)
    {
        //Lấy kết quả từ DAL
        $result = $this->QuyenDAL->getObj($ma);
        return array("mess" => "success");
        if ($result != null) {
            $maQuyen = $result->getMaQuyen();
            $tenQuyen = $result->getTenQuyen();

            $obj = array(
                "maQuyen" => $maQuyen,
                "tenQuyen" => $tenQuyen,
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
            $maQuyen = $obj->getMaQuyen();
            $tenQuyen = $obj->getTenQuyen();
            // return array("mess" => "check");

            //Thực hiện thêm đối tượng vào Database
            $result = $this->QuyenDAL->addObj($obj);

            if ($result) {
                return array(
                    "maQuyen" => $maQuyen,
                    "tenQuyen" => $tenQuyen,
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
        $result = $this->QuyenDAL->updateObj($obj);
        if ($result) {
            // Lấy thông tin từ đối tượng cập nhật
            $maQuyen = $obj->getMaQuyen();
            $tenQuyen = $obj->getTenQuyen();


            // Trả về mảng chứa thông báo thành công và thông tin cập nhật
            return array(
                "maQuyen" => $maQuyen,
                "tenQuyen" => $tenQuyen,
                "mess" => "success"
            );
        } else {
            return array("mess" => "Failed");
        }
    }


    // Tìm kiếm
    function searchAccountGroup($str)
    {
        $arr = $this->QuyenDAL->getListObj();
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $maQuyen = $item->getMaQuyen();
                $tenQuyen = $item->getTenQuyen();
                // Kiểm tra nếu chuỗi $str xuất hiện trong bất kỳ trường nào của đối tượng
                if (
                    strpos($maQuyen, $str) !== false || strpos($tenQuyen, $str) !== false
                ) {
                    $obj = array(
                        "maQuyen" => $maQuyen,
                        "tenQuyen" => $tenQuyen,
                        "mess" => "success"
                    );
                    array_push($result, $obj);
                }
            }
        }
        return $result;
    }

    // lấy mảng chứa PermissionDetail (chitietquyen)
    function getArrChiTietQuyen($maQuyen)
    {
        $quyenObj = $this->QuyenDAL->getObj($maQuyen);
        $arrChiTietQuyen = $this->ChiTietQuyenDAL->getArrByQuyen($maQuyen);
        $arrChucNang = $this->ChucNangDAL->getListObj();

        $result = array();

        // lấy đối tượng permission
        // $codePermission = $permissionObj->getCodePermission();
        $tenQuyen = $quyenObj->getTenQuyen();

        $result['maQuyen'] = $maQuyen;
        $result['tenQuyen'] = $tenQuyen;

        $dataChiTietQuyen = array();
        foreach ($arrChiTietQuyen as $item) {
            $obj = array(
                "maQuyen" => $maQuyen,
                "maChucNang" => $item->getMaChucNang(),
                "chucNangThem" => $item->getChucNangThem(),
                "chucNangSua" => $item->getChucNangSua(),
                "chucNangXoa" => $item->getChucNangXoa(),
                "chucNangTimKiem" => $item->getChucNangTimKiem(),
                "chamDiemDonLuyen" => $item->getChamDiemDonLuyen(),
                "chamDiemSongLuyen" => $item->getChamDiemSongLuyen(),
                "chamDiemCanBan" => $item->getChamDiemCanBan(),
                "chamDiemDoiKhang" => $item->getChamDiemDoiKhang(),
                "chamDiemTheLuc" => $item->getChamDiemTheLuc(),
                "chamDiemLyThuyet" => $item->getChamDiemLyThuyet()
            );
            array_push($dataChiTietQuyen, $obj);
        }
        $result['chiTietQuyen'] = $dataChiTietQuyen;

        $dataChucNang = array();
        foreach ($arrChucNang as $item) {
            $obj = array(
                "maChucNang" => $item->getMaChucNang(),
                "tenChucNang" => $item->getTenChucNang()
            );
            array_push($dataChucNang, $obj);
        }
        $result['chucNang'] = $dataChucNang;

        return $result;
    }

    // phân quyền
    // input: mang chua cac obj QuyenDetail
    // output: mess cap nhat
    function updateChiTietQuyen($arr)
    {
        if ($arr != null) {
            $check = 'success';
            foreach ($arr as $item) {
                $maQuyen = $item['maQuyen'];
                $maChucNang = $item['maChucNang'];
                $chucNangThem = $item['chucNangThem'];
                $chucNangSua = $item['chucNangSua'];
                $chucNangXoa = $item['chucNangXoa'];
                $chucNangTimKiem = $item['chucNangTimKiem'];
                $chamDiemDonLuyen = $item['chamDiemDonLuyen'];
                $chamDiemSongLuyen = $item['chamDiemSongLuyen'];
                $chamDiemCanBan = $item['chamDiemCanBan'];
                $chamDiemDoiKhang = $item['chamDiemDoiKhang'];
                $chamDiemTheLuc = $item['chamDiemTheLuc'];
                $chamDiemLyThuyet = $item['chamDiemLyThuyet'];


                $obj = new ChiTietQuyenDTO($maQuyen, $maChucNang, $chucNangThem, $chucNangSua, $chucNangXoa, $chucNangTimKiem, $chamDiemDonLuyen, $chamDiemSongLuyen, $chamDiemCanBan, $chamDiemDoiKhang, $chamDiemTheLuc, $chamDiemLyThuyet);

                // cập nhật
                if ($this->ChiTietQuyenDAL->updateObj($obj) != true) {
                    $check = 'failed';
                }
            }
            return array(
                "mess" => $check
            );
        } else {
            return array(
                "mess" => "failed"
            );
        }
    }

    // lấy dữ liệu function
    function getArrFunction()
    {
        $arr = $this->ChucNangDAL->getListObj();
        if ($arr != null) {
            $result = array();
            foreach ($arr as $item) {
                $maChucNang = $item->getMaChucNang();
                $tenChucNang = $item->getTenChucNang();

                $obj = array(
                    "maChucNang" => $maChucNang,
                    "tenChucNang" => $tenChucNang
                );

                array_push($result, $obj);
            }
            return $result;
        }
        return array();
    }

    // thêm đối tượng QuyenDetail
    // input: arr QuyenDetail
    // output: mess
    function addArrPermisstionDetail($arr)
    {
        if ($arr != null) {
            $check = 'success';
            foreach ($arr as $item) {
                $maQuyen = $item['maQuyen'];
                $maChucNang = $item['maChucNang'];
                $chucNangThem = $item['chucNangThem'];
                $chucNangSua = $item['chucNangSua'];
                $chucNangXoa = $item['chucNangXoa'];
                $chucNangTimKiem = $item['chucNangTimKiem'];
                $chamDiemDonLuyen = $item['chamDiemDonLuyen'];
                $chamDiemSongLuyen = $item['chamDiemSongLuyen'];
                $chamDiemCanBan = $item['chamDiemCanBan'];
                $chamDiemDoiKhang = $item['chamDiemDoiKhang'];
                $chamDiemTheLuc = $item['chamDiemTheLuc'];
                $chamDiemLyThuyet = $item['chamDiemLyThuyet'];

                $obj = new ChiTietQuyenDTO($maQuyen, $maChucNang, $chucNangThem, $chucNangSua, $chucNangXoa, $chucNangTimKiem, $chamDiemDonLuyen, $chamDiemSongLuyen, $chamDiemCanBan, $chamDiemDoiKhang, $chamDiemTheLuc, $chamDiemLyThuyet);

                // cập nhật
                if ($this->ChiTietQuyenDAL->addObj($obj) != true) {
                    // return array("mess" => "check");
                    $check = 'failed';
                }
            }
            return array(
                "mess" => $check
            );
        } else {
            return array(
                "mess" => "failed"
            );
        }
    }

    // xoa mang QuyenDetail
    function deleteObj_by_codePermission($maQuyen)
    {

        if ($this->ChiTietQuyenDAL->deleteObj_by_codePermission($maQuyen) == true) {
            return array(
                "mess" => "success"
            );
        } else {
            return array(
                "mess" => "failed"
            );
        }
    }
}


header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check = new QuanLyNhomNguoiDungBLL();

    $function = $_POST['function'];
    // checkLogin
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;
        case 'getObj':
            $maQuyen = $_POST['maQuyen'];
            $temp = $check->getObj($maQuyen);
            echo json_encode($temp);
            break;
        case 'deleteByID':
            $maQuyen = $_POST['maQuyen'];
            $temp = $check->deleteByID($maQuyen);
            echo json_encode($temp);
            break;
        case 'addObj':
            // Lấy dữ liệu đối tượng từ POST request
            $maQuyen = $_POST['maQuyen'];
            $tenQuyen = $_POST['tenQuyen'];

            // Tạo một đối tượng QuyenDTO từ dữ liệu POST
            $obj = new QuyenDTO($maQuyen, $tenQuyen);
            $temp = $check->addObj($obj);
            echo json_encode($temp);
            break;
        case 'updateObj':
            // Lấy dữ liệu đối tượng từ POST request
            $maQuyen = $_POST['maQuyen'];
            $tenQuyen = $_POST['tenQuyen'];
            // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            $obj = new QuyenDTO($maQuyen, $tenQuyen);
            $temp = $check->updateObj($obj);
            echo json_encode($temp);
            break;
        case 'searchAccountGroup':
            // Lấy dữ liệu đối tượng từ POST request
            $str = $_POST['str'];
            $temp = $check->searchAccountGroup($str);
            echo json_encode($temp);
            break;
        case 'getArrChiTietQuyen':
            $maQuyen = $_POST['maQuyen'];
            $temp = $check->getArrChiTietQuyen($maQuyen);
            echo json_encode($temp);
            break;
        case 'updateChiTietQuyen':
            $jsonStr = $_POST['arr'];
            $array = json_encode($jsonStr, true);
            $temp = $check->updateChiTietQuyen($array);
            echo json_encode($temp);
            break;
        case 'addArrPermisstionDetail':
            $jsonStr = $_POST['arr'];
            $array = json_encode($jsonStr, true);
            $temp = $check->addArrPermisstionDetail($array);
            echo json_encode($temp);
            break;
        case 'getArrFunction':
            $temp = $check->getArrFunction();
            echo json_encode($temp);
            break;
        case 'deleteQuyenDetail_by_maQuyen':
            $maQuyen = $_POST['maQuyen'];
            $temp = $check->deleteObj_by_codePermission($maQuyen);
            echo json_encode($temp);
            break;
    }
}
