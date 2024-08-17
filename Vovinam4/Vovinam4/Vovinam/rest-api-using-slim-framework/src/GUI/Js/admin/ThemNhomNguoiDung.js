//Ràng buộc dữ liệu nhập vào
function validateUserGroup(maQuyenValue, tenQuyenValue) {
  // Kiểm tra xem có bất kỳ trường nào để trống không
  if (!maQuyenValue || !tenQuyenValue) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Vui lòng điền đầy đủ thông tin",
    });
    return false;
  }

  // Nếu tất cả điều kiện đều được đáp ứng, trả về true
  return true;
}

// lấy code function
async function getDataFunction() {
  try {
    const response = await fetch("../../../BLL/QuanLyNhomNguoiDungBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getArrFunction"),
    });
    const data = await response.json();
    console.log(data);

    if (data != null) {
      return data;
    }
  } catch (error) {
    console.error("Error:", error);
  }
}
// getDataFunction();

// Thêm chi tiết phân quyền
async function addPermissionDetail(maQuyen) {
  let arrDataFunction = await getDataFunction();
  let arrObjPermissionDetail = [];
  for (let item of arrDataFunction) {
    let obj = {
      maQuyen: maQuyen,
      maChucNang: item.maChucNang,
      chucNangThem: "0",
      chucNangSua: "0",
      chucNangXoa: "0",
      chucNangTimKiem: "0",
      chamDiemDonLuyen: "0",
      chamDiemSongLuyen: "0",
      chamDiemCanBan: "0",
      chamDiemDoiKhang: "0",
      chamDiemTheLuc: "0",
      chamDiemLyThuyet: "0",
    };

    arrObjPermissionDetail.push(obj);
  }

  try {
    const response = await fetch("../../../BLL/QuanLyNhomNguoiDungBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("addArrPermisstionDetail") +
        "&arr=" +
        encodeURIComponent(JSON.stringify(arrObjPermissionDetail)),
    });
    const data = await response.json();
    // console.log(data);

    return data.mess;
  } catch (error) {
    console.error("Error:", error);
  }
}

//Thêm đối tượng
async function addObj(event) {
  event.preventDefault();
  try {
    let maQuyenValue = document.getElementById("maQuyen").value.trim();
    let tenQuyenValue = document.getElementById("tenQuyen").value.trim();
    // Validate dữ liệu trước khi thêm
    if (!validateUserGroup(maQuyenValue, tenQuyenValue)) {
      return; // Dừng việc thực hiện thêm nếu dữ liệu không hợp lệ
    }

    let response = await fetch("../../../BLL/QuanLyNhomNguoiDungBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("addObj") +
        "&maQuyen=" +
        encodeURIComponent(maQuyenValue) +
        "&tenQuyen=" +
        encodeURIComponent(tenQuyenValue),
    });

    let data = await response.json();
    // console.log(data);
    let messPermissionDetail = await addPermissionDetail(maQuyen);
    if (data.mess == "success" && messPermissionDetail == "success") {
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
        window.location.href = "../../../GUI/view/admin/tongquanQLNND.php";
      });
      // window.location.href = "./QuanLyKhoaThi.php"; // Chuyển hướng sau khi thêm thành công
    } else {
      Swal.fire({
        icon: "error",
        title: "Thêm không thành công",
        text: "Bị trùng dữ liệu",
        footer: '<a href="#"></a>',
      });
    }
  } catch (error) {
    console.error(error);
  }
}
