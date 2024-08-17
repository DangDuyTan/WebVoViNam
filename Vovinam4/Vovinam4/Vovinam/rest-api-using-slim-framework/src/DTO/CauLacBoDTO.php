<?php
class CauLacBoDTO
{
    private $maCauLacBo;
    private $tenCauLacBo;

    // hàm khởi tạo
    public function __construct($maCauLacBo, $tenCauLacBo)
    {
        $this->maCauLacBo = $maCauLacBo;
        $this->tenCauLacBo = $tenCauLacBo;
    }

    public function getMaCauLacBo()
    {
        return $this->maCauLacBo;
    }

    public function setMaCauLacBo($maCauLacBo)
    {
        $this->maCauLacBo = $maCauLacBo;
    }

    public function getTenCauLacBo()
    {
        return $this->tenCauLacBo;
    }

    public function setTenCauLacBo($tenCauLacBo)
    {
        $this->tenCauLacBo = $tenCauLacBo;
    }

    public function __toString()
    {
        return sprintf(
            "Ma Cau Lac Bo: %d\nTen Cau Lac Bo: %s\n",
            $this->maCauLacBo,
            $this->tenCauLacBo
        );
    }
}
