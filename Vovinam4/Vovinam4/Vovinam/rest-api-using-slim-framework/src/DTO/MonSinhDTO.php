<?php
class MonSinhDTO
{
    private $maMonSinh;
    private $maThe;
    private $hoTen;
    private $gioiTinh;
    private $ngaySinh;
    private $chieuCao;
    private $canNang;
    private $diaChi;
    private $soDienThoai;
    private $email;
    private $cccd;
    private $anhCCCD;
    private $anh3x4;
    private $ngayCapCCCD;
    private $noiCapCCCD;
    private $tenPhuHuynh;
    private $sdtPhuHuynh;
    private $congViec;
    private $lichSuTapLuyen;
    private $lichSuThi;
    private $bangCap;
    private $trinhDoVanHoa;
    private $khaNangNoiBat;
    private $trangThai;
    private $maCapDai;
    private $tenCapDai;
    private $maCauLacBo;

    // hàm khởi tạo
    public function __construct(
        $maMonSinh,
        $maThe = null,
        $hoTen = null,
        $gioiTinh = null,
        $ngaySinh = null,
        $chieuCao = null,
        $canNang = null,
        $diaChi = null,
        $soDienThoai = null,
        $email = null,
        $cccd = null,
        $anhCCCD = null,
        $anh3x4 = null,
        $ngayCapCCCD = null,
        $noiCapCCCD = null,
        $tenPhuHuynh = null,
        $sdtPhuHuynh = null,
        $congViec = null,
        $lichSuTapLuyen = null,
        $lichSuThi = null,
        $bangCap = null,
        $trinhDoVanHoa = null,
        $khaNangNoiBat = null,
        $trangThai = null,
        $maCapDai = null,
        $tenCapDai = null,
        $maCauLacBo = null,
    ) {
        $this->maMonSinh = $maMonSinh;
        $this->maThe = $maThe;
        $this->hoTen = $hoTen;
        $this->gioiTinh = $gioiTinh;
        $this->ngaySinh = $ngaySinh;
        $this->chieuCao = $chieuCao;
        $this->canNang = $canNang;
        $this->diaChi = $diaChi;
        $this->soDienThoai = $soDienThoai;
        $this->email = $email;
        $this->cccd = $cccd;
        $this->anhCCCD = $anhCCCD;
        $this->anh3x4 = $anh3x4;
        $this->ngayCapCCCD = $ngayCapCCCD;
        $this->noiCapCCCD = $noiCapCCCD;
        $this->tenPhuHuynh = $tenPhuHuynh;
        $this->sdtPhuHuynh = $sdtPhuHuynh;
        $this->congViec = $congViec;
        $this->lichSuTapLuyen = $lichSuTapLuyen;
        $this->lichSuThi = $lichSuThi;
        $this->bangCap = $bangCap;
        $this->trinhDoVanHoa = $trinhDoVanHoa;
        $this->khaNangNoiBat = $khaNangNoiBat;
        $this->trangThai = $trangThai;
        $this->maCapDai = $maCapDai;
        $this->tenCapDai = $tenCapDai;
        $this->maCauLacBo = $maCauLacBo;
    }

    public function getMaMonSinh()
    {
        return $this->maMonSinh;
    }

    public function setMaMonSinh($maMonSinh)
    {
        $this->maMonSinh = $maMonSinh;
    }

    public function getMaThe()
    {
        return $this->maThe;
    }

    public function setMaThe($maThe)
    {
        $this->maThe = $maThe;
    }

    public function getHoTen()
    {
        return $this->hoTen;
    }

    public function setHoTen($hoTen)
    {
        $this->hoTen = $hoTen;
    }

    public function getGioiTinh()
    {
        return $this->gioiTinh;
    }

    public function setGioiTinh($gioiTinh)
    {
        $this->gioiTinh = $gioiTinh;
    }

    public function getNgaySinh()
    {
        return $this->ngaySinh;
    }

    public function setNgaySinh($ngaySinh)
    {
        $this->ngaySinh = $ngaySinh;
    }

    public function getChieuCao()
    {
        return $this->chieuCao;
    }

    public function setChieuCao($chieuCao)
    {
        $this->chieuCao = $chieuCao;
    }

    public function getCanNang()
    {
        return $this->canNang;
    }

    public function setCanNang($canNang)
    {
        $this->canNang = $canNang;
    }

    public function getDiaChi()
    {
        return $this->diaChi;
    }

    public function setDiaChi($diaChi)
    {
        $this->diaChi = $diaChi;
    }

    public function getSoDienThoai()
    {
        return $this->soDienThoai;
    }

