<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/TransportDTO.php');

class SelectDAL extends AbstractionDAL
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


    // Lấy ra mảng các đối tượng
    function getListObj()
    {
        // Mảng để lưu trữ dữ liệu
        $result = array(
            "capDai" => array(),
            "khoaThi" => array(),
            "phanThi" => array(),
            "cauLacBo" => array(),
            "mess" => "success"
        );

        // Câu lệnh truy vấn cho từng bảng
        $queryCapDai = 'SELECT maCapDai, tenCapDai FROM capdai';
        $queryKhoaThi = 'SELECT maKhoaThi, tenKhoaThi FROM khoathi';
        $queryKyThuat = 'SELECT maKyThuat, tenKyThuat FROM kythuat';
        $queryCauLacBo = 'SELECT maCauLacBo, tenCauLacBo FROM caulacbo';

        // Thực hiện truy vấn cho bảng capdai
        $resultCapDai = $this->actionSQL->query($queryCapDai);
        if ($resultCapDai->num_rows > 0) {
            while ($data = $resultCapDai->fetch_assoc()) {
                $result['capDai'][] = array(
                    "maCapDai" => $data['maCapDai'],
                    "tenCapDai" => $data['tenCapDai']
                );
            }
        }

        // Thực hiện truy vấn cho bảng khoathi
        $resultKhoaThi = $this->actionSQL->query($queryKhoaThi);
        if ($resultKhoaThi->num_rows > 0) {
            while ($data = $resultKhoaThi->fetch_assoc()) {
                $result['khoaThi'][] = array(
                    "maKhoaThi" => $data['maKhoaThi'],
                    "tenKhoaThi" => $data['tenKhoaThi']
                );
            }
        }

        // Thực hiện truy vấn cho bảng kythuat
        $resultKyThuat = $this->actionSQL->query($queryKyThuat);
        if ($resultKyThuat->num_rows > 0) {
            while ($data = $resultKyThuat->fetch_assoc()) {
                $result['phanThi'][] = array(
                    "maKyThuat" => $data['maKyThuat'],
                    "tenKyThuat" => $data['tenKyThuat']
                );
            }
        }

        // Thực hiện truy vấn cho bảng caulacbo
        $resultCauLacBo = $this->actionSQL->query($queryCauLacBo);
        if ($resultCauLacBo->num_rows > 0) {
            while ($data = $resultCauLacBo->fetch_assoc()) {
                $result['cauLacBo'][] = array(
                    "maCauLacBo" => $data['maCauLacBo'],
                    "tenCauLacBo" => $data['tenCauLacBo']
                );
            }
        }
        // Trả về dữ liệu dưới dạng JSON
        $json = json_encode($result);
        // Thêm dòng này để kiểm tra trực tiếp kết quả JSON trả về
        echo $json;
        return $json;
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
