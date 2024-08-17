var dataPermission = "";

function validateUser(
  tenKhoaThiValue,
  ngayThiValue,
  ngayKetThucValue,
  capDaiValues
) {
  console.log("Validation started");

  // Kiểm tra các trường có được nhập đầy đủ không
  if (
    !tenKhoaThiValue ||
    !ngayThiValue ||
    !ngayKetThucValue ||
    capDaiValues.length === 0
  ) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Vui lòng điền đầy đủ thông tin",
    });
    return false;
  }

  // Trả về true nếu tất cả các điều kiện đều thỏa mãn
  return true;
}

// Thêm đối tượng
async function addObj(event) {
  event.preventDefault();

  try {
    let maKhoaThiValue = document.getElementById("maKhoaThi").value.trim();

    let tenKhoaThiValue = document.getElementById("tenKhoaThi").value.trim();
    let ngayThiValue = document.getElementById("ngayThi").value.trim();
    let ngayKetThucValue = document.getElementById("ngayKetThuc").value.trim();
    let ghiChuValue = document.getElementById("ghiChu").value.trim();
    let hienThiValue = document.getElementById("hienThi").value.trim();

    let capDaiCheckboxes = document.querySelectorAll(".capDai-checkbox");
    let capDaiValues = Array.from(capDaiCheckboxes)
      .filter((checkbox) => checkbox.checked)
      .map((checkbox) => checkbox.value);
    // Chuyển đổi capDaiValues thành chuỗi
    let capDaiValuesString = capDaiValues.join(",");
    if (
      !validateUser(
        tenKhoaThiValue,
        ngayThiValue,
        ngayKetThucValue,
        capDaiValues
      )
    ) {
      return;
    }

    console.log(capDaiValuesString);

    let response = await fetch("../../../BLL/QuanLyKhoaThiBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("addObj") +
        "&maKhoaThi=" +
        encodeURIComponent(maKhoaThiValue) +
        "&tenKhoaThi=" +
        encodeURIComponent(tenKhoaThiValue) +
        "&ngayThi=" +
        encodeURIComponent(ngayThiValue) +
        "&ngayKetThuc=" +
        encodeURIComponent(ngayKetThucValue) +
        "&hienThi=" +
        encodeURIComponent(hienThiValue) +
        "&ghiChu=" +
        encodeURIComponent(ghiChuValue) +
        "&dsCapDaiThi=" +
        encodeURIComponent(capDaiValuesString),
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

function dinhdangDate(currentDate) {
  var year = currentDate.getFullYear();
  var month = (currentDate.getMonth() + 1).toString().padStart(2, "0"); // Tháng bắt đầu từ 0 nên phải cộng thêm 1
  var day = currentDate.getDate().toString().padStart(2, "0");
  return year + "-" + month + "-" + day;
}

async function getListObj() {
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
    dataPermission = data;
    loadDataUserGroup(data);
  } catch (error) {
    console.error(error);
  }
}

function loadDataUserGroup(data) {
  let container = document.getElementById("dsCapDaiThi");
  let options = ``;
  for (let i of data) {
    let maCapDai = i.maCapDai;
    options += `<div>
                  <input type="checkbox" id="capDai_${maCapDai}" name="capDai[]" value="${maCapDai}" class="capDai-checkbox">
                  <label for="capDai_${maCapDai}">${i.tenCapDai}</label>
                </div>`;
  }
  console.log(options);
  container.innerHTML = options;
}

window.addEventListener("load", async function () {
  console.log("Trang quản lý nhóm người dùng đã load hoàn toàn");
  await getListObj();
  loadDataUserGroup(dataPermission);
});
