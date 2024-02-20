$(document).ready(function () {
  $(".menu p").click(function () {
    $(".menu p").removeClass("active");
    $(this).addClass("active");
    let menuText = $(this).text();
    $("th[data-field='data']").text(
      menuText === "Admin"
        ? "Admin"
        : menuText === "Pengguna"
        ? "Pengguna"
        : "Produk"
    );
    $("th[data-field='data2']").text(
      menuText === "Admin"
        ? "Email Admin"
        : menuText === "Pengguna"
        ? "Email Pengguna"
        : menuText === "Produk"
        ? "Harga"
        : "Pengguna"
    );
    $("th[data-field='data3']").text(
      menuText === "Admin"
        ? "Peran Admin"
        : menuText === "Pengguna"
        ? "Jenis Kelamin"
        : menuText === "Produk"
        ? "Jumlah Stok"
        : "Jumlah Produk"
    );
    $("th[data-field='data4']").text(
      menuText === "Admin"
        ? "Status Verifikasi"
        : menuText === "Pengguna"
        ? "Status Verifikasi"
        : menuText === "Produk"
        ? "Status Produk"
        : "Status Transaksi"
    );
    $("th[data-field='data5']").text(
      menuText === "Admin"
        ? ""
        : menuText === "Pengguna"
        ? ""
        : "Pemilik Produk"
    );
    $(".tbodyData tr").each(function () {
      let rowData = $(this).find("td").eq(2);
      rowData.html(
        menuText === "Admin"
          ? `<div>
                <img class="imageData" src="../assets/image/uploads/1.jpg"
                    alt="Foto Admin">
            </div>
            <div class="deskriptorContainer">
                <p class="fw-semibold m-auto">zonaDeveloper</p>
                <p class="fw-semibold deskriptorSmall m-auto">Naufal FIFA
                <div class="iconContainerData">
                    <a class="linkData" data-bs-toggle="modal"
                    data-bs-target="#editAdmin" href="">
                        <span class="">
                            <i class="fas fa-edit"></i>
                        </span>
                    </a>
                    <a class="linkData iconDataRight" href="">
                        <span class="">
                            <i class="fas fa-trash"></i>
                        </span>
                    </a>
                </div>
                </p>
            </div>`
          : menuText === "Pengguna"
          ? `<div>
                <img class="imageData" src="../assets/image/uploads/2.jpg"
                    alt="Foto Admin">
            </div>
            <div class="deskriptorContainer">
                <p class="fw-semibold m-auto">zonaNyaman</p>
                <p class="fw-semibold deskriptorSmall m-auto">Ahsan Ghifari
                <div class="iconContainerData">
                    <a class="linkData" data-bs-toggle="modal"
                    data-bs-target="#editAdmin" href="">
                        <span class="">
                            <i class="fas fa-edit"></i>
                        </span>
                    </a>
                    <a class="linkData iconDataRight" href="">
                        <span class="">
                            <i class="fas fa-trash"></i>
                        </span>
                    </a>
                </div>
                </p>
            </div>`
          : menuText === "Produk"
          ? `<div>
                  <img class="imageData" src="../assets/image/uploads/2.png"
                      alt="Foto Admin">
              </div>
              <div class="deskriptorContainer">
                  <p class="fw-semibold m-auto">Seismograf</p>
                  <p class="fw-semibold deskriptorSmall m-auto">Lorem Ipsum
                  <div class="iconContainerData">
                      <a class="linkData" data-bs-toggle="modal"
                      data-bs-target="#editAdmin" href="">
                          <span class="">
                              <i class="fas fa-edit"></i>
                          </span>
                      </a>
                      <a class="linkData iconDataRight" href="">
                          <span class="">
                              <i class="fas fa-trash"></i>
                          </span>
                      </a>
                  </div>
                  </p>
              </div>`
          : `<div>
          <img class="imageData" src="../assets/image/uploads/2.png"
              alt="Foto Admin">
            </div>
            <div class="deskriptorContainer">
                <p class="fw-semibold m-auto">Seismograf</p>
                <p class="fw-semibold deskriptorSmall m-auto">Lorem Ipsum
                <div class="iconContainerData">
                    <a class="linkData" data-bs-toggle="modal"
                    data-bs-target="#editAdmin" href="">
                        <span class="">
                            <i class="fas fa-edit"></i>
                        </span>
                    </a>
                    <a class="linkData iconDataRight" href="">
                        <span class="">
                            <i class="fas fa-trash"></i>
                        </span>
                    </a>
                </div>
                </p>
            </div>`
      );
    });
    $(".tbodyData tr").each(function () {
      let rowData = $(this).find("td").eq(3);
      rowData.html(
        menuText === "Admin"
          ? `Naufal@gmail.com`
          : menuText === "Pengguna"
          ? `Ahsan@gmail.com`
          : menuText === "Produk"
          ? `Rp 2000.000`
          : `<p class="fw-semibold m-auto">Ahsan</p>
          </p>`
      );
    });
    $(".tbodyData tr").each(function () {
      let rowData = $(this).find("td").eq(4);
      rowData.html(
        menuText === "Admin"
          ? `Super Admin`
          : menuText === "Pengguna"
          ? `Pria`
          : `10`
      );
    });
    $(".tbodyData tr").each(function () {
      let rowData = $(this).find("td").eq(5);
      rowData.html(
        menuText === "Admin"
          ? `<span class="badge text-bg-success">Terverifikasi</span>`
          : menuText === "Pengguna"
          ? `<span class="badge text-bg-success">Terverifikasi</span>`
          : menuText === "Produk"
          ? `<span class="badge text-bg-success">Tersedia</span>`
          : `<span class="badge text-bg-danger">Belum Di Setujui</span>`
      );
    });
    $(".tbodyData tr").each(function () {
      let rowData = $(this).find("td").eq(6);
      rowData.html(
        menuText === "Admin" ? `` : menuText === "Pengguna" ? `` : `Instansi A`
      );
    });
  });
});

const checkBoxHeader = document.querySelector(".checkBoxData");
checkBoxHeader.addEventListener("click", function () {
  const checkBoxes = document.querySelectorAll(".checkBoxData");
  checkBoxes.forEach(function (checkbox) {
    checkbox.checked = checkBoxHeader.checked;
  });
  const actionsDiv = document.getElementById("actions");
  if (checkBoxHeader.checked) {
    actionsDiv.style.display = "block";
  } else {
    actionsDiv.style.display = "none";
  }
});
