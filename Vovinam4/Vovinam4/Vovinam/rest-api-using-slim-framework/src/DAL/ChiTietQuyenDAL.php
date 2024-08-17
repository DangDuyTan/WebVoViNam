<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/ChiTietQuyenDTO.php');

class ChiTietQuyenDAL extends AbstractionDAL
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


    // xóa một đối tượng bởi mã đối tượng 
    function deleteByID($code)
    {
        // không có khóa chính
    }

    // xóa một đối tượng bởi mã quyền và mã chức năng
    // function deleteByID($maQuyen, $maChucNang)
    // {
    //     $string = "DELETE FROM chitietquyen WHERE maQuyen = '$maQuyen' AND maChucNang = '$maChucNang'";
    //     return $this->actionSQL->query($string);
    // }

    // xóa đối tượng theo mã codePermission
    function deleteObj_by_codePermission($maQuyen)
    {
        $query = "DELETE FROM chitietquyen WHERE maQuyen = '$maQuyen'";
        return $this->actionSQL->query($query);
    }

    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
        if ($obj != null) {
            $maQuyen = $obj->getMaQuyen();
            $maChucNang = $obj->getMaChucNang();
            $string = "DELETE FROM chitietquyen WHERE maQuyen = '$maQuyen' AND maChucNang = '$maChucNang'";
            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }

    // lấy ra mảng các đối tượng
    function getListObj()
    {
        $array_list = array();
        $query = 'SELECT * FROM chitietquyen';
        $result = $this->actionSQL->query($query);

        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $maQuyen = $data["maQuyen"];
                $maChucNang = $data["maChucNang"];
                $chucNangThem = $data["chucNangThem"];
                $chucNangSua = $data["chucNangSua"];
                $chucNangXoa = $data["chucNangXoa"];
                $chucNangTimKiem = $data["chucNangTimKiem"];
                $chamDiemDonLuyen = $data["chamDiemDonLuyen"];
                $chamDiemSongLuyen = $data["chamDiemSongLuyen"];
                $chamDiemCanBan = $data["chamDiemCanBan"];
                $chamDiemDoiKhang = $data["chamDiemDoiKhang"];
                $chamDiemTheLuc = $data["chamDiemTheLuc"];
                $chamDiemLyThuyet = $data["chamDiemLyThuyet"];

                $chiTietQuyen = new ChiTietQuyenDTO($maQuyen, $maChucNang, $chucNangThem, $chucNangSua, $chucNangXoa, $chucNangTimKiem, $chamDiemDonLuyen, $chamDiemSongLuyen, $chamDiemCanBan, $chamDiemDoiKhang, $chamDiemTheLuc, $chamDiemLyThuyet);
                array_push($array_list, $chiTietQuyen);
            }
            return $array_list;
        } else {
            return null;
        }
    }

    // lấy ra một array đối tượng dựa theo mã quyền
    function getArrByQuyen($maQuyen)
    {
        $query = "SELECT * FROM chitietquyen WHERE maQuyen = '$maQuyen'";
        $result = $this->actionSQL->query($query);

        if ($result->num_rows > 0) {
            $array = array();
            while ($data = $result->fetch_assoc()) {
                $maQuyen = $data["maQuyen"];
                $maChucNang = $data["maChucNang"];
                $chucNangThem = $data["chucNangThem"];
                $chucNangSua = $data["chucNangSua"];
                $chucNangXoa = $data["chucNangXoa"];
                $chucNangTimKiem = $data["chucNangTimKiem"];
                $chamDiemDonLuyen = $data["chamDiemDonLuyen"];
                $chamDiemSongLuyen = $data["chamDiemSongLuyen"];
                $chamDiemCanBan = $data["chamDiemCanBan"];
                $chamDiemDoiKhang = $data["chamDiemDoiKhang"];
                $chamDiemTheLuc = $data["chamDiemTheLuc"];
                $chamDiemLyThuyet = $data["chamDiemLyThuyet"];

                $chiTietQuyen = new ChiTietQuyenDTO($maQuyen, $maChucNang, $chucNangThem, $chucNangSua, $chucNangXoa, $chucNangTimKiem, $chamDiemDonLuyen, $chamDiemSongLuyen, $chamDiemCanBan, $chamDiemDoiKhang, $chamDiemTheLuc, $chamDiemLyThuyet);
                array_push($array, $chiTietQuyen);
            }
            return $array;
        } else {
            return null;
        }
    }

    // lấy ra một array đối tượng dựa theo mã đối tượng
    function getObj($code)
    {
        // bảng không có khóa chính nên không thể truy suất ra 1 đối tượng cụ thể dựa theo mã code
    }

    // lấy ra một array đối tượng dựa theo mã chức năng
    function getArrByChucNang($maChucNang)
    {
        $query = "SELECT * FROM chitietquyen WHERE maChucNang = '$maChucNang'";
        $result = $this->actionSQL->query($query);

        if ($result->num_rows > 0) {
            $array = array();
            while ($data = $result->fetch_assoc()) {
                $maQuyen = $data["maQuyen"];
                $maChucNang = $data["maChucNang"];
                $chucNangThem = $data["chucNangThem"];
                $chucNangSua = $data["chucNangSua"];
                $chucNangXoa = $data["chucNangXoa"];
                $chucNangTimKiem = $data["chucNangTimKiem"];
                $chamDiemDonLuyen = $data["chamDiemDonLuyen"];
                $chamDiemSongLuyen = $data["chamDiemSongLuyen"];
                $chamDiemCanBan = $data["chamDiemCanBan"];
                $chamDiemDoiKhang = $data["chamDiemDoiKhang"];
                $chamDiemTheLuc = $data["chamDiemTheLuc"];
                $chamDiemLyThuyet = $data["chamDiemLyThuyet"];

                $chiTietQuyen = new ChiTietQuyenDTO($maQuyen, $maChucNang, $chucNangThem, $chucNangSua, $chucNangXoa, $chucNangTimKiem, $chamDiemDonLuyen, $chamDiemSongLuyen, $chamDiemCanBan, $chamDiemDoiKhang, $chamDiemTheLuc, $chamDiemLyThuyet);
                array_push($array, $chiTietQuyen);
            }
            return $array;
        } else {
            return null;
        }
    }

    // thêm một đối tượng 
    function addObj($obj)
    {
        if ($obj != null) {
            $maQuyen = $obj->getMaQuyen();
            $maChucNang = $obj->getMaChucNang();
            $check = "SELECT * FROM chitietquyen WHERE maQuyen = '$maQuyen' AND maChucNang = '$maChucNang'";
            $resultCheck = $this->actionSQL->query($check);

            if ($resultCheck->num_rows < 1) {
                $chucNangThem = $obj->getChucNangThem();
                $chucNangSua = $obj->getChucNangSua();
                $chucNangXoa = $obj->getChucNangXoa();
                $chucNangTimKiem = $obj->getChucNangTimKiem();
                $chamDiemDonLuyen = $obj->getChamDiemDonLuyen();
                $chamDiemSongLuyen = $obj->getChamDiemSongLuyen();
                $chamDiemCanBan = $obj->getChamDiemCanBan();
                $chamDiemDoiKhang = $obj->getChamDiemDoiKhang();
                $chamDiemTheLuc = $obj->getChamDiemTheLuc();
                $chamDiemLyThuyet = $obj->getChamDiemLyThuyet();

                $query = "INSERT INTO chitietquyen (maQuyen, maChucNang, chucNangThem, chucNangSua, chucNangXoa, chucNangTimKiem, chamDiemDonLuyen, chamDiemSongLuyen, chamDiemCanBan, chamDiemDoiKhang, chamDiemTheLuc, chamDiemLyThuyet) VALUES ('$maQuyen', '$maChucNang', '$chucNangThem', '$chucNangSua', '$chucNangXoa', '$chucNangTimKiem', '$chamDiemDonLuyen', '$chamDiemSongLuyen', '$chamDiemCanBan', '$chamDiemDoiKhang', '$chamDiemTheLuc', '$chamDiemLyThuyet')";

                return $this->actionSQL->query($query);
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
            $maQuyen = $obj->getMaQuyen();
            $maChucNang = $obj->getMaChucNang();
            $chucNangThem = $obj->getChucNangThem();
            $chucNangSua = $obj->getChucNangSua();
            $chucNangXoa = $obj->getChucNangXoa();
            $chucNangTimKiem = $obj->getChucNangTimKiem();
            $chamDiemDonLuyen = $obj->getChamDiemDonLuyen();
            $chamDiemSongLuyen = $obj->getChamDiemSongLuyen();
            $chamDiemCanBan = $obj->getChamDiemCanBan();
            $chamDiemDoiKhang = $obj->getChamDiemDoiKhang();
            $chamDiemTheLuc = $obj->getChamDiemTheLuc();
            $chamDiemLyThuyet = $obj->getChamDiemLyThuyet();

            $query = "UPDATE chitietquyen 
                      SET chucNangThem = '$chucNangThem', 
                          chucNangSua = '$chucNangSua', 
                          chucNangXoa = '$chucNangXoa', 
                          chucNangTimKiem = '$chucNangTimKiem',
                          chamDiemDonLuyen = '$chamDiemDonLuyen',
                          chamDiemSongLuyen = '$chamDiemSongLuyen',
                          chamDiemCanBan = '$chamDiemCanBan',
                          chamDiemDoiKhang = '$chamDiemDoiKhang',
                          chamDiemTheLuc = '$chamDiemTheLuc',
                          chamDiemLyThuyet = '$chamDiemLyThuyet'
                      WHERE maQuyen = '$maQuyen' AND maChucNang = '$maChucNang'";

            return $this->actionSQL->query($query);
        } else {
            return false;
        }
    }
}


//check

// $check = new ChiTietQuyenDAL();
// $data = $check->getListObj();

// print_r($data);
// foreach ($data as $obj) {
//     echo $obj . "<br>";
// }

// check

// $check = new ChiTietQuyenDAL();
// $chiTietQuyen = new ChiTietQuyenDTO('ss', 'quanlyketquathi', 1, 1, 0, 0, 1, 0, 1, 1, 0, 1);

// echo $check->addObj($chiTietQuyen);
// echo $check->delete($chiTietQuyen); 