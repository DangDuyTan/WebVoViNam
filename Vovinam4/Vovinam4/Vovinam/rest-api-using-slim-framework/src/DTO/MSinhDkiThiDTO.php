<?php
class MSinhDkiThiDTO
{
    private $maCapDai;
    private $tenCapDai;

    private $maKhoaThi;
    private $tenKhoaThi;

    private $ngayThi;
    private $ngayKetThuc;
    private $ghiChu;
    // hàm khởi tạo
    public function __construct(
        $maCapDai,
        $tenCapDai,
        $maKhoaThi,
        $tenKhoaThi,
        $ngayThi,
        $ngayKetThuc,
        $ghiChu
    )
    {
        $this->maCapDai = $maCapDai;
        $this->tenCapDai = $tenCapDai;
        $this->maKhoaThi = $maKhoaThi;
        $this->tenKhoaThi = $tenKhoaThi;
        $this->ngayThi = $ngayThi;
        $this->ngayKetThuc = $ngayKetThuc;
        $this->ghiChu = $ghiChu;
    }

    public function getMaCapDai(){return $this->maCapDai;}
    public function setMaCapDai($maCapDai){$this->maCapDai = $maCapDai;}

    public function getTenCapDai(){return $this->tenCapDai;}
    public function setTenCapDai($tenCapDai){$this->tenCapDai = $tenCapDai;}

    public function getMaKhoaThi(){return $this->maKhoaThi;}
    public function setMaKhoaThi($maKhoaThi) {$this->maKhoaThi = $maKhoathi;}

    public function getTenKhoaThi() {return $this->tenKhoaThi;}
    public function setTenKhoaThi($tenKhoaThi) {$this->tenKhoaThi = $tenKhoaThi;}

    public function getngayThi() {return $this->ngayThi;}
    public function setngayThi($ngayThi) {$this->ngayThi = $ngayThi;}

    public function getngayKetThuc() {return $this->ngayKetThuc;}
    public function setngayKetThuc($ngayKetThuc) {$this->ngayKetThuc = $ngayKetThuc;}

    public function getghiChu() {return $this->ghiChu;}
    public function setghiChu($ghiChu) {$this-> ghiChu = $ghiChu;}

    public function __toString()
    {
        return sprintf(
            "Ma Cap Dai: %d\n
            Ten Cap Dai: %s\n
            Ma Khoa Thi: %d\n
            Ten Khoa Thi: %s\n
            ngayThi: %d\n
            ngayKetThuc: %s\n
            ghiChu: %s\n
            ",
            $this->maCapDai,
            $this->tenCapDai,
            $this->maKhoaThi,
            $this->tenKhoaThi,
            $this->ngayThi,
            $this->ngayKetThuc,
            $this->ghiChu,
        );
    }
}
