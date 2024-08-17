<?php
class KyThuatDTO
{
    private $maKyThuat;
    private $tenKyThuat;

    // hàm khởi tạo
    public function __construct($maKyThuat, $tenKyThuat = null)
    {
        $this->maKyThuat = $maKyThuat;
        $this->tenKyThuat = $tenKyThuat;
    }

    public function getMaKyThuat()
    {
        return $this->maKyThuat;
    }

    public function setMaKyThuat($maKyThuat)
    {
        $this->maKyThuat = $maKyThuat;
    }

    public function getTenKyThuat()
    {
        return $this->tenKyThuat;
    }

    public function setTenKyThuat($tenKyThuat)
    {
        $this->tenKyThuat = $tenKyThuat;
    }

    public function __toString()
    {
        return sprintf(
            "Ma Ky Thuat: %d\nTen Ky Thuat: %s\n",
            $this->maKyThuat,
            $this->tenKyThuat
        );
    }
}
