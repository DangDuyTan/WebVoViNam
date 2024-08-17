<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/QuyenDTO.php');

class QuyenDAL extends AbstractionDAL
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
    function deleteByID($maQuyen)
    {
        // kiểm tra bảng taikhoan có tham chiếu đến mã quyền không
        $check_data_TaiKhoan = "SELECT * FROM taikhoan WHERE maQuyen = '$maQuyen'";
        $resutl_1 = $this->actionSQL->query($check_data_TaiKhoan);

        // nếu không có tham chiếu nào, thực hiện xóa
        if ($resutl_1->num_rows < 1) {
            // xóa trong bảng chitietquyen trước
            $string1 = "DELETE FROM chitietquyen WHERE maQuyen = '$maQuyen'";

            // xóa trong bảng quyen
            $string2 = "DELETE FROM quyen WHERE maQuyen = '$maQuyen'";

            $resutl1 = $this->actionSQL->query($string1);
            $resutl2 = $this->actionSQL->query($string2);

            return $resutl1 && $resutl2;
        } else {
            return false;
        }
    }

    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
        if ($obj != null) {
            $maQuyen = $obj->getMaQuyen();

            // kiểm tra bảng taikhoan có tham chiếu đến mã quyền không
            $check_data_TaiKhoan = "SELECT * FROM taikhoan WHERE maQuyen = '$maQuyen'";
            $resutl_1 = $this->actionSQL->query($check_data_TaiKhoan);

            // nếu không có tham chiếu nào, thực hiện xóa
            if ($resutl_1->num_rows < 1) {
                // xóa trong bảng chitietquyen trước
                $string1 = "DELETE FROM chitietquyen WHERE maQuyen = '$maQuyen'";

                // xóa trong bảng quyen
                $string2 = "DELETE FROM quyen WHERE maQuyen = '$maQuyen'";

                $resutl1 = $this->actionSQL->query($string1);
                $resutl2 = $this->actionSQL->query($string2);

                return $resutl1 && $resutl2;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // lấy ra mảng các đối tượng
    function getListObj()
    {
        // Mảng chứa các đối tượng
        $quyen_list = array();

        // Câu lệnh truy vấn
        $query = 'SELECT * FROM quyen';

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($query);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            // Lấy dữ liệu và đưa vào mảng
            while ($data = $result->fetch_assoc()) {
                $maQuyen = $data["maQuyen"];
                $tenQuyen = $data["tenQuyen"];

                // Tạo đối tượng QuyenDTO và thêm vào mảng
                $quyen = new QuyenDTO($maQuyen, $tenQuyen);
                array_push($quyen_list, $quyen);
            }
            return $quyen_list;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // lấy ra một đối tượng dựa theo mã đối tượng
    function getObj($maQuyen)
    {
        // Câu lệnh truy vấn
        $query = "SELECT * FROM quyen WHERE maQuyen = '$maQuyen'";

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($query);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $maQuyen = $data["maQuyen"];
            $tenQuyen = $data["tenQuyen"];

            // Tạo đối tượng QuyenDTO và trả về
            $quyen = new QuyenDTO($maQuyen, $tenQuyen);
            return $quyen;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // thêm một đối tượng 
    function addObj($obj)
    {
        if ($obj != null) {
            // Lấy các thuộc tính từ đối tượng
            $maQuyen = $obj->getMaQuyen();
            $tenQuyen = $obj->getTenQuyen();

            // Kiểm tra xem mã quyền đã tồn tại trong cơ sở dữ liệu chưa
            $checkQuery = "SELECT * FROM quyen WHERE maQuyen = '$maQuyen'";
            $resultCheck = $this->actionSQL->query($checkQuery);

            // Nếu đối tượng không rỗng và mã quyền chưa tồn tại
            if ($obj != null && $resultCheck->num_rows < 1) {
                // Câu lệnh truy vấn để thêm đối tượng vào bảng quyen
                $insertQuery = "INSERT INTO quyen (maQuyen, tenQuyen) VALUES ('$maQuyen', '$tenQuyen')";

                // Thực hiện truy vấn
                return $this->actionSQL->query($insertQuery);
            } else {
                // Trả về false nếu đối tượng rỗng hoặc mã quyền đã tồn tại
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
            // Lấy các thuộc tính từ đối tượng
            $maQuyen = $obj->getMaQuyen();
            $tenQuyen = $obj->getTenQuyen();

            // Câu lệnh UPDATE
            $query = "UPDATE quyen 
                               SET tenQuyen = '$tenQuyen' 
                               WHERE maQuyen = '$maQuyen'";

            // Thực hiện truy vấn
            return $this->actionSQL->query($query);
        } else {
            // Trả về false nếu đối tượng rỗng
            return false;
        }
    }
}

//check

// $check = new QuyenDAL();
// $quyen = new QuyenDTO('quyen3', 'Quyen Test');
// echo $check->addObj($quyen);

// // // $data = $check->getListObj();

// // // print_r($data);
// // // foreach ($data as $obj) {
// // //     echo $obj . "<br>";
// // // }

// // // $dataobj = $check->getObj('quyen1');
// // // echo $dataobj->getMaQuyen();

// $quyen = new QuyenDTO('quyen3', 'Quyen Test');
// echo $check->addObj($quyen);

// // echo $check->updateObj($quyen);

// echo $check->deleteByID('quyen2');
// echo $check->delete($quyen);