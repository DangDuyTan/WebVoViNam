<?php
class QuyenDTO
{
    private $maQuyen;
    private $tenQuyen;

    // hàm khởi tạo
    public function __construct($maQuyen, $tenQuyen = null)
    {
        $this->maQuyen = $maQuyen;
        $this->tenQuyen = $tenQuyen;
    }

    public function getMaQuyen()
    {
        return $this->maQuyen;
    }

    public function setMaQuyen($maQuyen)
    {
        $this->maQuyen = $maQuyen;
    }

    public function getTenQuyen()
    {
        return $this->tenQuyen;
    }

    public function setTenQuyen($tenQuyen)
    {
        $this->tenQuyen = $tenQuyen;
    }

    public function __toString()
    {
        return sprintf(
            "Ma Quyen: %s\nTen Quyen: %s\n",
            $this->maQuyen,
            $this->tenQuyen
        );
    }
}
