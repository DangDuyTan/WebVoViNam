<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/CauLacBoDTO.php');

class CauLacBoDAL extends AbstractionDAL
{

    private $actionSQL = null;
    public function __construct()
    {
        parent::__construct();
        $this->actionSQL = parent::getConn();
    }

    // xóa một đối tượng bởi mã đối tượng 
    public function deleteByID($code)
    {
        // Bước 1: Xóa dữ liệu từ bảng caulacbo
        $query = "DELETE FROM caulacbo WHERE maCauLacBo = '$code'";
        $result = $this->actionSQL->query($query);

        return $result;
    }

    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
        if ($obj != null) {
            $code = $obj->getMaCauLacBo();
            return $this->deleteByID($code);
        } else {
            return false;
        }
    }

    // lấy ra mảng các đối tượng
    function getListObj()
    {
        // array return
        $array_list = array();
        // câu lệnh truy vấn
        $string = 'SELECT * FROM caulacbo';

        // thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            // Lấy dữ liệu và đưa vào mảng
            while ($data = $result->fetch_assoc()) {
                $maCauLacBo = $data["maCauLacBo"];
                $tenCauLacBo = $data["tenCauLacBo"];
                $cauLacBo = new CauLacBoDTO($maCauLacBo, $tenCauLacBo);
                array_push($array_list, $cauLacBo);
            }
            return $array_list;
        } else {
            return null;
        }
    }

    // lấy ra một đối tượng dựa theo mã đối tượng
    function getObj($code)
    {
        // cau lenh truy vấn
        $string = "SELECT * FROM caulacbo WHERE maCauLacBo = '$code'";
        // thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $maCauLacBo = $data["maCauLacBo"];
            $tenCauLacBo = $data["tenCauLacBo"];

            $cauLacBo = new CauLacBoDTO($maCauLacBo, $tenCauLacBo);

            return $cauLacBo;
        } else {
            return null;
        }
    }

    // thêm một đối tượng 
    function addObj($obj)
    {
        if ($obj != null) {
            $tenCauLacBo = $obj->getTenCauLacBo();

            // cau lenh truy vấn
            $string = "INSERT INTO caulacbo (tenCauLacBo) VALUES ('$tenCauLacBo')";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }

    // sửa một đối tượng
    function updateObj($obj)
    {
        if ($obj != null) {
            $maCauLacBo = $obj->getMaCauLacBo();
            $tenCauLacBo = $obj->getTenCauLacBo();
            // Câu lệnh UPDATE
            $string = "UPDATE caulacbo 
                    SET tenCauLacBo = '$tenCauLacBo'
                    WHERE maCauLacBo = '$maCauLacBo'";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }
}

// check
// $check = new CauLacBoDAL();
// $data = $check->getListObj();
// print_r($data);
// foreach ($data as $obj) {
//     echo $obj . "<br>";
// }