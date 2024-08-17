<?php
class DSKQuaDTO
{
    private $maChiTietKetQua;
    //private $maMonSinh;
    private $hoTen;
    private $maThe;
    private $maCauLacBo;
    private $tenCauLacBo;
    private $maKhoaThi;
    private $tenKhoaThi;
    private $maCapDai;
    private $tenCapDai;
    //private $maKyThuat;
    //private $tenKyThuat;
    //private $diemDon;
    //private $diemCan;
    //private $diemSong;
    //private $diemDoi;
    //private $diemLyThuyet;
    //private $diemTheLuc;
    private $tongDiem;
    private $KetQua;
    private $GiamKhaoCham;
    private $GhiChu;
    private $NgayCham;
    //private $maCTPhieuDiem;
    //private $maKetQuaThi;
    // Hàm khởi tạo
    public function __construct(
        $maChiTietKetQua,
        //$maMonSinh = null,
        $hoTen = null,
        $maThe = null,
        $maCauLacBo = null,
        $tenCauLacBo = null,
        $maKhoaThi = null,
        $tenKhoaThi = null,
        $maCapDai = null,
        $tenCapDai =  null,
        //$maKyThuat = null,
        //$tenKyThuat = null,
        //$diemDon = 0,
        //$diemCan = 0,
        //$diemSong = 0,
        //$diemDoi = 0,
        //$diemLyThuyet = 0,
        //$diemTheLuc = 0,
        $tongDiem = 0,
        $KetQua = 0,
        $GiamKhaoCham = null,
        $GhiChu = null,
        $NgayCham = null
        //$maCTPhieuDiem = null,
        //$maKetQuaThi = null
    ) {
        $this->maChiTietKetQua = $maChiTietKetQua;
        //$this->maMonSinh = $maMonSinh;
        $this->hoTen = $hoTen;
        $this->maThe = $maThe;
        $this->maCauLacBo = $maCauLacBo;
        $this->tenCauLacBo = $tenCauLacBo;
        $this->maKhoaThi = $maKhoaThi;
        $this->tenKhoaThi = $tenKhoaThi;
        $this->maCapDai = $maCapDai;
        $this->tenCapDai = $tenCapDai;
        //$this->maKyThuat = $maKyThuat;
        //$this->tenKyThuat = $tenKyThuat;
        //$this->diemDon = (float)$diemDon;
        //$this->diemCan = (float)$diemCan;
        //$this->diemSong = (float)$diemSong;
        //$this->diemDoi = (float)$diemDoi;
        //$this->diemLyThuyet = (float)$diemLyThuyet;
        //$this->diemTheLuc = (float)$diemTheLuc;
        $this->tongDiem = (float)$tongDiem;
        $this->KetQua = $KetQua;
        $this->GiamKhaoCham = $GiamKhaoCham;
        $this->GhiChu = $GhiChu;
        $this->NgayCham = $NgayCham;
        //$this->maCTPhieuDiem = $maCTPhieuDiem;
        //$this->maKetQuaThi = $maKetQuaThi;
    }

    // Getter methods
    public function getmaChiTietKetQua() { return $this->maChiTietKetQua; }
    //public function getMaMonSinh() { return $this->maMonSinh; }
    public function getHoTen() { return $this->hoTen; }
    public function getMaThe() { return $this->maThe; }
    public function getMaCauLacBo() { return $this->maCauLacBo; }
    public function getTenCauLacBo() { return $this->tenCauLacBo; }
    public function getMaKhoaThi() { return $this->maKhoaThi; }
    public function getTenKhoaThi() { return $this->tenKhoaThi; }
    public function getMaCapDai() { return $this->maCapDai; }
    public function getTenCapDai() { return $this->tenCapDai; }
    //public function getMaKyThuat() { return $this->maKyThuat; }
    //public function getTenKyThuat() { return $this->tenKyThuat; }
    //public function getdiemDon() { return $this->diemDon; }
    //public function getdiemCan() { return $this->diemCan; }
    //public function getdiemSong() { return $this->diemSong; }
    //public function getdiemDoi() { return $this->diemDoi; }
    //public function getdiemLyThuyet() { return $this->diemLyThuyet; }
    //public function getdiemTheLuc() { return $this->diemTheLuc; }
    public function gettongDiem() { return $this->tongDiem; }
    public function getKetQua() { return $this->KetQua; }
    public function getGiamKhaoCham() { return $this->GiamKhaoCham; }
    public function getGhiChu() { return $this->GhiChu; }
    public function getNgayCham() { return $this->NgayCham; }
    //public function getmaCTPhieuDiem() { return $this->maCTPhieuDiem; }
    //public function getmaKetQuaThi() { return $this->maKetQuaThi; }

