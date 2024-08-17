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
var dataPermission1 = "";
//Lấy danh sách đối tượng môn sinh
var dataMonSinh = "";
async function getListObj() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/QuanLyMonSinhBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getListMonSinhChuaDangKy"),
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

function selectRow(row) {
  // Loại bỏ lớp 'selected-row' từ tất cả các hàng
  var rows = document.querySelectorAll("#danhsachUser-monsinhdangkythi tr");
  rows.forEach(function (r) {
    r.classList.remove("selected-row");
  });

  // Thêm lớp 'selected-row' vào hàng được chọn
  row.classList.add("selected-row");

  // Cập nhật trạng thái của checkbox
  var checkbox = row.querySelector(".select-row-checkbox");
  checkbox.checked = !checkbox.checked;
}

document
  .getElementById("selectAllCheckbox")
  .addEventListener("change", function () {
    var rows = document.querySelectorAll("#danhsachUser-monsinhdangkythi tr");
    var checkboxes = document.querySelectorAll(
      "#danhsachUser-monsinhdangkythi .select-row-checkbox"
    );
    checkboxes.forEach(function (checkbox, index) {
      checkbox.checked = this.checked;
      if (this.checked) {
        rows[index].classList.add("selected-row");
      } else {
        rows[index].classList.remove("selected-row");
      }
    }, this);
  });

