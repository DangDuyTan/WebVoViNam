// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function checkLogin_usermanager() {
  try {
    const response = await fetch("../../../BLL/TaiKhoanBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("checkLogin"),
    });
    const data = await response.json();
    console.log(data);
    let result = data[0];
    if (result.result == "success" && result.codePermission != "user") {
      // getDataPermission_payment(result.codePermission);
      return result.codePermission;
    }
    // for (let i of data) {
    //        console.log(i);
    // }
    // showProductItem(data);
  } catch (error) {
    console.error("Error:", error);
  }
}
// checkLogin();

async function getDataPermission_usermanager(codePermission) {
  try {
    const response = await fetch("../../../BLL/QuanLyNhomNguoiDungBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("getArrPermissionDetail") +
        "&codePermission=" +
        encodeURIComponent(codePermission),
    });
    const data = await response.json();
    console.log(data);

    if (data != null) {
      // checkUpPermission_payment(data.permissionDetail,codePermission,"");
      return data;
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

// setup các chức năng được truy cập
function checkUpPermission_usermanager(dataPermissionDetail, functionPoint) {
  if (functionPoint == "") {
    return false;
  }

  for (let item of dataPermissionDetail) {
    if (item.functionCode == "account") {
      console.log("Phan quyen");
      // thêm
      if (item.addPermission == "1" && functionPoint == "add") {
        console.log("Được phép thêm");
        return true;
      } else if (item.addPermission != "1" && functionPoint == "add") {
        console.log("Không Được phép thêm");
        return false;
      }
      // sửa
      if (item.fixPermission == "1" && functionPoint == "update") {
        console.log("Được phép sửa");
        return true;
      } else if (item.fixPermission != "1" && functionPoint == "update") {
        console.log("Không Được phép sửa");
        return false;
      }

      // xóa
      if (item.deletePermission == "1" && functionPoint == "delete") {
        console.log("Được phép xóa");
        return true;
      } else if (item.deletePermission != "1" && functionPoint == "delete") {
        console.log("Không Được phép xóa");
        return false;
      }
    }
  }
}

//Lấy danh sách đối tượng
async function getListObj() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/QuanLyMonSinhBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList"),
    });
    let data = await response.json();
    console.log(data);
    await loadData(data);
    loadPage();
  } catch (error) {
    console.error(error);
  }
}

// getListObj();
// lấy dữ liệu từ kết quả  rearch
function searchMonSinh() {
  document.getElementById("input-search-account").oninput = async function () {
    try {
      // Gọi AJAX để xóa payment
      let str = document
        .getElementById("input-search-account")
        .value.trim()
        .toLowerCase();
      let response = await fetch("../../../BLL/QuanLyMonSinhBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("searchMonSinh") +
          "&str=" +
          encodeURIComponent(str),
      });

      let data = await response.json();
      if (data.length == 0) {
        console.log("Không có dữ liệu");

        document.querySelector("#Pagination").style.display = "none";
        loadData(data);
      } else {
        loadData(data);
        document.querySelector("#Pagination").style.display = "flex";
        loadItem(1, 4);
      }
      console.log(data);

      loadPage();
    } catch (error) {
      console.error(error);
    }
  };
}

