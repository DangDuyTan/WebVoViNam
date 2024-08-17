<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/TransportDTO.php');

class KyThuatDAL extends AbstractionDAL
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
    function deleteByID($code)
    {
        // do bảng ctphieudiem có tham chiếu khóa ngoại đến thuộc tính khóa maKyThuat của bảng kythuat
        // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa
        $check_data_CTPhieuDiem = "SELECT * FROM ctphieudiem WHERE maKyThuat = '$code'";

        $resutl_1 = $this->actionSQL->query($check_data_CTPhieuDiem);

        if ($resutl_1->num_rows < 1) {
            $string = "DELETE FROM kythuat WHERE maKyThuat = '$code'";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }

    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
        if ($obj != null) {
            $code = $obj->getMaKyThuat();
            // do bảng ctphieudiem có tham chiếu khóa ngoại đến thuộc tính khóa maKyThuat của bảng kythuat
            // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa

            $check_data_ctphieudiem = "SELECT * FROM ctphieudiem WHERE maKyThuat = '$code'";

            $resutl_1 = $this->actionSQL->query($check_data_ctphieudiem);

            if ($resutl_1->num_rows < 1) {
                $string = "DELETE FROM kythuat WHERE maKyThuat = '$code'";

                return $this->actionSQL->query($string);
            } else {
                return false;
            }
        }
    }

    // lấy ra mảng các đối tượng
    function getListObj()
    {
        // Mảng để lưu trữ các đối tượng
        $array_list = array();

        // Câu lệnh truy vấn
        $string = 'SELECT * FROM kythuat';

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            // Lặp qua các dòng kết quả và thêm vào mảng
            while ($data = $result->fetch_assoc()) {
                $maKyThuat = $data['maKyThuat'];
                $tenKyThuat = $data["tenKyThuat"];

                // Tạo đối tượng KyThuatDTO và thêm vào mảng
                $kyThuat = new KyThuatDTO($maKyThuat, $tenKyThuat);
                array_push($array_list, $kyThuat);
            }
            return $array_list;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // lấy ra một đối tượng dựa theo mã đối tượng
    function getObj($code)
    {
        // Câu lệnh truy vấn
        $string = "SELECT * FROM kythuat WHERE maKyThuat = '$code'";

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $maKyThuat = $data['maKyThuat'];
            $tenKyThuat = $data["tenKyThuat"];

            // Tạo đối tượng KyThuatDTO và trả về
            $kyThuat = new KyThuatDTO($maKyThuat, $tenKyThuat);
            return $kyThuat;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // thêm một đối tượng 
    function addObj($obj)
    {
        if ($obj != null) {
            $maKyThuat = $obj->getMaKyThuat();
            // Kiểm tra xem có bị trùng thuộc tính khóa không
            $check = "SELECT * FROM kythuat WHERE maKyThuat = '$maKyThuat'";
            $resultCheck = $this->actionSQL->query($check);

            if ($resultCheck->num_rows < 1) {
                $tenKyThuat = $obj->getTenKyThuat();

                // Câu lệnh truy vấn
                $string = "INSERT INTO kythuat (maKyThuat, tenKyThuat) VALUES ('$maKyThuat', '$tenKyThuat')";

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
            $maKyThuat = $obj->getMaKyThuat();
            $tenKyThuat = $obj->getTenKyThuat();

            // Câu lệnh UPDATE
            $string = "UPDATE kythuat 
                       SET tenKyThuat = '$tenKyThuat'
                       WHERE maKyThuat = '$maKyThuat'";

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