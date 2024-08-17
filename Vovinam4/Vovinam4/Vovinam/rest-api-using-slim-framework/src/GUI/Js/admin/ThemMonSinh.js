// -------------------------- load hình ảnh ---------------------------
// $(document).ready(function () {
//   // Load hình ảnh
//   $("#anh3x4 , #anhCCCD").change(function () {
//     const files = $(this)[0].files;
//     if (files.length > 0) {
//       const imagePreview = $("#imagePreviewC, #imagePreviewB");
//       imagePreview.empty();

//       for (let i = 0; i < files.length; i++) {
//         const file = files[i];
//         const reader = new FileReader();

//         reader.onload = function (e) {
//           const img = $("<img>")
//             .attr("src", e.target.result)
//             .addClass("img-thumbnail");
//           imagePreview.append(img);
//         };
//         reader.readAsDataURL(file);
//       }
//     }
//   });
// });

//Ràng buộc dữ liệu nhập vào

function validateUser(
  hoTenValue,
  gioiTinhValue,
  ngaySinhValue,
  soDienThoaiValue,
  emailValue,
  cccdValue,
  // thoiGianTaoValue,
  // thoiGianSuaValue,
  anhCCCDValue,
  anh3x4Value,
  ngayCapCCCDValue,
  noiCapCCCDValue,
  trangThaiValue,
  maCapDaiValue,
  maCauLacBoValue
) {
  console.log("okkk");
  console.log(hoTenValue);

  // event.preventDefault();

  // Kiểm tra các trường có được nhập đầy đủ không
  if (
    !hoTenValue ||
    !gioiTinhValue ||
    !ngaySinhValue ||
    !soDienThoaiValue ||
    !emailValue ||
    !cccdValue ||
    !anhCCCDValue ||
    !trangThaiValue ||
    !maCapDaiValue ||
    !anh3x4Value ||
    !ngayCapCCCDValue ||
    !noiCapCCCDValue ||
    !maCauLacBoValue
  ) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Vui lòng điền đầy đủ thông tin",
    });
    return false;
  }

  // Kiểm tra định dạng email
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(emailValue)) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Email không hợp lệ",
    });
    return false;
  }

  // Kiểm tra định dạng số điện thoại
  const phoneRegex = /^0\d{9}$/;
  if (!phoneRegex.test(soDienThoaiValue)) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Số điện thoại phải có 10 chữ số và bắt đầu bằng số 0",
    });
    return false;
  }
  // Kiểm tra cccd có đủ 11-12 số không

  // Trả về true nếu tất cả các điều kiện đều thỏa mãn
  return true;
}
//Ràng buộc dữ liệu nhập vào
var dataPermission = "";
var dataPermission_caulacbo = "";