async function loadData(data) {
  let container = document.getElementById("danhsachUser-monsinhdangkythi");
  let result = ``;
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
    let anh3x4 = i.anh3x4;
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
    //Môn sinh chưa đăng ký
    let String = `
            <tr onclick="selectRow(this)">
               <td><input type="checkbox" class="select-row-checkbox" id="${maMonSinh}"></td>
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
    stt++;
  }

  container.innerHTML = result;
}

// thêm một đối tương
// async function addObj(event) {
//   // lấy thông tin mã  codePermission của người đăng nhập
//   let codePermission = await checkLogin_usermanager();
//   // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
//   let data = await getDataPermission_usermanager(codePermission);
//   // lấy thông tin có được phép làm chức ăng đó không
//   let check = checkUpPermission_usermanager(data.permissionDetail, "add");

//   if (check == true) {
//     window.location.href = "../../../GUI/view/admin/tongquanthemQLND.php";
//   } else {
//     event.preventDefault();
//     Swal.fire({
//       icon: "error",
//       title: "Thêm không thành công",
//       text: "Không đủ quyền hàng",
//     });
//   }
// }

async function addObj(event) {
  event.preventDefault();

  try {
    let maKetQuaThiValue = document.getElementById("maKetQuaThi").value.trim();
    // let maMonSinhValue = document.getElementById("maMonSinh").value.trim();
    let maKhoaThiValue = document.getElementById("maKhoaThi").value.trim();
    let capDaiDuThiValue = document.getElementById("capDaiDuThi").value.trim();
    let ghiChuValue = document.getElementById("ghiChu").value.trim();
    // let capDaiHienTaiValue = document
    //   .getElementById("capDaiHienTai")
    //   .value.trim();
    // let ketQuaValue = document.getElementById("ketQua").value.trim();
    // let trangThaiHoSoValue = document
    //   .getElementById("trangThaiHoSo")
    //   .value.trim();
    // let ghiChuValue = document.getElementById("ghiChu").value.trim();
    let ngayChamValue = document.getElementById("ngayCham").value.trim();

    // let capDaiCheckboxes = document.querySelectorAll(".capDai-checkbox");
    // let capDaiValues = Array.from(capDaiCheckboxes)
    //   .filter((checkbox) => checkbox.checked)
    //   .map((checkbox) => checkbox.value);
    // Chuyển đổi capDaiValues thành chuỗi
    // let capDaiValuesString = capDaiValues.join(",");
    // if (!validateUser(maKhoaThiValue, capDaiDuThiValue)) {
    //   return;
    // }

    // console.log(capDaiValuesString);

    function dinhdangDate(currentDate) {
      var year = currentDate.getFullYear();
      var month = currentDate.getMonth() + 1; // Tháng bắt đầu từ 0 nên phải cộng thêm 1
      var day = currentDate.getDate();

      return year + "-" + month + "-" + day;
    }

    ngayChamValue = new Date(dinhdangDate(new Date()))
      .toISOString()
      .slice(0, 10);

    let response = await fetch("../../../BLL/QuanLyKetQuaThiBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("addObj") +
        "&maKetQuaThi=" +
        encodeURIComponent(maKetQuaThiValue) +
        "&maMonSinh=" +
        encodeURIComponent(null) +
        "&maKhoaThi=" +
        encodeURIComponent(maKhoaThiValue) +
        "&capDaiHienTai=" +
        encodeURIComponent(null) +
        "&capDaiDuThi=" +
        encodeURIComponent(capDaiDuThiValue) +
        "&ketQua=" +
        encodeURIComponent(null) +
        "&trangThaiHoSo=" +
        encodeURIComponent(0) +
        "&ghiChu=" +
        encodeURIComponent(ghiChuValue) +
        "&ngayCham=" +
        encodeURIComponent(ngayChamValue) +
        "&fileDuThi=" +
        encodeURIComponent(),
    });

    let data = await response.json();
    console.log(data);
    if (data.mess === "success") {
      Swal.fire({
        title: "Thêm thành công!",
        width: 600,
        padding: "3em",
        color: "#716add",
        background: "#fff url(../../image/trees.png)",
        backdrop: `
          rgba(0,0,123,0.4)
          url("../../image/nyan-cat.gif")
          left top
          no-repeat
        `,
      }).then(() => {
        window.location.href = "./QuanLyKhoaThi.php"; // Chuyển hướng sau khi thêm thành công
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Thêm không thành công",
        text: "Bị trùng dữ liệu",
      });
    }
  } catch (error) {
    console.error(error);
  }
}

//phần phân trang

function loadItem(thisPage, limit) {
  // tính vị trí bắt đầu và kêt thúc
  let beginGet = limit * (thisPage - 1);
  let endGet = limit * thisPage - 1;

  // lấy tất cả các dòng dữ liệu có trong bảng
  let all_data_rows = document.querySelectorAll(
    "#danhsachUser-monsinhdangkythi > tr"
  );

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

async function getListObjKhoaThiCapDai() {
  try {
    // Gọi AJAX để lấy danh sách các đối tượng
    let response = await fetch("../../../BLL/QuanLyCapDaiBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList"),
    });

    let data = await response.json();
    console.log(data);
    dataPermission1 = data;
    loadDataUserGroup(data);
  } catch (error) {
    console.error(error);
  }
}

function loadDataCapDai(data) {
  let container = document.getElementById("capDaiDuThi");
  let options = ``;
  for (let i of data) {
    let maCapDai = i.maCapDai;
    options += `<option value="${maCapDai}">${i.tenCapDai}</option>`;
  }
  console.log(options);
  container.innerHTML = options;
}

async function getListObjKhoaThi() {
  try {
    // Gọi AJAX để lấy danh sách các đối tượng
    let response = await fetch("../../../BLL/QuanLyKhoaThiBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList"),
    });

    let data = await response.json();
    console.log(data);
    dataPermission = data;
    loadDataUserGroup(data);
  } catch (error) {
    console.error(error);
  }
}

function loadDataUserGroup(data) {
  let container = document.getElementById("maKhoaThi");
  let options = ``;
  for (let i of data) {
    let maKhoaThi = i.maKhoaThi;
    options += `<option value="${maKhoaThi}">${i.tenKhoaThi}</option>`;
  }
  console.log(options);
  container.innerHTML = options;
}

window.addEventListener("load", async function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
  console.log("Trang quản lý người dùng đã load hoàn toàn");
  // await getListObj_MonSinh;
  await getListObjKhoaThi();
  await getListObjKhoaThiCapDai();
  await getListObj();
  loadItem(1, 4);
  searchMonSinh();
  loadDataCapDai(dataPermission1);
  loadDataUserGroup(dataPermission);
});
