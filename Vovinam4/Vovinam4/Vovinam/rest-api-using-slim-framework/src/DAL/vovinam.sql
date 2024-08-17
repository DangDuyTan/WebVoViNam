
-- Bảng quyền
CREATE TABLE quyen (
    maQuyen VARCHAR(255) PRIMARY KEY NOT NULL,
    tenQuyen VARCHAR(255)
);
CREATE TABLE caulacbo (
    maCauLacBo INT PRIMARY KEY AUTO_INCREMENT,
    tenCauLacBo VARCHAR(255) NOT NULL
);
-- Bảng tài khoản
CREATE TABLE taikhoan (
    tenDangNhap VARCHAR(255) PRIMARY KEY NOT NULL,
    ho VARCHAR(255),
    ten VARCHAR(255),
    matKhau VARCHAR(255),
    anhDaiDien VARCHAR(255),
    loai VARCHAR(255),
    -- ('SUPPER_ADMIN', 'JUDGE', 'CLUB_COACH', 'STUDENT'),
    thoiGianTao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    thoiGianSua TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    kichHoat INT(1) DEFAULT 1, -- 1: hiển thị, 0: khóa
    soDienThoai VARCHAR(255),
    maQuyen VARCHAR(255),
    maCauLacBo INT,
    FOREIGN KEY (maQuyen) REFERENCES quyen(maQuyen)
    FOREIGN KEY (maCauLacBo) REFERENCES caulacbo(maCauLacBo)
);

-- Bảng chức năng
CREATE TABLE chucnang (
    maChucNang VARCHAR(255) PRIMARY KEY NOT NULL,
    tenChucNang VARCHAR(255)
);

-- Bảng chi tiết quyền
CREATE TABLE chitietquyen (
    maQuyen VARCHAR(255) NOT NULL,
    maChucNang VARCHAR(255) NOT NULL,
    chucNangThem INT(1) DEFAULT 0,
    chucNangSua INT(1) DEFAULT 0,
    chucNangXoa INT(1) DEFAULT 0,
    chucNangTimKiem INT(1) DEFAULT 0,
    chamDiemDonLuyen INT(1) DEFAULT 0,
    chamDiemSongLuyen INT(1) DEFAULT 0,
    chamDiemCanBan INT(1) DEFAULT 0,
    chamDiemDoiKhang INT(1) DEFAULT 0,
    chamDiemTheLuc INT(1) DEFAULT 0,
    chamDiemLyThuyet INT(1) DEFAULT 0,
    PRIMARY KEY (maQuyen, maChucNang),
    FOREIGN KEY (maQuyen) REFERENCES quyen(maQuyen),
    FOREIGN KEY (maChucNang) REFERENCES chucnang(maChucNang)
);


-- Bảng khóa thi
CREATE TABLE khoathi (
    maKhoaThi INT PRIMARY KEY AUTO_INCREMENT,
    tenKhoaThi VARCHAR(255),
    ngayThi DATE,
    ngayKetThuc DATE,
    hienThi INT(1) DEFAULT 1, -- 0: ẩn, 1: hiển thị
    ghiChu VARCHAR(255)
);

-- Bảng cấp đai
CREATE TABLE capdai (
    maCapDai INT PRIMARY KEY AUTO_INCREMENT,
    tenCapDai VARCHAR(255)
);

-- Bảng kỹ thuật
CREATE TABLE kythuat (
    maKyThuat INT PRIMARY KEY AUTO_INCREMENT,
    tenKyThuat VARCHAR(255)
);

-- Bảng môn sinh
CREATE TABLE monsinh (
    maMonSinh INT PRIMARY KEY AUTO_INCREMENT,
    maThe INT,
    hoTen VARCHAR(255),
    gioiTinh TINYINT(1) Default 1,
    ngaySinh DATE,
    chieuCao INT,
    canNang INT,
    diaChi VARCHAR(255),
    soDienThoai VARCHAR(255),
    email VARCHAR(255),
    cccd VARCHAR(255),
    anhCCCD VARCHAR(255),
    anh3x4 VARCHAR(255),
    ngayCapCCCD DATE,
    noiCapCCCD VARCHAR(255),
    tenPhuHuynh VARCHAR(255),
    sdtPhuHuynh VARCHAR(255),
    congViec VARCHAR(255),
    lichSuTapLuyen VARCHAR(255),
    lichSuThi VARCHAR(255),
    bangCap VARCHAR(255),
    trinhDoVanHoa VARCHAR(255),
    khaNangNoiBat VARCHAR(255),
    trangThai INT Default 1, -- 1: đang tập luyện (không có trong danh sách đăng ký thi đấu), 0: đang chờ thi
    maCapDai INT, -- Cấp đai hiện tại
    maCauLacBo INT, -- câu lạc bộ 
    FOREIGN KEY (maCapDai) REFERENCES capdai(maCapDai)
    FOREIGN KEY (maCauLacBo) REFERENCES caulacbo(maCauLacBo)

);

