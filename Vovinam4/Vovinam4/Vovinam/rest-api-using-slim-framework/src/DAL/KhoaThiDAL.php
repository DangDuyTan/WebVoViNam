<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/KhoaThiDTO.php');

class KhoaThiDAL extends AbstractionDAL
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
        // do bảng ketquathi và ctphieudiem có tham chiếu khóa ngoại đến thuộc tính khóa maKhoaThi của bảng khoathi
        // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa
        $check_data_KetQuaThi = "SELECT * FROM ketquathi WHERE maKhoaThi = '$code'";
        $check_data_CtPhieuDiem = "SELECT * FROM ctphieudiem WHERE maKhoaThi = '$code'";

        $result1 = $this->actionSQL->query($check_data_KetQuaThi);
        $result2 = $this->actionSQL->query($check_data_CtPhieuDiem);

        if ($result1->num_rows < 1 && $result2->num_rows < 1) {
            $string = "DELETE FROM khoathi WHERE maKhoaThi = '$code'";
            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }

    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
        if ($obj != null) {
            $code = $obj->getMaKhoaThi();
            // do bảng ketquathi và ctphieudiem có tham chiếu khóa ngoại đến thuộc tính khóa maKhoaThi của bảng khoathi
            // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa

            $check_data_KetQuaThi = "SELECT * FROM ketquathi WHERE maKhoaThi = '$code'";
            $check_data_CtPhieuDiem = "SELECT * FROM ctphieudiem WHERE maKhoaThi = '$code'";

            $result1 = $this->actionSQL->query($check_data_KetQuaThi);
            $result2 = $this->actionSQL->query($check_data_CtPhieuDiem);

            if ($result1->num_rows < 1 && $result2->num_rows < 1) {
                $string = "DELETE FROM khoathi WHERE maKhoaThi = '$code'";
                return $this->actionSQL->query($string);
            } else {
                return false;
            }
        }
    }

    // lấy ra mảng các đối tượng với thông tin cấp đai
    function getListObj()
    {
        // Mảng để lưu trữ các đối tượng
        $array_list = array();

        // Câu lệnh truy vấn
        $string = "
            SELECT 
                k.maKhoaThi, 
                k.tenKhoaThi, 
                k.ngayThi, 
                k.ngayKetThuc, 
                k.hienThi, 
                k.ghiChu, 
                GROUP_CONCAT(c.tenCapDai) AS dsCapDaiThi
            FROM 
                khoathi k
            LEFT JOIN 
                khoathicapdai kc ON k.maKhoaThi = kc.maKhoaThi
            LEFT JOIN 
                capdai c ON kc.maCapDai = c.maCapDai
            GROUP BY 
                k.maKhoaThi
        ";

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        // Kiểm tra số hàng được trả về
        if ($result->num_rows > 0) {
            // Lặp qua các dòng kết quả và thêm vào mảng
            while ($data = $result->fetch_assoc()) {
                $maKhoaThi = $data['maKhoaThi'];
                $tenKhoaThi = $data["tenKhoaThi"];
                $ngayThi = $data["ngayThi"];
                $ngayKetThuc = $data["ngayKetThuc"];
                $hienThi = $data["hienThi"];
                $ghiChu = $data["ghiChu"];
                $dsCapDaiThi = $data["dsCapDaiThi"]; // danh sách cấp đai

                // Tạo đối tượng KhoaThiDTO và thêm vào mảng
                $khoaThi = new KhoaThiDTO($maKhoaThi, $tenKhoaThi, $ngayThi, $ngayKetThuc, $hienThi, $ghiChu, $dsCapDaiThi);
                array_push($array_list, $khoaThi);
            }
            return $array_list;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // // lấy ra mảng các đối tượng
    // function getListObj()
    // {
    //     // Mảng để lưu trữ các đối tượng
    //     $array_list = array();

    //     // Câu lệnh truy vấn
    //     $string = 'SELECT * FROM khoathi';

    //     // Thực hiện truy vấn
    //     $result = $this->actionSQL->query($string);

    //     // Kiểm tra số hàng được trả về
    //     if ($result->num_rows > 0) {
    //         // Lặp qua các dòng kết quả và thêm vào mảng
    //         while ($data = $result->fetch_assoc()) {
    //             $maKhoaThi = $data['maKhoaThi'];
    //             $tenKhoaThi = $data["tenKhoaThi"];
    //             $ngayThi = $data["ngayThi"];
    //             $ngayKetThuc = $data["ngayKetThuc"]; // lấy giá trị từ cột ngayKetThuc
    //             $hienThi = $data["hienThi"];
    //             $ghiChu = $data["ghiChu"];
    //             $dsCapDaiThi = $data["dsCapDaiThi"]; // danh sách cấp đai

    //             // Tạo đối tượng KhoaThiDTO và thêm vào mảng
    //             $khoaThi = new KhoaThiDTO($maKhoaThi, $tenKhoaThi, $ngayThi, $ngayKetThuc, $hienThi, $ghiChu, $dsCapDaiThi);
    //             array_push($array_list, $khoaThi);
    //         }
    //         return $array_list;
    //     } else {
    //         // Trường hợp không có dữ liệu trả về
    //         return null;
    //     }
    // }

    // lấy ra một đối tượng dựa theo mã đối tượng
    function getObj($code)
    {
        // Câu lệnh truy vấn
        $string = "SELECT * FROM khoathi WHERE maKhoaThi = '$code'";

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($string);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $maKhoaThi = $data['maKhoaThi'];
            $tenKhoaThi = $data["tenKhoaThi"];
            $ngayThi = $data["ngayThi"];
            $ngayKetThuc = $data["ngayKetThuc"]; // lấy giá trị từ cột ngayKetThuc
            $hienThi = $data["hienThi"];
            $ghiChu = $data["ghiChu"];
            $dsCapDaiThi = $data["dsCapDaiThi"]; // danh sách cấp đai

            // Tạo đối tượng KhoaThiDTO và thêm vào mảng
            $khoaThi = new KhoaThiDTO($maKhoaThi, $tenKhoaThi, $ngayThi, $ngayKetThuc, $hienThi, $ghiChu, $dsCapDaiThi);
            return $khoaThi;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // thêm một đối tượng 
    // function addObj($obj)
    // {
    //     if ($obj != null) {
    //         $maKhoaThi = $obj->getMaKhoaThi();
    //         // Kiểm tra xem có bị trùng thuộc tính khóa không
    //         $check = "SELECT * FROM khoathi WHERE maKhoaThi = '$maKhoaThi'";
    //         $resultCheck = $this->actionSQL->query($check);

    //         if ($resultCheck->num_rows < 1) {
    //             $tenKhoaThi = $obj->getTenKhoaThi();
    //             $ngayThi = $obj->getNgayThi();
    //             $ngayKetThuc = $obj->getNgayKetThuc(); // lấy giá trị từ đối tượng
    //             $hienThi = $obj->getHienThi();
    //             $ghiChu = $obj->getGhiChu();
    //             $dsCapDaiThi = $obj->getDsCapDaiThi();
    //             // Câu lệnh truy vấn
    //             $string = "INSERT INTO khoathi (maKhoaThi, tenKhoaThi, ngayThi, ngayKetThuc, hienThi, ghiChu) VALUES ('$maKhoaThi', '$tenKhoaThi', '$ngayThi', '$ngayKetThuc', '$hienThi', '$ghiChu', '$dsCapDaiThi')";

    //             return $this->actionSQL->query($string);
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }


    // function addObj($obj)
    // {
    //     if ($obj != null) {
    //         $maKhoaThi = $obj->getMaKhoaThi();
    //         // Kiểm tra xem có bị trùng thuộc tính khóa không
    //         $check = "SELECT * FROM khoathi WHERE maKhoaThi = '$maKhoaThi'";
    //         $resultCheck = $this->actionSQL->query($check);

    //         if ($resultCheck->num_rows < 1) {
    //             $tenKhoaThi = $obj->getTenKhoaThi();
    //             $ngayThi = $obj->getNgayThi();
    //             $ngayKetThuc = $obj->getNgayKetThuc();
    //             $hienThi = $obj->getHienThi();
    //             $ghiChu = $obj->getGhiChu();
    //             $dsCapDaiThi = $obj->getDsCapDaiThi();

    //             // Lấy ngày hiện tại
    //             $currentDate = date('Y-m-d');

    //             // Kiểm tra điều kiện ngày
    //             if ($ngayKetThuc >= $ngayThi && $ngayThi >= $currentDate && $ngayKetThuc >= $currentDate) {
    //                 // Câu lệnh truy vấn
    //                 $string = "INSERT INTO khoathi (tenKhoaThi, ngayThi, ngayKetThuc, hienThi, ghiChu) VALUES ('$tenKhoaThi', '$ngayThi', '$ngayKetThuc', '$hienThi', '$ghiChu')";

    //                 return $this->actionSQL->query($string);
    //             } else {
    //                 // Ngày không hợp lệ
    //                 return false;
    //             }
    //         } else {
    //             // Trùng mã khóa thi
    //             return false;
    //         }
    //     } else {
    //         // Đối tượng null
    //         return false;
    //     }
    // }

    function addObj($obj)
    {
        if ($obj != null) {
            $maKhoaThi = $obj->getMaKhoaThi();
            $check = "SELECT * FROM khoathi WHERE maKhoaThi = '$maKhoaThi'";
            $resultCheck = $this->actionSQL->query($check);

            if ($resultCheck->num_rows < 1) {
                $tenKhoaThi = $obj->getTenKhoaThi();
                $ngayThi = $obj->getNgayThi();
                $ngayKetThuc = $obj->getNgayKetThuc();
                $hienThi = $obj->getHienThi();
                $ghiChu = $obj->getGhiChu();
                $dsCapDaiThi = $obj->getDsCapDaiThi();
                $currentDate = date('Y-m-d');

                if ($ngayKetThuc >= $ngayThi && $ngayThi >= $currentDate && $ngayKetThuc >= $currentDate) {
                    // Bắt đầu transaction
                    $this->actionSQL->begin_transaction(); // Sử dụng begin_transaction()

                    try {
                        $string = "INSERT INTO khoathi (tenKhoaThi, ngayThi, ngayKetThuc, hienThi, ghiChu) VALUES ('$tenKhoaThi', '$ngayThi', '$ngayKetThuc', '$hienThi', '$ghiChu')";
                        $result = $this->actionSQL->query($string);

                        if ($result) {
                            $maKhoaThiMoi = $this->actionSQL->insert_id;
                            // Chuyển đổi chuỗi dsCapDaiThi thành mảng
                            $dsCapDaiArray = explode(",", $dsCapDaiThi);

                            foreach ($dsCapDaiArray as $maCapDai) {
                                $sqlCapDai = "INSERT INTO khoathicapdai (maKhoaThi, maCapDai) VALUES ('$maKhoaThiMoi', '$maCapDai')";
                                $this->actionSQL->query($sqlCapDai);
                            }

                            $this->actionSQL->commit();
                            return true;
                        } else {
                            $this->actionSQL->rollback();
                            return false;
                        }
                    } catch (Exception $e) {
                        $this->actionSQL->rollback();
                        return false;
                    }
                } else {
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
            $maKhoaThi = $obj->getMaKhoaThi();
            $tenKhoaThi = $obj->getTenKhoaThi();
            $ngayThi = $obj->getNgayThi();
            $ngayKetThuc = $obj->getNgayKetThuc(); // lấy giá trị từ đối tượng
            $hienThi = $obj->getHienThi();
            $ghiChu = $obj->getGhiChu();
            // $dsCapDaiThi = $obj->getDsCapDaiThi();
            // Câu lệnh UPDATE
            $string = "UPDATE khoathi 
                       SET tenKhoaThi = '$tenKhoaThi', 
                           ngayThi = '$ngayThi', 
                           ngayKetThuc = '$ngayKetThuc', 
                           hienThi = '$hienThi', 
                           ghiChu = '$ghiChu'
                       
                       WHERE maKhoaThi = '$maKhoaThi'";

            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }
}


//check
// $check = new KhoaThiDAL();
// $data = $check->getListObjWithCapDai();
// print_r($data);
// foreach ($data as $obj) {
//     echo $obj . "<br>";
// }
// $check = new KhoaThiDAL();
// $khoaThi1 = new KhoaThiDTO('KT001', 'Khóa thi mùa xuân', '2024-08-01', '2024-08-02', 1, 'Ghi chú 1', 'capDaiThi1');
// $khoaThi2 = new KhoaThiDTO('KT002', 'Khóa thi mùa hè', '2024-07-28', '2024-07-29', 1, 'Ghi chú 2', 'capDaiThi2');
// $khoaThi3 = new KhoaThiDTO('KT003', 'Khóa thi mùa thu', '2024-07-27', '2024-07-28', 1, 'Ghi chú 3', 'capDaiThi3'); // không hợp lệ, ngày thi < ngày hiện tại
// // echo $check->addObj($khoaThi2);

// $result1 = $check->addObj($khoaThi1); // Nên thành công
// $result2 = $check->addObj($khoaThi2); // Nên thất bại, vì ngayKetThuc < ngayThi
// $result3 = $check->addObj($khoaThi3); // Nên thất bại, vì ngayThi < ngày hiện tại

// echo $result1 ? "Thêm KhoaThi 1 thành công" : "Thêm KhoaThi 1 thất bại";
// echo $result2 ? "Thêm KhoaThi 2 thành công" : "Thêm KhoaThi 2 thất bại";
// echo $result3 ? "Thêm KhoaThi 3 thành công" : "Thêm KhoaThi 3 thất bại";


// Khởi tạo đối tượng DAL
// $khoaThiDAL = new KhoaThiDAL();

// // Tạo đối tượng KhoaThiDTO với dữ liệu mẫu
// $maKhoaThi = 'KT001';
// $tenKhoaThiMoi = 'Khóa thi mùa thu 2024';
// $ngayThiMoi = '2024-09-10';
// $ngayKetThucMoi = '2024-09-15';
// $hienThiMoi = 1;
// $ghiChuMoi = 'Cập nhật thông tin khóa thi';

// // Tạo đối tượng DTO với dữ liệu mới
// $khoaThiUpdate = new KhoaThiDTO($maKhoaThi, $tenKhoaThiMoi, $ngayThiMoi, $ngayKetThucMoi, $hienThiMoi, $ghiChuMoi, []);

// // Gọi hàm updateObj và nhận kết quả
// $result = $khoaThiDAL->updateObj($khoaThiUpdate);

// // Kiểm tra kết quả
// if ($result) {
//     echo "Cập nhật thông tin khóa thi thành công!";
// } else {
//     echo "Cập nhật thông tin khóa thi thất bại!";
// }