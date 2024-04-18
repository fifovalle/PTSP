// Get all dot elements
const dots = document.querySelectorAll(".dot");

// Loop through each dot element
dots.forEach((dot) => {
  // Add click event listener
  dot.addEventListener("click", () => {
    // Remove active class from all dots
    dots.forEach((d) => d.classList.remove("active"));
    // Add active class to the clicked dot
    dot.classList.add("active");
  });
});
function showContentPemesanan(id) {
  // Semua konten disembunyikan
  let contentSections = document.querySelectorAll(".col-md-10");
  contentSections.forEach(function (section) {
    section.style.display = "none";
  });

  // Tampilkan konten berdasarkan ID yang diberikan
  document.getElementById(id).style.display = "block";

  // Ubah gaya tombol sesuai dengan ID yang diberikan
  let buttons = document.querySelectorAll("#opsi-pemesanan .btn");
  buttons.forEach(function (button) {
    button.classList.remove("btn-success"); // Hapus kelas btn-success dari semua tombol
    button.classList.add("btn-outline-success"); // Tambahkan kelas btn-outline-success ke semua tombol
    button.style.color = "green";
  });

  // Tentukan tombol yang diklik
  let clickedButton = document.getElementById(
    id === "history-pesanan" ? "history-order" : "tracking-order"
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

document.getElementById("file").addEventListener("change", function() {
    let file = this.files[0];
    let reader = new FileReader();

    reader.onload = function(e) {
        let previewFileDiv = document.getElementById("preview-file");

        // Display the preview file div
        previewFileDiv.style.display = "block";

        // Display file name
        let fileNameSpan = document.createElement("span");
        fileNameSpan.innerHTML = "<strong>" + file.name + "</strong>";
        previewFileDiv.innerHTML = ""; // Clear previous content
        previewFileDiv.appendChild(fileNameSpan);

        let label = document.querySelector(".custum-file-upload");
        label.style.display = "none";

        let label2 = document.querySelector(".add-file-upload");
        label2.style.display = "block";
    };

    reader.readAsDataURL(file);
});

document.getElementById("file2").addEventListener("change", function() {
    let file2 = this.files[0];
    let reader2 = new FileReader();

    reader2.onload = function(e) {
        let previewFileDiv2 = document.getElementById("preview-file2");

        // Display the preview file div
        previewFileDiv2.style.display = "block";

        // Display file name
        let fileNameSpan2 = document.createElement("span");
        fileNameSpan2.innerHTML = "<strong>" + file2.name + "</strong>";
        previewFileDiv2.innerHTML = ""; // Clear previous content
        previewFileDiv2.appendChild(fileNameSpan2);

        let label2 = document.querySelector(".add-file-upload");
        label2.style.display = "none";

        let label3 = document.querySelector(".add-file-upload3");
        label3.style.display = "block";
    };

    reader2.readAsDataURL(file2);
});

document.getElementById("file3").addEventListener("change", function() {
    let file3 = this.files[0];
    let reader3 = new FileReader();

    reader3.onload = function(e) {
        let previewFileDiv3 = document.getElementById("preview-file3");

        // Display the preview file div
        previewFileDiv3.style.display = "block";

        // Display file name
        let fileNameSpan3 = document.createElement("span");
        fileNameSpan3.innerHTML = "<strong>" + file3.name + "</strong>";
        previewFileDiv3.innerHTML = ""; // Clear previous content
        previewFileDiv3.appendChild(fileNameSpan3);

        let label3 = document.querySelector(".add-file-upload3");
        label3.style.display = "none";
    };

    reader3.readAsDataURL(file3);
});

