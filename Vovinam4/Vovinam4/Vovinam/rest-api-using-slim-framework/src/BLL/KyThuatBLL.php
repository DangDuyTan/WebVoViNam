<?php
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');
require('../DTO/KyThuatDTO.php');
require('../DAL/KyThuatDAL.php');

class KyThuatBLL
{
    private $KyThuatDAL;
    function __construct()
    {
        $this->KyThuatDAL = new KyThuatDAL();
    }
    // Lấy danh sách
    function getList()
    {
        $arr = $this->KyThuatDAL->getListObj();
        $result = array();
        // Kiểm tra nếu danh sách không rỗng
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                // Lấy dữ liệu từ đối tượng CapDaiDTO
                $obj = array(
                    "maKyThuat" => $item->getMaKyThuat(),
                    "tenKyThuat" => $item->getTenKyThuat(),

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
    $check = new KyThuatBLL();

    $function = $_POST['function'] ?? '';
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;

    }
}