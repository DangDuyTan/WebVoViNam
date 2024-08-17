var dataPermission = "";

async function getListObj() {
  try {
    let response = await fetch("../../../BLL/GiamKhaoBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList"),
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    let data = await response.json();
    if (!Array.isArray(data)) {
      throw new Error('Unexpected data format');
    }

    console.log("Dữ liệu PD", data);
    await showTablePD(data);
    loadPage();
  } catch (error) {
    console.error(error);
  }
}

async function getSelect() {
  try {
      let response = await fetch("../../../BLL/GiamKhaoBLL.php", {
          method: "POST",
          headers: {
              "Content-Type": "application/x-www-form-urlencoded",
          },
          body: "function=" + encodeURIComponent("getSelect"),
      });

      if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
      }

      let data = await response.json();
      console.log("Dữ liệu select nhận được từ API:", data);

       // Update select options with received data
    const selectKhoaThi = document.getElementById('khoa-thi');
    const selectCapDai = document.getElementById('cap-dai-du-thi');
    const selectPhanThi = document.getElementById('phan-thi');

    selectKhoaThi.innerHTML = '<option value="">Chọn Khóa Thi</option>';
    selectCapDai.innerHTML = '<option value="">Chọn Cấp Đai</option>';
    selectPhanThi.innerHTML = '<option value="">Chọn Phần Thi</option>';

    data['khoaThi'].forEach(option => {
      const newOption = document.createElement('option');
      newOption.value = option['maKhoaThi'];
      newOption.text = option['tenKhoaThi'];
      selectKhoaThi.appendChild(newOption);
    });

    data['capDai'].forEach(option => {
      const newOption = document.createElement('option');
      newOption.value = option['maCapDai'];
      newOption.text = option['tenCapDai'];
      selectCapDai.appendChild(newOption);
    });

    data['phanThi'].forEach(option => {
      const newOption = document.createElement('option');
      newOption.value = option['maKyThuat'];
      newOption.text = option['tenKyThuat'];
      selectPhanThi.appendChild(newOption); // typo: should be selectPhanThi
    });
        
    } catch (error) {
        console.error(error);
    }
}

// Hàm lọc dữ liệu theo các tiêu chí
async function btnLoc() {
  try {
    // Lấy giá trị từ các phần chọn
    const khoaThi = document.getElementById('khoa-thi').value;
    const capDai = document.getElementById('cap-dai-du-thi').value;
    const phanThi = document.getElementById('phan-thi').value;

    // Gửi yêu cầu đến API
    let response = await fetch("../../../BLL/GiamKhaoBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList"),
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    //Nhận dữ liệu từ API
    let data = await response.json();
    console.log("Dữ liệu lọc", data);

    if (!Array.isArray(data)) {
      throw new Error('Unexpected data format');
    }
    // Lọc dữ liệu dựa trên các tiêu chí
    const filteredData = data.filter(item => {
      return (
        (khoaThi === "" || item.maKhoaThi === khoaThi) &&
        (capDai === "" || item.maCapDai === capDai) &&
        (phanThi === "" || item.maKyThuat === phanThi)
      );
    });

    // Hiển thị dữ liệu đã lọc vào bảng
    await showTablePD(filteredData);
    loadPage();

  } catch (error) {
    console.error('Lỗi khi lọc dữ liệu:', error);
  }
}
// Gán hàm btnLoc vào sự kiện click của nút "Lọc"
document.getElementById('locdanhsach').addEventListener('click', btnLoc);