    // Setter methods
    public function setmaChiTietKetQua($value) { $this->maChiTietKetQua = $value; }
    //public function setMaMonSinh($value) { $this->maMonSinh = $value; }
    public function setHoTen($value) { $this->hoTen = $value; }
    public function setMaThe($value) { $this->maThe = $value; }
    public function setMaCauLacBo($value) { $this->maCauLacBo = $value; }
    public function setTenCauLacBo($value) { $this->tenCauLacBo = $value; }
    public function setMaKhoaThi($value) { $this->maKhoaThi = $value; }
    public function setTenKhoaThi($value) { $this->tenKhoaThi = $value; }
    public function setMaCapDai($value) { $this->maCapDai = $value; }
    public function setTenCapDai($value) { $this->tenCapDai = $value; }
    //public function setMaKyThuat($value) { $this->maKyThuat = $value; }
    //public function setTenKyThuat($value) { $this->tenKyThuat = $value; }
    //public function setdiemDon($value) { $this->diemDon = (float)$value; }
    //public function setdiemCan($value) { $this->diemCan = (float)$value; }
    //public function setdiemSong($value) { $this->diemSong = (float)$value; }
    //public function setdiemDoi($value) { $this->diemDoi = (float)$value; }
    //public function setdiemLyThuyet($value) { $this->diemLyThuyet = (float)$value; }
    //public function setdiemTheLuc($value) { $this->diemTheLuc = (float)$value; }
    public function settongDiem($value) { $this->tongDiem = (float)$value; }
    public function setKetQua($value) { $this->KetQua = $value; }
    public function setGiamKhaoCham($value) { $this->GiamKhaoCham = $value; }
    public function setGhiChu($value) { $this->GhiChu = $value; }
    public function setNgayCham($value) { $this->NgayCham = $value; }
    //public function setmaCTPhieuDiem($value) { $this->maCTPhieuDiem = $value; }
    //public function setmaKetQuaThi($value) { $this->maKetQuaThi = $value; }
    // Phương thức __toString()
    public function __toString()
    {
        return sprintf(
            "maChiTietKetQua: %s\n
            
            hoTen: %s\n
            maThe: %s\n
            maCauLacBo: %s\n
            tenCauLacBo: %s\n
            maKhoaThi: %s\n
            tenKhoaThi: %s\n
            maCapDai: %s\n
            tenCapDai: %s\n
            
            tongDiem: %d\n
            KetQua: %d\n
            GiamKhaoCham: %d\n
            GhiChu: %s\n
            NgayCham: %s"
            ,
            $this->maChiTietKetQua,
            //$this->maMonSinh,
            $this->hoTen,
            $this->maThe,
            $this->maCauLacBo,
            $this->tenCauLacBo,
            $this->maKhoaThi,
            $this->tenKhoaThi,
            $this->maCapDai,
            $this->tenCapDai,
            //$this->maKyThuat,
            //$this->tenKyThuat,
            //$this->diemDon,
            //$this->diemCan,
            //$this->diemSong,
            //$this->diemDoi,
            //$this->diemLyThuyet,
            //$this->diemTheLuc,
            $this->tongDiem,
            $this->KetQua,
            $this->GiamKhaoCham,
            $this->GhiChu,
            $this->NgayCham
            //$this->maCTPhieuDiem,
            //$this->maKetquaThi
        );
    }
}

