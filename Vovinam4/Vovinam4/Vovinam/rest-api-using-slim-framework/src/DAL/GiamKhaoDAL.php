<?php

// import
//require('../DAL/AbstractionDAL.php');
//require('../DTO/GiamKhaoDTO.php');

class GiamKhaoDAL extends AbstracGiamKhaoDAL
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
                        ct.maCTPhieuDiem AS `maCTPhieuDiem`,
                        msclb.hoTen AS `hoTen`,
                        msclb.maThe AS `maThe`,
                        msclb.maCauLacBo AS `maCauLacBo`,
                        msclb.tenCauLacBo AS `tenCauLacBo`,
                        kt.maKhoaThi AS `maKhoaThi`,
                        kt.tenKhoaThi AS `tenKhoaThi`,
                        cd1.maCapDai AS `maCapDai`,
                        cd1.tenCapDai AS `tenCapDai`,
                        kt2.maKyThuat AS `maKyThuat`,
                        kt2.tenKyThuat AS `tenKyThuat`,
                        ct.ThuocBai AS `ThuocBai`,
                        ct.NhanhManh AS `NhanhManh`,
                        ct.TanPhap AS `TanPhap`,
                        ct.ThuyetPhuc AS `ThuyetPhuc`,
                        (ct.ThuocBai + ct.NhanhManh + ct.TanPhap + ct.ThuyetPhuc) AS `Diem`,
                        CASE 
                            WHEN ct.KetQua = 1 THEN 'Đạt'
                            ELSE 'Không đạt'
                        END AS `KetQua`,
                        ct.GhiChu AS `GhiChu`,
                        ct.NgayCham AS `NgayCham`,
                        ct.maMonSinh AS `maMonSinh`,
                        ct.maChiTietKetQua AS `maChiTietKetQua`,
                        ct.GiamKhaoCham AS `GiamKhaoCham`
                    FROM ctphieudiem ct
                    JOIN MonSinhCauLacBo msclb ON ct.maMonSinh = msclb.maMonSinh
                    JOIN chitietketquathi ctkq ON ct.maChiTietKetQua = ctkq.maChiTietKetQua
                    JOIN khoathi kt ON ct.maKhoaThi = kt.maKhoaThi
                    JOIN capdai cd1 ON ct.maCapDai = cd1.maCapDai
                    JOIN kythuat kt2 ON ct.maKyThuat = kt2.maKyThuat
                    
                    ORDER BY msclb.hoTen";
        $array_list = array();
        $result = $this->actionSQL->query($string);
        if ($result === false) {
            die("Error executing query: " . $this->actionSQL->error);
        }
        while ($data = $result->fetch_assoc()) {
            $CTPhieuDiem = new GiamKhaoDTO(
                $data['maCTPhieuDiem'],
                $data['maMonSinh'],
                $data['hoTen'],
                $data['maThe'],
                $data['maCauLacBo'],
                $data['tenCauLacBo'],
                $data['maKhoaThi'],
                $data['tenKhoaThi'],
                $data['maCapDai'],
                $data['tenCapDai'],
                $data['maKyThuat'],
                $data['tenKyThuat'],
                $data['ThuocBai'],
                $data['NhanhManh'],
                $data['TanPhap'],
                $data['ThuyetPhuc'],
                $data['Diem'],
                $data['KetQua'],
                $data['GiamKhaoCham'],
                $data['maChiTietKetQua'],
                $data['GhiChu'],
                $data['NgayCham'],
            );
            $array_list[] = $CTPhieuDiem;
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