async function loadData(data) {
  let container = document.getElementById("danhsachUser");
  let container1 = document.getElementById("delete-User");
  let container2 = document.getElementById("edit-User");
  // let container3 = document.getElementById("danhsachUser-monsinhdangkythi");
  let result = ``;
  let result1 = ``;
  let result2 = ``;
  let result3 = ``;

  let stt = 1;

  for (let i of data) {
    let maMonSinh = i.maMonSinh;
    let maThe = i.maThe;
    let hoTen = i.hoTen;
    let gioiTinh = i.gioiTinh;
    let ngaySinh = i.ngaySinh;
    let chieuCao = i.chieuCao;
    let canNang = i.canNang;
    let diaChi = i.diaChi;
    let soDienThoai = i.soDienThoai;
    let email = i.email;
    let cccd = i.cccd;
    let anhCCCD = i.anhCCCD;
    // let anh3x4 = i.anh3x4;
    let ngayCapCCCD = i.ngayCapCCCD;
    let noiCapCCCD = i.noiCapCCCD;
    let tenPhuHuynh = i.tenPhuHuynh;
    let sdtPhuHuynh = i.sdtPhuHuynh;
    let congViec = i.congViec;
    let lichSuTapLuyen = i.lichSuTapLuyen;
    let lichSuThi = i.lichSuThi;
    let bangCap = i.bangCap;
    let trinhDoVanHoa = i.trinhDoVanHoa;
    let khaNangNoiBat = i.khaNangNoiBat;
    let trangThai = i.trangThai;
    let maCapDai = i.maCapDai;
    let tenCapDai = i.tenCapDai;
    let maCauLacBo = i.maCauLacBo;
    //khai báo để load ảnh avatar
    // let stringImg = i.anh3x4;
    // let arrImg = stringImg.split(" ");
    // let firstImg = stringImg[0];
    // let anh3x4Array = JSON.parse(i.anh3x4); // Parse the JSON string to an array
    // let anh3x4URL = anh3x4Array[0]; // Assuming you want to load the first image
    let anh3x4URL = i.anh3x4;
    //Môn sinh chưa đăng ký
    // console.log(maCauLacBo);

    //khong dung
    let tenDangNhap = i.tenDangNhap;
    let ho = i.ho;
    let ten = i.ten;
    let matKhau = i.matKhau;
    let anhDaDien = i.anhDaiDien;
    let loai = i.loai;
    let thoiGianTao = i.thoiGianTao;
    let thoiGianSua = i.thoiGianSua;
    let kichHoat = i.kichHoat;
    // let soDienThoai = i.soDienThoai;
    let maQuyen = i.maQuyen;
    let username = i.username;
    let passWord = i.passWord;
    let dateCreated = i.dateCreated;
    let accountStatus = i.accountStatus;
    let name = i.name;
    // let email = i.email;
    let phoneNumber = i.phoneNumber;
    let birth = i.birth;
    let sex = i.sex;
    let codePermissions = i.codePermissions;
    let strStt = "";
    if (i.trangThai == "1") {
      strStt = `<td><a class="btn btn-sm btn-primary" title="Click để khóa" onclick="updateMonSinh('${i.maMonSinh}','${i.trangThai}',event)"> Đang tập luyện <i class="fa "></i></a></td>`;
    } else {
      strStt = `<td><a class="btn btn-sm btn-danger" title="Click để mở khóa" onclick="updateMonSinh('${i.maMonSinh}','${i.trangThai}',event)"> Chờ thi đấu <i class="fa "></i></a></td>`;
    }

    let String = `
        <tr>
           <td>${stt}</td>
           <td><img src="../${anh3x4URL}" width="70px" height="90px"></td>
           <td>${maThe}</td>
           <td>${hoTen}</td>
           <td>${soDienThoai}</td>
           <td>${ngaySinh}</td>
           <td>${tenCapDai}</td>
           
           ${strStt}
           <td><a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUser-${i.maMonSinh}"><i class="fa fa-edit"></i></a></td>
           <td><a href="#" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteUser-${i.maMonSinh}"><i class="fa fa-trash"></i>Xóa</a></td>
        </tr>
              
          `;
    let String1 = `
        <div class="modal fade" id="deleteUser-${i.maMonSinh}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xóa môn sinh</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc muốn xóa môn sinh này?
                    <br>
                    Mã môn sinh: ${i.maMonSinh}
                    <br>
                    Họ tên môn sinh: ${i.hoTen}
                    <br>
                    Điện thoại môn sinh: ${i.soDienThoai}
                    <br>
                    Ngày sinh môn sinh: ${i.ngaySinh}
                    <br>
                    Cấp đai môn sinh: ${i.tenCapDai}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-confirm-delete" onclick="deleteByID('${i.maMonSinh}')">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    
          `;
    let String2 = `
        <div class="modal fade" id="editUser-${
          i.maMonSinh
        }" tabindex="-1" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Sửa thông tin môn sinh</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Mã Môn sinh</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }" value="${i.maMonSinh}"
                                name="maMonSinh" placeholder="4" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="maThe" class="form-label">Mã thẻ</label>
                            <input type="number" class="form-control" id="${
                              i.maMonSinh
                            }-${i.maThe}"
                                value="${i.maThe}" name="maThe">
                        </div>  
                        <div class="mb-3">
                            <label for="hoTen" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }-${i.hoTen}" value="${i.hoTen}"
                                name="hoTen">
                        </div>                      
                        <div class="mb-3">
                            <label for="gioiTinh" class="form-label">Giới tính</label>
                            ${stringSelectorSex(gioiTinh, maMonSinh)}
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" id="${
                              i.maMonSinh
                            }-${i.ngaySinh}"
                                value="${i.ngaySinh}" name="ngaySinh">
                        </div>
                        <div class="mb-3">
                            <label for="chieuCao" class="form-label">Chiều cao</label>
                            <input type= "number" class="form-control" id="${
                              i.maMonSinh
                            }-${i.chieuCao}" value="${i.chieuCao}"
                                name="chieuCao">
                        </div>
                        <div class="mb-3">
                            <label for="canNang" class="form-label">Cân nặng</label>
                            <input type="number" class="form-control" id="${
                              i.maMonSinh
                            }-${i.canNang}" value="${i.canNang}"
                                name="canNang">
                        </div>
                        <div class="mb-3">
                            <label for="diaChi" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }-${i.diaChi}" value="${i.diaChi}"
                                name="diaChi">
                        </div>
                        <div class="mb-3">
                            <label for="soDienThoai" class="form-label">Số điện thoại</label>
                            <input type="number" class="form-control" id="${
                              i.maMonSinh
                            }-${i.soDienThoai}" value="${i.soDienThoai}"
                                name="soDienThoai">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }-${i.email}" value="${i.email}"
                                name="email">
                        </div>
                        <div class="mb-3">
                            <label for="cccd" class="form-label">CCCD</label>
                            <input type="number" class="form-control" id="${
                              i.maMonSinh
                            }-${i.cccd}" value="${i.cccd}"
                                name="cccd">
                        </div>
                        <div class="mb-3">
                            
                            <input type="hidden" class="form-control" id="${
                              i.maMonSinh
                            }-${i.anhCCCD}" value="${i.anhCCCD}"
                                name="anhCCCD">
                        </div>
                        <div class="mb-3">
                            
                            <input type="hidden" class="form-control" id="${
                              i.maMonSinh
                            }-${i.anh3x4}" value="${i.anh3x4}"
                                name="anh3x4">
                        </div>
                        <div class="mb-3">
                            <label for="ngayCapCCCD" class="form-label">Ngày cấp CCCD</label>
                            <input type="date" class="form-control" id="${
                              i.maMonSinh
                            }-${i.ngayCapCCCD}" value="${i.ngayCapCCCD}"
                                name="ngayCapCCCD">
                        </div>
                        <div class="mb-3">
                            <label for="noiCapCCCD" class="form-label">Nơi cấp CCCD</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }-${i.noiCapCCCD}" value="${i.noiCapCCCD}"
                                name="ngayCapCCCD">
                        </div>
                         <div class="mb-3">
                            <label for="tenPhuHuynh" class="form-label">Tên phụ huynh</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }-${i.tenPhuHuynh}" value="${i.tenPhuHuynh}"
                                name="ngayCapCCCD">
                        </div>
                        <div class="mb-3">
                            <label for="sdtPhuHuynh" class="form-label">SĐT phụ huynh</label>
                            <input type="number" class="form-control" id="${
                              i.maMonSinh
                            }-${i.sdtPhuHuynh}" value="${i.sdtPhuHuynh}"
                                name="ngayCapCCCD">
                        </div>
                        <div class="mb-3">
                            <label for="congViec" class="form-label">Công việc</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }-${i.congViec}" value="${i.congViec}"
                                name="congViec">
                        </div>
                        <div class="mb-3">
                            <label for="lichSuTapLuyen" class="form-label">Lịch sử tập luyện</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }-${i.lichSuTapLuyen}" value="${i.lichSuTapLuyen}"
                                name="lichSuTapLuyen">
                        </div>
                        <div class="mb-3">
                            <label for="lichSuThi" class="form-label">Lịch sử thi</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }-${i.lichSuThi}" value="${i.lichSuThi}"
                                name="lichSuThi">
                        </div>
                        <div class="mb-3">
                            <label for="bangCap" class="form-label">Bằng cấp</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }-${i.bangCap}" value="${i.bangCap}"
                                name="bangCap">
                        </div>
                        <div class="mb-3">
                            <label for="trinhDoVanHoa" class="form-label">Trình độ văn hóa</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }-${i.trinhDoVanHoa}" value="${i.trinhDoVanHoa}"
                                name="trinhDoVanHoa">
                        </div>
                        <div class="mb-3">
                            <label for="khaNangNoiBat" class="form-label">Khả năng nổi bật</label>
                            <input type="text" class="form-control" id="${
                              i.maMonSinh
                            }-${i.khaNangNoiBat}" value="${i.khaNangNoiBat}"
                                name="khaNangNoiBat">
                        </div>
                        
                        <div class="mb-3">
                          <label for="brandsuppliers" class="form-label">Cấp đai</label>
                            ${stringSelectorPermission(
                              dataPermission,
                              maCapDai,
                              maMonSinh
                            )}
                        </div>             
                        <div class="mb-3">
                          <label for="brandsuppliers" class="form-label">Câu lạc bộ</label>
                            ${stringSelectorMaCauLacBo(
                              dataPermission_caulacbo,
                              maCauLacBo,
                              maMonSinh
                            )}
                        </div>          
                        <div class="mb-3">
                        <label for="trangThai" class="form-label">Trạng thái</label>
                        ${stringSelectorStatus(trangThai, maMonSinh)}
                        </div>
                        <div style="text-align:right;">
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary"
                        onclick="updateObj('${i.maMonSinh}', '${i.maMonSinh}-${
      i.maThe
    }', '${i.maMonSinh}-${i.hoTen}','${i.maMonSinh}-${i.gioiTinh}','${
      i.maMonSinh
    }-${i.ngaySinh}','${i.maMonSinh}-${i.chieuCao}','${i.maMonSinh}-${
      i.canNang
    }','${i.maMonSinh}-${i.diaChi}','${i.maMonSinh}-${i.soDienThoai}','${
      i.maMonSinh
    }-${i.email}','${i.maMonSinh}-${i.cccd}','${i.maMonSinh}-${i.anhCCCD}','${
      i.maMonSinh
    }-${i.anh3x4}','${i.maMonSinh}-${i.ngayCapCCCD}','${i.maMonSinh}-${
      i.noiCapCCCD
    }','${i.maMonSinh}-${i.tenPhuHuynh}','${i.maMonSinh}-${i.sdtPhuHuynh}','${
      i.maMonSinh
    }-${i.congViec}','${i.maMonSinh}-${i.lichSuTapLuyen}','${i.maMonSinh}-${
      i.lichSuThi
    }','${i.maMonSinh}-${i.bangCap}','${i.maMonSinh}-${i.trinhDoVanHoa}','${
      i.maMonSinh
    }-${i.khaNangNoiBat}','${i.maMonSinh}-${i.trangThai}','${i.maMonSinh}-${
      i.maCapDai
    }','${i.maMonSinh}-${i.maCauLacBo}',event)">Sửa
    môn sinh</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    
    `;
    // <div class="mb-3">
    //     <label for="brandsuppliers" class="form-label">Nhóm người dùng</label>
    //     ${stringSelectorPermission(
    //       dataPermission,
    //       codePermissions,
    //       tenDangNhap
    //     )}
    // </div>
    let String3 = `
          <tr>
             <td>${stt}</td>
             <td>${maMonSinh}</td>
             <td>${hoTen}</td>
             <td>${soDienThoai}</td>
             <td>${ngaySinh}</td>
             <td>${tenCapDai}</td>
          </tr>
                
            `;
    // console.log(String);
    result += String;
    result1 += String1;
    result2 += String2;
    // result3 += String3;
    stt++;
  }
  // console.log(result);
  container.innerHTML = result;
  container1.innerHTML = result1;
  // console.log(result1);
  container2.innerHTML = result2;
  // container3.innerHTML = result3;
  // console.log(result3);
}
// hiển thị password
// function togglePasswordVisibility(inputId) {
//   var passwordInput = document.getElementById(inputId);
//   var toggleButton = document.getElementById("togglePassword");

