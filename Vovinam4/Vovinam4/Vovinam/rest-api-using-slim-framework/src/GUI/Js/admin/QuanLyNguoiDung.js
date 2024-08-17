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

var dataPermission = "";
//Lấy danh sách đối tượng
async function getListObj() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/QuanLyNguoiDungBLL.php", {
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
function searchAccount() {
  document.getElementById("input-search-account").oninput = async function () {
    try {
      // Gọi AJAX để xóa payment
      let str = document
        .getElementById("input-search-account")
        .value.trim()
        .toLowerCase();
      let response = await fetch("../../../BLL/QuanLyNguoiDungBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("searchAccount") +
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
  let result = ``;
  let result1 = ``;
  let result2 = ``;
  let stt = 1;

  for (let i of data) {
    let tenDangNhap = i.tenDangNhap;
    let ho = i.ho;
    let ten = i.ten;
    let matKhau = i.matKhau;
    let anhDaiDien = i.anhDaiDien;
    let loai = i.loai;
    let thoiGianTao = i.thoiGianTao;
    let thoiGianSua = i.thoiGianSua;
    let kichHoat = i.kichHoat;
    let soDienThoai = i.soDienThoai;
    let maQuyen = i.maQuyen;

    let username = i.username;
    let passWord = i.passWord;
    let dateCreated = i.dateCreated;
    let accountStatus = i.accountStatus;
    let name = i.name;
    let email = i.email;
    let phoneNumber = i.phoneNumber;
    let birth = i.birth;
    let sex = i.sex;
    let codePermissions = i.codePermissions;
    // let maQuyen = maQuyen;

    let strStt = "";
    if (i.kichHoat == "1") {
      strStt = `<td><a class="btn btn-sm btn-primary" title="Click để khóa" onclick="updateStateUser('${i.tenDangNhap}','${i.kichHoat}',event)"> Đang kích hoạt <i class="fa fa-eye"></i></a></td>`;
    } else {
      strStt = `<td><a class="btn btn-sm btn-danger" title="Click để mở khóa" onclick="updateStateUser('${i.tenDangNhap}','${i.kichHoat}',event)"> Đang bị khóa <i class="fa fa-eye-slash"></i></a></td>`;
    }

    let String = `
      <tr>
         <td>${stt}</td>
         <td>${tenDangNhap}</td>
         <td>${ho}</td>
         <td>${ten}</td>
         <td>${loai}</td>
         <td>${soDienThoai}</td>
         ${strStt}
         <td><a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUser-${i.tenDangNhap}"><i class="fa fa-edit"></i></a></td>
         <td><a href="#" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteUser-${i.tenDangNhap}"><i class="fa fa-trash"></i>Xóa</a></td>
      </tr>
            
        `;
    let String1 = `
      <div class="modal fade" id="deleteUser-${i.tenDangNhap}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">Xóa người dùng</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  Bạn có chắc muốn xóa người dùng này?
                  <br>
                  Mã người dùng: ${i.tenDangNhap}
                  <br>
                  Tên người dùng: ${i.ten}
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                  <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-confirm-delete" onclick="deleteByID('${i.tenDangNhap}')">Xóa</button>
              </div>
          </div>
      </div>
  </div>
  
        `;
    let String2 = `
      <div class="modal fade" id="editUser-${
        i.tenDangNhap
      }" tabindex="-1" aria-labelledby="editModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Sửa thông tin người dùng</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="editForm">
                      <div class="mb-3">
                          <label for="name" class="form-label">Tên đăng nhập</label>
                          <input type="text" class="form-control" id="${
                            i.tenDangNhap
                          }" value="${i.tenDangNhap}"
                              name="codeSupplier" placeholder="NCC001" disabled>
                      </div>
                      <div class="mb-3">
                          <label for="name" class="form-label">Mật khấu</label>
                          <div class="input-group">
                          <input type="password" class="form-control" id="${
                            i.tenDangNhap
                          }-${i.matKhau}"
                              value="${
                                i.matKhau
                              }" name="passWord" aria-describedby="togglePassword">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button" class="togglePassword" onclick="togglePasswordVisibility('${
                                i.tenDangNhap
                              }-${i.matKhau}')">Show</button>
                            </div>
                          
                          </div>
                      </div>
                      <input type="hidden" class="form-control" id="${
                        i.tenDangNhap
                      }-${i.thoiGianTao}"
                          value="${i.thoiGianTao}" name="thoiGianTao">
                      <input type="hidden" class="form-control" id="${
                        i.tenDangNhap
                      }-${i.thoiGianSua}"
                          value="${i.thoiGianSua}" name="thoiGianSua">
                      <div class="mb-3">
                          <label for="ho" class="form-label">Họ</label>
                          <input type="text" class="form-control" id="${
                            i.tenDangNhap
                          }-${i.ho}" value="${i.ho}"
                              name="ho">
                      </div>
                      <div class="mb-3">
                          <label for="ten" class="form-label">Tên</label>
                          <input type="text" class="form-control" id="${
                            i.tenDangNhap
                          }-${i.ten}" value="${i.ten}"
                              name="ten">
                      </div>
                      <div class="mb-3">
                          <label for="loại" class="form-label">Loại</label>
                          <input type="text" class="form-control" id="${
                            i.tenDangNhap
                          }-${i.loai}" value="${i.loai}"
                              name="ten">
                      </div>
                      <div class="mb-3">
                          <label for="soDienThoai" class="form-label">Số điện thoại</label>
                          <input type="text" class="form-control" id="${
                            i.tenDangNhap
                          }-${i.soDienThoai}"
                              value="${i.soDienThoai}" name="soDienThoai">
                      </div>
                      <div class="mb-3">
                          <label for="anhDaiDien" class="form-label">Ảnh đại diện</label>
                          <input type="text" class="form-control" id="${
                            i.tenDangNhap
                          }-${i.anhDaiDien}"
                              value="${i.anhDaiDien}" name="anhDaiDien">
                      </div>
                        
                      <div class="mb-3">
                          <label for="brandsuppliers" class="form-label">Nhóm người dùng</label>
                          ${stringSelectorPermission(
                            dataPermission,
                            maQuyen,
                            tenDangNhap
                          )}
                      </div>
                      <div class="mb-3">
                          <label for="brandsuppliers" class="form-label">Trạng thái</label>
                          ${stringSelectorStatus(kichHoat, tenDangNhap)}
                      </div>
                      <div style="text-align:right;">
                          <button type="submit" data-bs-dismiss="modal" class="btn btn-primary"
                              onclick="updateObj('${i.tenDangNhap}','${
      i.tenDangNhap
    }-${i.ho}','${i.tenDangNhap}-${i.ten}','${i.tenDangNhap}-${i.matKhau}','${
      i.tenDangNhap
    }-${i.anhDaiDien}','${i.tenDangNhap}-${i.loai}','${i.tenDangNhap}-${
      i.thoiGianTao
    }','${i.tenDangNhap}-${i.thoiGianSua}','${i.tenDangNhap}-${i.kichHoat}','${
      i.tenDangNhap
    }-${i.soDienThoai}','${i.tenDangNhap}-${i.maQuyen}',event)">Sửa
                              người dùng</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
      
        `;
    // console.log(String);
    result += String;
    result1 += String1;
    result2 += String2;
    stt++;
  }
  // console.log(result);
  container.innerHTML = result;
  container1.innerHTML = result1;
  // console.log(result1);
  container2.innerHTML = result2;
  // console.log(result2);
}
// hiển thị password
function togglePasswordVisibility(inputId) {
  var passwordInput = document.getElementById(inputId);
  var toggleButton = document.getElementById("togglePassword");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    toggleButton.textContent = "Hide";
  } else {
    passwordInput.type = "password";
    toggleButton.textContent = "Show";
  }
}

async function getListUserGr() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/QuanLyNhomNguoiDungBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList"),
    });

    let data = await response.json();
    console.log(data);
    dataPermission = data;
    // loadDataUserGroup(data);
  } catch (error) {
    console.error(error);
  }
}

