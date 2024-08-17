<?php

// import
//require('../DAL/AbstractionDAL.php');
//require('../DTO/GiamKhaoDTO.php');

class MSinhDkiThiDAL extends AbstracGiamKhaoDAL
{
    private $actionSQL = null;

    public function __construct()
    {
        parent::__construct();
        $this->actionSQL = parent::getConn();
        $this->createView();
    }

    private function createView()
    {
        $query = "CREATE OR REPLACE VIEW MonSinhCauLacBo AS
                  SELECT ms.maMonSinh, ms.hoTen, ms.maThe, clb.tenCauLacBo , clb.maCauLacBo
                  FROM monsinh ms
                  JOIN caulacbo clb ON ms.maCauLacBo = clb.maCauLacBo";
        $this->actionSQL->query($query);
    }
    function getListObj()
    {
        $string = "SELECT 
                        kt.maKhoaThi,
                        cd.maCapDai,
                        kt.ghiChu,
                        kt.ngayThi,
                        kt.ngayKetThuc,
                        kt.tenKhoaThi,
                        cd.tenCapDai
                    FROM khoathicapdai ktcd
                    JOIN khoathi kt ON ktcd.maKhoaThi = kt.maKhoaThi
                    JOIN capdai cd ON ktcd.maCapDai = cd.maCapDai                                         
                    ORDER BY kt.ngayThi";
        $array_list = array();
        $result = $this->actionSQL->query($string);
        if ($result === false) {
            die("Error executing query: " . $this->actionSQL->error);
        }
        while ($data = $result->fetch_assoc()) {
            $DSKTCD = new MSinhDkiThiDTO(
                $data['maCapDai'],
                $data['tenCapDai'],
                $data['maKhoaThi'],
                $data['tenKhoaThi'],
                $data['ngayThi'],
                $data['ngayKetThuc'],
                $data['ghiChu']
            );
            $array_list[] = $DSKTCD;
        }
        return $array_list;
    }
    
    // sửa một đối tượng
    function updateObj($obj)
    {
        if ($obj != null) {
            $maCTPhieuDiem = $obj->getMaCTPhieuDiem();
            $ThuocBai = $obj->getThuocBai();
            $NhanhManh = $obj->getNhanhManh();
            $TanPhap = $obj->getTanPhap(); // lấy giá trị từ đối tượng
            $ThuyetPhuc = $obj->getThuyetPhuc();
            $GhiChu = $obj->getGhiChu();
            // Tính tổng điểm
            $Diem = $ThuocBai + $NhanhManh + $TanPhap + $ThuyetPhuc;
            // Xác định giá trị của KetQua
            $KetQua = $Diem >= 5 ? 1 : 0;
            // Câu lệnh UPDATE
            $string = "UPDATE ctphieudiem 
                       SET ThuocBai = '$ThuocBai', 
                           NhanhManh = '$NhanhManh', 
                           TanPhap = '$TanPhap', 
                           ThuyetPhuc = '$ThuyetPhuc', 
                            Diem = '$Diem',
                            KetQua = '$KetQua',
                           GhiChu = '$GhiChu'                       
                       WHERE maCTPhieuDiem = '$maCTPhieuDiem'";
            return $this->actionSQL->query($string);
        } else {
            return false;
        }
    }    

    function getSelect() {
        $queryKhoaThi = "SELECT maKhoaThi, tenKhoaThi FROM khoathi";
        $queryCapDai = "SELECT maCapDai, tenCapDai FROM capdai";
        $queryPhanThi = "SELECT maKyThuat, tenKyThuat FROM kythuat";
        $queryCLB = "SELECT maCauLacBo, tenCauLacBo FROM caulacbo";
        $stmtKhoaThi = $this->conn->query($queryKhoaThi);
        $stmtCapDai = $this->conn->query($queryCapDai);
        $stmtPhanThi = $this->conn->query($queryPhanThi);
        $stmtCLB = $this->conn->query($queryCLB);
        return [
            'khoaThi' => $stmtKhoaThi->fetch_all(MYSQLI_ASSOC),
            'capDai' => $stmtCapDai->fetch_all(MYSQLI_ASSOC),
            'phanThi' => $stmtPhanThi->fetch_all(MYSQLI_ASSOC),
            'CauLacBo' => $stmtCLB->fetch_all(MYSQLI_ASSOC)
        ];
    }    
}