//   if (passwordInput.type === "password") {
//     passwordInput.type = "text";
//     toggleButton.textContent = "Hide";
//   } else {
//     passwordInput.type = "password";
//     toggleButton.textContent = "Show";
//   }
// }

var dataPermission = "";
// load dữ liệu cấp đai
async function getListUserGr() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/QuanLyCapDaiBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList"),
    });

    let data = await response.json();
    // console.log(data);
    dataPermission = data;
    // loadDataUserGroup(data);
  } catch (error) {
    console.error(error);
  }
}

function stringSelectorPermission(dataPermission, maCapDai, maMonSinh) {
  // console.log(dataPermission);
  var string1 = `<select style="border-radius: 5px;
      border: 1px solid #d1c9c9;
      padding: 13px 7px;
      width: 100%;
      display: block;" id="${maMonSinh}-${maCapDai}" name="${maMonSinh}-${maCapDai}">`;
  for (let i of dataPermission) {
    if (i.maCapDai === maCapDai) {
      string1 += `<option selected value="${i.maCapDai}">${i.tenCapDai}</option>`;
    } else {
      string1 += `<option  value="${i.maCapDai}">${i.tenCapDai}</option>`;
    }
  }
  string1 += `</select>`;
  // console.log("KOKOKOKOKO");
  // console.log(string1);
  return string1;
}
var dataPermission_caulacbo = "";

