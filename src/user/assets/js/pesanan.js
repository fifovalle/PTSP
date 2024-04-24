const dots = document.querySelectorAll(".dot");

dots.forEach((dot) => {
  dot.addEventListener("click", () => {
    dots.forEach((d) => d.classList.remove("active"));
    dot.classList.add("active");
  });
});
function showContentPemesanan(id) {
  let contentSections = document.querySelectorAll(".col-md-10");
  contentSections.forEach(function (section) {
    section.style.display = "none";
  });

  document.getElementById(id).style.display = "block";

  let buttons = document.querySelectorAll("#opsi-pemesanan .btn");
  buttons.forEach(function (button) {
    button.classList.remove("btn-success");
    button.classList.add("btn-outline-success");
    button.style.color = "green";
  });

  let clickedButton = document.getElementById(
    id === "history-pesanan" ? "history-order" : "tracking-order",
  );
  clickedButton.classList.add("btn-success");
  clickedButton.classList.remove("btn-outline-success");
  clickedButton.style.color = "white";
}

let tombolStatusPengajuan = document.getElementById("btn-status-pengajuan");
let tombolStatusPembayaran = document.getElementById("btn-status-pembayaran");
let tombolStatusPembuatan = document.getElementById("btn-status-pembuatan");
let tombolStatusSelesai = document.getElementById("btn-status-selesai");
let elemenAjuan = document.getElementById("ajuan");
let elemenPembayaran = document.getElementById("pembayaran");
let elemenPembuatan = document.getElementById("pembuatan");
let elemenSelesai = document.getElementById("selesai");

elemenAjuan.classList.remove("d-none");
elemenPembayaran.classList.add("d-none");
elemenPembuatan.classList.add("d-none");
elemenSelesai.classList.add("d-none");

tombolStatusPengajuan.classList.add("btn-primary");
tombolStatusPengajuan.style.color = "white";

tombolStatusPengajuan.addEventListener("click", function () {
  elemenAjuan.classList.remove("d-none");
  elemenPembayaran.classList.add("d-none");
  elemenPembuatan.classList.add("d-none");
  elemenSelesai.classList.add("d-none");
});

tombolStatusPembayaran.addEventListener("click", function () {
  elemenAjuan.classList.add("d-none");
  elemenPembayaran.classList.remove("d-none");
  elemenPembuatan.classList.add("d-none");
  elemenSelesai.classList.add("d-none");
});

tombolStatusPembuatan.addEventListener("click", function () {
  elemenAjuan.classList.add("d-none");
  elemenPembayaran.classList.add("d-none");
  elemenPembuatan.classList.remove("d-none");
  elemenSelesai.classList.add("d-none");
});

tombolStatusSelesai.addEventListener("click", function () {
  elemenAjuan.classList.add("d-none");
  elemenPembayaran.classList.add("d-none");
  elemenPembuatan.classList.add("d-none");
  elemenSelesai.classList.remove("d-none");
});

const tombolStatus = document.querySelectorAll(".opsi-statuspesanan");
tombolStatus.forEach(function (tombol) {
  tombol.addEventListener("click", function () {
    tombolStatus.forEach(function (btn) {
      btn.classList.remove("btn-primary");
      btn.style.color = "";
    });
    this.classList.add("btn-primary");
    this.style.color = "white";
  });
});

document.getElementById("btn-beli-lagi").addEventListener("click", function () {
  window.location.href = "katalogproduk.php";
});
document
  .getElementById("btn-beli-lagi1")
  .addEventListener("click", function () {
    window.location.href = "katalogproduk.php";
  });
document.getElementById("nilai-ikm").addEventListener("click", function () {
  window.location.href = "ikm.php";
});
