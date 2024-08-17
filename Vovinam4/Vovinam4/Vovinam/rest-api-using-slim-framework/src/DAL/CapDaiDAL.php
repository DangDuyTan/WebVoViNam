<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/CapDaiDTO.php');

class CapDaiDAL extends AbstractionDAL
{

    private $actionSQL = null;
    public function __construct()
    {
        parent::__construct();
        $this->actionSQL = parent::getConn();

        // if ($this->actionSQL != null) {
        //        echo 'thanh cong';
        // }
    }

    // xóa một đối tượng bởi mã đối tượng 
    public function deleteByID($code)
    {
        // Bước 1: Xóa dữ liệu từ bảng ketquathi
        $query1 = "DELETE FROM ketquathi WHERE maCapDai = '$code'";
        $result1 = $this->actionSQL->query($query1);

        // Bước 2: Xóa dữ liệu từ bảng ctphieudiem
        $query2 = "DELETE FROM ctphieudiem WHERE maCapDai = '$code'";
        $result2 = $this->actionSQL->query($query2);

        // Bước 3: Xóa dữ liệu từ bảng capdai
        $query3 = "DELETE FROM capdai WHERE maCapDai = '$code'";
        $result3 = $this->actionSQL->query($query3);

        // Kiểm tra xem các truy vấn xóa đã thành công hay không
        // Nếu cả ba truy vấn đều thành công (trả về true), thì trả về true
        // Ngược lại, trả về false
        return $result1 && $result2 && $result3;
    }


    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
        if ($obj != null) {
            $code = $obj->getMaCapDai();
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
        $string = 'SELECT * FROM capdai';

        // thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            // Lấy dữ liệu và đưa vào mảng
            while ($data = $result->fetch_assoc()) {
                $maCapDai = $data["maCapDai"];
                $tenCapDai = $data["tenCapDai"];
                $capDai = new CapDaiDTO($maCapDai, $tenCapDai);
                array_push($array_list, $capDai);
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
        $string = "SELECT * FROM capdai WHERE maCapDai = '$code'";
        // thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $maCapDai = $data["maCapDai"];
            $tenCapDai = $data["tenCapDai"];

            $capDai = new CapDaiDTO($maCapDai, $tenCapDai);

            return $capDai;
        } else {
            return null;
        }
    }
    // thêm một đối tượng 
    function addObj($obj)
    {
        if ($obj != null) {
            $maCapDai = $obj->getMaCapDai();


            // kiểm tra xem có bị trùng thuộc tính khóa không
            $check = "SELECT * FROM capdai WHERE maCapDai = '$maCapDai'";
            $resultCheck = $this->actionSQL->query($check);

            if ($resultCheck->num_rows < 1) {
                $tenCapDai = $obj->getTenCapDai();

                // cau lenh truy vấn
                $string = "INSERT INTO capdai (maCapDai, tenCapDai) VALUES ('$maCapDai', '$tenCapDai')";

                return $this->actionSQL->query($string);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // sửa một đối tượng
    function updateObj($obj)
    {
        if ($obj != null) {
            $maCapDai = $obj->getMaCapDai();
            $tenCapDai = $obj->getTenCapDai();
            // Câu lệnh UPDATE
            $string = "UPDATE capdai 
                    SET tenCapDai = '$tenCapDai'
                    WHERE maCapDai = '$maCapDai'";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }
}

// check

// $check = new TranSportDAL();

// $check->getListObj();

// print_r($check->getListObj());

// echo $check->getObj('ECO003')->getCodeTransport();

// echo $check->addObj(new TransportDTO('test', 'test', 'test'));

// echo $check->updateObj(new TransportDTO('test', 'test', '123'));

// echo $check->delete(new TransportDTO('test', 'test', '123'));


// $check = new CapDaiDAL();
// $data = $check->getListObj();
// print_r($data);
// foreach ($data as $obj) {
//     echo $obj . "<br>";
// }