// load dữ liệu câu lạc bộ
async function getListUserGr_caulacbo() {
  try {
    let response = await fetch("../../../BLL/QuanLyCauLacBoBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList_caulacbo"),
    });

    let data = await response.json();
    console.log(data);
    dataPermission_caulacbo = data;
    // loadDataUserGroup(data);
  } catch (error) {
    console.error(error);
  }
}

function stringSelectorMaCauLacBo(
  dataPermission_caulacbo,
  maCauLacBo,
  maMonSinh
) {
  // console.log(dataPermission_caulacbo);
  var string1 = `<select style="border-radius: 5px;
      border: 1px solid #d1c9c9;
      padding: 13px 7px;
      width: 100%;
      display: block;" id="${maMonSinh}-${maCauLacBo}" name="${maMonSinh}-${maCauLacBo}">`;
  for (let i of dataPermission_caulacbo) {
    if (i.maCauLacBo === maCauLacBo) {
      string1 += `<option selected value="${i.maCauLacBo}">${i.tenCauLacBo}</option>`;
    } else {
      string1 += `<option  value="${i.maCauLacBo}">${i.tenCauLacBo}</option>`;
    }
  }
  string1 += `</select>`;
  // console.log("KOKOKOKOKO");
  // console.log(string1);
  return string1;
}

