var dataPermission = "";

async function getListObj() {
  try {
    let response = await fetch("../../../BLL/MSinhDkiThiBLL.php", {
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

    console.log("Dữ liệu KTCD", data);
    await showTable(data);
    loadPage();
  } catch (error) {
    console.error(error);
  }
}

async function getSelect() {
  try {
      let response = await fetch("../../../BLL/MSinhDkiThiBLL.php", {
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

    selectKhoaThi.innerHTML = '<option value="">Chọn Khóa Thi</option>';
    selectCapDai.innerHTML = '<option value="">Chọn Cấp Đai</option>';

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

    // Gửi yêu cầu đến API
    let response = await fetch("../../../BLL/MSinhDkiThiBLL.php", {
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
        (capDai === "" || item.maCapDai === capDai)
      );
    });

    // Hiển thị dữ liệu đã lọc vào bảng
    await showTable(filteredData);
    loadPage();

  } catch (error) {
    console.error('Lỗi khi lọc dữ liệu:', error);
  }
}
// Gán hàm btnLoc vào sự kiện click của nút "Lọc"
document.getElementById('locdanhsach').addEventListener('click', btnLoc);
var maMonSinh = "1"
async function showTable(data) {
  console.log("Dữ liệu KTCD trong loadData:", data);

  let container = document.getElementById("danhsachKetqua-khoathicapdai");
  let result = ``;
  let stt = 1;

  for (let i of data) {
    result += `
      <tr>
          <td>${stt}</td>
          <td>${i.tenKhoaThi}</td>
          <td>${i.tenCapDai}</td>
          <td>${formatDate(i.ngayThi)}</td>
          <td>${formatDate(i.ngayKetThuc)}</td>
          <td>${i.ghiChu}</td>
          <td>
              <button class="Btndkithi" data-id="${i.maMonSinh}">Đăng kí thi</button>
          </td>
        </tr>
    `;

    stt++;
  }

  container.innerHTML = result;

}
 //chuyển đổi date
 function formatDate(inputDate) {
    let dateParts = inputDate.split("-");
    return `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`; // yyyy-MM-dd -> dd-MM-yyyy
  }

// lấy dữ liệu từ kết quả  rearch
function searchKTCD() {
    document.getElementById("input-search-dskq").oninput = async function () {
      try {
        // Gọi AJAX để xóa payment
        let str = document
          .getElementById("input-search-dskq")
          .value.trim()
          .toLowerCase();
        let response = await fetch("../../../BLL/MSinhDkiThiBLL.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body:
            "function=" +
            encodeURIComponent("searchKTCD") +
            "&str=" +
            encodeURIComponent(str),
        });
  
        let data = await response.json();
        if (data.length == 0) {
          console.log("Không có dữ liệu tìm kiếm");
  
          document.querySelector("#Pagination").style.display = "none";
          showTable(data);
        } else {
          showTable(data);
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

  function loadItem(thisPage, limit) {
    // tính vị trí bắt đầu và kêt thúc
    let beginGet = limit * (thisPage - 1);
    let endGet = limit * thisPage - 1;
  
    // lấy tất cả các dòng dữ liệu có trong bảng
    let all_data_rows = document.querySelectorAll("#danhsachKetqua-khoathicapdai > tr");
  
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
    console.log("Trang Môn sinh đăng kí đã load hoàn toàn");
    //const userId = // lấy giá trị userId từ trang web của bạn, ví dụ từ URL hoặc input field
    await getListObj();
    searchKTCD();
    getSelect();
    loadItem(1, 4);
  });