//Thêm đối tượng
async function addObj(event) {
  event.preventDefault();

  try {
    let maMonSinhValue = document.getElementById("maMonSinh").value.trim();
    let maTheValue = document.getElementById("maThe").value.trim();
    let hoTenValue = document.getElementById("hoTen").value.trim();
    let gioiTinhValue = document.getElementById("gioiTinh").value;
    let ngaySinhValue = document.getElementById("ngaySinh").value.trim();
    let chieuCaoValue = document.getElementById("chieuCao").value.trim();
    let canNangValue = document.getElementById("canNang").value.trim();
    let diaChiValue = document.getElementById("diaChi").value.trim();
    let soDienThoaiValue = document.getElementById("soDienThoai").value.trim();
    let emailValue = document.getElementById("email").value.trim();
    let cccdValue = document.getElementById("cccd").value.trim();
    let anhCCCDValue = document.getElementById("anhCCCD").value.trim();
    let anh3x4Value = document.getElementById("anh3x4").value.trim();
    let ngayCapCCCDValue = document.getElementById("ngayCapCCCD").value.trim();
    let noiCapCCCDValue = document.getElementById("noiCapCCCD").value.trim();
    let tenPhuHuynhValue = document.getElementById("tenPhuHuynh").value.trim();
    let sdtPhuHuynhValue = document.getElementById("sdtPhuHuynh").value.trim();
    let congViecValue = document.getElementById("congViec").value.trim();
    let lichSuTapLuyenValue = document
      .getElementById("lichSuTapLuyen")
      .value.trim();
    let lichSuThiValue = document.getElementById("lichSuThi").value.trim();
    let bangCapValue = document.getElementById("bangCap").value.trim();
    let trinhDoVanHoaValue = document
      .getElementById("trinhDoVanHoa")
      .value.trim();
    let khaNangNoiBatValue = document
      .getElementById("khaNangNoiBat")
      .value.trim();
    let trangThaiValue = document.getElementById("trangThai").value.trim();
    let maCapDaiValue = document.getElementById("maCapDai").value.trim();
    let maCauLacBoValue = document.getElementById("maCauLacBo").value.trim();

    // file ảnh 3x4
    let files3x4 = document.querySelector("#anh3x4").files;
    let filesCCCD = document.querySelector("#anhCCCD").files;
    let image_3x4 = [];
    let image_cccd = [];

    let imageCounter = 1; // Đếm biến từng ảnh
    var productFolderName = "monsinh-" + cccdValue; // Tạo tên thư mục mới cho album ảnh sản phẩm
    console.log(productFolderName);

    for (let i = 0; i < files3x4.length; i++) {
      const file = files3x4[i];
      const newFileName = "monsinh-3x4-" + imageCounter + ".jpg"; // Tạo tên mới cho file ảnh
      var destinationPath =
        "../../view/admin/upload.php?productFolder=" +
        encodeURIComponent(productFolderName);
      imageCounter++; // Tăng số thứ tự của ảnh trong sản phẩm

      let string = `../image/monsinh/${productFolderName}/${newFileName}`;
      const reader = new FileReader();
      reader.onload = (function (file, newFileName) {
        return function (event) {
          const fileData = event.target.result;

          // Thực hiện việc copy file và đổi tên vào đường dẫn đích
          saveFile(destinationPath, newFileName, fileData, productFolderName);
        };
      })(file, newFileName, productFolderName);

      reader.readAsArrayBuffer(file);

      image_3x4.push(string);
    }

    for (let i = 0; i < filesCCCD.length; i++) {
      const file = filesCCCD[i];
      const newFileName = "monsinh-cccd-" + imageCounter + ".jpg"; // Tạo tên mới cho file ảnh CCCD
      var destinationPath =
        "../../view/admin/upload.php?productFolder=" +
        encodeURIComponent(productFolderName);
      imageCounter++; // Tăng số thứ tự của ảnh trong sản phẩm

      let string = `../image/monsinh/${productFolderName}/${newFileName}`;
      const reader = new FileReader();
      reader.onload = (function (file, newFileName) {
        return function (event) {
          const fileData = event.target.result;

          // Thực hiện việc copy file và đổi tên vào đường dẫn đích
          saveFile(destinationPath, newFileName, fileData, productFolderName);
        };
      })(file, newFileName, productFolderName);

      reader.readAsArrayBuffer(file);

      image_cccd.push(string);
    }
    // // function dinhdangDate(currentDate) {
    //   var year = currentDate.getFullYear();
    //   var month = currentDate.getMonth() + 1; // Tháng bắt đầu từ 0 nên phải cộng thêm 1
    //   var day = currentDate.getDate();

    //   return year + "-" + month + "-" + day;
    // }

    // thoiGianTaoValue = new Date(dinhdangDate(new Date()))
    //   .toISOString()
    //   .slice(0, 10);

    if (
      !validateUser(
        hoTenValue,
        gioiTinhValue,
        ngaySinhValue,
        soDienThoaiValue,
        emailValue,
        cccdValue,
        anhCCCDValue,
        anh3x4Value,
        ngayCapCCCDValue,
        noiCapCCCDValue,
        trangThaiValue,
        maCapDaiValue,
        maCauLacBoValue
      )
    ) {
      return;
    }
    console.log(maMonSinhValue);
    console.log(maTheValue);
    console.log(hoTenValue);
    console.log(gioiTinhValue);
    console.log(ngaySinhValue);
    console.log(chieuCaoValue);
    console.log(canNangValue);
    console.log(diaChiValue);
    console.log(soDienThoaiValue);
    console.log(emailValue);
    console.log(cccdValue);
    console.log(anhCCCDValue);
    console.log(anh3x4Value);
    console.log(ngayCapCCCDValue);
    console.log(noiCapCCCDValue);
    console.log(tenPhuHuynhValue);
    console.log(sdtPhuHuynhValue);
    console.log(congViecValue);
    console.log(lichSuTapLuyenValue);
    console.log(lichSuThiValue);
    console.log(bangCapValue);
    console.log(trinhDoVanHoaValue);
    console.log(khaNangNoiBatValue);
    console.log(trangThaiValue);
    console.log(maCapDaiValue);
    // console.log(tenCapDaiValue);
    console.log(maCauLacBoValue);

    let response = await fetch("../../../BLL/QuanLyMonSinhBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("addObj") +
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
        encodeURIComponent(JSON.stringify(image_cccd)) +
        "&anh3x4=" +
        encodeURIComponent(JSON.stringify(image_3x4)) +
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
        encodeURIComponent(maCauLacBoValue),
    });

    let data = await response.json();
    console.log(data);
    console.log(data.mess);
    if (data.mess === "success") {
      Swal.fire({
        title: "Thêm môn sinh thành công!",
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
        window.location.href = "../../../GUI/view/admin/QuanLyMonSinh.php";
      });
      // window.location.href = "./Tong.php"; // Chuyển hướng sau khi thêm thành công
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

// load bảng cấp đai
async function getListObj_capdai() {
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
    console.log(data);
    dataPermission = data;
    // loadDataUserGroup(data);
  } catch (error) {
    console.error(error);
  }
}

function loadDataUserGroup_capdai(data) {
  let container = document.getElementById("maCapDai");
  let options = ``;
  for (let i of data) {
    let maCapDai = i.maCapDai;
    options += `<option value="${maCapDai}">${i.tenCapDai}</option>`;
  }
  console.log(options);
  container.innerHTML = options;
}

// load bảng câu lạc bộ
async function getListObj_caulacbo() {
  try {
    // Gọi AJAX để xóa payment

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

function loadDataUserGroup_caulacbo(data) {
  let container = document.getElementById("maCauLacBo");
  let options = ``;
  for (let i of data) {
    let maCauLacBo = i.maCauLacBo;
    options += `<option value="${maCauLacBo}">${i.tenCauLacBo}</option>`;
  }
  console.log(options);
  container.innerHTML = options;
}

function saveFile(destinationPath, fileName, fileData, productFolderName) {
  const url = destinationPath + "&newFileName=" + encodeURIComponent(fileName); // Chuyển tên mới của file qua truy vấn URL

  const formData = new FormData();
  formData.append(
    "file",
    new Blob([fileData], { type: "application/octet-stream" }),
    fileName
  );

  fetch(url, {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      console.log("File copied and renamed successfully.");
      console.log(
        "File path: ../image/monsinh/" + productFolderName + "/" + fileName
      ); // In ra đường dẫn của file ảnh
      imageCounter = 1;
    })
    .catch((error) => {
      console.error("There was a problem with your fetch operation:", error);
    });
}

function dinhdangDate(currentDate) {
  var year = currentDate.getFullYear();
  var month = currentDate.getMonth() + 1; // Tháng bắt đầu từ 0 nên phải cộng thêm 1
  var day = currentDate.getDate();

  return year + "-" + month + "-" + day;
}

window.addEventListener("load", async function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
  console.log("Trang quản lý nhóm người dùng đã load hoàn toàn");
  await getListObj_capdai();
  await getListObj_caulacbo();
  loadDataUserGroup_capdai(dataPermission);
  loadDataUserGroup_caulacbo(dataPermission_caulacbo);
});