function stringSelectorSex(gioiTinh, maMonSinh) {
  var string = `<select style="border-radius: 5px;
      border: 1px solid #d1c9c9;
      padding: 13px 7px;
      width: 100%;
      display: block;" id="${maMonSinh}-${gioiTinh}" name="${maMonSinh}-${gioiTinh}">`;
  if (gioiTinh === "1" || gioiTinh == 1) {
    string += `<option selected value="1">Nam</option> <option value="0">Nữ</option>`;
  } else {
    string += `<option selected value="0">Nữ</option> <option value="1">Nam</option>`;
  }
  string += `</select>`;
  return string;
}

function stringSelectorStatus(trangThai, maMonSinh) {
  var string = `<select style="border-radius: 5px;
      border: 1px solid #d1c9c9;
      padding: 13px 7px;
      width: 100%;
      display: block;" id="${maMonSinh}-${trangThai}" name="${maMonSinh}-${trangThai}">`;
  if (trangThai === "1") {
    string += `<option selected value="1">Đang tập luyện</option> <option  value="0">Chờ thi đấu</option>`;
  } else {
    string += `<option selected value="0">Chờ thi đấu</option> <option  value="1">Đang tập luyện</option>`;
  }
  string += `</select>`;
  return string;
}

// Lấy một đối tượng bằng id
async function getObj() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/QuanLyMonSinhBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("getObj") +
        "&maMonSinh=" +
        encodeURIComponent(obj.maMonSinh),
    });

    let data = await response.json();
    console.log(data);
  } catch (error) {
    console.error(error);
  }
}

