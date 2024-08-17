<?php
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');
require('../DTO/SelectDTO.php');
require('../DAL/SelectDAL.php');

class SelectBLL
{
    private $SelectDAL;
    function __construct()
    {
        $this->SelectDAL = new SelectDAL();
    }
    // Lấy danh sách
    function getList()
    {
        $arr = $this->SelectDAL->getListObj();
        $result = array();
        // Kiểm tra nếu danh sách không rỗng
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                // Lấy dữ liệu từ đối tượng SelectDTO
                $obj = array(
                    "maCapDai" => $item->getMaCapDai(),
                    "tenCapDai" => $item->getTenCapDai(),
                    "maKhoaThi" => $item->getMaKhoaThi(),
                    "tenKhoaThi" => $item->getTenKhoaThi(),
                    "maKyThuat" => $item->getMaKyThuat(),
                    "tenKyThuat" => $item->getTenKyThuat(),
                    "maCauLacBo" => $item->getMaCauLacBo(),
                    "tenCauLacBo" => $item->getTenCauLacBo(),
                    
                    "mess" => "success"
                );

                array_push($result, $obj);
            }
            return $result;
        } else {
            return array("mess" => "Failed");
        }
    }

}

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check = new SelectBLL();

    $function = $_POST['function'] ?? '';
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;

    }
}