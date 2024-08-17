<?php
class ChucNangDTO
{
    private $maChucNang;
    private $tenChucNang;

    // hàm khởi tạo
    public function __construct($maChucNang, $tenChucNang = null)
    {
        $this->maChucNang = $maChucNang;
        $this->tenChucNang = $tenChucNang;
    }

    public function getMaChucNang()
    {
        return $this->maChucNang;
    }

    public function setMaChucNang($maChucNang)
    {
        $this->maChucNang = $maChucNang;
    }

    public function getTenChucNang()
    {
        return $this->tenChucNang;
    }

    public function setTenChucNang($tenChucNang)
    {
        $this->tenChucNang = $tenChucNang;
    }

    public function __toString()
    {
        return sprintf(
            "Ma Chuc Nang: %s\nTen Chuc Nang: %s\n",
            $this->maChucNang,
            $this->tenChucNang
        );
    }
}
