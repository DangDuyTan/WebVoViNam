<?php
class CapDaiDTO
{
    private $maCapDai;
    private $tenCapDai;

    // hàm khởi tạo
    public function __construct($maCapDai, $tenCapDai)
    {
        $this->maCapDai = $maCapDai;
        $this->tenCapDai = $tenCapDai;
    }

    public function getMaCapDai()
    {
        return $this->maCapDai;
    }

    public function setMaCapDai($maCapDai)
    {
        $this->maCapDai = $maCapDai;
    }

    public function getTenCapDai()
    {
        return $this->tenCapDai;
    }

    public function setTenCapDai($tenCapDai)
    {
        $this->tenCapDai = $tenCapDai;
    }

    public function __toString()
    {
        return sprintf(
            "Ma Cap Dai: %d\nTen Cap Dai: %s\n",
            $this->maCapDai,
            $this->tenCapDai
        );
    }
}
