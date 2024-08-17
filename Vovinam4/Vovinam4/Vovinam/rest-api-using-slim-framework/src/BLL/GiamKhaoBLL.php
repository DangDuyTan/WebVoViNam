<?php
require('../DAL/connectionDatabase.php');
require('../DAL/AbstracGiamKhaoDAL.php');
require('../DTO/GiamKhaoDTO.php');
require('../DAL/GiamKhaoDAL.php');

class GiamKhaoBLL
{
    private $GiamKhaoDAL;
    function __construct()
    {
        $this->GiamKhaoDAL = new GiamKhaoDAL();
    }
    // Lấy danh sách
    function getList()
    {
        $arr = $this->GiamKhaoDAL->getListObj();
        $result = array();

        if (count($arr) > 0) {
            foreach ($arr as $item) {
                // Lấy dữ liệu từ đối tượng GiamKhaoDTO
                $obj = array(
                    "maCTPhieuDiem" => $item->getMaCTPhieuDiem(),
                    "maMonSinh" => $item->getMaMonSinh(),
                    "hoTen" => $item->getHoTen(),
                    "maThe" => $item->getMaThe(),
                    "maCauLacBo" => $item->getMaCauLacBo(),
                    "tenCauLacBo" => $item->getTenCauLacBo(),
                    "maKhoaThi" => $item->getMaKhoaThi(),
                    "tenKhoaThi" => $item->getTenKhoaThi(),
                    "maCapDai" => $item->getMaCapDai(),
                    "tenCapDai" => $item->getTenCapDai(),
                    "maKyThuat" => $item->getMaKyThuat(),
                    "tenKyThuat" => $item->getTenKyThuat(),
                    "ThuocBai" => $item->getThuocBai(),
                    "NhanhManh" => $item->getNhanhManh(),
                    "TanPhap" => $item->getTanPhap(),
                    "ThuyetPhuc" => $item->getThuyetPhuc(),
                    "Diem" => $item->getDiem(),
                    "ketQua" => $item->getKetQua(),
                    "GiamKhaoCham" => $item->getGiamKhaoCham(),
                    "maChiTietKetQua" => $item->getMaChiTietKetQua(),
                    "GhiChu" => $item->getGhiChu(),
                    "NgayCham" => $item->getNgayCham(),

                    "mess" => "success"
                );

                array_push($result, $obj);
            }
            return $result;
        } else {
            return array("mess" => "Failed");
        }
    }
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

    function getSelect() {
        $result = $this->GiamKhaoDAL->getSelect();
        return $result;
    }


}

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check = new GiamKhaoBLL();

    $function = $_POST['function'] ?? '';
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;
            case 'updateObj':
            // Lấy dữ liệu đối tượng từ POST request
            $maCTPhieuDiem = $_POST['maCTPhieuDiem'];
            $ThuocBai = $_POST["ThuocBai"];
            $NhanhManh = $_POST["NhanhManh"];
            $TanPhap = $_POST["TanPhap"]; 
            $ThuyetPhuc = $_POST["ThuyetPhuc"];
            $GhiChu = $_POST["GhiChu"];
            // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            $obj = new GiamKhaoDTO(
                $maCTPhieuDiem,
                null, // maMonSinh
                null, // hoTen
                null, // maThe
                null,
                null, // tenCauLacBo
                null,
                null, // tenKhoaThi
                null,
                null, // tenCapDai
                null,
                null, // tenKyThuat
                $ThuocBai,
                $NhanhManh,
                $TanPhap,
                $ThuyetPhuc,
                0, // Diem, sẽ được tính toán trong hàm updateObj
                0, // KetQua, sẽ được tính toán trong hàm updateObj
                null, // GiamKhaoCham
                null, // maChiTietKetQua
                $GhiChu,
                null  // NgayCham
            );
            $temp = $check->updateObj($obj);
            echo json_encode($temp);
            break;
        case 'getSelect':
            $temp = $check->getSelect();
            echo json_encode($temp);
            break;

    }
}