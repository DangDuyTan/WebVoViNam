<?php
class CTPhieuDiemDTO
{
    private $maCTPhieuDiem;
    private $maKetQuaThi;
    private $maKhoaThi;
    private $maCapDai;
    private $maKyThuat;
    private $maMonSinh;
    private $thuocBai;
    private $nhanhManh;
    private $tanPhap;
    private $thuyetPhuc;
    private $diem;
    private $ketQua;
    private $giamKhaoCham;
    private $ghiChu;

    // hàm khởi tạo
    public function __construct(
        $maCTPhieuDiem,
        $maKetQuaThi = null,
        $maKhoaThi = null,
        $maCapDai = null,
        $maKyThuat = null,
        $maMonSinh = null,
        $thuocBai = null,
        $nhanhManh = null,
        $tanPhap = null,
        $thuyetPhuc = null,
        $diem = null,
        $ketQua = 0,
        $giamKhaoCham = null,
        $ghiChu = null
    ) {
        $this->maCTPhieuDiem = $maCTPhieuDiem;
        $this->maKetQuaThi = $maKetQuaThi;
        $this->maKhoaThi = $maKhoaThi;
        $this->maCapDai = $maCapDai;
        $this->maKyThuat = $maKyThuat;
        $this->maMonSinh = $maMonSinh;
        $this->thuocBai = $thuocBai;
        $this->nhanhManh = $nhanhManh;
        $this->tanPhap = $tanPhap;
        $this->thuyetPhuc = $thuyetPhuc;
        $this->diem = $diem;
        $this->ketQua = $ketQua;
        $this->giamKhaoCham = $giamKhaoCham;
        $this->ghiChu = $ghiChu;
    }

    public function getMaCTPhieuDiem()
    {
        return $this->maCTPhieuDiem;
    }

    public function setMaCTPhieuDiem($maCTPhieuDiem)
    {
        $this->maCTPhieuDiem = $maCTPhieuDiem;
    }

    public function getMaKetQuaThi()
    {
        return $this->maKetQuaThi;
    }

    public function setMaKetQuaThi($maKetQuaThi)
    {
        $this->maKetQuaThi = $maKetQuaThi;
    }

    public function getMaKhoaThi()
    {
        return $this->maKhoaThi;
    }

    public function setMaKhoaThi($maKhoaThi)
    {
        $this->maKhoaThi = $maKhoaThi;
    }

    public function getMaCapDai()
    {
        return $this->maCapDai;
    }

    public function setMaCapDai($maCapDai)
    {
        $this->maCapDai = $maCapDai;
    }

    public function getMaKyThuat()
    {
        return $this->maKyThuat;
    }

    public function setMaKyThuat($maKyThuat)
    {
        $this->maKyThuat = $maKyThuat;
    }

    public function getMaMonSinh()
    {
        return $this->maMonSinh;
    }

    public function setMaMonSinh($maMonSinh)
    {
        $this->maMonSinh = $maMonSinh;
    }

    public function getThuocBai()
    {
        return $this->thuocBai;
    }

    public function setThuocBai($thuocBai)
    {
        $this->thuocBai = $thuocBai;
    }

    public function getNhanhManh()
    {
        return $this->nhanhManh;
    }

    public function setNhanhManh($nhanhManh)
    {
        $this->nhanhManh = $nhanhManh;
    }

    public function getTanPhap()
    {
        return $this->tanPhap;
    }

    public function setTanPhap($tanPhap)
    {
        $this->tanPhap = $tanPhap;
    }

    public function getThuyetPhuc()
    {
        return $this->thuyetPhuc;
    }

    public function setThuyetPhuc($thuyetPhuc)
    {
        $this->thuyetPhuc = $thuyetPhuc;
    }

    public function getDiem()
    {
        return $this->diem;
    }

    public function setDiem($diem)
    {
        $this->diem = $diem;
    }

    public function getKetQua()
    {
        return $this->ketQua;
    }

    public function setKetQua($ketQua)
    {
        $this->ketQua = $ketQua;
    }

    public function getGiamKhaoCham()
    {
        return $this->giamKhaoCham;
    }

    public function setGiamKhaoCham($giamKhaoCham)
    {
        $this->giamKhaoCham = $giamKhaoCham;
    }

    public function getGhiChu()
    {
        return $this->ghiChu;
    }

    public function setGhiChu($ghiChu)
    {
        $this->ghiChu = $ghiChu;
    }

    public function __toString()
    {
        return sprintf(
            "Ma CT Phieu Diem: %d\nMa Ket Qua Thi: %d\nMa Khoa Thi: %d\nMa Cap Dai: %d\nMa Ky Thuat: %d\nMa Mon Sinh: %d\nThuoc Bai: %.2f\nNhanh Manh: %.2f\nTan Phap: %.2f\nThuyet Phuc: %.2f\nDiem: %.2f\nKet Qua: %d\nGiam Khao Cham: %s\nGhi Chu: %s\n",
            $this->maCTPhieuDiem,
            $this->maKetQuaThi,
            $this->maKhoaThi,
            $this->maCapDai,
            $this->maKyThuat,
            $this->maMonSinh,
            $this->thuocBai,
            $this->nhanhManh,
            $this->tanPhap,
            $this->thuyetPhuc,
            $this->diem,
            $this->ketQua,
            $this->giamKhaoCham,
            $this->ghiChu
        );
    }
}
