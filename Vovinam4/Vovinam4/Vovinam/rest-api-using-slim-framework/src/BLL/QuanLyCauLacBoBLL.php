<?php

require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');
require('../DTO/CauLacBoDTO.php');
require('../DAL/CauLacBoDAL.php');

class QuanLyCauLacBoBLL
{
    private $QuanLyCauLacBoDAL;

    function __construct()
    {
        $this->QuanLyCauLacBoDAL = new CauLacBoDAL();
    }

    // Lấy danh sách câu lạc bộ
    function getList()
    {
        // Mảng dữ liệu lấy được từ DAL
        // return array("mess" => "check");
        // return array($arr);
        $arr = $this->QuanLyCauLacBoDAL->getListObj();
        $result = array();

        if (count($arr) > 0) {
            foreach ($arr as $item) {
                // Lấy dữ liệu từ đối tượng CauLacBoDTO
                $maCauLacBo = $item->getMaCauLacBo();
                $tenCauLacBo = $item->getTenCauLacBo();
                $obj = array(
                    "maCauLacBo" => $maCauLacBo,
                    "tenCauLacBo" => $tenCauLacBo,
                    "mess" => "success"
                );
                array_push($result, $obj);
            }
            return $result;
        } else {
            return array("mess" => "Failed");
        }
    }

    // Lấy một đối tượng câu lạc bộ dựa trên mã câu lạc bộ
    // function getObj($code)
    // {
    //     $result = $this->QuanLyCauLacBoDAL->getObj($code);

    //     if ($result != null) {
    //         $maCauLacBo = $result->getMaCauLacBo();
    //         $tenCauLacBo = $result->getTenCauLacBo();
    //         $obj = array(
    //             "maCauLacBo" => $maCauLacBo,
    //             "tenCauLacBo" => $tenCauLacBo,
    //             "mess" => "success"
    //         );
    //         return $obj;
    //     } else {
    //         return array("mess" => "Failed");
    //     }
    // }

    // // Thêm một đối tượng câu lạc bộ
    // function addObj($obj)
    // {
    //     if ($obj != null) {
    //         $result = $this->QuanLyCauLacBoDAL->addObj($obj);

    //         if ($result) {
    //             return array(
    //                 "maCauLacBo" => $obj->getMaCauLacBo(),
    //                 "tenCauLacBo" => $obj->getTenCauLacBo(),
    //                 "mess" => "success"
    //             );
    //         } else {
    //             return array("mess" => "Failed");
    //         }
    //     } else {
    //         return array("mess" => "Failed");
    //     }
    // }

    // // Cập nhật thông tin một câu lạc bộ
    // function updateObj($obj)
    // {
    //     if ($obj != null) {
    //         $result = $this->QuanLyCauLacBoDAL->updateObj($obj);

    //         if ($result) {
    //             return array(
    //                 "maCauLacBo" => $obj->getMaCauLacBo(),
    //                 "tenCauLacBo" => $obj->getTenCauLacBo(),
    //                 "mess" => "success"
    //             );
    //         } else {
    //             return array("mess" => "Failed");
    //         }
    //     } else {
    //         return array("mess" => "Failed");
    //     }
    // }

    // // Xóa một đối tượng câu lạc bộ theo mã câu lạc bộ
    // function deleteByID($code)
    // {
    //     $result = $this->QuanLyCauLacBoDAL->deleteByID($code);

    //     if ($result) {
    //         return array("mess" => "success");
    //     } else {
    //         return array("mess" => "Failed");
    //     }
    // }
}


header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check = new QuanLyCauLacBoBLL();

    $function = $_POST['function'];

    switch ($function) {
        case 'getList_caulacbo':
            $temp = $check->getList();
            echo json_encode($temp);
            break;
            // case 'getObj':
            //     $maCauLacBo = $_POST['maCauLacBo'];
            //     $temp = $check->getObj($maCauLacBo);
            //     echo json_encode($temp);
            //     break;
            // case 'addObj':
            //     $maCauLacBo = $_POST['maCauLacBo'];
            //     $tenCauLacBo = $_POST['tenCauLacBo'];
            //     $obj = new CauLacBoDTO($maCauLacBo, $tenCauLacBo);
            //     $temp = $check->addObj($obj);
            //     echo json_encode($temp);
            //     break;
            // case 'updateObj':
            //     $maCauLacBo = $_POST['maCauLacBo'];
            //     $tenCauLacBo = $_POST['tenCauLacBo'];
            //     $obj = new CauLacBoDTO($maCauLacBo, $tenCauLacBo);
            //     $temp = $check->updateObj($obj);
            //     echo json_encode($temp);
            //     break;
            // case 'deleteByID':
            //     $maCauLacBo = $_POST['maCauLacBo'];
            //     $temp = $check->deleteByID($maCauLacBo);
            //     echo json_encode($temp);
            //     break;
    }
}
