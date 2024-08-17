<?php
require('../DAL/connectionDatabase.php');
require('../DAL/AbstracGiamKhaoDAL.php');
require('../DTO/MSinhDkiThiDTO.php');
require('../DAL/MSinhDkiThiDAL.php');

class MSinhDkiThiBLL
{
    private $MSinhDkiThiDAL;
    function __construct()
    {
        $this->MSinhDkiThiDAL = new MSinhDkiThiDAL();
    }
    // Lấy danh sách
    function getList()
    {
        $arr = $this->MSinhDkiThiDAL->getListObj();
        $result = array();

        if (count($arr) > 0) {
            foreach ($arr as $item) {
                // Lấy dữ liệu từ đối tượng GiamKhaoDTO
                $obj = array(
                    "maKhoaThi" => $item->getMaKhoaThi(),
                    "tenCapDai" => $item->getTenCapDai(),
                    "maCapDai" => $item->getMaCapDai(),
                    "tenKhoaThi" => $item->getTenKhoaThi(),
                    "ngayThi" => $item->getngayThi(),
                    "ngayKetThuc" => $item->getngayKetThuc(),
                    "ghiChu" => $item->getghiChu(),

                    "mess" => "success"
                );

                array_push($result, $obj);
            }
            return $result;
        } else {
            return array("mess" => "Failed");
        }
    }
    /*
    // Cập nhật đối tượng 
    function updateObj($obj)
    {
        // Lấy thông tin từ đối tượng
        $maCTPhieuDiem = $obj->getMaCTPhieuDiem();
        $ThuocBai = $obj->getThuocBai();
        $NhanhManh = $obj->getNhanhManh();
        $TanPhap = $obj->getTanPhap();
        $ThuyetPhuc = $obj->getThuyetPhuc();
        $GhiChu = $obj->getGhiChu();

        // Tính tổng điểm
        $Diem = $ThuocBai + $NhanhManh + $TanPhap + $ThuyetPhuc;

        // Xác định giá trị của KetQua
        $KetQua = $Diem >= 5 ? 1 : 0;

        // Cập nhật thông tin vào đối tượng
        $obj->setDiem($Diem);
        $obj->setKetQua($KetQua);

        // Thực hiện cập nhật qua DAL
        $result = $this->GiamKhaoDAL->updateObj($obj);
        if ($result) {
            // Trả về mảng chứa thông báo thành công và thông tin cập nhật
            return array(
                "maCTPhieuDiem" => $maCTPhieuDiem,
                "ThuocBai" => $ThuocBai,
                "NhanhManh" => $NhanhManh,
                "TanPhap" => $TanPhap,
                "ThuyetPhuc" => $ThuyetPhuc,
                "Diem" => $Diem,
                "KetQua" => $KetQua,
                "GhiChu" => $GhiChu,
                "mess" => "success"
            );
        } else {
            return array("mess" => "Failed");
        }
    }
*/
    function getSelect() {
        $result = $this->MSinhDkiThiDAL->getSelect();
        return $result;
    }

    // Tìm kiếm
    function searchKTCD($str)
    {
        $arr = $this->MSinhDkiThiDAL->getListObj();
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $maKhoaThi = $item->getMaKhoaThi();
                $tenKhoaThi = $item->getTenKhoaThi();
                $maCapDai = $item->getMaCapDai();
                $tenCapDai = $item->getTenCapDai();
                $ngayThi = $item->getngayThi();
                $ngayKetThuc = $item->getngayKetThuc();
                $ghiChu = $item->getghiChu();

                // Kiểm tra nếu chuỗi $str xuất hiện trong bất kỳ trường nào của đối tượng
                if (
                    strpos(strtolower($tenCapDai), $str) !== false 
                    || strpos(strtolower($tenKhoaThi), $str) !== false
                ) {
                    $obj = array(
                        "maKhoaThi" => $maKhoaThi,
                        "tenKhoaThi" => $tenKhoaThi,
                        "maCapDai" => $maCapDai,
                        "tenCapDai" => $tenCapDai,
                        "ngayThi" => $ngayThi,
                        "ngayKetThuc" => $ngayKetThuc,
                        "ghiChu" => $ghiChu,
                        "mess" => "success"
                    );
                    array_push($result, $obj);
                }
            }
        }
        return $result;
    }
}

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check = new MSinhDkiThiBLL();

    $function = $_POST['function'] ?? '';
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;
        case 'getSelect':
            $temp = $check->getSelect();
            echo json_encode($temp);
            break;
        case 'searchKTCD':
            // Lấy dữ liệu đối tượng từ POST request
            $str = $_POST['str'];
            $temp = $check->searchKTCD($str);
            echo json_encode($temp);
            break;
    }
}