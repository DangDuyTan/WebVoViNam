<?php

// import
require('../DAL/AbstractionDAL.php');
require('../DTO/KetQuaThiDTO.php');

class KetQuaThiDAL extends AbstractionDAL
{
    private $actionSQL = null;

    public function __construct()
    {
        parent::__construct();
        $this->actionSQL = parent::getConn();
    }

    // xóa một đối tượng bởi mã đối tượng 
    function deleteByID($code)
    {
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
        $array_list = array();

        // Câu lệnh truy vấn để lấy tất cả các thông tin cần thiết từ các bảng
        $string = "SELECT 
                        kq.maKetQuaThi,
                        m.hoTen,
                        k.tenKhoaThi,
                        cd1.tenCapDai AS capDaiHienTai,
                        cd2.tenCapDai AS capDaiDuThi,
                        kq.ketQua,
                        kq.trangThaiHoSo,
                        kq.ghiChu,
                        kq.ngayCham,
                        kq.fileDuThi
                   FROM ketquathi kq
                   JOIN monsinh m ON kq.maMonSinh = m.maMonSinh
                   JOIN khoathi k ON kq.maKhoaThi = k.maKhoaThi
                   JOIN capdai cd1 ON kq.capDaiHienTai = cd1.maCapDai
                   JOIN capdai cd2 ON kq.capDaiDuThi = cd2.maCapDai";

        $result = $this->actionSQL->query($string);

        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $maKetQuaThi = $data['maKetQuaThi'];
                $maMonSinh = $data['hoTen'];
                $maKhoaThi = $data['tenKhoaThi'];
                $capDaiHienTai = $data['capDaiHienTai'];
                $capDaiDuThi = $data['capDaiDuThi'];
                $ketQua = $data['ketQua'];
                $trangThaiHoSo = $data['trangThaiHoSo'];
                $ghiChu = $data['ghiChu'];
                $ngayCham = $data['ngayCham'];
                $fileDuThi = $data['fileDuThi'];

                // Tạo đối tượng KetQuaThiDTO và thêm vào mảng
                $ketQuaThi = new KetQuaThiDTO($maKetQuaThi, $maMonSinh, $maKhoaThi, $capDaiHienTai, $capDaiDuThi, $ketQua, $trangThaiHoSo, $ghiChu, $ngayCham, $fileDuThi);
                array_push($array_list, $ketQuaThi);
            }
            return $array_list;
        } else {
            return null;
        }
    }

    // lấy ra một đối tượng dựa theo mã đối tượng
    function getObj($code)
    {
        $string = "SELECT 
                        kq.maKetQuaThi,
                        m.hoTen,
                        k.tenKhoaThi,
                        cd1.tenCapDai AS capDaiHienTai,
                        cd2.tenCapDai AS capDaiDuThi,
                        kq.ketQua,
                        kq.trangThaiHoSo,
                        kq.ghiChu,
                        kq.ngayCham,
                        kq.fileDuThi
                   FROM ketquathi kq
                   JOIN monsinh m ON kq.maMonSinh = m.maMonSinh
                   JOIN khoathi k ON kq.maKhoaThi = k.maKhoaThi
                   JOIN capdai cd1 ON kq.capDaiHienTai = cd1.maCapDai
                   JOIN capdai cd2 ON kq.capDaiDuThi = cd2.maCapDai
                   WHERE kq.maKetQuaThi = '$code'";

        $result = $this->actionSQL->query($string);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $maKetQuaThi = $data['maKetQuaThi'];
            $tenMonSinh = $data['hoTen'];
            $tenKhoaThi = $data['tenKhoaThi'];
            $capDaiHienTai = $data['capDaiHienTai'];
            $capDaiDuThi = $data['capDaiDuThi'];
            $ketQua = $data['ketQua'];
            $trangThaiHoSo = $data['trangThaiHoSo'];
            $ghiChu = $data['ghiChu'];
            $ngayCham = $data['ngayCham'];
            $fileDuThi = $data['fileDuThi'];
            $ketQuaThi = new KetQuaThiDTO($maKetQuaThi, $tenMonSinh, $tenKhoaThi, $capDaiHienTai, $capDaiDuThi, $ketQua, $trangThaiHoSo, $ghiChu, $ngayCham, $fileDuThi);
            return $ketQuaThi;
        } else {
            return null;
        }
    }

    // thêm một đối tượng
    // function addObj($obj)
    // {
    //     if ($obj != null) {
    //         $maKetQuaThi = $obj->getMaKetQuaThi();
    //         $check = "SELECT * FROM ketquathi WHERE maKetQuaThi = '$maKetQuaThi'";
    //         $resultCheck = $this->actionSQL->query($check);

    //         if ($resultCheck->num_rows < 1) {
    //             $maMonSinh = $obj->getMaMonSinh();
    //             $maKhoaThi = $obj->getMaKhoaThi();
    //             $capDaiHienTai = $obj->getCapDaiHienTai();
    //             $capDaiDuThi = $obj->getCapDaiDuThi();
    //             $ketQua = $obj->getKetQua();
    //             $trangThaiHoSo = $obj->getTrangThaiHoSo();
    //             $ghiChu = $obj->getGhiChu();
    //             $ngayCham = $obj->getNgayCham();

    //             $string = "INSERT INTO ketquathi (maKetQuaThi, maMonSinh, maKhoaThi, capDaiHienTai, capDaiDuThi, ketQua, trangThaiHoSo, ghiChu, ngayCham) 
    //                        VALUES ('$maKetQuaThi', '$maMonSinh', '$maKhoaThi', '$capDaiHienTai', '$capDaiDuThi', '$ketQua', '$trangThaiHoSo', '$ghiChu', '$ngayCham')";

    //             return $this->actionSQL->query($string);
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }
    function addObj($obj)
    {
        if ($obj != null) {
            $maKetQuaThi = $obj->getMaKetQuaThi();
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

                // Kiểm tra xem mã khóa thi và mã cấp đai có cùng một bộ không
                $checkKhoaThiCapDai = "SELECT * FROM khoathicapdai WHERE maKhoaThi = '$maKhoaThi' AND maCapDai = '$capDaiDuThi'";
                $resultKhoaThiCapDai = $this->actionSQL->query($checkKhoaThiCapDai);

                if ($resultKhoaThiCapDai->num_rows > 0) {
                    $string = "INSERT INTO ketquathi (maKetQuaThi, maMonSinh, maKhoaThi, capDaiHienTai, capDaiDuThi, ketQua, trangThaiHoSo, ghiChu, ngayCham, fileDuThi) 
                               VALUES ('$maKetQuaThi', '$maMonSinh', '$maKhoaThi', '$capDaiHienTai', '$capDaiDuThi', '$ketQua', '$trangThaiHoSo', '$ghiChu', '$ngayCham', '$fileDuThi')";

                    return $this->actionSQL->query($string);
                } else {
                    // Trường hợp mã khóa thi và mã cấp đai không hợp lệ
                    return false;
                }
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
            $fileDuThi = $obj->getFileDuThi();
            $string = "UPDATE ketquathi 
                       SET maMonSinh = '$maMonSinh', 
                           maKhoaThi = '$maKhoaThi', 
                           capDaiHienTai = '$capDaiHienTai', 
                           capDaiDuThi = '$capDaiDuThi', 
                           ketQua = '$ketQua', 
                           trangThaiHoSo = '$trangThaiHoSo', 
                           ghiChu = '$ghiChu', 
                           ngayCham = '$ngayCham',
                           fileDuThi = '$fileDuThi'
                       WHERE maKetQuaThi = '$maKetQuaThi'";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }


    function updateStateUser($maKetQuaThi, $trangThaiHoSo)
    {
        // $tenDangNhap_encode = base64_encode($tenDangNhap);
        // Câu lệnh UPDATE
        if ($trangThaiHoSo == '1') {
            $string = "UPDATE ketquathi 
                                SET 
                                trangThaiHoSo = '0',
                                ketQua = '0',
                                ghiChu = 'Không đạt yêu cầu'
                                WHERE maKetQuaThi = '$maKetQuaThi'";
        } else {
            $string = "UPDATE ketquathi 
                                SET 
                                trangThaiHoSo = '1',
                                ketQua = '1',
                                ghiChu = 'Đạt yêu cầu'
                                WHERE maKetQuaThi = '$maKetQuaThi'";
        }

        return $this->actionSQL->query($string);
    }
}


//check
// $check = new KetQuaThiDAL();
// $data = $check->getListObj();
// print_r($data);
// foreach ($data as $obj) {
//     echo $obj . "<br>";
// }
// $check = new KetQuaThiDAL();


// $ketQuaThiDTO = new KetQuaThiDTO(null, 5, 4, 5, 4, 1, 0, 'Ghi chú mẫu', '2024-08-01', 'kkkk');
// $ketQuaThiDAL = new KetQuaThiDAL();

// $result = $ketQuaThiDAL->addObj($ketQuaThiDTO);

// if ($result) {
//     echo "Thêm dữ liệu thành công!";
// } else {
//     echo "Không thể thêm dữ liệu!";
// }


// $check = new CauLacBoDAL();
// $data = $check->getListObj();
// // print_r($data);
// foreach ($data as $obj) {
//     echo $obj . "<br>";
// }