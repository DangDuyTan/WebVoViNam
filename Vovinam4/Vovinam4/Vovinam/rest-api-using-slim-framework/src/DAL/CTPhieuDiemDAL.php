<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/CTPhieuDiemDTO.php');

class CTPhieuDiemDAL extends AbstractionDAL
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
        $string = "DELETE FROM CTPhieuDiem WHERE maCTPhieuDiem = '$code'";

        return $this->actionSQL->query($string);
    }

    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
        if ($obj != null) {
            $code = $obj->getMaCTPhieuDiem();
            $string = "DELETE FROM CTPhieuDiem WHERE maCTPhieuDiem = '$code'";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }

    // lấy ra mảng các đối tượng
    function getListObj()
    {
        // Mảng để lưu trữ các đối tượng
        $array_list = array();

        // Câu lệnh truy vấn
        $string = 'SELECT * FROM CTPhieuDiem';

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            // Lặp qua các dòng kết quả và thêm vào mảng
            while ($data = $result->fetch_assoc()) {
                $maCTPhieuDiem = $data['maCTPhieuDiem'];
                $maKetQuaThi = $data["maKetQuaThi"];
                $maKhoaThi = $data["maKhoaThi"];
                $maCapDai = $data["maCapDai"];
                $maKyThuat = $data["maKyThuat"];
                $maMonSinh = $data["maMonSinh"];
                $ThuocBai = $data["ThuocBai"];
                $NhanhManh = $data["NhanhManh"];
                $TanPhap = $data["TanPhap"];
                $ThuyetPhuc = $data["ThuyetPhuc"];
                $Diem = $data["Diem"];
                $KetQua = $data["KetQua"];
                $GiamKhaoCham = $data["GiamKhaoCham"];
                $GhiChu = $data["GhiChu"];

                // Tạo đối tượng CTPhieuDiemDTO và thêm vào mảng
                $CTPhieuDiem = new CTPhieuDiemDTO($maCTPhieuDiem, $maKetQuaThi, $maKhoaThi, $maCapDai, $maKyThuat, $maMonSinh, $ThuocBai, $NhanhManh, $TanPhap, $ThuyetPhuc, $Diem, $KetQua, $GiamKhaoCham, $GhiChu);
                array_push($array_list, $CTPhieuDiem);
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
        $string = "SELECT * FROM CTPhieuDiem WHERE maCTPhieuDiem = '$code'";

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $maCTPhieuDiem = $data['maCTPhieuDiem'];
            $maKetQuaThi = $data["maKetQuaThi"];
            $maKhoaThi = $data["maKhoaThi"];
            $maCapDai = $data["maCapDai"];
            $maKyThuat = $data["maKyThuat"];
            $maMonSinh = $data["maMonSinh"];
            $ThuocBai = $data["ThuocBai"];
            $NhanhManh = $data["NhanhManh"];
            $TanPhap = $data["TanPhap"];
            $ThuyetPhuc = $data["ThuyetPhuc"];
            $Diem = $data["Diem"];
            $KetQua = $data["KetQua"];
            $GiamKhaoCham = $data["GiamKhaoCham"];
            $GhiChu = $data["GhiChu"];

            // Tạo đối tượng CTPhieuDiemDTO và trả về
            $CTPhieuDiem = new CTPhieuDiemDTO($maCTPhieuDiem, $maKetQuaThi, $maKhoaThi, $maCapDai, $maKyThuat, $maMonSinh, $ThuocBai, $NhanhManh, $TanPhap, $ThuyetPhuc, $Diem, $KetQua, $GiamKhaoCham, $GhiChu);
            return $CTPhieuDiem;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // thêm một đối tượng 
    function addObj($obj)
    {
        if ($obj != null) {
            $maCTPhieuDiem = $obj->getMaCTPhieuDiem();
            // Kiểm tra xem có bị trùng thuộc tính khóa không
            $check = "SELECT * FROM CTPhieuDiem WHERE maCTPhieuDiem = '$maCTPhieuDiem'";
            $resultCheck = $this->actionSQL->query($check);

            if ($resultCheck->num_rows < 1) {
                $maKetQuaThi = $obj->getMaKetQuaThi();
                $maKhoaThi = $obj->getMaKhoaThi();
                $maCapDai = $obj->getMaCapDai();
                $maKyThuat = $obj->getMaKyThuat();
                $maMonSinh = $obj->getMaMonSinh();
                $ThuocBai = $obj->getThuocBai();
                $NhanhManh = $obj->getNhanhManh();
                $TanPhap = $obj->getTanPhap();
                $ThuyetPhuc = $obj->getThuyetPhuc();
                $Diem = $obj->getDiem();
                $KetQua = $obj->getKetQua();
                $GiamKhaoCham = $obj->getGiamKhaoCham();
                $GhiChu = $obj->getGhiChu();

                // Câu lệnh truy vấn
                $string = "INSERT INTO CTPhieuDiem (maCTPhieuDiem, maKetQuaThi, maKhoaThi, maCapDai, maKyThuat, maMonSinh, ThuocBai, NhanhManh, TanPhap, ThuyetPhuc, Diem, KetQua, GiamKhaoCham, GhiChu) 
                           VALUES ('$maCTPhieuDiem', '$maKetQuaThi', '$maKhoaThi', '$maCapDai', '$maKyThuat', '$maMonSinh', '$ThuocBai', '$NhanhManh', '$TanPhap', '$ThuyetPhuc', '$Diem', '$KetQua', '$GiamKhaoCham', '$GhiChu')";

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
            $maCTPhieuDiem = $obj->getMaCTPhieuDiem();
            $maKetQuaThi = $obj->getMaKetQuaThi();
            $maKhoaThi = $obj->getMaKhoaThi();
            $maCapDai = $obj->getMaCapDai();
            $maKyThuat = $obj->getMaKyThuat();
            $maMonSinh = $obj->getMaMonSinh();
            $ThuocBai = $obj->getThuocBai();
            $NhanhManh = $obj->getNhanhManh();
            $TanPhap = $obj->getTanPhap();
            $ThuyetPhuc = $obj->getThuyetPhuc();
            $Diem = $obj->getDiem();
            $KetQua = $obj->getKetQua();
            $GiamKhaoCham = $obj->getGiamKhaoCham();
            $GhiChu = $obj->getGhiChu();

            // Câu lệnh UPDATE
            $string = "UPDATE CTPhieuDiem 
                       SET maKetQuaThi = '$maKetQuaThi', 
                           maKhoaThi = '$maKhoaThi', 
                           maCapDai = '$maCapDai', 
                           maKyThuat = '$maKyThuat', 
                           maMonSinh = '$maMonSinh', 
                           ThuocBai = '$ThuocBai', 
                           NhanhManh = '$NhanhManh', 
                           TanPhap = '$TanPhap', 
                           ThuyetPhuc = '$ThuyetPhuc', 
                           Diem = '$Diem', 
                           KetQua = '$KetQua', 
                           GiamKhaoCham = '$GiamKhaoCham', 
                           GhiChu = '$GhiChu' 
                       WHERE maCTPhieuDiem = '$maCTPhieuDiem'";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }
}