-- Bảng kết quả thi
CREATE TABLE ketquathi (
    maKetQuaThi INT PRIMARY KEY AUTO_INCREMENT,
    maMonSinh INT,
    maKhoaThi INT,
    capDaiHienTai INT,
    capDaiDuThi INT,
    ketQua INT(1) DEFAULT 0, -- 1: đậu, 0: rớt
    trangThaiHoSo INT(1) DEFAULT 0, -- 1: được duyệt, 0: chưa duyệt
    ghiChu VARCHAR(255),
    ngayCham DATE,
    FOREIGN KEY (maMonSinh) REFERENCES monsinh(maMonSinh), --liên kết khóa ngoại
    FOREIGN KEY (maKhoaThi) REFERENCES khoathi(maKhoaThi),--liên kết khóa ngoại
    FOREIGN KEY (capDaiHienTai) REFERENCES capdai(maCapDai),--liên kết khóa ngoại
    FOREIGN KEY (capDaiDuThi) REFERENCES capdai(maCapDai)--liên kết khóa ngoại
);

-- Bảng chi tiết kết quả thi
CREATE TABLE chitietketquathi (
    maChiTietKetQua INT PRIMARY KEY AUTO_INCREMENT,
    maKetQuaThi INT,
    -- maKyThuat INT, -- Nội dung thi như Kỹ thuật căn bản
    diemDon FLOAT,
    diemCan FLOAT,
    diemSong FLOAT,
    diemDoi FLOAT,
    diemLyThuyet FLOAT,
    diemTheLuc FLOAT,
    tongDiem FLOAT,
    ketQua INT(1) DEFAULT 0, -- 1: đạt, 0: không đạt
    ghiChu VARCHAR(255),
    tenDangNhap VARCHAR(255),
    FOREIGN KEY (maKetQuaThi) REFERENCES ketquathi(maKetQuaThi),
    FOREIGN KEY (tenDangNhap) REFERENCES taikhoan(tenDangNhap),
    -- FOREIGN KEY (maKyThuat) REFERENCES kythuat(maKyThuat)
);


-- Bảng CTPhieuDiem
CREATE TABLE CTPhieuDiem (
    maCTPhieuDiem INT PRIMARY KEY AUTO_INCREMENT,
    -- maKetQuaThi INT,
    maKhoaThi INT, -- Nội dung thi như Kỹ thuật căn bản
    maCapDai INT,
    maKyThuat INT,
    maMonSinh INT,
    ThuocBai FLOAT,
    NhanhManh FLOAT,
    TanPhap FLOAT,
    ThuyetPhuc FLOAT,
    Diem FLOAT,
    ketQua INT(1) DEFAULT 0, -- 1: đạt, 0: không đạt
    GiamKhaoCham VARCHAR(255),
    maChiTietKetQua INT,
    ghiChu VARCHAR(255),
    -- FOREIGN KEY (maKetQuaThi) REFERENCES ketquathi(maKetQuaThi),
    FOREIGN KEY (maMonSinh) REFERENCES monsinh(maMonSinh),
    FOREIGN KEY (maKyThuat) REFERENCES kythuat(maKyThuat),
    FOREIGN KEY (maKhoaThi) REFERENCES khoathi(maKhoaThi),
    FOREIGN KEY (maCapDai) REFERENCES capdai(maCapDai),
    FOREIGN KEY (GiamKhaoCham) REFERENCES taikhoan(tenDangNhap)
    FOREIGN KEY (maChiTietKetQua) REFERENCES chitietketquathi(maChiTietKetQua)
);


