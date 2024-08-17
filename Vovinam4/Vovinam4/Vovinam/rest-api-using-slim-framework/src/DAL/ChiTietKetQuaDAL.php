<?php
class ChiTietKetQuaDAL extends AbstracDSachCTKQ
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
    function getListObj($maChiTietKetQua)
    {
        $string = "SELECT 
                        ct.maChiTietKetQua AS `maChiTietKetQua`,
                        ct.maCTPhieuDiem AS `maCTPhieuDiem`,
                        msclb.hoTen AS `hoTen`,
                        msclb.maThe AS `maThe`,
                        msclb.tenCauLacBo AS `tenCauLacBo`,
                        kt.tenKhoaThi AS `tenKhoaThi`,
                        cd1.tenCapDai AS `tenCapDai`,
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
                        ct.GiamKhaoCham AS `GiamKhaoCham`
                    FROM 
                        ctphieudiem ct
                    JOIN MonSinhCauLacBo msclb ON ct.maMonSinh = msclb.maMonSinh
                    JOIN chitietketquathi ctkq ON ct.maChiTietKetQua = ctkq.maChiTietKetQua
                    JOIN khoathi kt ON ct.maKhoaThi = kt.maKhoaThi
                    JOIN capdai cd1 ON ct.maCapDai = cd1.maCapDai
                    JOIN kythuat kt2 ON ct.maKyThuat = kt2.maKyThuat
                    WHERE ct.maChiTietKetQua = ?
                    ORDER BY ct.maChiTietKetQua, ct.maCTPhieuDiem
                    ";
        $stmt = $this->actionSQL->prepare($string);
        $stmt->bind_param('i', $maChiTietKetQua);
        $stmt->execute();
        $results = $stmt->get_result();
    
        // Xây dựng cấu trúc JSON
        $response = [];
        foreach ($results as $row) {
            $maChiTietKetQua = $row['maChiTietKetQua'];
            
            if (!isset($response[$maChiTietKetQua])) {
                $response[$maChiTietKetQua] = [
                    'maChiTietKetQua' => $maChiTietKetQua,
                    'hoTen' => $row['hoTen'],
                    'maThe' => $row['maThe'],
                    'tenCauLacBo' => $row['tenCauLacBo'],
                    'tenKhoaThi' => $row['tenKhoaThi'],
                    'tenCapDai' => $row['tenCapDai'],
                    'details' => []
                ];
            }
    
            $details = [
                'maCTPhieuDiem' => $row['maCTPhieuDiem'],
                'tenKyThuat' => $row['tenKyThuat'],
                'thuocBai' => $row['ThuocBai'],
                'nhanhManh' => $row['NhanhManh'],
                'tanPhap' => $row['TanPhap'],
                'thuyetPhuc' => $row['ThuyetPhuc'],
                'Diem' => $row['Diem'],
                'KetQua' => $row['KetQua'],
                'GiamKhaoCham' => $row['GiamKhaoCham'],
                'GhiChu' => $row['GhiChu']
            ];
    
            $response[$maChiTietKetQua]['details'][] = $details;
        }
    
        return array_values($response);
    } 
}
