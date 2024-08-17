<?php
class SelectDTO
{
    private $maCapDai;
    private $tenCapDai;

    private $maKhoaThi;
    private $tenKhoaThi;

    private $maKyThuat;
    private $tenKyThuat;

    private $maCauLacBo;
    private $tenCauLacBo;

    // hàm khởi tạo
    public function __construct(
        $maCapDai,
        $tenCapDai,
        $maKhoaThi,
        $tenKhoaThi,
        $maKyThuat,
        $tenKyThuat,
        $maCauLacBo,
        $tenCauLacBo
    )
    {
        $this->maCapDai = $maCapDai;
        $this->tenCapDai = $tenCapDai;
        $this->maKhoaThi = $maKhoaThi;
        $this->tenKhoaThi = $tenKhoaThi;
        $this->maKyThuat = $maKyThuat;
        $this->tenKyThuat = $tenKyThuat;
        $this->maCauLacBo = $maCauLacBo;
        $this->tenCauLacBo = $tenCauLacBo;
    }

    public function getMaCapDai(){return $this->maCapDai;}
    public function setMaCapDai($maCapDai){$this->maCapDai = $maCapDai;}

    public function getTenCapDai(){return $this->tenCapDai;}
    public function setTenCapDai($tenCapDai){$this->tenCapDai = $tenCapDai;}

    public function getMaKhoaThi(){return $this->maKhoaThi;}
    public function setMaKhoaThi($maKhoaThi) {$this->maKhoaThi = $maKhoa;}

    public function getTenKhoaThi() {return $this->tenKhoaThi;}
    public function setTenKhoaThi($tenKhoaThi) {$this->tenKhoaThi = $tenKhoaThi;}

    public function getMaCauLacBo() {return $this->maCauLacBo;}
    public function setMaCauLacBo($maCauLacBo) {$this->maCauLacBo = $maCauLacBo;}

    public function getTenCauLacBo() {return $this->tenCauLacBo;}
    public function setTenCauLacBo($tenCauLacBo) {$this->tenCauLacBo = $tenCauLacBo;} 

    public function getMaKyThuat() {return $this->maKyThuat;}
    public function setMaKyThuat($maKyThuat) {$this->maKyThuat = $maKyThuat;}

    public function getTenKyThuat() {return $this->tenKyThuat;}
    public function setTenKyThuat($tenKyThuat) {$this->tenKyThuat = $tenKyThuat;}

    public function __toString()
    {
        return sprintf(
            "Ma Cap Dai: %d\n
            Ten Cap Dai: %s\n
            Ma Khoa Thi: %d\n
            Ten Khoa Thi: %s\n
            Ma Ky Thuat: %d\n
            Ten Ky Thuat: %s\n
            Ma Cau Lac Bo: %d\n
            Ten Cau Lac Bo: %s\n
            ",
            $this->maCapDai,
            $this->tenCapDai,
            $this->maKhoaThi,
            $this->tenKhoaThi,
            $this->maKyThuat,
            $this->tenKyThuat,
            $this->maCauLacBo,
            $this->tenCauLacBo,
        );
    }
}
