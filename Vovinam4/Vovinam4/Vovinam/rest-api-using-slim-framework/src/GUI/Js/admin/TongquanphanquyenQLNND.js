// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function getDataPermission_tongquanphanquyen(justData) {
  // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
  let urlParams = new URLSearchParams(window.location.search);

  // Lấy giá trị của tham số 'code' từ URL hiện tại
  let maQuyen = urlParams.get("maQuyen");

  if (maQuyen != "" && maQuyen != null) {
    try {
      const response = await fetch("../../../BLL/QuanLyNhomNguoiDungBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("getArrChiTietQuyen") +
          "&maQuyen=" +
          encodeURIComponent(maQuyen),
      });
      const data = await response.json();
      console.log(data);

      if (data != null) {
        console.log(data);
        // checkUpPermission_payment(data.permissionDetail,codePermission,"");
        if (justData == true) {
          return data;
        } else {
          showData(maQuyen, data.chiTietQuyen, data.chucNang);
        }
      } else {
        window.location.href = "../../../GUI/view/admin/tongquanQLNND.php";
      }
    } catch (error) {
      console.error("Error:", error);
      window.location.href = "../../../GUI/view/admin/tongquanQLNND.php";
    }
  } else {
    window.location.href = "../../../GUI/view/admin/tongquanQLNND.php";
  }
}

function showData(maQuyen, chiTietQuyen, dataChucNang) {
  let container = document.getElementById("content-data-table");
  let chucNangObj = {};
  for (let item of dataChucNang) {
    chucNangObj[item.maChucNang] = item.tenChucNang;
  }
  // console.log(functionObj);

  let result = "";
  for (let item of chiTietQuyen) {
    let string = "";
    let tenChucNang = chucNangObj[item.maChucNang];
    let chucNangThem = item.chucNangThem;
    let chucNangSua = item.chucNangSua;
    let chucNangXoa = item.chucNangXoa;
    let chucNangTimKiem = item.chucNangTimKiem;
    let chamDiemDonLuyen = item.chamDiemDonLuyen;
    let chamDiemSongLuyen = item.chamDiemSongLuyen;
    let chamDiemCanBan = item.chamDiemCanBan;
    let chamDiemDoiKhang = item.chamDiemDoiKhang;
    let chamDiemTheLuc = item.chamDiemTheLuc;
    let chamDiemLyThuyet = item.chamDiemLyThuyet;

    let stringTenChucNang = `<td>${tenChucNang}</td>`;

    let stringchucNangThem = "";
    let stringchucNangSua = "";
    let stringchucNangXoa = "";
    let stringchucNangTimKiem = "";
    let stringchamDiemDonLuyen = "";
    let stringchamDiemSongLuyen = "";
    let stringchamDiemCanBan = "";
    let stringchamDiemDoiKhang = "";
    let stringchamDiemTheLuc = "";
    let stringchamDiemLyThuyet = "";

    // them
    if (chucNangThem == "1") {
      stringchucNangThem = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chucNangThem" checked></td>`;
    } else if (chucNangThem != "1") {
      stringchucNangThem = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chucNangThem"></td>`;
    }
    // update
    if (chucNangSua == "1") {
      stringchucNangSua = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chucNangSua" checked></td>`;
    } else if (chucNangSua != "1") {
      stringchucNangSua = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chucNangSua"></td>`;
    }
    // xoa
    if (chucNangXoa == "1") {
      stringchucNangXoa = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chucNangXoa" checked></td>`;
    } else if (chucNangXoa != "1") {
      stringchucNangXoa = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chucNangXoa"></td>`;
    }
    // xem
    if (chucNangTimKiem == "1") {
      stringchucNangTimKiem = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chucNangTimKiem" checked></td>`;
    } else if (chucNangTimKiem != "1") {
      stringchucNangTimKiem = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chucNangTimKiem"></td>`;
    }

    // đơn luyện
    if (chamDiemDonLuyen == "1") {
      stringchamDiemDonLuyen = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemDonLuyen" checked></td>`;
    } else if (chamDiemDonLuyen != "1") {
      stringchamDiemDonLuyen = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemDonLuyen"></td>`;
    }
    // song luyện
    if (chamDiemSongLuyen == "1") {
      stringchamDiemSongLuyen = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemSongLuyen" checked></td>`;
    } else if (chamDiemSongLuyen != "1") {
      stringchamDiemSongLuyen = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemSongLuyen"></td>`;
    }
    // căn bản
    if (chamDiemCanBan == "1") {
      stringchamDiemCanBan = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemCanBan" checked></td>`;
    } else if (chamDiemCanBan != "1") {
      stringchamDiemCanBan = `
                     <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemCanBan"></td>`;
    }
    // đối kháng
    if (chamDiemDoiKhang == "1") {
      stringchamDiemDoiKhang = `
                 <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemDoiKhang" checked></td>`;
    } else if (chamDiemDoiKhang != "1") {
      stringchamDiemDoiKhang = `
                 <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemDoiKhang"></td>`;
    }

    // thể lực
    if (chamDiemTheLuc == "1") {
      stringchamDiemTheLuc = `
                 <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemTheLuc" checked></td>`;
    } else if (chamDiemTheLuc != "1") {
      stringchamDiemTheLuc = `
                 <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemTheLuc"></td>`;
    }
    // lý thuyết
    if (chamDiemLyThuyet == "1") {
      stringchamDiemLyThuyet = `
                 <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemLyThuyet" checked></td>`;
    } else if (chamDiemLyThuyet != "1") {
      stringchamDiemLyThuyet = `
                 <td><input type="checkbox" name="" value="" id = "${maQuyen}-${item.maChucNang}-chamDiemLyThuyet"></td>`;
    }

    // string
    string = `
                     <tr>
                            ${stringTenChucNang}
                            ${stringchucNangThem}
                            ${stringchucNangSua}
                            ${stringchucNangXoa}
                            ${stringchucNangTimKiem}
                            ${stringchamDiemDonLuyen}
                            ${stringchamDiemSongLuyen}
                            ${stringchamDiemCanBan}
                            ${stringchamDiemDoiKhang}
                            ${stringchamDiemTheLuc}
                            ${stringchamDiemLyThuyet}
                     </tr>
              `;
    result += string;
  }
  container.innerHTML = result;
}
//

