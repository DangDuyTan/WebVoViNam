
async function DanhSachKQ() {
    try {
      // Gọi AJAX để xóa payment
      let response = await fetch("../../../BLL/DSKQBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "function=" + encodeURIComponent("getList"),
      });
      // Kiểm tra trạng thái của phản hồi
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      
      // Ghi lại dữ liệu trả về từ API
      let data = await response.json();
      console.log("Dữ liệu dskq nhận được từ API:", data);
      await showTableKQ(data);
      loadPage();
    } catch (error) {
      console.error(error);
    }
  }
  
async function getSelect() {
  try {
      let response = await fetch("../../../BLL/DSKQBLL.php", {
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
      console.log("Dữ liệu select dskq nhận được từ API:", data);

       // Update select options with received data
    const selectKhoaThi = document.getElementById('khoa-thi');
    const selectCapDai = document.getElementById('cap-dai-du-thi');
    const selectCLB = document.getElementById('clb');

    selectKhoaThi.innerHTML = '<option value="">Chọn Khóa Thi</option>';
    selectCapDai.innerHTML = '<option value="">Chọn Cấp Đai</option>';
    selectCLB.innerHTML = '<option value="">Chọn Câu Lạc Bộ</option>';

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
    data['CauLacBo'].forEach(option => {
      const newOption = document.createElement('option');
      newOption.value = option['maCauLacBo'];
      newOption.text = option['tenCauLacBo'];
      selectCLB.appendChild(newOption);
    });

    } catch (error) {
        console.error(error);
    }
}

async function btnLoc() {
    try {
        const khoaThi = document.getElementById('khoa-thi').value;
        const capDai = document.getElementById('cap-dai-du-thi').value;
        const CauLacBo = document.getElementById('clb').value;

        let response = await fetch("../../../BLL/DSKQBLL.php", {
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
        console.log("Dữ liệu Lọc dskq nhận được từ API:", data);

        if (!Array.isArray(data)) {
            throw new Error('Unexpected data format');
        }
        // Lọc dữ liệu dựa trên các tiêu chí
        const filteredData = data.filter(item => {
        return (
            (khoaThi === "" || item.maKhoaThi === khoaThi) &&
            (capDai === "" || item.maCapDai === capDai) &&
            (CauLacBo === "" || item.maCauLacBo === CauLacBo)
        );
        });

        await showTableKQ(filteredData);
        loadPage();
    } catch (error) {
        console.error(error);
    }
}
document.getElementById('locdanhsach').addEventListener('click', btnLoc);

 //chuyển đổi date
 function formatDate(inputDate) {
  let dateParts = inputDate.split("-");
  return `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`; // yyyy-MM-dd -> dd-MM-yyyy
}

async function showTableKQ(data) {
    console.log("Dữ liệu dskq trong loadData:", data);  // Ghi lại dữ liệu nhận được để kiểm tra
  
    let container = document.getElementById("danhsachKetqua");
    let result = "";

    let stt = 1;
  
    for (let i of data) {
      result  += `
        <tr>
          <td>${stt}</td>
          <td>${i.hoTen}</td>
          <td>${i.maThe}</td>
          <td>${i.tenCauLacBo}</td>
          <td>${i.tenKhoaThi}</td>
          <td>${i.tenCapDai}</td>
          <td>${i.tongDiem}</td>
          <td>${i.KetQua}</td>
          <td>${formatDate(i.NgayCham)}</td>
          <td>
              <button class="seebutton" data-id="${i.maChiTietKetQua}">Xem Chi Tiết</button>
          </td>
        </tr>
        `;
      stt++;
    }
    container.innerHTML = result;
  }

// lấy dữ liệu từ kết quả  rearch
function searchDSKQ() {
    document.getElementById("input-search-dskq").oninput = async function () {
      try {
        // Gọi AJAX để xóa payment
        let str = document
          .getElementById("input-search-dskq")
          .value.trim()
          .toLowerCase();
        let response = await fetch("../../../BLL/DSKQBLL.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body:
            "function=" +
            encodeURIComponent("searchDSKQ") +
            "&str=" +
            encodeURIComponent(str),
        });
  
        let data = await response.json();
        if (data.length == 0) {
          console.log("Không có dữ liệu tìm kiếm");
  
          document.querySelector("#Pagination").style.display = "none";
          showTableKQ(data);
        } else {
          showTableKQ(data);
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
  var currentMaChiTietKetQua = null;

  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('XemChiTietKQPD');
    if (modal) {
      modal.style.display = 'none';
    }
  
    document.querySelector('#danhsachKetqua').addEventListener('click', function (event) {
      if (event.target && event.target.classList.contains('seebutton')) {
        currentMaChiTietKetQua = event.target.getAttribute('data-id');
        if (currentMaChiTietKetQua) {
          XemChiTietKQ(currentMaChiTietKetQua);
        } else {
          console.error("Data ID not found.");
        }
      }
    });
  });
  

  async function XemChiTietKQ(currentMaChiTietKetQua) {
    if (!currentMaChiTietKetQua) {
      console.error("No currentMaChiTietKetQua set.");
      return;
    }
  
    try {
      // Gọi AJAX để lấy chi tiết kết quả
      let response = await fetch("../../../BLL/ChiTietKetQuaBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `function=ListCTKQ&maChiTietKetQua=${encodeURIComponent(currentMaChiTietKetQua)}`,
      });
  
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
  
      let data = await response.json();
      console.log("Dữ liệu chi tiết nhận được từ API:", data);
  
      if (!data || data.length === 0) {
        console.error("No data received.");
        return;
      }
  
      const mainData = data[0];
  
      const modalContent = `
        <div class="modal-header">
          <h5 class="modaltitle">Bảng điểm chi tiết</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="infoText">
          <div class="thongtin">
            <p>Họ tên: ${mainData.hoTen}</p>
            <p>Mã Thẻ: ${mainData.maThe}</p>
            <p>Câu lạc bộ: ${mainData.tenCauLacBo}</p>
          </div>
          <div class="thongtin">
            <p>Khóa thi: ${mainData.tenKhoaThi}</p>
            <p>Cấp đai dự thi: ${mainData.tenCapDai}</p>
          </div>
        </div>
        <table class="danhsach">
          <thead>
            <tr>
              <th>STT</th>
              <th>Kỹ thuật</th>
              <th>Thuộc bài <br> (5đ)</th>
              <th>Nhanh mạnh <br> (2đ)</th>
              <th>Tấn pháp <br> (2đ)</th>
              <th>Thuyết phục <br> (1đ)</th>
              <th>Điểm</th>
              <th>Kết quả</th>
              <th>GK chấm</th>
              <th>Ghi chú</th>
            </tr>
          </thead>
          <tbody>
            ${(mainData.details || []).map((detail, index) => `
              <tr>
                  <td>${index + 1}</td>
                  <td>${detail.tenKyThuat}</td>
                  <td>${detail.thuocBai}</td>
                  <td>${detail.nhanhManh}</td>
                  <td>${detail.tanPhap}</td>
                  <td>${detail.thuyetPhuc}</td>
                  <td>${detail.Diem}</td>
                  <td>${detail.KetQua}</td>
                  <td>${detail.GiamKhaoCham}</td>
                  <td>${detail.GhiChu}</td>
              </tr>
          `).join('')}
          </tbody>
        </table>
      `;
  
      const modalContentElement = document.querySelector('.detailmodel');
      if (modalContentElement) {
        modalContentElement.innerHTML = modalContent;
  
        const modal = document.getElementById('XemChiTietKQPD');
        if (modal) {
          modal.style.display = 'block';
        }
      } else {
        console.error("Modal content element not found.");
      }
  
      const closeButton = document.querySelector('.close');
      if (closeButton) {
        closeButton.onclick = function () {
          const modal = document.getElementById('XemChiTietKQPD');
          if (modal) {
            modal.style.display = 'none';
          }
        };
      } else {
        console.error("Close button not found.");
      }
  
    } catch (error) {
      console.error(error);
    }
  }
  
  

  



  function loadItem(thisPage, limit) {
    // tính vị trí bắt đầu và kêt thúc
    let beginGet = limit * (thisPage - 1);
    let endGet = limit * thisPage - 1;
  
    // lấy tất cả các dòng dữ liệu có trong bảng
    let all_data_rows = document.querySelectorAll("#danhsachKetqua > tr");
  
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
    console.log("Trang Giám Khảo dskq đã load hoàn toàn");
    //const userId = // lấy giá trị userId từ trang web của bạn, ví dụ từ URL hoặc input field
    await DanhSachKQ();
    //XemChiTietKQ();
    getSelect();
    searchDSKQ();
    loadItem(1, 4);
  });