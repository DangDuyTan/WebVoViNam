<?php
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');
require('../DTO/KhoaThiDTO.php');
require('../DAL/KhoaThiDAL.php');

class KhoaThiBLL
{
    private $KhoaThiDAL;
    function __construct()
    {
        $this->KhoaThiDAL = new KhoaThiDAL();
    }
    // Lấy danh sách
    function getList()
    {
        $arr = $this->KhoaThiDAL->getListObj();
        $result = array();
        // Kiểm tra nếu danh sách không rỗng
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                // Lấy dữ liệu từ đối tượng CapDaiDTO
                $obj = array(
                    "maKhoaThi" => $item->getMaKhoaThi(),
                    "tenKhoaThi" => $item->getTenKhoaThi(),

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
    $check = new KhoaThiBLL();

    $function = $_POST['function'] ?? '';
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;

    }
}