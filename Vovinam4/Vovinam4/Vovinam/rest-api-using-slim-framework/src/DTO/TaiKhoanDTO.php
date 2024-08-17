<?php
class TaiKhoanDTO
{
    private $tenDangNhap;
    private $ho;
    private $ten;
    private $matKhau;
    private $anhDaiDien;
    private $loai;
    private $thoiGianTao;
    private $thoiGianSua;
    private $kichHoat;
    private $soDienThoai;
    private $maQuyen;

    // hàm khởi tạo
    public function __construct(
        $tenDangNhap,
        $ho = null,
        $ten = null,
        $matKhau = null,
        $anhDaiDien = null,
        $loai = null,
        $thoiGianTao = null,
        $thoiGianSua = null,
        $kichHoat = 1,
        $soDienThoai = null,
        $maQuyen = null
    ) {
        $this->tenDangNhap = $tenDangNhap;
        $this->ho = $ho;
        $this->ten = $ten;
        $this->matKhau = $matKhau;
        $this->anhDaiDien = $anhDaiDien;
        $this->loai = $loai;
        $this->thoiGianTao = $thoiGianTao;
        $this->thoiGianSua = $thoiGianSua;
        $this->kichHoat = $kichHoat;
        $this->soDienThoai = $soDienThoai;
        $this->maQuyen = $maQuyen;
    }

    public function getTenDangNhap()
    {
        return $this->tenDangNhap;
    }

    public function setTenDangNhap($tenDangNhap)
    {
        $this->tenDangNhap = $tenDangNhap;
    }

    public function getHo()
    {
        return $this->ho;
    }

    public function setHo($ho)
    {
        $this->ho = $ho;
    }

    public function getTen()
    {
        return $this->ten;
    }

    public function setTen($ten)
    {
        $this->ten = $ten;
    }

    public function getMatKhau()
    {
        return $this->matKhau;
    }

    public function setMatKhau($matKhau)
    {
        $this->matKhau = $matKhau;
    }

    public function getAnhDaiDien()
    {
        return $this->anhDaiDien;
    }

    public function setAnhDaiDien($anhDaiDien)
    {
        $this->anhDaiDien = $anhDaiDien;
    }

    public function getLoai()
    {
        return $this->loai;
    }

    public function setLoai($loai)
    {
        $this->loai = $loai;
    }

    public function getThoiGianTao()
    {
        return $this->thoiGianTao;
    }

    public function setThoiGianTao($thoiGianTao)
    {
        $this->thoiGianTao = $thoiGianTao;
    }

    public function getThoiGianSua()
    {
        return $this->thoiGianSua;
    }

    public function setThoiGianSua($thoiGianSua)
    {
        $this->thoiGianSua = $thoiGianSua;
    }

    public function getKichHoat()
    {
        return $this->kichHoat;
    }

    public function setKichHoat($kichHoat)
    {
        $this->kichHoat = $kichHoat;
    }

    public function getSoDienThoai()
    {
        return $this->soDienThoai;
    }

    public function setSoDienThoai($soDienThoai)
    {
        $this->soDienThoai = $soDienThoai;
    }

    public function getMaQuyen()
    {
        return $this->maQuyen;
    }

    public function setMaQuyen($maQuyen)
    {
        $this->maQuyen = $maQuyen;
    }

    public function __toString()
    {
        return sprintf(
            "Ten Dang Nhap: %s\nHo: %s\nTen: %s\nMat Khau: %s\nAnh Dai Dien: %s\nLoai: %s\nThoi Gian Tao: %s\nThoi Gian Sua: %s\nKich Hoat: %d\nSo Dien Thoai: %s\nMa Quyen: %s\n",
            $this->tenDangNhap,
            $this->ho,
            $this->ten,
            $this->matKhau,
            $this->anhDaiDien,
            $this->loai,
            $this->thoiGianTao,
            $this->thoiGianSua,
            $this->kichHoat,
            $this->soDienThoai,
            $this->maQuyen
        );
    }
}