-- Bảng trung gian để liên kết khoathi và capdai
CREATE TABLE khoathicapdai (
    maKhoaThi INT,
    maCapDai INT,
    PRIMARY KEY (maKhoaThi, maCapDai),
    FOREIGN KEY (maKhoaThi) REFERENCES khoathi(maKhoaThi) ON DELETE CASCADE,
    FOREIGN KEY (maCapDai) REFERENCES capdai(maCapDai) ON DELETE CASCADE
);



-- Bảng chi tiết quyền liên kết với bảng quyền
ALTER TABLE chitietquyen
ADD FOREIGN KEY (maQuyen) REFERENCES quyen(maQuyen);

-- Bảng chi tiết quyền liên kết với bảng chức năng
ALTER TABLE chitietquyen
ADD FOREIGN KEY (maChucNang) REFERENCES chucnang(maChucNang);

-- Bảng kết quả thi liên kết với bảng môn sinh
ALTER TABLE ketquathi
ADD FOREIGN KEY (maMonSinh) REFERENCES monsinh(maMonSinh);

-- Bảng kết quả thi liên kết với bảng khóa thi
ALTER TABLE ketquathi
ADD FOREIGN KEY (maKhoaThi) REFERENCES khoathi(maKhoaThi);

-- Bảng chi tiết kết quả thi liên kết với bảng kết quả thi
ALTER TABLE chitietketquathi
ADD FOREIGN KEY (maKetQuaThi) REFERENCES ketquathi(maKetQuaThi);

-- Bảng chi tiết kết quả thi liên kết với bảng tài khoản (giám khảo chấm thi)
ALTER TABLE chitietketquathi
ADD FOREIGN KEY (tenDangNhap) REFERENCES taikhoan(tenDangNhap);


-- Thêm dữ liệu vào các bảng
-- Thêm dữ liệu vào bảng quyền
INSERT INTO quyen (maQuyen, tenQuyen) VALUES
('quantri', 'Quản trị cấp cao'),
('giamkhaodonluyen', 'Giám khảo đơn luyện'),
('giamkhaosongluyen', 'Giám khảo song luyện'),
('giamkhaocanban', 'Giám khảo căn bản'),
('giamkhaodoikhang', 'Giám khảo đối kháng'),
('giamkhaotheluc', 'Giám khảo thể lục'),
('giamkhaolythuyet', 'Giám khảo lý thuyết'),
('monsinh', 'Môn sinh'),
('huanluyenvientruongclb', 'Huấn luyện viên trưởng');

-- Thêm dữ liệu vào bảng taikhoan
INSERT INTO taikhoan (tenDangNhap, ho, ten, matKhau, anhDaiDien, loai, thoiGianTao, thoiGianSua, kichHoat, soDienThoai, maQuyen) VALUES
('nguyenvana', 'Nguyen', 'Van A', 'password123', 'avatar.jpg', 'STUDENT', NOW(), NOW(), 1, '0912345678', 'monsinh'),
('judgehong', 'Hoang', 'Hong', 'judgepass', 'judge.jpg', 'JUDGE', NOW(), NOW(), 1, '0923456789', 'giamkhaodonluyen'),
('coachbui', 'Bui', 'Binh', 'coachpass', 'coach.jpg', 'CLUB_COACH', NOW(), NOW(), 1, '0934567890', 'giamkhaolythuyet'),
('admintran', 'Tran', 'Thanh', 'adminpass', 'admin.jpg', 'SUPPER_ADMIN', NOW(), NOW(), 1, '0945678901', 'quantri'),
('assistantle', 'Le', 'Lan', 'assistantpass', 'assistant.jpg', 'STUDENT', NOW(), NOW(), 1, '0956789012', 'huanluyenvientruongclb'),
('supervisornguyen', 'Nguyen', 'Nga', 'supervisorpass', 'supervisor.jpg', 'JUDGE', NOW(), NOW(), 1, '0967890123', 'giamkhaocanban');

-- Thêm dữ liệu vào bảng chức năng
INSERT INTO chucnang (maChucNang, tenChucNang) VALUES
('quanlytaikhoan', 'Quản lý tài khoản'),
('quanlymonsinh', 'Quản lý môn sinh'),
('quanlykhoathi', 'Quản lý khóa thi'),
('quanlychamthi', 'Quản lý chấm thi'),
('quanlyketquathi', 'Quản lý kết quả thi'),
('quanlydangkyduthi', 'Quản lý đăng ký dự thi');

