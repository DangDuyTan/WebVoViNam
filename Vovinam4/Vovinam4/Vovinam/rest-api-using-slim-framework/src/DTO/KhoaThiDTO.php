<?php
class KhoaThiDTO
{
    private $maKhoaThi;
    private $tenKhoaThi;
    private $ngayThi;
    private $ngayKetThuc;
    private $hienThi;
    private $ghiChu;
    private $dsCapDaiThi; // Danh sách cấp đai

    // hàm khởi tạo
    public function __construct(
        $maKhoaThi,
        $tenKhoaThi = null,
        $ngayThi = null,
        $ngayKetThuc = null,
        $hienThi = 1,
        $ghiChu = null,
        $dsCapDaiThi = null // Khởi tạo danh sách cấp đai
    ) {
        $this->maKhoaThi = $maKhoaThi;
        $this->tenKhoaThi = $tenKhoaThi;
        $this->ngayThi = $ngayThi;
        $this->ngayKetThuc = $ngayKetThuc;
        $this->hienThi = $hienThi;
        $this->ghiChu = $ghiChu;
        $this->dsCapDaiThi = $dsCapDaiThi;
    }

    // Getter và Setter cho các thuộc tính, bao gồm dsCapDai
    public function getMaKhoaThi()
    {
        return $this->maKhoaThi;
    }
    public function setMaKhoaThi($maKhoaThi)
    {
        $this->maKhoaThi = $maKhoaThi;
    }

    public function getTenKhoaThi()
    {
        return $this->tenKhoaThi;
    }
    public function setTenKhoaThi($tenKhoaThi)
    {
        $this->tenKhoaThi = $tenKhoaThi;
    }

    public function getNgayThi()
    {
        return $this->ngayThi;
    }
    public function setNgayThi($ngayThi)
    {
        $this->ngayThi = $ngayThi;
    }

    public function getNgayKetThuc()
    {
        return $this->ngayKetThuc;
    }
    public function setNgayKetThuc($ngayKetThuc)
    {
        $this->ngayKetThuc = $ngayKetThuc;
    }

    public function getHienThi()
    {
        return $this->hienThi;
    }
    public function setHienThi($hienThi)
    {
        $this->hienThi = $hienThi;
    }

    public function getGhiChu()
    {
        return $this->ghiChu;
    }
    public function setGhiChu($ghiChu)
    {
        $this->ghiChu = $ghiChu;
    }

    public function getDsCapDaiThi()
    {
        return $this->dsCapDaiThi;
    }
    public function setDsCapDaiThi($dsCapDaiThi)
    {
        $this->dsCapDaiThi = $dsCapDaiThi;
    }

    public function __toString()
    {
        return sprintf(
            "Ma Khoa Thi: %d\nTen Khoa Thi: %s\nNgay Thi: %s\nNgay Ket Thuc: %s\nHien Thi: %d\nGhi Chu: %s\nDanh Sach Cap Dai Thi: %s\n",
            $this->maKhoaThi,
            $this->tenKhoaThi,
            $this->ngayThi,
            $this->ngayKetThuc,
            $this->hienThi,
            $this->ghiChu,
            $this->dsCapDaiThi
        );
    }
}
