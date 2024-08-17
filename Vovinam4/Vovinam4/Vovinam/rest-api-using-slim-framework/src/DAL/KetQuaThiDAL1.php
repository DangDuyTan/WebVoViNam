<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/KetQuaThiDTO.php');

class KetQuaThiDAL extends AbstractionDAL
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
        // do bảng ctphieudiem có tham chiếu khóa ngoại đến thuộc tính khóa maKetQuaThi của bảng ketquathi
        // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa
        $check_data_CtPhieuDiem = "SELECT * FROM ctphieudiem WHERE maKetQuaThi = '$code'";

        $result = $this->actionSQL->query($check_data_CtPhieuDiem);

        if ($result->num_rows < 1) {
            $string = "DELETE FROM ketquathi WHERE maKetQuaThi = '$code'";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }

    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
        if ($obj != null) {
            $code = $obj->getMaKetQuaThi();
            // do bảng ctphieudiem có tham chiếu khóa ngoại đến thuộc tính khóa maKetQuaThi của bảng ketquathi
            // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa
            $check_data_CtPhieuDiem = "SELECT * FROM ctphieudiem WHERE maKetQuaThi = '$code'";

            $result = $this->actionSQL->query($check_data_CtPhieuDiem);

            if ($result->num_rows < 1) {
                $string = "DELETE FROM ketquathi WHERE maKetQuaThi = '$code'";

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
        $string = 'SELECT * FROM ketquathi';

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            // Lặp qua các dòng kết quả và thêm vào mảng
            while ($data = $result->fetch_assoc()) {
                $maKetQuaThi = $data['maKetQuaThi'];
                $maMonSinh = $data["maMonSinh"];
                $maKhoaThi = $data["maKhoaThi"];
                $capDaiHienTai = $data["capDaiHienTai"];
                $capDaiDuThi = $data["capDaiDuThi"];
                $ketQua = $data["ketQua"];
                $trangThaiHoSo = $data["trangThaiHoSo"];
                $ghiChu = $data["ghiChu"];
                $ngayCham = $data["ngayCham"];

                // Tạo đối tượng KetQuaThiDTO và thêm vào mảng
                $ketQuaThi = new KetQuaThiDTO($maKetQuaThi, $maMonSinh, $maKhoaThi, $capDaiHienTai, $capDaiDuThi, $ketQua, $trangThaiHoSo, $ghiChu, $ngayCham);
                array_push($array_list, $ketQuaThi);
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
        $string = "SELECT * FROM ketquathi WHERE maKetQuaThi = '$code'";

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $maKetQuaThi = $data['maKetQuaThi'];
            $maMonSinh = $data["maMonSinh"];
            $maKhoaThi = $data["maKhoaThi"];
            $capDaiHienTai = $data["capDaiHienTai"];
            $capDaiDuThi = $data["capDaiDuThi"];
            $ketQua = $data["ketQua"];
            $trangThaiHoSo = $data["trangThaiHoSo"];
            $ghiChu = $data["ghiChu"];
            $ngayCham = $data["ngayCham"];

            // Tạo đối tượng KetQuaThiDTO và trả về
            $ketQuaThi = new KetQuaThiDTO($maKetQuaThi, $maMonSinh, $maKhoaThi, $capDaiHienTai, $capDaiDuThi, $ketQua, $trangThaiHoSo, $ghiChu, $ngayCham);
            return $ketQuaThi;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // thêm một đối tượng 
    function addObj($obj)
    {
        if ($obj != null) {
            $maKetQuaThi = $obj->getMaKetQuaThi();
            // Kiểm tra xem có bị trùng thuộc tính khóa không
            $check = "SELECT * FROM ketquathi WHERE maKetQuaThi = '$maKetQuaThi'";
            $resultCheck = $this->actionSQL->query($check);

            if ($resultCheck->num_rows < 1) {
                $maMonSinh = $obj->getMaMonSinh();
                $maKhoaThi = $obj->getMaKhoaThi();
                $capDaiHienTai = $obj->getCapDaiHienTai();
                $capDaiDuThi = $obj->getCapDaiDuThi();
                $ketQua = $obj->getKetQua();
                $trangThaiHoSo = $obj->getTrangThaiHoSo();
                $ghiChu = $obj->getGhiChu();
                $ngayCham = $obj->getNgayCham();
                $fileDuThi = $obj->getFileDuThi();
                // Câu lệnh truy vấn
                $string = "INSERT INTO ketquathi (maKetQuaThi, maMonSinh, maKhoaThi, capDaiHienTai, capDaiDuThi, ketQua, trangThaiHoSo, ghiChu, , fileDuThi) 
                           VALUES ('$maKetQuaThi', '$maMonSinh', '$maKhoaThi', '$capDaiHienTai', '$capDaiDuThi', '$ketQua', '$trangThaiHoSo', '$ghiChu', '$ngayCham', '$fileDuThi')";

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
            $maKetQuaThi = $obj->getMaKetQuaThi();
            $maMonSinh = $obj->getMaMonSinh();
            $maKhoaThi = $obj->getMaKhoaThi();
            $capDaiHienTai = $obj->getCapDaiHienTai();
            $capDaiDuThi = $obj->getCapDaiDuThi();
            $ketQua = $obj->getKetQua();
            $trangThaiHoSo = $obj->getTrangThaiHoSo();
            $ghiChu = $obj->getGhiChu();
            $ngayCham = $obj->getNgayCham();

            // Câu lệnh UPDATE
            $string = "UPDATE ketquathi 
                       SET maMonSinh = '$maMonSinh', 
                           maKhoaThi = '$maKhoaThi', 
                           capDaiHienTai = '$capDaiHienTai', 
                           capDaiDuThi = '$capDaiDuThi', 
                           ketQua = '$ketQua', 
                           trangThaiHoSo = '$trangThaiHoSo', 
                           ghiChu = '$ghiChu', 
                           ngayCham = '$ngayCham'
                       WHERE maKetQuaThi = '$maKetQuaThi'";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }
}