//Xóa một đối tượng
async function deleteByID(maMonSinh) {
  // lấy thông tin mã  codePermission của người đăng nhập
  // let codePermission = await checkLogin_usermanager();
  // // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  // let data = await getDataPermission_usermanager(codePermission);
  // // lấy thông tin có được phép làm chức ăng đó không
  // let check = checkUpPermission_usermanager(data.permissionDetail, "delete");

  if (true) {
    try {
      // Gọi AJAX để xóa payment

      let response = await fetch("../../../BLL/QuanLyMonSinhBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("deleteByID") +
          "&maMonSinh=" +
          encodeURIComponent(maMonSinh),
      });
      let data = await response.json();
      console.log(data);

      if (data.mess === "success") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Đã xóa môn sinh thành công",
          showConfirmButton: false,
          timer: 1500,
        });
        await getListObj();
      } else {
        Swal.fire({
          icon: "error",
          title: "Không cho phép xóa",
          text: "Bị ràng buộc dữ liệu",
          timer: 1500,
        });
      }
    } catch (error) {
      console.error(error);
    }
  } else {
    Swal.fire({
      icon: "error",
      title: "Xóa không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

// thêm một đối tương
async function addObj(event) {
  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_usermanager();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_usermanager(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_usermanager(data.permissionDetail, "add");

  if (check == true) {
    window.location.href = "../../../GUI/view/admin/tongquanthemQLND.php";
  } else {
    event.preventDefault();
    Swal.fire({
      icon: "error",
      title: "Thêm không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

// Sửa một đối tượng
async function updateObj(
  maMonSinh,
  maThe,
  hoTen,
  gioiTinh,
  ngaySinh,
  chieuCao,
  canNang,
  diaChi,
  soDienThoai,
  email,
  cccd,
  anhCCCD,
  anh3x4,
  ngayCapCCCD,
  noiCapCCCD,
  tenPhuHuynh,
  sdtPhuHuynh,
  congViec,
  lichSuTapLuyen,
  lichSuThi,
  bangCap,
  trinhDoVanHoa,
  khaNangNoiBat,
  trangThai,
  maCapDai,
  maCaulacBo,
  event
) {
  event.preventDefault();

  // lấy thông tin mã  codePermission của người đăng nhập
  // let codePermission = await checkLogin_usermanager();
  // // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  // let data = await getDataPermission_usermanager(codePermission);
  // // lấy thông tin có được phép làm chức ăng đó không
  // let check = checkUpPermission_usermanager(data.permissionDetail, "update");

  if (true) {
    // let usernameValue = document.getElementById(username).value.trim();
    // let passWordValue = document.getElementById(passWord).value.trim();
    // let dateCreatedValue = document.getElementById(dateCreated).value.trim();
    // let accountStatusValue = document
    //   .getElementById(accountStatus)
    //   .value.trim();
    // let nameValue = document.getElementById(name).value.trim();
    // let addressValue = document.getElementById(address).value.trim();
    // let emailValue = document.getElementById(email).value.trim();
    // let phoneNumberValue = document.getElementById(phoneNumber).value.trim();
    // let birthValue = document.getElementById(birth).value.trim();
    // let sexValue = document.getElementById(sex).value.trim();
    // let codePermissionsValue = document
    //   .getElementById(codePermissions)
    //   .value.trim();
    // console.log(usernameValue);
    // console.log(passWordValue);
    // console.log(phoneNumberValue);

    let maMonSinhValue = document.getElementById(maMonSinh).value.trim();
    let maTheValue = document.getElementById(maThe).value.trim();
    let hoTenValue = document.getElementById(hoTen).value.trim();
    let gioiTinhValue = document.getElementById(gioiTinh).value;
    let ngaySinhValue = document.getElementById(ngaySinh).value.trim();
    let chieuCaoValue = document.getElementById(chieuCao).value.trim();
    let canNangValue = document.getElementById(canNang).value.trim();
    let diaChiValue = document.getElementById(diaChi).value.trim();
    let soDienThoaiValue = document.getElementById(soDienThoai).value.trim();
    let emailValue = document.getElementById(email).value.trim();
    let cccdValue = document.getElementById(cccd).value.trim();
    let anhCCCDValue = document.getElementById(anhCCCD).value.trim();
    let anh3x4Value = document.getElementById(anh3x4).value.trim();
    let ngayCapCCCDValue = document.getElementById(ngayCapCCCD).value.trim();
    let noiCapCCCDValue = document.getElementById(noiCapCCCD).value.trim();
    let tenPhuHuynhValue = document.getElementById(tenPhuHuynh).value.trim();
    let sdtPhuHuynhValue = document.getElementById(sdtPhuHuynh).value.trim();
    let congViecValue = document.getElementById(congViec).value.trim();
    let lichSuTapLuyenValue = document
      .getElementById(lichSuTapLuyen)
      .value.trim();
    let lichSuThiValue = document.getElementById(lichSuThi).value.trim();
    let bangCapValue = document.getElementById(bangCap).value.trim();
    let trinhDoVanHoaValue = document
      .getElementById(trinhDoVanHoa)
      .value.trim();
    let khaNangNoiBatValue = document
      .getElementById(khaNangNoiBat)
      .value.trim();
    let trangThaiValue = document.getElementById(trangThai).value.trim();
    let maCapDaiValue = document.getElementById(maCapDai).value.trim();
    let maCaulacBoValue = document.getElementById(maCaulacBo).value.trim();

    // if (
    //   !usernameValue ||
    //   !passWordValue ||
    //   !dateCreatedValue ||
    //   !accountStatusValue ||
    //   !nameValue ||
    //   !addressValue ||
    //   !emailValue ||
    //   !phoneNumberValue ||
    //   !birthValue ||
    //   !sexValue ||
    //   !codePermissionsValue
    // ) {
    //   Swal.fire({
    //     icon: "error",
    //     title: "Lỗi",
    //     text: "Vui lòng điền đầy đủ thông tin",
    //     footer: '<a href="#"></a>',
    //   });
    //   await getListObj();
    //   return;
    // }

    // // Kiểm tra định dạng email
    // const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    // if (!emailRegex.test(emailValue)) {
    //   Swal.fire({
    //     icon: "error",
    //     title: "Lỗi",
    //     text: "Email không hợp lệ",
    //     footer: '<a href="#"></a>',
    //   });
    //   await getListObj();
    //   return;
    // }

    // // Kiểm tra định dạng số điện thoại
    // const phoneRegex = /^\d{10,11}$/;
    // if (!phoneRegex.test(phoneNumberValue)) {
    //   Swal.fire({
    //     icon: "error",
    //     title: "Lỗi",
    //     text: "Số điện thoại phải có 10 chữ số",
    //     footer: '<a href="#"></a>',
    //   });
    //   await getListObj();
    //   return;
    // }
    // // Kiểm tra xem mật khẩu và mật khẩu nhập lại có khớp nhau không

    // const usernameRegex = /^[^\s@+]+$/;
    // if (!usernameRegex.test(usernameValue)) {
    //   Swal.fire({
    //     icon: "error",
    //     title: "Lỗi",
    //     text: "Tên đăng nhập không được chứa ký tự đặc biệt như '@' hoặc '+',...",
    //     footer: '<a href="#"></a>',
    //   });
    //   await getListObj();
    //   return;
    // }
    console.log(gioiTinhValue);
    try {
      // Gọi AJAX để sửa đối tượng
      let response = await fetch("../../../BLL/QuanLyMonSinhBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("updateObj") +
          "&maMonSinh=" +
          encodeURIComponent(maMonSinhValue) +
          "&maThe=" +
          encodeURIComponent(maTheValue) +
          "&hoTen=" +
          encodeURIComponent(hoTenValue) +
          "&gioiTinh=" +
          encodeURIComponent(gioiTinhValue) +
          "&ngaySinh=" +
          encodeURIComponent(ngaySinhValue) +
          "&chieuCao=" +
          encodeURIComponent(chieuCaoValue) +
          "&canNang=" +
          encodeURIComponent(canNangValue) +
          "&diaChi=" +
          encodeURIComponent(diaChiValue) +
          "&soDienThoai=" +
          encodeURIComponent(soDienThoaiValue) +
          "&email=" +
          encodeURIComponent(emailValue) +
          "&cccd=" +
          encodeURIComponent(cccdValue) +
          "&anhCCCD=" +
          encodeURIComponent(anhCCCDValue) +
          "&anh3x4=" +
          encodeURIComponent(anh3x4Value) +
          "&ngayCapCCCD=" +
          encodeURIComponent(ngayCapCCCDValue) +
          "&noiCapCCCD=" +
          encodeURIComponent(noiCapCCCDValue) +
          "&tenPhuHuynh=" +
          encodeURIComponent(tenPhuHuynhValue) +
          "&sdtPhuHuynh=" +
          encodeURIComponent(sdtPhuHuynhValue) +
          "&congViec=" +
          encodeURIComponent(congViecValue) +
          "&lichSuTapLuyen=" +
          encodeURIComponent(lichSuTapLuyenValue) +
          "&lichSuThi=" +
          encodeURIComponent(lichSuThiValue) +
          "&bangCap=" +
          encodeURIComponent(bangCapValue) +
          "&trinhDoVanHoa=" +
          encodeURIComponent(trinhDoVanHoaValue) +
          "&khaNangNoiBat=" +
          encodeURIComponent(khaNangNoiBatValue) +
          "&trangThai=" +
          encodeURIComponent(trangThaiValue) +
          "&maCapDai=" +
          encodeURIComponent(maCapDaiValue) +
          "&maCauLacBo=" +
          encodeURIComponent(maCaulacBoValue),
      });
      let data = await response.json();
      console.log(data);
      if (data.mess === "success") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Sửa thông tin môn sinh thành công",
          showConfirmButton: false,
          timer: 1500,
        });
        await getListObj();
      }
    } catch (error) {
      console.error(error);
    }
  } else {
    Swal.fire({
      icon: "error",
      title: "Sửa không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

//Hàm thay đổi trạng thái

async function updateMonSinh(maMonSinh, trangThai, event) {
  event.preventDefault();

  // lấy thông tin mã  codePermission của người đăng nhập
  // let codePermission = await checkLogin_usermanager();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  // let data = await getDataPermission_usermanager(codePermission);
  // lấy thông tin có được phép làm chức năng đó không
  // let check = checkUpPermission_usermanager(data.permissionDetail, "update");

  if (true) {
    try {
      const response = await fetch("../../../BLL/QuanLyMonSinhBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("updateMonSinh") +
          "&maMonSinh=" +
          encodeURIComponent(maMonSinh) +
          "&trangThai=" +
          encodeURIComponent(trangThai),
      });

      const data = await response.json();
      console.log(data);
      if (data.mess === "success") {
        await getListObj();
      }
    } catch (error) {
      console.error("Error:", error);
    }
  } else {
    Swal.fire({
      icon: "error",
      title: "Sửa không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

//phần phân trang

function loadItem(thisPage, limit) {
  // tính vị trí bắt đầu và kêt thúc
  let beginGet = limit * (thisPage - 1);
  let endGet = limit * thisPage - 1;

  // lấy tất cả các dòng dữ liệu có trong bảng
  let all_data_rows = document.querySelectorAll("#danhsachUser > tr");

  all_data_rows.forEach((item, index) => {
    if (index >= beginGet && index <= endGet) {
      item.style.display = "table-row";
    } else {
      item.style.display = "none";
    }
  });

  // hàm tính có bao nhieu nút chuyển trang
  listPage(thisPage, limit, all_data_rows);
  // loadPage();
}

function listPage(thisPage, limit, all_data_rows) {
  let result = "";
  let count = Math.ceil(all_data_rows.length / limit);
  // thêm nút prev

  if (thisPage != 1) {
    let string = `<li class="page-item" onclick="loadItem(${
      Number(thisPage) - 1
    },${limit})"><a class="page-link">Previous</a></li>`;
    result += string;
  } else if (thisPage == 1) {
    let string = `<li class="page-item disabled" style="cursor: default;"><a class="page-link">Previous</a></li>`;
    result += string;
  }

  // tính xem có bao nhieu nút

  // lấy container chứa nút phân trang
  let container = document.getElementById("Pagination");

  for (let i = 1; i <= count; i++) {
    let string = `<li class="page-item" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
    if (i == thisPage) {
      string = `<li class="page-item active" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
    }
    result += string;
  }

  // thêm nút next

  if (thisPage != count) {
    let string1 = `<li class="page-item" onclick="loadItem(${
      Number(thisPage) + 1
    },${limit})"><a class="page-link">Next</a></li>`;
    result += string1;
  } else if (thisPage == count) {
    let string1 = `<li class="page-item disabled" style="cursor: default;"><a class="page-link">Next</a></li>`;
    result += string1;
  }

  container.innerHTML = result;
}

function loadPage() {
  // Lấy danh sách tất cả các thẻ <li> trong <ul> có id là "Panigation"
  var listItems = document.querySelectorAll("#Pagination li");

  // Duyệt qua từng phần tử trong danh sách
  listItems.forEach(function (item) {
    // Kiểm tra xem phần tử hiện tại có class là "active" hay không
    if (item.classList.contains("active")) {
      // Nếu có, lấy nội dung trong thẻ <a> bên trong và chuyển thành số
      var activePageText = item.querySelector("a").textContent.trim();
      var activePageNumber = parseInt(activePageText);
      console.log("Trang đang active: " + activePageNumber);
      loadItem(activePageNumber, 4);
    }
  });
}
window.addEventListener("load", async function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
  console.log("Trang quản lý người dùng đã load hoàn toàn");
  await getListUserGr();
  await getListUserGr_caulacbo();
  await getListObj();
  loadItem(1, 4);
  searchMonSinh();
});