    public function setSoDienThoai($soDienThoai)
    {
        $this->soDienThoai = $soDienThoai;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCCCD()
    {
        return $this->cccd;
    }

    public function setCCCD($cccd)
    {
        $this->cccd = $cccd;
    }

    public function getAnhCCCD()
    {
        return $this->anhCCCD;
    }

    public function setAnhCCCD($anhCCCD)
    {
        $this->anhCCCD = $anhCCCD;
    }

    public function getAnh3x4()
    {
        return $this->anh3x4;
    }

    public function setAnh3x4($anh3x4)
    {
        $this->anh3x4 = $anh3x4;
    }

    public function getNgayCapCCCD()
    {
        return $this->ngayCapCCCD;
    }

    public function setNgayCapCCCD($ngayCapCCCD)
    {
        $this->ngayCapCCCD = $ngayCapCCCD;
    }

    public function getNoiCapCCCD()
    {
        return $this->noiCapCCCD;
    }

    public function setNoiCapCCCD($noiCapCCCD)
    {
        $this->noiCapCCCD = $noiCapCCCD;
    }

    public function getTenPhuHuynh()
    {
        return $this->tenPhuHuynh;
    }

    public function setTenPhuHuynh($tenPhuHuynh)
    {
        $this->tenPhuHuynh = $tenPhuHuynh;
    }

    public function getSdtPhuHuynh()
    {
        return $this->sdtPhuHuynh;
    }

    public function setSdtPhuHuynh($sdtPhuHuynh)
    {
        $this->sdtPhuHuynh = $sdtPhuHuynh;
    }

    public function getCongViec()
    {
        return $this->congViec;
    }

    public function setCongViec($congViec)
    {
        $this->congViec = $congViec;
    }

    public function getLichSuTapLuyen()
    {
        return $this->lichSuTapLuyen;
    }

    public function setLichSuTapLuyen($lichSuTapLuyen)
    {
        $this->lichSuTapLuyen = $lichSuTapLuyen;
    }

    public function getLichSuThi()
    {
        return $this->lichSuThi;
    }

    public function setLichSuThi($lichSuThi)
    {
        $this->lichSuThi = $lichSuThi;
    }

    public function getBangCap()
    {
        return $this->bangCap;
    }

    public function setBangCap($bangCap)
    {
        $this->bangCap = $bangCap;
    }

    public function getTrinhDoVanHoa()
    {
        return $this->trinhDoVanHoa;
    }

    public function setTrinhDoVanHoa($trinhDoVanHoa)
    {
        $this->trinhDoVanHoa = $trinhDoVanHoa;
    }

    public function getKhaNangNoiBat()
    {
        return $this->khaNangNoiBat;
    }

    public function setKhaNangNoiBat($khaNangNoiBat)
    {
        $this->khaNangNoiBat = $khaNangNoiBat;
    }
    public function getTrangThai()
    {
        return $this->trangThai;
    }

    public function setTrangThai($trangThai)
    {
        $this->trangThai = $trangThai;
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
    public function getMaCauLacBo()
    {
        return $this->maCauLacBo;
    }

    public function setMaCauLacBo($maCauLacBo)
    {
        $this->maCauLacBo = $maCauLacBo;
    }

    public function __toString()
    {
        return sprintf(
            "Ma Mon Sinh: %d\nMa The: %d\nHo Ten: %s\nGioi Tinh: %d\nNgay Sinh: %s\nChieu Cao: %d\nCan Nang: %d\nDia Chi: %s\nSo Dien Thoai: %s\nEmail: %s\nCCCD: %s\nAnh CCCD: %s\nAnh 3x4: %s\nNgay Cap CCCD: %s\nNoi Cap CCCD: %s\nTen Phu Huynh: %s\nSDT Phu Huynh: %s\nCong Viec: %s\nLich Su Tap Luyen: %s\nLich Su Thi: %s\nBang Cap: %s\nTrinh Do Van Hoa: %s\nKha Nang Noi Bat: %s\nTrang Thai: %d\nMa Cap Dai: %d\nTen Cap Dai: %s\nnMa Cau Lac Bo: %d\n",
            $this->maMonSinh,
            $this->maThe,
            $this->hoTen,
            $this->gioiTinh,
            $this->ngaySinh,
            $this->chieuCao,
            $this->canNang,
            $this->diaChi,
            $this->soDienThoai,
            $this->email,
            $this->cccd,
            $this->anhCCCD,
            $this->anh3x4,
            $this->ngayCapCCCD,
            $this->noiCapCCCD,
            $this->tenPhuHuynh,
            $this->sdtPhuHuynh,
            $this->congViec,
            $this->lichSuTapLuyen,
            $this->lichSuThi,
            $this->bangCap,
            $this->trinhDoVanHoa,
            $this->khaNangNoiBat,
            $this->trangThai,
            $this->maCapDai,
            $this->tenCapDai,
            $this->maCauLacBo
        );
    }
}