async function PhanQuyen() {
  let data = await getDataPermission_tongquanphanquyen(true);

  let maQuyen = data.maQuyen;
  //chú ý
  let dataChucNang = data.chucNang;

  let arrObjChiTietQuyen = [];
  for (let item of dataChucNang) {
    // functionCodeArr.push(item.functionCode);

    // lấy các giá trị check box
    let chucNangThem_value = "0";
    let chucNangSua_value = "0";
    let chucNangXoa_value = "0";
    let chucNangTimKiem_value = "0";
    let chamDiemDonLuyen_value = "0";
    let chamDiemSongLuyen_value = "0";
    let chamDiemCanBan_value = "0";
    let chamDiemDoiKhang_value = "0";
    let chamDiemTheLuc_value = "0";
    let chamDiemLyThuyet_value = "0";

    let checkBox_chucNangThem = document.getElementById(
      `${maQuyen}-${item.maChucNang}-chucNangThem`
    );
    let checkBox_chucNangSua = document.getElementById(
      `${maQuyen}-${item.maChucNang}-chucNangSua`
    );
    let checkBox_chucNangXoa = document.getElementById(
      `${maQuyen}-${item.maChucNang}-chucNangXoa`
    );
    let checkBox_chucNangTimKiem = document.getElementById(
      `${maQuyen}-${item.maChucNang}-chucNangTimKiem`
    );
    let checkBox_chamDiemDonLuyen = document.getElementById(
      `${maQuyen}-${item.maChucNang}-chamDiemDonLuyen`
    );
    let checkBox_chamDiemSongLuyen = document.getElementById(
      `${maQuyen}-${item.maChucNang}-chamDiemSongLuyen`
    );
    let checkBox_chamDiemCanBan = document.getElementById(
      `${maQuyen}-${item.maChucNang}-chamDiemCanBan`
    );
    let checkBox_chamDiemDoiKhang = document.getElementById(
      `${maQuyen}-${item.maChucNang}-chamDiemDoiKhang`
    );
    let checkBox_chamDiemTheLuc = document.getElementById(
      `${maQuyen}-${item.maChucNang}-chamDiemTheLuc`
    );
    let checkBox_chamDiemLyThuyet = document.getElementById(
      `${maQuyen}-${item.maChucNang}-chamDiemLyThuyet`
    );
    if (checkBox_chucNangThem.checked) {
      chucNangThem_value = "1";
    }

    if (checkBox_chucNangSua.checked) {
      chucNangSua_value = "1";
    }

    if (checkBox_chucNangXoa.checked) {
      chucNangXoa_value = "1";
    }

    if (checkBox_chucNangTimKiem.checked) {
      chucNangTimKiem_value = "1";
    }

    if (checkBox_chamDiemDonLuyen.checked) {
      chamDiemDonLuyen_value = "1";
    }

    if (checkBox_chamDiemSongLuyen.checked) {
      chamDiemSongLuyen_value = "1";
    }

    if (checkBox_chamDiemCanBan.checked) {
      chamDiemCanBan_value = "1";
    }

    if (checkBox_chamDiemDoiKhang.checked) {
      chamDiemDoiKhang_value = "1";
    }
    if (checkBox_chamDiemTheLuc.checked) {
      chamDiemTheLuc_value = "1";
    }

    if (checkBox_chamDiemLyThuyet.checked) {
      chamDiemLyThuyet_value = "1";
    }

    let obj = {
      maQuyen: maQuyen,
      maChucNang: item.maChucNang,
      chucNangThem: chucNangThem_value,
      chucNangSua: chucNangSua_value,
      chucNangXoa: chucNangXoa_value,
      chucNangTimKiem: chucNangTimKiem_value,
      chamDiemDonLuyen: chamDiemDonLuyen_value,
      chamDiemSongLuyen: chamDiemSongLuyen_value,
      chamDiemCanban: chamDiemCanBan_value,
      chamDiemDoiKhang: chamDiemDoiKhang_value,
      chamDiemTheLuc: chamDiemTheLuc_value,
      chamDiemLyThuyet: chamDiemLyThuyet_value,
    };

    arrObjChiTietQuyen.push(obj);
  }

  console.log(arrObjChiTietQuyen);

  try {
    const response = await fetch("../../../BLL/QuanLyNhomNguoiDungBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("updateChiTietQuyen") +
        "&arr=" +
        encodeURIComponent(JSON.stringify(arrObjChiTietQuyen)),
    });
    const data = await response.json();
    console.log(data);

    if (data.mess == "success") {
      Swal.fire({
        title: "Phân quyền thành công!",
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
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Phân quyền không thành công",
        text: "Bị trùng dữ liệu",
      });
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

window.addEventListener("load", async function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh,

  getDataPermission_tongquanphanquyen(false);
});