function stringSelectorPermission(dataPermission, maQuyen, tenDangNhap) {
  console.log(dataPermission);
  var string1 = `<select style="border-radius: 5px;
    border: 1px solid #d1c9c9;
    padding: 13px 7px;
    width: 100%;
    display: block;" id="${tenDangNhap}-${maQuyen}" name="${tenDangNhap}-${maQuyen}">`;
  for (let i of dataPermission) {
    if (i.maQuyen === maQuyen) {
      string1 += `<option selected value="${i.maQuyen}">${i.tenQuyen}</option>`;
    } else {
      string1 += `<option  value="${i.maQuyen}">${i.tenQuyen}</option>`;
    }
  }
  string1 += `</select>`;
  // console.log("KOKOKOKOKO");
  // console.log(string1);
  return string1;
}

function stringSelectorSex(sex, username) {
  var string = `<select style="border-radius: 5px;
    border: 1px solid #d1c9c9;
    padding: 13px 7px;
    width: 100%;
    display: block;" id="${username}-${sex}" name="${username}-${sex}">`;
  if (sex === "nam" || sex === "Nam" || sex === "Male" || sex === "male") {
    string += `<option selected value="Nam">Nam</option> <option  value="Nữ">Nữ</option>`;
  } else {
    string += `<option selected value="Nữ">Nữ</option> <option  value="Nam">Nam</option>`;
  }
  string += `</select>`;
  return string;
}