async function showTablePD(data) {
  console.log("Dữ liệu PD trong loadData:", data);

  let container = document.getElementById("danhsachChamThi");
  let container1 = document.getElementById("edit-User");
  let result = ``;
  let result1 = ``;
  let stt = 1;

  for (let i of data) {
    result += `
      <tr>
        <td>${stt}</td>
        <td>${i.hoTen}</td>
        <td>${i.maThe}</td>
        <td>${i.tenCauLacBo}</td>
        <td>${i.tenKhoaThi}</td>
        <td>${i.tenCapDai}</td>
        <td>${i.tenKyThuat}</td>
        <td>${i.ThuocBai}</td>
        <td>${i.NhanhManh}</td>
        <td>${i.TanPhap}</td>
        <td>${i.ThuyetPhuc}</td>
        <td>${i.Diem}</td>
        <td>${i.ketQua}</td>
        <td>${i.GhiChu}</td>
        <td><a href="#" class="edit-button" data-bs-toggle="modal" data-bs-target="#editUser-${i.maCTPhieuDiem}">Sửa</a></td>
      </tr>
    `;
    let String1 = `
    <div class="modal fade" id="editUser-${i.maCTPhieuDiem}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Sửa điểm môn sinh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên môn sinh</label>
                        <input type="text" class="form-control" id="${i.hoTen}" value="${i.hoTen}"
                            name="hoTen" placeholder="NCC001" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Mã thẻ</label>
                        <input type="text" class="form-control" id="${i.maThe}" value="${i.maThe}"
                            name="maThe" placeholder="NCC001" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Câu lạc bộ</label>
                        <input type="text" class="form-control" id="${i.tenCauLacBo}" value="${i.tenCauLacBo}"
                            name="tenCauLacBo" placeholder="NCC001" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Khóa thi</label>
                        <input type="text" class="form-control" id="${i.tenKhoaThi}" value="${i.tenKhoaThi}"
                            name="tenKhoaThi" placeholder="NCC001" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Cấp đai dự thi</label>
                        <input type="text" class="form-control" id="${i.tenCapDai}" value="${i.tenCapDai}"
                            name="tenCapDai" placeholder="NCC001" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Phần thi</label>
                        <input type="text" class="form-control" id="${i.tenKyThuat}" value="${i.tenKyThuat}"
                            name="tenKyThuat" placeholder="NCC001" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ThuocBai" class="form-label">Thuộc bài (5đ)</label>
                        <div class="input-group">
                        <input type="number" class="form-control" id="${i.maCTPhieuDiem}-${i.ThuocBai}"
                            value="${i.ThuocBai}" name="ThuocBai" min="0" max="5" aria-describedby="togglePassword">  
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="NhanhManh" class="form-label">Nhanh mạnh (2đ)</label>
                        <div class="input-group">
                        <input type="number" class="form-control" id="${i.maCTPhieuDiem}-${i.NhanhManh}"
                            value="${i.NhanhManh}" name="NhanhManh" min="0" max="2" aria-describedby="togglePassword">  
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="TanPhap" class="form-label">Tấn pháp (2đ)</label>
                        <div class="input-group">
                        <input type="number" class="form-control" id="${i.maCTPhieuDiem}-${i.TanPhap}"
                            value="${i.TanPhap}" name="TanPhap" min="0" max="2" aria-describedby="togglePassword">  
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="ThuyetPhuc" class="form-label">Thuyết phục (1đ)</label>
                        <div class="input-group">
                        <input type="number" class="form-control" id="${i.maCTPhieuDiem}-${i.ThuyetPhuc}"
                            value="${i.ThuyetPhuc}" name="ThuyetPhuc" min="0" max="1" aria-describedby="togglePassword">  
                        </div>
                    </div>                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Điểm</label>
                        <input type="number" class="form-control" id="${i.Diem}" value="${i.Diem}"
                            name="Diem" placeholder="NCC001" disabled>
                    </div>                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Kết quả</label>
                        <input type="text" class="form-control" id="${i.ketQua}" value="${i.ketQua}"
                            name="ketQua" placeholder="NCC001" disabled>
                    </div>                    
                    <div class="mb-3">
                        <label for="GhiChu" class="form-label">Ghi chú</label>
                        <input type="text" class="form-control" id="${i.maCTPhieuDiem}-${i.GhiChu}" value="${i.GhiChu}"
                            name="GhiChu">
                    </div>
                    
                    <div style="text-align:right;">
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary"
                            onclick="updateObj('${i.maCTPhieuDiem}',
                             '${i.maCTPhieuDiem}-${i.ThuocBai}',
                             '${i.maCTPhieuDiem}-${i.NhanhManh}',
                             '${i.maCTPhieuDiem}-${i.TanPhap}',
                             '${i.maCTPhieuDiem}-${i.ThuyetPhuc}',
                             '${i.maCTPhieuDiem}-${i.GhiChu}',event)">Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
      `;
    result1 += String1;
    stt++;
  }
  container1.innerHTML = result1;
  container.innerHTML = result;

}
//Sửa một đối tượng
async function updateObj(
  maCTPhieuDiem,
  ThuocBai,
  NhanhManh,
  TanPhap,
  ThuyetPhuc,
  GhiChu,
  event
) {
  event.preventDefault();
  if (true) {
    let thuocbaiValue = document.getElementById(ThuocBai).value.trim();
    let nhanhmanhValue = document.getElementById(NhanhManh).value.trim();
    let tanphapValue = document.getElementById(TanPhap).value.trim();
    let thuyetphucValue = document.getElementById(ThuyetPhuc).value.trim();
    let ghichuValue = document.getElementById(GhiChu).value.trim();
    console.log(thuocbaiValue);
    console.log(thuyetphucValue);
      // Kiểm tra ràng buộc giá trị
    if (thuocbaiValue < 0 || thuocbaiValue > 5 ||
        nhanhmanhValue < 0 || nhanhmanhValue > 2 ||
        tanphapValue < 0 || tanphapValue > 2 ||
        thuyetphucValue < 0 || thuyetphucValue > 1) {
      Swal.fire({
        icon: 'error',
        title: 'Dữ liệu không hợp lệ',
        text: 'Vui lòng nhập giá trị trong phạm vi cho phép.'
      });
      return;
    }
    try {
      // Gọi AJAX để sửa đối tượng
      let response = await fetch("../../../BLL/GiamKhaoBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
        "function=" +
        encodeURIComponent("updateObj") +
        "&maCTPhieuDiem=" +
        encodeURIComponent(maCTPhieuDiem) +
        "&ThuocBai=" +
        encodeURIComponent(thuocbaiValue) +
        "&NhanhManh=" +
        encodeURIComponent(nhanhmanhValue) +
        "&TanPhap=" +
        encodeURIComponent(tanphapValue) +
        "&ThuyetPhuc=" +
        encodeURIComponent(thuyetphucValue) +
        "&GhiChu=" +
        encodeURIComponent(ghichuValue),
      });
      let data = await response.json();
      console.log("data sửa",data);
      if (data.mess === "success") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Sửa thông tin thành công",
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

async function DanhSachKQ() {
  try {
    // Gọi AJAX để xóa payment
    let response = await fetch("../../../BLL/GiamKhaoBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("DanhSachKQ"),
    });
    // Kiểm tra trạng thái của phản hồi
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    
    // Ghi lại dữ liệu trả về từ API
    let data = await response.json();
    console.log("Dữ liệu dskq nhận được từ API:", data);
    await showTablePD(data);
    loadPage();
  } catch (error) {
    console.error(error);
  }
}



  function loadItem(thisPage, limit) {
    // tính vị trí bắt đầu và kêt thúc
    let beginGet = limit * (thisPage - 1);
    let endGet = limit * thisPage - 1;
  
    // lấy tất cả các dòng dữ liệu có trong bảng
    let all_data_rows = document.querySelectorAll("#danhsachChamThi > tr");
  
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
      result += `<li class="page-item" onclick="loadItem(${thisPage - 1}, ${limit})"><a class="page-link">Previous</a></li>`;
    } else {
      result += `<li class="page-item disabled"><a class="page-link">Previous</a></li>`;
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
      result += `<li class="page-item" onclick="loadItem(${thisPage + 1}, ${limit})"><a class="page-link">Next</a></li>`;
    } else {
      result += `<li class="page-item disabled"><a class="page-link">Next</a></li>`;
    }
  
    container.innerHTML = result;
  }

  function loadPage() {
    let listItems = document.querySelectorAll("#Pagination li");
    listItems.forEach(function (item) {
      if (item.classList.contains("active")) {
        let activePageNumber = parseInt(item.querySelector("a").textContent.trim());
        console.log("Trang đang active: " + activePageNumber);
        loadItem(activePageNumber, 4);
      }
    });
  }

  window.addEventListener("load", async function () {
    // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
    console.log("Trang Giám Khảo đã load hoàn toàn");
    //const userId = // lấy giá trị userId từ trang web của bạn, ví dụ từ URL hoặc input field
    await getListObj();
    getSelect();
    loadItem(1, 4);
  });