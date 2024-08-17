<?php
class ChiTietQuyenDTO
{
    private $maQuyen;
    private $maChucNang;
    private $chucNangThem;
    private $chucNangSua;
    private $chucNangXoa;
    private $chucNangTimKiem;
    private $chamDiemDonLuyen;
    private $chamDiemSongLuyen;
    private $chamDiemCanBan;
    private $chamDiemDoiKhang;
    private $chamDiemTheLuc;
    private $chamDiemLyThuyet;

    // hàm khởi tạo
    public function __construct(
        $maQuyen,
        $maChucNang,
        $chucNangThem = 0,
        $chucNangSua = 0,
        $chucNangXoa = 0,
        $chucNangTimKiem = 0,
        $chamDiemDonLuyen = 0,
        $chamDiemSongLuyen = 0,
        $chamDiemCanBan = 0,
        $chamDiemDoiKhang = 0,
        $chamDiemTheLuc = 0,
        $chamDiemLyThuyet = 0
    ) {
        $this->maQuyen = $maQuyen;
        $this->maChucNang = $maChucNang;
        $this->chucNangThem = $chucNangThem;
        $this->chucNangSua = $chucNangSua;
        $this->chucNangXoa = $chucNangXoa;
        $this->chucNangTimKiem = $chucNangTimKiem;
        $this->chamDiemDonLuyen = $chamDiemDonLuyen;
        $this->chamDiemSongLuyen = $chamDiemSongLuyen;
        $this->chamDiemCanBan = $chamDiemCanBan;
        $this->chamDiemDoiKhang = $chamDiemDoiKhang;
        $this->chamDiemTheLuc = $chamDiemTheLuc;
        $this->chamDiemLyThuyet = $chamDiemLyThuyet;
    }

    public function getMaQuyen()
    {
        return $this->maQuyen;
    }

    public function setMaQuyen($maQuyen)
    {
        $this->maQuyen = $maQuyen;
    }

    public function getMaChucNang()
    {
        return $this->maChucNang;
    }

    public function setMaChucNang($maChucNang)
    {
        $this->maChucNang = $maChucNang;
    }

    public function getChucNangThem()
    {
        return $this->chucNangThem;
    }

    public function setChucNangThem($chucNangThem)
    {
        $this->chucNangThem = $chucNangThem;
    }

    public function getChucNangSua()
    {
        return $this->chucNangSua;
    }

    public function setChucNangSua($chucNangSua)
    {
        $this->chucNangSua = $chucNangSua;
    }

    public function getChucNangXoa()
    {
        return $this->chucNangXoa;
    }

    public function setChucNangXoa($chucNangXoa)
    {
        $this->chucNangXoa = $chucNangXoa;
    }

    public function getChucNangTimKiem()
    {
        return $this->chucNangTimKiem;
    }

    public function setChucNangTimKiem($chucNangTimKiem)
    {
        $this->chucNangTimKiem = $chucNangTimKiem;
    }

    public function getChamDiemDonLuyen()
    {
        return $this->chamDiemDonLuyen;
    }

    public function setChamDiemDonLuyen($chamDiemDonLuyen)
    {
        $this->chamDiemDonLuyen = $chamDiemDonLuyen;
    }

    public function getChamDiemSongLuyen()
    {
        return $this->chamDiemSongLuyen;
    }

    public function setChamDiemSongLuyen($chamDiemSongLuyen)
    {
        $this->chamDiemSongLuyen = $chamDiemSongLuyen;
    }

    public function getChamDiemCanBan()
    {
        return $this->chamDiemCanBan;
    }

    public function setChamDiemCanBan($chamDiemCanBan)
    {
        $this->chamDiemCanBan = $chamDiemCanBan;
    }

    public function getChamDiemDoiKhang()
    {
        return $this->chamDiemDoiKhang;
    }

    public function setChamDiemDoiKhang($chamDiemDoiKhang)
    {
        $this->chamDiemDoiKhang = $chamDiemDoiKhang;
    }

    public function getChamDiemTheLuc()
    {
        return $this->chamDiemTheLuc;
    }

    public function setChamDiemTheLuc($chamDiemTheLuc)
    {
        $this->chamDiemTheLuc = $chamDiemTheLuc;
    }

    public function getChamDiemLyThuyet()
    {
        return $this->chamDiemLyThuyet;
    }

    public function setChamDiemLyThuyet($chamDiemLyThuyet)
    {
        $this->chamDiemLyThuyet = $chamDiemLyThuyet;
    }

    public function __toString()
    {
        return sprintf(
            "Ma Quyen: %s\nMa Chuc Nang: %s\nChuc Nang Them: %d\nChuc Nang Sua: %d\nChuc Nang Xoa: %d\nChuc Nang Tim Kiem: %d\nCham Diem Don Luyen: %d\nCham Diem Song Luyen: %d\nCham Diem Can Ban: %d\nCham Diem Doi Khang: %d\nCham Diem The Luc: %d\nCham Diem Ly Thuyet: %d\n",
            $this->maQuyen,
            $this->maChucNang,
            $this->chucNangThem,
            $this->chucNangSua,
            $this->chucNangXoa,
            $this->chucNangTimKiem,
            $this->chamDiemDonLuyen,
            $this->chamDiemSongLuyen,
            $this->chamDiemCanBan,
            $this->chamDiemDoiKhang,
            $this->chamDiemTheLuc,
            $this->chamDiemLyThuyet
        );
    }
}