function stringSelectorStatus(kichHoat, tenDangNhap) {
  var string = `<select style="border-radius: 5px;
    border: 1px solid #d1c9c9;
    padding: 13px 7px;
    width: 100%;
    display: block;" id="${tenDangNhap}-${kichHoat}" name="${tenDangNhap}-${kichHoat}">`;
  if (kichHoat === "1") {
    string += `<option selected value="1">Đang kích hoạt</option> <option  value="0">Đang bị khóa</option>`;
  } else {
    string += `<option selected value="0">Đang bị khóa</option> <option  value="1">Đang kích hoạt</option>`;
  }
  string += `</select>`;
  return string;
}

// Lấy một đối tượng bằng id
async function getObj() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/QuanLyNguoiDungBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("getObj") +
        "&tenDangNhap=" +
        encodeURIComponent(obj.tenDangNhap),
    });

    let data = await response.json();
    console.log(data);
  } catch (error) {
    console.error(error);
  }
}

//Xóa một đối tượng
async function deleteByID(code) {
  // lấy thông tin mã  codePermission của người đăng nhập
  // let codePermission = await checkLogin_usermanager();
  // // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  // let data = await getDataPermission_usermanager(codePermission);
  // // lấy thông tin có được phép làm chức ăng đó không
  // let check = checkUpPermission_usermanager(data.permissionDetail, "delete");

  if (true) {
    try {
      // Gọi AJAX để xóa payment

      let response = await fetch("../../../BLL/QuanLyNguoiDungBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("deleteByID") +
          "&tenDangNhap=" +
          encodeURIComponent(code),
      });
      let data = await response.json();
      console.log(data);

      if (data.mess === "success") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Đã xóa tài khoản người dùng thành công",
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

//Sửa một đối tượng
async function updateObj(
  tenDangNhap,
  ho,
  ten,
  matKhau,
  anhDaiDien,
  loai,
  thoiGianTao,
  thoiGianSua,
  kichHoat,
  soDienThoai,
  maQuyen,
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
    let tenDangNhapValue = document.getElementById(tenDangNhap).value.trim();
    let hoValue = document.getElementById(ho).value.trim();
    let tenValue = document.getElementById(ten).value.trim();
    let matKhauValue = document.getElementById(matKhau).value.trim();
    let anhDaiDienValue = document.getElementById(anhDaiDien).value.trim();
    let loaiValue = document.getElementById(loai).value.trim();
    let thoiGianTaoValue = document.getElementById(thoiGianTao).value.trim();
    let thoiGianSuaValue = document.getElementById(thoiGianSua).value.trim();
    let kichHoatValue = document.getElementById(kichHoat).value.trim();
    let soDienThoaiValue = document.getElementById(soDienThoai).value.trim();
    let maQuyenValue = document.getElementById(maQuyen).value.trim();

    function dinhdangDate(currentDate) {
      var year = currentDate.getFullYear();
      var month = currentDate.getMonth() + 1; // Tháng bắt đầu từ 0 nên phải cộng thêm 1
      var day = currentDate.getDate();

      return year + "-" + month + "-" + day;
    }

    thoiGianSuaValue = new Date(dinhdangDate(new Date()))
      .toISOString()
      .slice(0, 10);

    if (
      !tenDangNhapValue ||
      !hoValue ||
      !tenValue ||
      !matKhauValue ||
      !anhDaiDienValue ||
      !loaiValue ||
      !kichHoatValue ||
      !soDienThoaiValue
    ) {
      Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: "Vui lòng điền đầy đủ thông tin",
        footer: '<a href="#"></a>',
      });
      await getListObj();
      return;
    }

    // Kiểm tra định dạng email
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

    // Kiểm tra định dạng số điện thoại
    const phoneRegex = /^\d{10,11}$/;
    if (!phoneRegex.test(soDienThoaiValue)) {
      Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: "Số điện thoại phải có 10 chữ số",
        footer: '<a href="#"></a>',
      });
      await getListObj();
      return;
    }
    // Kiểm tra xem mật khẩu và mật khẩu nhập lại có khớp nhau không

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

    try {
      // Gọi AJAX để sửa đối tượng
      let response = await fetch("../../../BLL/QuanLyNguoiDungBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("updateObj") +
          "&tenDangNhap=" +
          encodeURIComponent(tenDangNhapValue) +
          "&ho=" +
          encodeURIComponent(hoValue) +
          "&ten=" +
          encodeURIComponent(tenValue) +
          "&matKhau=" +
          encodeURIComponent(matKhauValue) +
          "&anhDaiDien=" +
          encodeURIComponent(anhDaiDienValue) +
          "&loai=" +
          encodeURIComponent(loaiValue) +
          "&thoiGianTao=" +
          encodeURIComponent(thoiGianTaoValue) +
          "&thoiGianSua=" +
          encodeURIComponent(thoiGianSuaValue) +
          "&kichHoat=" +
          encodeURIComponent(kichHoatValue) +
          "&soDienThoai=" +
          encodeURIComponent(soDienThoaiValue) +
          "&maQuyen=" +
          encodeURIComponent(maQuyenValue),
      });
      let data = await response.json();
      console.log(data);
      if (data.mess === "success") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Sửa thông tin người dùng thành công",
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

async function updateStateUser(tenDangNhap, kichHoat, event) {
  event.preventDefault();

  // lấy thông tin mã  codePermission của người đăng nhập
  // let codePermission = await checkLogin_usermanager();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  // let data = await getDataPermission_usermanager(codePermission);
  // lấy thông tin có được phép làm chức năng đó không
  // let check = checkUpPermission_usermanager(data.permissionDetail, "update");

  if (true) {
    try {
      const response = await fetch("../../../BLL/QuanLyNguoiDungBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("updateStateUser") +
          "&tenDangNhap=" +
          encodeURIComponent(tenDangNhap) +
          "&kichHoat=" +
          encodeURIComponent(kichHoat),
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
  await getListObj();
  loadItem(1, 4);
  searchAccount();
});
