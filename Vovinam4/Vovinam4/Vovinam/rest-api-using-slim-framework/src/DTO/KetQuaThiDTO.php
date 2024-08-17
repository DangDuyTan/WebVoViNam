<?php
class KetQuaThiDTO
{
    private $maKetQuaThi;
    private $maMonSinh;
    private $maKhoaThi;
    private $capDaiHienTai;
    private $capDaiDuThi;
    private $ketQua;
    private $trangThaiHoSo;
    private $ghiChu;
    private $ngayCham;
    private $fileDuThi;

    // hàm khởi tạo
    public function __construct(
        $maKetQuaThi,
        $maMonSinh = null,
        $maKhoaThi = null,
        $capDaiHienTai = null,
        $capDaiDuThi = null,
        $ketQua = 0,
        $trangThaiHoSo = 0,
        $ghiChu = null,
        $ngayCham = null,
        $fileDuThi = null
    ) {
        $this->maKetQuaThi = $maKetQuaThi;
        $this->maMonSinh = $maMonSinh;
        $this->maKhoaThi = $maKhoaThi;
        $this->capDaiHienTai = $capDaiHienTai;
        $this->capDaiDuThi = $capDaiDuThi;
        $this->ketQua = $ketQua;
        $this->trangThaiHoSo = $trangThaiHoSo;
        $this->ghiChu = $ghiChu;
        $this->ngayCham = $ngayCham;
        $this->fileDuThi = $fileDuThi;
    }

    public function getMaKetQuaThi()
    {
        return $this->maKetQuaThi;
    }

    public function setMaKetQuaThi($maKetQuaThi)
    {
        $this->maKetQuaThi = $maKetQuaThi;
    }

    public function getMaMonSinh()
    {
        return $this->maMonSinh;
    }

    public function setMaMonSinh($maMonSinh)
    {
        $this->maMonSinh = $maMonSinh;
    }

    public function getMaKhoaThi()
    {
        return $this->maKhoaThi;
    }

    public function setMaKhoaThi($maKhoaThi)
    {
        $this->maKhoaThi = $maKhoaThi;
    }

    public function getCapDaiHienTai()
    {
        return $this->capDaiHienTai;
    }

    public function setCapDaiHienTai($capDaiHienTai)
    {
        $this->capDaiHienTai = $capDaiHienTai;
    }

    public function getCapDaiDuThi()
    {
        return $this->capDaiDuThi;
    }

    public function setCapDaiDuThi($capDaiDuThi)
    {
        $this->capDaiDuThi = $capDaiDuThi;
    }

    public function getKetQua()
    {
        return $this->ketQua;
    }

    public function setKetQua($ketQua)
    {
        $this->ketQua = $ketQua;
    }

    public function getTrangThaiHoSo()
    {
        return $this->trangThaiHoSo;
    }

    public function setTrangThaiHoSo($trangThaiHoSo)
    {
        $this->trangThaiHoSo = $trangThaiHoSo;
    }

    public function getGhiChu()
    {
        return $this->ghiChu;
    }

    public function setGhiChu($ghiChu)
    {
        $this->ghiChu = $ghiChu;
    }

    public function getNgayCham()
    {
        return $this->ngayCham;
    }

    public function setNgayCham($ngayCham)
    {
        $this->ngayCham = $ngayCham;
    }
    public function getFileDuThi()
    {
        return $this->fileDuThi;
    }

    public function setFileDuThi($fileDuThi)
    {
        $this->fileDuThi = $fileDuThi;
    }

    public function __toString()
    {
        return sprintf(
            "Ma Ket Qua Thi: %d\nMa Mon Sinh: %d\nMa Khoa Thi: %d\nCap Dai Hien Tai: %s\nCap Dai Du Thi: %s\nKet Qua: %d\nTrang Thai Ho So: %d\nGhi Chu: %s\nNgay Cham: %s\nFile Du Thi: %s\n",
            $this->maKetQuaThi,
            $this->maMonSinh,
            $this->maKhoaThi,
            $this->capDaiHienTai,
            $this->capDaiDuThi,
            $this->ketQua,
            $this->trangThaiHoSo,
            $this->ghiChu,
            $this->ngayCham,
            $this->fileDuThi
        );
    }
}
