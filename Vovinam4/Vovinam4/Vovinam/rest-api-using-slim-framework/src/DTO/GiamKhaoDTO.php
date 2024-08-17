<?php
class GiamKhaoDTO
{
    private $maCTPhieuDiem;
    private $maMonSinh;
    private $hoTen;
    private $maThe;
    private $maCauLacBo;
    private $tenCauLacBo;
    private $maKhoaThi;
    private $tenKhoaThi;
    private $maCapDai;
    private $tenCapDai;
    private $maKyThuat;
    private $tenKyThuat;
    private $ThuocBai;
    private $NhanhManh;
    private $TanPhap;
    private $ThuyetPhuc;
    private $Diem;
    private $KetQua;
    private $GiamKhaoCham;
    private $maChiTietKetQua;
    private $GhiChu;
    private $NgayCham;
    // Hàm khởi tạo
    public function __construct(
        $maCTPhieuDiem,
        $maMonSinh = null,
        $hoTen = null,
        $maThe = null,
        $maCauLacBo = null,
        $tenCauLacBo = null,
        $maKhoaThi = null,
        $tenKhoaThi = null,
        $maCapDai = null,
        $tenCapDai =  null,
        $maKyThuat = null,
        $tenKyThuat = null,
        $ThuocBai = 0,
        $NhanhManh = 0,
        $TanPhap = 0,
        $ThuyetPhuc = 0,
        $Diem = 0,
        $KetQua = 0,
        $GiamKhaoCham = null,
        $maChiTietKetQua = null,
        $GhiChu = null,
        $NgayCham = null
    ) {
        $this->maCTPhieuDiem = $maCTPhieuDiem;
        $this->maMonSinh = $maMonSinh;
        $this->hoTen = $hoTen;
        $this->maThe = $maThe;
        $this->maCauLacBo = $maCauLacBo;
        $this->tenCauLacBo = $tenCauLacBo;
        $this->maKhoaThi = $maKhoaThi;
        $this->tenKhoaThi = $tenKhoaThi;
        $this->maCapDai = $maCapDai;
        $this->tenCapDai = $tenCapDai;
        $this->maKyThuat = $maKyThuat;
        $this->tenKyThuat = $tenKyThuat;
        $this->ThuocBai = (float)$ThuocBai;
        $this->NhanhManh = (float)$NhanhManh;
        $this->TanPhap = (float)$TanPhap;
        $this->ThuyetPhuc = (float)$ThuyetPhuc;
        $this->Diem = (float)$Diem;
        $this->KetQua = $KetQua;
        $this->GiamKhaoCham = $GiamKhaoCham;
        $this->maChiTietKetQua = $maChiTietKetQua;
        $this->GhiChu = $GhiChu;
        $this->NgayCham = $NgayCham;
    }

    // Getter methods
    public function getMaCTPhieuDiem() { return $this->maCTPhieuDiem; }
    public function getMaMonSinh() { return $this->maMonSinh; }
    public function getHoTen() { return $this->hoTen; }
    public function getMaThe() { return $this->maThe; }
    public function getMaCauLacBo() { return $this->maCauLacBo; }
    public function getTenCauLacBo() { return $this->tenCauLacBo; }
    public function getMaKhoaThi() { return $this->maKhoaThi; }
    public function getTenKhoaThi() { return $this->tenKhoaThi; }
    public function getMaCapDai() { return $this->maCapDai; }
    public function getTenCapDai() { return $this->tenCapDai; }
    public function getMaKyThuat() { return $this->maKyThuat; }
    public function getTenKyThuat() { return $this->tenKyThuat; }
    public function getThuocBai() { return $this->ThuocBai; }
    public function getNhanhManh() { return $this->NhanhManh; }
    public function getTanPhap() { return $this->TanPhap; }
    public function getThuyetPhuc() { return $this->ThuyetPhuc; }
    public function getDiem() { return $this->Diem; }
    public function getKetQua() { return $this->KetQua; }
    public function getGiamKhaoCham() { return $this->GiamKhaoCham; }
    public function getMaChiTietKetQua() { return $this->maChiTietKetQua; }
    public function getGhiChu() { return $this->GhiChu; }
    public function getNgayCham() { return $this->NgayCham; }

    // Setter methods
    public function setMaCTPhieuDiem($value) { $this->maCTPhieuDiem = $value; }
    public function setMaMonSinh($value) { $this->maMonSinh = $value; }
    public function setHoTen($value) { $this->hoTen = $value; }
    public function setMaThe($value) { $this->maThe = $value; }
    public function setMaCauLacBo($value) { $this->maCauLacBo = $value; }
    public function setTenCauLacBo($value) { $this->tenCauLacBo = $value; }
    public function setMaKhoaThi($value) { $this->maKhoaThi = $value; }
    public function setTenKhoaThi($value) { $this->tenKhoaThi = $value; }
    public function setMaCapDai($value) { $this->maCapDai = $value; }
    public function setTenCapDai($value) { $this->tenCapDai = $value; }
    public function setMaKyThuat($value) { $this->maKyThuat = $value; }
    public function setTenKyThuat($value) { $this->tenKyThuat = $value; }
    public function setThuocBai($value) { $this->ThuocBai = (float)$value; }
    public function setNhanhManh($value) { $this->NhanhManh = (float)$value; }
    public function setTanPhap($value) { $this->TanPhap = (float)$value; }
    public function setThuyetPhuc($value) { $this->ThuyetPhuc = (float)$value; }
    public function setDiem($value) { $this->Diem = (float)$value; }
    public function setKetQua($value) { $this->KetQua = $value; }
    public function setGiamKhaoCham($value) { $this->GiamKhaoCham = $value; }
    public function setMaChiTietKetQua($value) { $this->maChiTietKetQua = $value; }
    public function setGhiChu($value) { $this->GhiChu = $value; }
    public function setNgayCham($value) { $this->NgayCham = $value; }

    // Phương thức __toString()
    public function __toString()
    {
        return sprintf(
            "maCTPhieuDiem: %s\n
            maMonSinh: %s\n
            hoTen: %s\n
            maThe: %s\n
            maCauLacBo: %s\n
            tenCauLacBo: %s\n
            maKhoaThi: %s\n
            tenKhoaThi: %s\n
            maCapDai: %s\n
            tenCapDai: %s\n
            maKyThuat: %s\n
            tenKyThuat: %s\n
            ThuocBai: %d\n
            NhanhManh: %d\n
            TanPhap: %d\n
            ThuyetPhuc: %d\n
            Diem: %d\n
            KetQua: %d\n
            GiamKhaoCham: %d\n
            maChiTietKetQua: %d\n
            GhiChu: %s\n
            NgayCham: %s",
            $this->maCTPhieuDiem,
            $this->maMonSinh,
            $this->hoTen,
            $this->maThe,
            $this->maCauLacBo,
            $this->tenCauLacBo,
            $this->maKhoaThi,
            $this->tenKhoaThi,
            $this->maCapDai,
            $this->tenCapDai,
            $this->maKyThuat,
            $this->tenKyThuat,
            $this->ThuocBai,
            $this->NhanhManh,
            $this->TanPhap,
            $this->ThuyetPhuc,
            $this->Diem,
            $this->KetQua,
            $this->GiamKhaoCham,
            $this->maChiTietKetQua,
            $this->GhiChu,
            $this->NgayCham
        );
    }
}

