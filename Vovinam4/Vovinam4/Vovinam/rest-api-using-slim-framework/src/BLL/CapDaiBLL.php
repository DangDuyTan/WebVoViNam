<?php
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');
require('../DTO/CapDaiDTO.php');
require('../DAL/CapDaiDAL.php');

class CapDaiBLL
{
    private $CapDaiDAL;
    function __construct()
    {
        $this->CapDaiDAL = new CapDaiDAL();
    }
    // Lấy danh sách
    function getList()
    {
        $arr = $this->CapDaiDAL->getListObj();
        $result = array();
        // Kiểm tra nếu danh sách không rỗng
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                // Lấy dữ liệu từ đối tượng CapDaiDTO
                $obj = array(
                    "maCapDai" => $item->getMaCapDai(),
                    "tenCapDai" => $item->getTenCapDai(),

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
    $check = new CapDaiBLL();

    $function = $_POST['function'] ?? '';
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;

    }
}