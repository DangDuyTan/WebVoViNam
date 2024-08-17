<?php

// import
//require('../DAL/AbstractionDAL.php');
//require('../DTO/GiamKhaoDTO.php');

class DSKQuaDAL extends AbstracDSKQ
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
                        ctkt.maChiTietKetQua AS maChiTietKetQua,
                        msclb.hoTen,
                        msclb.maThe,
                        msclb.tenCauLacBo,
                        msclb.maCauLacBo,
                        kt.tenKhoaThi,
                        kt.maKhoaThi,
                        cd.tenCapDai,
                        cd.maCapDai,
                        SUM(ctpd.Diem) AS tongDiem,
                        ctkt.ghiChu AS GhiChu,
                        CASE ctkt.ketQua
                            WHEN 1 THEN 'Đạt'
                            ELSE 'Không đạt'
                        END AS KetQua,
                        ctpd.GiamKhaoCham,
                        MAX(ctpd.ngayCham) AS NgayCham
                    FROM chitietketquathi ctkt
                    
                    JOIN CTPhieuDiem ctpd ON ctkt.maChiTietKetQua = ctpd.maChiTietKetQua
                    JOIN MonSinhCauLacBo msclb ON msclb.maMonSinh = ctpd.maMonSinh
                    JOIN caulacbo clb ON msclb.maCauLacBo = clb.maCauLacBo
                    JOIN khoathi kt ON ctpd.maKhoaThi = kt.maKhoaThi
                    JOIN capdai cd ON ctpd.maCapDai = cd.maCapDai
                    GROUP BY ctpd.maChiTietKetQua, msclb.hoTen, msclb.maThe, msclb.tenCauLacBo, 
                         msclb.maCauLacBo, kt.tenKhoaThi, kt.maKhoaThi, cd.tenCapDai, 
                         cd.maCapDai, ctkt.ketQua, ctpd.GiamKhaoCham
                    ORDER BY TongDiem DESC;";
        $array_list = array();
        $result = $this->actionSQL->query($string);
        if ($result === false) {
            die("Error executing query: " . $this->actionSQL->error);
        }
        while ($data = $result->fetch_assoc()) {
            $DSKQ = new DSKQuaDTO(
                $data['maChiTietKetQua'],
                //$data['maMonSinh'],
                $data['hoTen'],
                $data['maThe'],
                $data['maCauLacBo'],
                $data['tenCauLacBo'],
                $data['maKhoaThi'],
                $data['tenKhoaThi'],
                $data['maCapDai'],
                $data['tenCapDai'],
                //$data['maKyThuat'],
                //$data['tenKyThuat'],
                //$data['diemDon'],
                //$data['diemCan'],
                //$data['diemSong'],
                //$data['diemDoi'],
                //$data['diemLyThuyet'],
                //$data['diemTheLuc'],
                $data['tongDiem'],
                $data['KetQua'],
                $data['GiamKhaoCham'],
                $data['GhiChu'],
                $data['NgayCham'],
                //$data['maCTPhieuDiem'],
                //$data['maKetQuaThi'],
            );
            $array_list[] = $DSKQ;
        }
        return $array_list;
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