-- Thêm dữ liệu vào bảng chi tiết quyền
INSERT INTO chitietquyen (maQuyen, maChucNang, chucNangThem, chucNangSua, chucNangXoa, chucNangTimKiem, chamDiemDonLuyen, chamDiemSongLuyen, chamDiemCanBan, chamDiemDoiKhang, chamDiemTheLuc, chamDiemLyThuyet) VALUES
('quantri', 'quanlytaikhoan', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('quantri', 'quanlymonsinh', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('quantri', 'quanlykhoathi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('quantri', 'quanlychamthi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('quantri', 'quanlyketquathi', 0, 0, 0, 0, 1, 1, 1, 1, 1, 1),
('quantri', 'quanlydangkyduthi', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1),

('giamkhaodonluyen', 'quanlytaikhoan', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaodonluyen', 'quanlymonsinh', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaodonluyen', 'quanlykhoathi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaodonluyen', 'quanlychamthi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaodonluyen', 'quanlyketquathi', 0, 0, 0, 0, 1, 1, 1, 1, 1, 1),
('giamkhaodonluyen', 'quanlydangkyduthi', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1),


('giamkhaosongluyen', 'quanlytaikhoan', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaosongluyen', 'quanlymonsinh', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaosongluyen', 'quanlykhoathi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaosongluyen', 'quanlychamthi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaosongluyen', 'quanlyketquathi', 0, 0, 0, 0, 1, 1, 1, 1, 1, 1),
('giamkhaosongluyen', 'quanlydangkyduthi', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1),


('giamkhaocanban', 'quanlytaikhoan', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaocanban', 'quanlymonsinh', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaocanban', 'quanlykhoathi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaocanban', 'quanlychamthi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaocanban', 'quanlyketquathi', 0, 0, 0, 0, 1, 1, 1, 1, 1, 1),
('giamkhaocanban', 'quanlydangkyduthi', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1),

('giamkhaodoikhang', 'quanlytaikhoan', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaodoikhang', 'quanlymonsinh', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaodoikhang', 'quanlykhoathi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaodoikhang', 'quanlychamthi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaodoikhang', 'quanlyketquathi', 0, 0, 0, 0, 1, 1, 1, 1, 1, 1),
('giamkhaodoikhang', 'quanlydangkyduthi', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1),


('giamkhaotheluc', 'quanlytaikhoan', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaotheluc', 'quanlymonsinh', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaotheluc', 'quanlykhoathi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaotheluc', 'quanlychamthi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaotheluc', 'quanlyketquathi', 0, 0, 0, 0, 1, 1, 1, 1, 1, 1),
('giamkhaotheluc', 'quanlydangkyduthi', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1),


('giamkhaolythuyet', 'quanlytaikhoan', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaolythuyet', 'quanlymonsinh', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaolythuyet', 'quanlykhoathi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaolythuyet', 'quanlychamthi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('giamkhaolythuyet', 'quanlyketquathi', 0, 0, 0, 0, 1, 1, 1, 1, 1, 1),
('giamkhaolythuyet', 'quanlydangkyduthi', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1),

('monsinh', 'quanlytaikhoan', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('monsinh', 'quanlymonsinh', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('monsinh', 'quanlykhoathi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('monsinh', 'quanlychamthi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('monsinh', 'quanlyketquathi', 0, 0, 0, 0, 1, 1, 1, 1, 1, 1),
('monsinh', 'quanlydangkyduthi', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1),

('huanluyenvientruongclb', 'quanlytaikhoan', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('huanluyenvientruongclb', 'quanlymonsinh', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('huanluyenvientruongclb', 'quanlykhoathi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('huanluyenvientruongclb', 'quanlychamthi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('huanluyenvientruongclb', 'quanlyketquathi', 0, 0, 0, 0, 1, 1, 1, 1, 1, 1),
('huanluyenvientruongclb', 'quanlydangkyduthi', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1);








-- Thêm dữ liệu vào bảng khóa thi
INSERT INTO khoathi (tenKhoaThi, ngayThi, ngayKetThuc, hienThi, ghiChu) VALUES
('Kỳ Thi Hè 2024', '2024-08-01', '2024-08-15', 1, 'Thi đầu mùa hè'),
('Kỳ Thi Thu 2024', '2024-11-01', '2024-11-15', 1, 'Thi cuối mùa thu'),
('Kỳ Thi Đông 2024', '2024-12-01', '2024-12-15', 1, 'Thi mùa đông'),
('Kỳ Thi Xuân 2025', '2025-02-01', '2025-02-15', 1, 'Thi đầu mùa xuân'),
('Kỳ Thi Hè 2025', '2025-08-01', '2025-08-15', 1, 'Thi đầu mùa hè'),
('Kỳ Thi Thu 2025', '2025-11-01', '2025-11-15', 1, 'Thi cuối mùa thu');

-- Thêm dữ liệu vào bảng cấp đai
INSERT INTO capdai (tenCapDai) VALUES
('Đai Xanh'),
('Đai Đen'),
('Đai Trắng'),
('Đai Vàng'),
('Đai Nâu'),
('Đai Đỏ');

-- Thêm dữ liệu vào bảng kỹ thuật
INSERT INTO kythuat (tenKyThuat) VALUES
('Kỹ thuật đơn luyện'),
('Kỹ thuật căn bản'),
('Kỹ thuật song luyện'),
('Kỹ thuật đối kháng'),
('Kỹ thuật thể lực'),
('Kỹ thuật lý thuyết');


-- Thêm dữ liệu vào bảng môn sinh
INSERT INTO monsinh (
    maThe, hoTen, gioiTinh, ngaySinh, chieuCao, canNang, diaChi, soDienThoai, email, cccd,
    anhCCCD, anh3x4, ngayCapCCCD, noiCapCCCD, tenPhuHuynh, sdtPhuHuynh, congViec, lichSuTapLuyen,
    lichSuThi, bangCap, trinhDoVanHoa, khaNangNoiBat, maCapDai
) VALUES
(1, 'Nguyen Van A', 1, '2000-01-01', 170, 60, '123 Duong ABC, Quan X', '0123456789', 'nguyenvana@example.com', '123456789012',
 'anhcccd1.jpg', 'anh3x4_1.jpg', '2024-01-01', 'TPHCM', 'Nguyen Thi B', '0987654321', 'Giao Vien', 'Tap Luyen 2023',
 'Thi 2023', 'Cao Dang', '12', 'Kha nang tot', 1),
(2, 'Le Thi B', 0, '1999-02-02', 165, 55, '456 Duong XYZ, Quan Y', '0987654321', 'lethib@example.com', '234567890123',
 'anhcccd2.jpg', 'anh3x4_2.jpg', '2024-02-01', 'Hanoi', 'Le Van C', '0976543210', 'Sinh Vien', 'Tap Luyen 2022',
 'Thi 2022', 'Dai Hoc', '10', 'Kha nang tot', 2),
(3, 'Tran Van C', 1, '1998-03-03', 175, 70, '789 Duong DEF, Quan Z', '0765432109', 'tranvanc@example.com', '345678901234',
 'anhcccd3.jpg', 'anh3x4_3.jpg', '2024-03-01', 'Danang', 'Tran Thi D', '0765432108', 'Kinh Doanh', 'Tap Luyen 2021',
 'Thi 2021', 'Cao Dang', '8', 'Kha nang tot', 3),
(4, 'Hoang Thi D', 0, '2001-04-04', 160, 50, '101 Duong GHI, Quan A', '0654321098', 'hoangthid@example.com', '456789012345',
 'anhcccd4.jpg', 'anh3x4_4.jpg', '2024-04-01', 'Haiphong', 'Hoang Van E', '0654321097', 'Nhan Vien', 'Tap Luyen 2020',
 'Thi 2020', 'Cao Dang', '9', 'Kha nang tot', 4),
(5, 'Pham Van E', 1, '2002-05-05', 180, 75, '202 Duong JKL, Quan B', '0543210987', 'phamvane@example.com', '567890123456',
 'anhcccd5.jpg', 'anh3x4_5.jpg', '2024-05-01', 'Cantho', 'Pham Thi F', '0543210986', 'Sinh Vien', 'Tap Luyen 2019',
 'Thi 2019', 'Trung Hoc', '11', 'Kha nang tot', 5),
(6, 'Vo Thi F', 0, '2003-06-06', 155, 48, '303 Duong MNO, Quan C', '0432109876', 'vothif@example.com', '678901234567',
 'anhcccd6.jpg', 'anh3x4_6.jpg', '2024-06-01', 'Hue', 'Vo Van G', '0432109875', 'Giao Vien', 'Tap Luyen 2018',
 'Thi 2018', 'Trung Hoc', '13', 'Kha nang tot', 6);


-- Thêm dữ liệu vào bảng kết quả thi
INSERT INTO ketquathi (maMonSinh, maKhoaThi, capDaiHienTai, capDaiDuThi, ketQua, trangThaiHoSo, ghiChu, ngayCham) VALUES
(1, 1, 2, 3, 1, 1, 'Đạt yêu cầu', '2024-07-16'),
(2, 2, 1, 2, 1, 1, 'Không đạt yêu cầu', '2024-11-16'),
(3, 3, 3, 4, 1, 1, 'Đạt yêu cầu', '2024-12-16'),
(4, 4, 4, 5, 1, 1, 'Không đạt yêu cầu', '2025-02-16'),
(5, 5, 5, 6, 1, 1, 'Đạt yêu cầu', '2025-08-16'),
(6, 6, 6, 1, 1, 1, 'Đạt yêu cầu', '2025-11-16');

-- Thêm dữ liệu vào bảng chi tiết kết quả thi
INSERT INTO chitietketquathi (maKetQuaThi, maKyThuat, diemDon, diemCan, diemSong, diemDoi, diemLyThuyet, diemTheLuc, tongDiem, ketQua, ghiChu, tenDangNhap) VALUES
(1, 1, 8.0, 9.0, 7.5, 8.5, 9.0, 8.0, 50.0, 1, 'Đạt yêu cầu', 'judgehong'),
(2, 2, 6.0, 7.0, 5.5, 6.5, 7.0, 6.0, 38.0, 0, 'Không đạt yêu cầu', 'judgehong'),
(3, 3, 9.0, 8.0, 9.5, 8.5, 9.0, 8.5, 53.5, 1, 'Đạt yêu cầu', 'judgehong'),
(4, 4, 5.0, 6.0, 4.5, 5.5, 6.0, 5.0, 32.0, 0, 'Không đạt yêu cầu', 'judgehong'),
(5, 5, 8.5, 8.5, 7.0, 7.5, 8.0, 7.5, 47.0, 1, 'Đạt yêu cầu', 'judgehong'),
(6, 6, 9.5, 9.0, 8.5, 8.0, 9.0, 8.5, 52.5, 1, 'Đạt yêu cầu', 'judgehong');

-- Thêm dữ liệu vào bảng CTPhieuDiem
INSERT INTO CTPhieuDiem (maKetQuaThi, maKhoaThi, maCapDai, maKyThuat, maMonSinh, ThuocBai, NhanhManh, TanPhap, ThuyetPhuc, Diem, ketQua, GiamKhaoCham, ghiChu) VALUES
(1, 1, 2, 1, 1, 8.0, 8.0, 8.0, 8.0, 8.0, 1, 'judgehong', 'Đạt yêu cầu'),
(2, 2, 1, 2, 2, 6.0, 6.0, 6.0, 6.0, 6.0, 0, 'judgehong', 'Không đạt yêu cầu'),
(3, 3, 3, 3, 3, 9.0, 9.0, 9.0, 9.0, 9.0, 1, 'judgehong', 'Đạt yêu cầu'),
(4, 4, 4, 4, 4, 5.0, 5.0, 5.0, 5.0, 5.0, 0, 'judgehong', 'Không đạt yêu cầu'),
(5, 5, 5, 5, 5, 8.5, 8.5, 8.5, 8.5, 8.5, 1, 'judgehong', 'Đạt yêu cầu'),
(6, 6, 6, 6, 6, 9.5, 9.5, 9.5, 9.5, 9.5, 1, 'judgehong', 'Đạt yêu cầu');


-- Thêm dữ liệu vào bảng khoathicapdai để đồng bộ
INSERT INTO khoathicapdai (maKhoaThi, maCapDai) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 3),
(3, 2),
(3, 4),
(4, 1),
(4, 4),
(5, 1),
(5, 2),
(6, 3),
(6, 4);





