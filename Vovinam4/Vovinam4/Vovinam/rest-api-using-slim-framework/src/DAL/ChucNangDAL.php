<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/ChucNangDTO.php');

class ChucNangDAL extends AbstractionDAL
{
    private $actionSQL = null;

    public function __construct()
    {
        parent::__construct();
        $this->actionSQL = parent::getConn();

        // if ($this->actionSQL != null) {
        //     echo 'thanh cong';
        // }
    }

    // xóa một đối tượng bởi mã chức năng
    function deleteByID($maChucNang)
    {
        // do bảng chitietquyen có tham chiếu khóa ngoại đến thuộc tính khóa maChucNang của bảng chucnang
        // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa
        $check_data_ChiTietQuyen = "SELECT * FROM chitietquyen WHERE maChucNang = '$maChucNang'";
        $result_1 = $this->actionSQL->query($check_data_ChiTietQuyen);

        if ($result_1->num_rows < 1) {
            $string = "DELETE FROM chucnang WHERE maChucNang = '$maChucNang'";
            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }

    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
        if ($obj != null) {
            $maChucNang = $obj->getMaChucNang();
            // do bảng chitietquyen có tham chiếu khóa ngoại đến thuộc tính khóa maChucNang của bảng chucnang
            // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa
            $check_data_Orders = "SELECT * FROM chitietquyen WHERE maChucNang = '$maChucNang'";
            $result_1 = $this->actionSQL->query($check_data_Orders);

            if ($result_1->num_rows < 1) {
                $string = "DELETE FROM chucnang WHERE maChucNang = '$maChucNang'";
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
        $string = 'SELECT * FROM chucnang';

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            // Lặp qua các dòng kết quả và thêm vào mảng
            while ($data = $result->fetch_assoc()) {
                $maChucNang = $data['maChucNang'];
                $tenChucNang = $data["tenChucNang"];

                // Tạo đối tượng ChucNangDTO và thêm vào mảng
                $chucNang = new ChucNangDTO($maChucNang, $tenChucNang);
                array_push($array_list, $chucNang);
            }
            return $array_list;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // lấy ra một đối tượng dựa theo mã chức năng
    function getObj($maChucNang)
    {
        // Câu lệnh truy vấn
        $string = "SELECT * FROM chucnang WHERE maChucNang = '$maChucNang'";

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $maChucNang = $data['maChucNang'];
            $tenChucNang = $data["tenChucNang"];

            // Tạo đối tượng ChucNangDTO và trả về
            $chucNang = new ChucNangDTO($maChucNang, $tenChucNang);
            return $chucNang;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // thêm một đối tượng 
    function addObj($obj)
    {
        if ($obj != null) {
            $maChucNang = $obj->getMaChucNang();
            // Kiểm tra xem có bị trùng thuộc tính khóa không
            $check = "SELECT * FROM chucnang WHERE maChucNang = '$maChucNang'";
            $resultCheck = $this->actionSQL->query($check);

            if ($resultCheck->num_rows < 1) {
                $tenChucNang = $obj->getTenChucNang();

                // Câu lệnh truy vấn
                $string = "INSERT INTO chucnang (maChucNang, tenChucNang) VALUES ('$maChucNang', '$tenChucNang')";

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
            $maChucNang = $obj->getMaChucNang();
            $tenChucNang = $obj->getTenChucNang();

            // Câu lệnh UPDATE
            $string = "UPDATE chucnang 
                       SET tenChucNang = '$tenChucNang'
                       WHERE maChucNang = '$maChucNang'";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }
}


//check

// $check = new ChucNangDAL();
// $data = $check->getListObj();

// print_r($data);
// foreach ($data as $obj) {
//     echo $obj . "<br>";
// }

// $check = new ChucNangDAL();
// $quyen = new ChucNangDTO('chucnangtest', 'Chuc nang test');
// echo $check->addObj($quyen);