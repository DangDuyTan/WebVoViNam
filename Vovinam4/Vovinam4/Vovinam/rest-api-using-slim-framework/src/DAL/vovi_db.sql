-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 14, 2024 lúc 06:45 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vovi_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `capdai`
--

CREATE TABLE `capdai` (
  `maCapDai` int(11) NOT NULL,
  `tenCapDai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `capdai`
--

INSERT INTO `capdai` (`maCapDai`, `tenCapDai`) VALUES
(1, 'Tự Vệ'),
(2, 'Lam Đai Tam'),
(3, 'Lam Đai Nhị'),
(4, 'Lam Đai Nhất'),
(5, 'Lam Đai'),
(6, 'Hồng đai IV cấp'),
(7, 'Hồng đai V cấp'),
(8, 'Hồng đai IV cấp'),
(9, 'Hồng đai III cấp'),
(10, 'Hồng đai II cấp'),
(11, 'Hồng đai I cấp'),
(12, 'Hoàng đai III cấp'),
(13, 'Hoàng đai II cấp'),
(14, 'Hoàng đai I cấp'),
(15, 'Hoàng đai'),
(16, 'Chuẩn Hồng đai');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `caulacbo`
--

CREATE TABLE `caulacbo` (
  `maCauLacBo` int(11) NOT NULL,
  `tenCauLacBo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `caulacbo`
--

INSERT INTO `caulacbo` (`maCauLacBo`, `tenCauLacBo`) VALUES
(1, 'CLB Võ Thuật A'),
(2, 'CLB Võ Thuật B'),
(3, 'CLB Võ Thuật C'),
(4, 'CLB Võ Thuật D');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietketquathi`
--

CREATE TABLE `chitietketquathi` (
  `maChiTietKetQua` int(11) NOT NULL,
  `maKetQuaThi` int(11) DEFAULT NULL,
  `diemDon` float DEFAULT NULL,
  `diemCan` float DEFAULT NULL,
  `diemSong` float DEFAULT NULL,
  `diemDoi` float DEFAULT NULL,
  `diemLyThuyet` float DEFAULT NULL,
  `diemTheLuc` float DEFAULT NULL,
  `tongDiem` float DEFAULT NULL,
  `ketQua` int(1) DEFAULT 0,
  `ghiChu` varchar(255) DEFAULT NULL,
  `tenDangNhap` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietketquathi`
--

INSERT INTO `chitietketquathi` (`maChiTietKetQua`, `maKetQuaThi`, `diemDon`, `diemCan`, `diemSong`, `diemDoi`, `diemLyThuyet`, `diemTheLuc`, `tongDiem`, `ketQua`, `ghiChu`, `tenDangNhap`) VALUES
(1, 1, 8.5, 9, 8, 7.5, 8.5, 9, 50.5, 1, 'Ghi chú chi tiết 1', 'gk1'),
(2, 2, 7, 6.5, 7.5, 7, 6.5, 7, 41.5, 0, 'Ghi chú chi tiết 2', 'gk2'),
(3, 3, 9, 8.5, 9, 8.5, 9, 9.5, 63.5, 1, 'Ghi chú chi tiết 3', 'gk3'),
(4, 4, 6, 5.5, 6, 6.5, 5.5, 6, 35.5, 0, 'Ghi chú chi tiết 4', 'gk4'),
(5, 5, 8, 8.5, 8, 7.5, 8, 8.5, 48.5, 1, 'Ghi chú chi tiết 5', 'gk5'),
(6, 6, 7.5, 7, 7.5, 7, 7, 7.5, 43.5, 0, 'Ghi chú chi tiết 6', 'gk6');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietquyen`
--

CREATE TABLE `chitietquyen` (
  `maQuyen` varchar(255) NOT NULL,
  `maChucNang` varchar(255) NOT NULL,
  `chucNangThem` int(1) DEFAULT 0,
  `chucNangSua` int(1) DEFAULT 0,
  `chucNangXoa` int(1) DEFAULT 0,
  `chucNangTimKiem` int(1) DEFAULT 0,
  `chamDiemDonLuyen` int(1) DEFAULT 0,
  `chamDiemSongLuyen` int(1) DEFAULT 0,
  `chamDiemCanBan` int(1) DEFAULT 0,
  `chamDiemDoiKhang` int(1) DEFAULT 0,
  `chamDiemTheLuc` int(1) DEFAULT 0,
  `chamDiemLyThuyet` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietquyen`
--

INSERT INTO `chitietquyen` (`maQuyen`, `maChucNang`, `chucNangThem`, `chucNangSua`, `chucNangXoa`, `chucNangTimKiem`, `chamDiemDonLuyen`, `chamDiemSongLuyen`, `chamDiemCanBan`, `chamDiemDoiKhang`, `chamDiemTheLuc`, `chamDiemLyThuyet`) VALUES
('giamkhaodonluyen', 'ChamDiem', 0, 0, 0, 1, 1, 0, 0, 0, 0, 0),
('giamkhaosongluyen', 'ChamDiem', 0, 0, 0, 1, 0, 1, 0, 0, 0, 0),
('quantri', 'QLKhoaThi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('quantri', 'QLTaiKhoan', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucnang`
--

CREATE TABLE `chucnang` (
  `maChucNang` varchar(255) NOT NULL,
  `tenChucNang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chucnang`
--

INSERT INTO `chucnang` (`maChucNang`, `tenChucNang`) VALUES
('ChamDiem', 'Chấm điểm'),
('QLCapDai', 'Quản lý cấp đai'),
('QLDangKyThi', 'Quản lý Đăng ký dự thi'),
('QLKhoaThi', 'Quản lý khóa thi'),
('QLMonSinh', 'Quản lý môn sinh'),
('QLTaiKhoan', 'Quản lý tài khoản');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctphieudiem`
--

CREATE TABLE `ctphieudiem` (
  `maCTPhieuDiem` int(11) NOT NULL,
  `maKhoaThi` int(11) DEFAULT NULL,
  `maCapDai` int(11) DEFAULT NULL,
  `maKyThuat` int(11) DEFAULT NULL,
  `maMonSinh` int(11) DEFAULT NULL,
  `ThuocBai` float DEFAULT NULL,
  `NhanhManh` float DEFAULT NULL,
  `TanPhap` float DEFAULT NULL,
  `ThuyetPhuc` float DEFAULT NULL,
  `Diem` float DEFAULT NULL,
  `ketQua` int(1) DEFAULT 0,
  `GiamKhaoCham` varchar(255) DEFAULT NULL,
  `maChiTietKetQua` int(11) DEFAULT NULL,
  `ghiChu` varchar(255) DEFAULT NULL,
  `NgayCham` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ctphieudiem`
--

INSERT INTO `ctphieudiem` (`maCTPhieuDiem`, `maKhoaThi`, `maCapDai`, `maKyThuat`, `maMonSinh`, `ThuocBai`, `NhanhManh`, `TanPhap`, `ThuyetPhuc`, `Diem`, `ketQua`, `GiamKhaoCham`, `maChiTietKetQua`, `ghiChu`, `NgayCham`) VALUES
(1, 1, 1, 1, 1, 8.5, 7.5, 8, 8.5, 32.5, 1, 'gk1', 1, 'Ghi chú phiếu điểm 1', '2025-11-16'),
(2, 2, 2, 2, 2, 7, 6.5, 6.5, 7, 27, 0, 'gk2', 2, 'Ghi chú phiếu điểm 2', '2025-11-16'),
(3, 3, 3, 3, 3, 9, 8.5, 8.5, 9, 35, 1, 'gk3', 3, 'Ghi chú phiếu điểm 3', '2025-11-16'),
(4, 4, 4, 4, 4, 6, 5.5, 6, 6.5, 24, 0, 'gk4', 4, 'Ghi chú phiếu điểm 4', '2025-11-16'),
(5, 5, 5, 5, 5, 8, 7.5, 8, 8.5, 32, 1, 'gk5', 5, 'Ghi chú phiếu điểm 5', '2025-11-16'),
(6, 6, 6, 6, 6, 7.5, 7, 7.5, 7, 29.5, 0, 'gk6', 6, 'Ghi chú phiếu điểm 6', '2025-11-16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ketquathi`
--

CREATE TABLE `ketquathi` (
  `maKetQuaThi` int(11) NOT NULL,
  `maMonSinh` int(11) DEFAULT NULL,
  `maKhoaThi` int(11) DEFAULT NULL,
  `capDaiHienTai` int(11) DEFAULT NULL,
  `capDaiDuThi` int(11) DEFAULT NULL,
  `ketQua` int(1) DEFAULT 0,
  `trangThaiHoSo` int(1) DEFAULT 0,
  `ghiChu` varchar(255) DEFAULT NULL,
  `ngayCham` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ketquathi`
--

INSERT INTO `ketquathi` (`maKetQuaThi`, `maMonSinh`, `maKhoaThi`, `capDaiHienTai`, `capDaiDuThi`, `ketQua`, `trangThaiHoSo`, `ghiChu`, `ngayCham`) VALUES
(1, 1, 1, 1, 2, 1, 1, 'Ghi chú kết quả thi 1', '2024-08-01'),
(2, 2, 2, 2, 3, 0, 0, 'Ghi chú kết quả thi 2', '2024-08-05'),
(3, 3, 3, 3, 4, 1, 1, 'Ghi chú kết quả thi 3', '2024-08-10'),
(4, 4, 4, 4, 1, 0, 0, 'Ghi chú kết quả thi 4', '2024-08-12'),
(5, 5, 5, 1, 2, 1, 1, 'Ghi chú kết quả thi 5', '2024-08-15'),
(6, 6, 6, 2, 3, 1, 1, 'Ghi chú kết quả thi 6', '2024-08-18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoathi`
--

CREATE TABLE `khoathi` (
  `maKhoaThi` int(11) NOT NULL,
  `tenKhoaThi` varchar(255) DEFAULT NULL,
  `ngayThi` date DEFAULT NULL,
  `ngayKetThuc` date DEFAULT NULL,
  `hienThi` int(1) DEFAULT 1,
  `ghiChu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khoathi`
--

INSERT INTO `khoathi` (`maKhoaThi`, `tenKhoaThi`, `ngayThi`, `ngayKetThuc`, `hienThi`, `ghiChu`) VALUES
(1, 'Khóa thi 1', '2024-08-01', '2024-08-02', 1, 'Ghi chú khóa thi 1'),
(2, 'Khóa thi 2', '2024-08-05', '2024-08-06', 1, 'Ghi chú khóa thi 2'),
(3, 'Kỳ Thi Hè 2024', '2024-08-01', '2024-08-15', 1, 'Thi đầu mùa hè'),
(4, 'Kỳ Thi Thu 2024', '2024-11-01', '2024-11-15', 1, 'Thi cuối mùa thu'),
(5, 'Kỳ Thi Đông 2024', '2024-12-01', '2024-12-15', 1, 'Thi mùa đông'),
(6, 'Kỳ Thi Xuân 2025', '2025-02-01', '2025-02-15', 1, 'Thi đầu mùa xuân'),
(7, 'Kỳ Thi Hè 2025', '2025-08-01', '2025-08-15', 1, 'Thi đầu mùa hè'),
(8, 'Kỳ Thi Thu 2025', '2025-11-01', '2025-11-15', 1, 'Thi cuối mùa thu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoathicapdai`
--

CREATE TABLE `khoathicapdai` (
  `maKhoaThi` int(11) NOT NULL,
  `maCapDai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khoathicapdai`
--

INSERT INTO `khoathicapdai` (`maKhoaThi`, `maCapDai`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 2),
(4, 3),
(4, 4),
(5, 3),
(5, 4),
(5, 5),
(6, 4),
(6, 5),
(6, 6),
(7, 1),
(7, 5),
(7, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kythuat`
--

CREATE TABLE `kythuat` (
  `maKyThuat` int(11) NOT NULL,
  `tenKyThuat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `kythuat`
--

INSERT INTO `kythuat` (`maKyThuat`, `tenKyThuat`) VALUES
(1, 'Kỹ thuật đơn luyện'),
(2, 'Kỹ thuật căn bản'),
(3, 'Kỹ thuật song luyện'),
(4, 'Kỹ thuật đối kháng'),
(5, 'Kỹ thuật thể lực'),
(6, 'Kỹ thuật lý thuyết');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monsinh`
--

CREATE TABLE `monsinh` (
  `maMonSinh` int(11) NOT NULL,
  `maThe` int(11) DEFAULT NULL,
  `hoTen` varchar(255) DEFAULT NULL,
  `gioiTinh` tinyint(1) DEFAULT 1,
  `ngaySinh` date DEFAULT NULL,
  `chieuCao` int(11) DEFAULT NULL,
  `canNang` int(11) DEFAULT NULL,
  `diaChi` varchar(255) DEFAULT NULL,
  `soDienThoai` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cccd` varchar(255) DEFAULT NULL,
  `anhCCCD` varchar(255) DEFAULT NULL,
  `anh3x4` varchar(255) DEFAULT NULL,
  `ngayCapCCCD` date DEFAULT NULL,
  `noiCapCCCD` varchar(255) DEFAULT NULL,
  `tenPhuHuynh` varchar(255) DEFAULT NULL,
  `sdtPhuHuynh` varchar(255) DEFAULT NULL,
  `congViec` varchar(255) DEFAULT NULL,
  `lichSuTapLuyen` varchar(255) DEFAULT NULL,
  `lichSuThi` varchar(255) DEFAULT NULL,
  `bangCap` varchar(255) DEFAULT NULL,
  `trinhDoVanHoa` varchar(255) DEFAULT NULL,
  `khaNangNoiBat` varchar(255) DEFAULT NULL,
  `trangThai` int(11) DEFAULT 1,
  `maCapDai` int(11) DEFAULT NULL,
  `maCauLacBo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `monsinh`
--

INSERT INTO `monsinh` (`maMonSinh`, `maThe`, `hoTen`, `gioiTinh`, `ngaySinh`, `chieuCao`, `canNang`, `diaChi`, `soDienThoai`, `email`, `cccd`, `anhCCCD`, `anh3x4`, `ngayCapCCCD`, `noiCapCCCD`, `tenPhuHuynh`, `sdtPhuHuynh`, `congViec`, `lichSuTapLuyen`, `lichSuThi`, `bangCap`, `trinhDoVanHoa`, `khaNangNoiBat`, `trangThai`, `maCapDai`, `maCauLacBo`) VALUES
(1, 1, 'Nguyen Van A', 1, '2000-01-01', 170, 60, '123 Duong ABC, Quan X', '0123456789', 'nguyenvana@example.com', '123456789012', 'anhcccd1.jpg', 'anh3x4_1.jpg', '2024-01-01', 'TPHCM', 'Nguyen Thi B', '0987654321', 'Giao Vien', 'Tap Luyen 2023', 'Thi 2023', 'Cao Dang', '12', 'Kha nang tot', 0, 1, 1),
(2, 2, 'Le Thi B', 0, '1999-02-02', 165, 55, '456 Duong XYZ, Quan Y', '0987654321', 'lethib@example.com', '234567890123', 'anhcccd2.jpg', 'anh3x4_2.jpg', '2024-02-01', 'Hanoi', 'Le Van C', '0976543210', 'Sinh Vien', 'Tap Luyen 2022', 'Thi 2022', 'Dai Hoc', '10', 'Kha nang tot', 0, 2, 2),
(3, 3, 'Tran Van C', 1, '1998-03-03', 175, 70, '789 Duong DEF, Quan Z', '0765432109', 'tranvanc@example.com', '345678901234', 'anhcccd3.jpg', 'anh3x4_3.jpg', '2024-03-01', 'Danang', 'Tran Thi D', '0765432108', 'Kinh Doanh', 'Tap Luyen 2021', 'Thi 2021', 'Cao Dang', '8', 'Kha nang tot', 0, 3, 3),
(4, 4, 'Hoang Thi D', 0, '2001-04-04', 160, 50, '101 Duong GHI, Quan A', '0654321098', 'hoangthid@example.com', '456789012345', 'anhcccd4.jpg', 'anh3x4_4.jpg', '2024-04-01', 'Haiphong', 'Hoang Van E', '0654321097', 'Nhan Vien', 'Tap Luyen 2020', 'Thi 2020', 'Cao Dang', '9', 'Kha nang tot', 0, 4, 4),
(5, 5, 'Pham Van E', 1, '2002-05-05', 180, 75, '202 Duong JKL, Quan B', '0543210987', 'phamvane@example.com', '567890123456', 'anhcccd5.jpg', 'anh3x4_5.jpg', '2024-05-01', 'Cantho', 'Pham Thi F', '0543210986', 'Sinh Vien', 'Tap Luyen 2019', 'Thi 2019', 'Trung Hoc', '11', 'Kha nang tot', 0, 5, 1),
(6, 6, 'Vo Thi F', 0, '2003-06-06', 155, 48, '303 Duong MNO, Quan C', '0432109876', 'vothif@example.com', '678901234567', 'anhcccd6.jpg', 'anh3x4_6.jpg', '2024-06-01', 'Hue', 'Vo Van G', '0432109875', 'Giao Vien', 'Tap Luyen 2018', 'Thi 2018', 'Trung Hoc', '13', 'Kha nang tot', 0, 6, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `maQuyen` varchar(255) NOT NULL,
  `tenQuyen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`maQuyen`, `tenQuyen`) VALUES
('giamkhaocanban', 'Giám khảo căn bản'),
('giamkhaodoikhang', 'Giám khảo đối kháng'),
('giamkhaodonluyen', 'Giám khảo đơn luyện'),
('giamkhaolythuyet', 'Giám khảo lý thuyết'),
('giamkhaosongluyen', 'Giám khảo song luyện'),
('giamkhaotheluc', 'Giám khảo thể lực'),
('huanluyenvientruongclb', 'Huấn luyện viên trưởng'),
('monsinh', 'Môn sinh'),
('quantri', 'Quản trị cấp cao');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `tenDangNhap` varchar(255) NOT NULL,
  `ho` varchar(255) DEFAULT NULL,
  `ten` varchar(255) DEFAULT NULL,
  `matKhau` varchar(255) DEFAULT NULL,
  `anhDaiDien` varchar(255) DEFAULT NULL,
  `loai` varchar(255) DEFAULT NULL,
  `thoiGianTao` timestamp NOT NULL DEFAULT current_timestamp(),
  `thoiGianSua` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kichHoat` int(1) DEFAULT 1,
  `soDienThoai` varchar(255) DEFAULT NULL,
  `maQuyen` varchar(255) DEFAULT NULL,
  `maCauLacBo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`tenDangNhap`, `ho`, `ten`, `matKhau`, `anhDaiDien`, `loai`, `thoiGianTao`, `thoiGianSua`, `kichHoat`, `soDienThoai`, `maQuyen`, `maCauLacBo`) VALUES
('admin', 'Hoang', 'Hong', '123', 'avatar.jpg', 'JUDGE', '2024-08-07 17:48:15', '2024-08-07 17:48:15', 1, '0912345679', 'quantri', NULL),
('gk1', 'Hoang', 'Hongsd', 'password123', 'avatar.jpg', 'JUDGE', '2024-08-07 17:48:15', '2024-08-07 17:48:15', 1, '0912345679', 'giamkhaosongluyen', NULL),
('gk2', 'Hoang', 'Hongâ', 'password123', 'avatar.jpg', 'JUDGE', '2024-08-07 17:48:15', '2024-08-07 17:48:15', 1, '0912345679', 'giamkhaocanban', NULL),
('gk3', 'Hoang', 'Hongx', 'password123', 'avatar.jpg', 'JUDGE', '2024-08-07 17:48:15', '2024-08-07 17:48:15', 1, '0912345679', 'giamkhaodoikhang', NULL),
('gk4', 'Hoang', 'Hongz', 'password123', 'avatar.jpg', 'JUDGE', '2024-08-07 17:48:15', '2024-08-07 17:48:15', 1, '0912345679', 'giamkhaotheluc', NULL),
('gk5', 'Hoang', 'Hongc', 'password123', 'avatar.jpg', 'JUDGE', '2024-08-07 17:48:15', '2024-08-07 17:48:15', 1, '0912345679', 'giamkhaolythuyet', NULL),
('gk6', 'Hoang', 'Hongb', '123', 'avatar.jpg', 'JUDGE', '2024-08-07 17:48:15', '2024-08-07 17:48:15', 1, '0912345679', 'quantri', NULL),
('judgehong', 'Hoang', 'Hong', 'password123', 'avatar.jpg', 'JUDGE', '2024-08-07 17:48:15', '2024-08-07 17:48:15', 1, '0912345679', 'giamkhaodonluyen', NULL),
('nguyenvana', 'Nguyen', 'Van A', 'password123', 'avatar.jpg', 'STUDENT', '2024-08-07 17:48:15', '2024-08-07 17:48:15', 1, '0912345678', 'huanluyenvientruongclb', 1),
('truongclbB', 'Hoang', 'Hong2', 'password123', 'avatar.jpg', 'JUDGE', '2024-08-07 17:48:15', '2024-08-07 17:48:15', 1, '0912345679', 'huanluyenvientruongclb', 2),
('truongclbC', 'Hoang', 'Hong3', '123', 'avatar.jpg', 'JUDGE', '2024-08-07 17:48:15', '2024-08-07 17:48:15', 1, '0912345679', 'huanluyenvientruongclb', 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `capdai`
--
ALTER TABLE `capdai`
  ADD PRIMARY KEY (`maCapDai`);

--
-- Chỉ mục cho bảng `caulacbo`
--
ALTER TABLE `caulacbo`
  ADD PRIMARY KEY (`maCauLacBo`);

--
-- Chỉ mục cho bảng `chitietketquathi`
--
ALTER TABLE `chitietketquathi`
  ADD PRIMARY KEY (`maChiTietKetQua`),
  ADD KEY `maKetQuaThi` (`maKetQuaThi`),
  ADD KEY `tenDangNhap` (`tenDangNhap`);

--
-- Chỉ mục cho bảng `chitietquyen`
--
ALTER TABLE `chitietquyen`
  ADD PRIMARY KEY (`maQuyen`,`maChucNang`),
  ADD KEY `maChucNang` (`maChucNang`);

--
-- Chỉ mục cho bảng `chucnang`
--
ALTER TABLE `chucnang`
  ADD PRIMARY KEY (`maChucNang`);

--
-- Chỉ mục cho bảng `ctphieudiem`
--
ALTER TABLE `ctphieudiem`
  ADD PRIMARY KEY (`maCTPhieuDiem`),
  ADD KEY `maMonSinh` (`maMonSinh`),
  ADD KEY `maKyThuat` (`maKyThuat`),
  ADD KEY `maKhoaThi` (`maKhoaThi`),
  ADD KEY `maCapDai` (`maCapDai`),
  ADD KEY `GiamKhaoCham` (`GiamKhaoCham`),
  ADD KEY `maChiTietKetQua` (`maChiTietKetQua`);

--
-- Chỉ mục cho bảng `ketquathi`
--
ALTER TABLE `ketquathi`
  ADD PRIMARY KEY (`maKetQuaThi`),
  ADD KEY `maMonSinh` (`maMonSinh`),
  ADD KEY `maKhoaThi` (`maKhoaThi`),
  ADD KEY `capDaiHienTai` (`capDaiHienTai`),
  ADD KEY `capDaiDuThi` (`capDaiDuThi`);

--
-- Chỉ mục cho bảng `khoathi`
--
ALTER TABLE `khoathi`
  ADD PRIMARY KEY (`maKhoaThi`);

--
-- Chỉ mục cho bảng `khoathicapdai`
--
ALTER TABLE `khoathicapdai`
  ADD PRIMARY KEY (`maKhoaThi`,`maCapDai`),
  ADD KEY `maCapDai` (`maCapDai`);

--
-- Chỉ mục cho bảng `kythuat`
--
ALTER TABLE `kythuat`
  ADD PRIMARY KEY (`maKyThuat`);

--
-- Chỉ mục cho bảng `monsinh`
--
ALTER TABLE `monsinh`
  ADD PRIMARY KEY (`maMonSinh`),
  ADD KEY `maCapDai` (`maCapDai`),
  ADD KEY `maCauLacBo` (`maCauLacBo`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`maQuyen`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`tenDangNhap`),
  ADD KEY `maQuyen` (`maQuyen`),
  ADD KEY `maCauLacBo` (`maCauLacBo`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `capdai`
--
ALTER TABLE `capdai`
  MODIFY `maCapDai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `caulacbo`
--
ALTER TABLE `caulacbo`
  MODIFY `maCauLacBo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `chitietketquathi`
--
ALTER TABLE `chitietketquathi`
  MODIFY `maChiTietKetQua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `ctphieudiem`
--
ALTER TABLE `ctphieudiem`
  MODIFY `maCTPhieuDiem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `ketquathi`
--
ALTER TABLE `ketquathi`
  MODIFY `maKetQuaThi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `khoathi`
--
ALTER TABLE `khoathi`
  MODIFY `maKhoaThi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `kythuat`
--
ALTER TABLE `kythuat`
  MODIFY `maKyThuat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `monsinh`
--
ALTER TABLE `monsinh`
  MODIFY `maMonSinh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietketquathi`
--
ALTER TABLE `chitietketquathi`
  ADD CONSTRAINT `chitietketquathi_ibfk_1` FOREIGN KEY (`maKetQuaThi`) REFERENCES `ketquathi` (`maKetQuaThi`),
  ADD CONSTRAINT `chitietketquathi_ibfk_2` FOREIGN KEY (`tenDangNhap`) REFERENCES `taikhoan` (`tenDangNhap`);

--
-- Các ràng buộc cho bảng `chitietquyen`
--
ALTER TABLE `chitietquyen`
  ADD CONSTRAINT `chitietquyen_ibfk_1` FOREIGN KEY (`maQuyen`) REFERENCES `quyen` (`maQuyen`),
  ADD CONSTRAINT `chitietquyen_ibfk_2` FOREIGN KEY (`maChucNang`) REFERENCES `chucnang` (`maChucNang`);

--
-- Các ràng buộc cho bảng `ctphieudiem`
--
ALTER TABLE `ctphieudiem`
  ADD CONSTRAINT `ctphieudiem_ibfk_1` FOREIGN KEY (`maMonSinh`) REFERENCES `monsinh` (`maMonSinh`),
  ADD CONSTRAINT `ctphieudiem_ibfk_2` FOREIGN KEY (`maKyThuat`) REFERENCES `kythuat` (`maKyThuat`),
  ADD CONSTRAINT `ctphieudiem_ibfk_3` FOREIGN KEY (`maKhoaThi`) REFERENCES `khoathi` (`maKhoaThi`),
  ADD CONSTRAINT `ctphieudiem_ibfk_4` FOREIGN KEY (`maCapDai`) REFERENCES `capdai` (`maCapDai`),
  ADD CONSTRAINT `ctphieudiem_ibfk_5` FOREIGN KEY (`GiamKhaoCham`) REFERENCES `taikhoan` (`tenDangNhap`),
  ADD CONSTRAINT `ctphieudiem_ibfk_6` FOREIGN KEY (`maChiTietKetQua`) REFERENCES `chitietketquathi` (`maChiTietKetQua`);

--
-- Các ràng buộc cho bảng `ketquathi`
--
ALTER TABLE `ketquathi`
  ADD CONSTRAINT `ketquathi_ibfk_1` FOREIGN KEY (`maMonSinh`) REFERENCES `monsinh` (`maMonSinh`),
  ADD CONSTRAINT `ketquathi_ibfk_2` FOREIGN KEY (`maKhoaThi`) REFERENCES `khoathi` (`maKhoaThi`),
  ADD CONSTRAINT `ketquathi_ibfk_3` FOREIGN KEY (`capDaiHienTai`) REFERENCES `capdai` (`maCapDai`),
  ADD CONSTRAINT `ketquathi_ibfk_4` FOREIGN KEY (`capDaiDuThi`) REFERENCES `capdai` (`maCapDai`);

--
-- Các ràng buộc cho bảng `khoathicapdai`
--
ALTER TABLE `khoathicapdai`
  ADD CONSTRAINT `khoathicapdai_ibfk_1` FOREIGN KEY (`maKhoaThi`) REFERENCES `khoathi` (`maKhoaThi`) ON DELETE CASCADE,
  ADD CONSTRAINT `khoathicapdai_ibfk_2` FOREIGN KEY (`maCapDai`) REFERENCES `capdai` (`maCapDai`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `monsinh`
--
ALTER TABLE `monsinh`
  ADD CONSTRAINT `monsinh_ibfk_1` FOREIGN KEY (`maCapDai`) REFERENCES `capdai` (`maCapDai`),
  ADD CONSTRAINT `monsinh_ibfk_2` FOREIGN KEY (`maCauLacBo`) REFERENCES `caulacbo` (`maCauLacBo`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`maQuyen`) REFERENCES `quyen` (`maQuyen`),
  ADD CONSTRAINT `taikhoan_ibfk_2` FOREIGN KEY (`maCauLacBo`) REFERENCES `caulacbo` (`maCauLacBo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
