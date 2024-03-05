// Get all dot elements
const dots = document.querySelectorAll('.dot');

// Loop through each dot element
dots.forEach(dot => {
    // Add click event listener
    dot.addEventListener('click', () => {
        // Remove active class from all dots
        dots.forEach(d => d.classList.remove('active'));
        // Add active class to the clicked dot
        dot.classList.add('active');
    });
});
function showContentPemesanan(id) {
    // Hide all content sections
    var contentSections = document.querySelectorAll('.col-md-10');
    contentSections.forEach(function(section) {
        section.style.display = 'none';
    });
    
    // Display the selected content section
    document.getElementById(id).style.display = 'block';
}

var tombolStatusPengajuan = document.getElementById("btn-status-pengajuan");
var tombolStatusPembayaran = document.getElementById("btn-status-pembayaran");
var tombolStatusPembuatan = document.getElementById("btn-status-pembuatan");
var tombolStatusSelesai = document.getElementById("btn-status-selesai");
var elemenAjuan = document.getElementById("ajuan");
var elemenPembayaran = document.getElementById("pembayaran");
var elemenPembuatan = document.getElementById("pembuatan");
var elemenSelesai = document.getElementById("selesai");

elemenAjuan.classList.remove("d-none");
elemenPembayaran.classList.add("d-none");
elemenPembuatan.classList.add("d-none");
elemenSelesai.classList.add("d-none");

tombolStatusPengajuan.classList.add('btn-primary');
tombolStatusPengajuan.style.color = 'white';

tombolStatusPengajuan.addEventListener("click", function() {
    elemenAjuan.classList.remove("d-none");
    elemenPembayaran.classList.add("d-none");
    elemenPembuatan.classList.add("d-none");
    elemenSelesai.classList.add("d-none");
});

tombolStatusPembayaran.addEventListener("click", function() {
    elemenAjuan.classList.add("d-none");
    elemenPembayaran.classList.remove("d-none");
    elemenPembuatan.classList.add("d-none");
    elemenSelesai.classList.add("d-none");
});

tombolStatusPembuatan.addEventListener("click", function() {
    elemenAjuan.classList.add("d-none");
    elemenPembayaran.classList.add("d-none");
    elemenPembuatan.classList.remove("d-none");
    elemenSelesai.classList.add("d-none");
});

tombolStatusSelesai.addEventListener("click", function() {
    elemenAjuan.classList.add("d-none");
    elemenPembayaran.classList.add("d-none");
    elemenPembuatan.classList.add("d-none");
    elemenSelesai.classList.remove("d-none");
});

const tombolStatus = document.querySelectorAll('.opsi-statuspesanan');
tombolStatus.forEach(function(tombol) {
    tombol.addEventListener('click', function() {
        tombolStatus.forEach(function(btn) {
            btn.classList.remove('btn-primary');
            btn.style.color = ''; 
        });
        this.classList.add('btn-primary');
        this.style.color = 'white'; 
    });
});

document.getElementById("btn-beli-lagi").addEventListener("click", function() {
    window.location.href = "katalogproduk.php";
});
document.getElementById("btn-beli-lagi1").addEventListener("click", function() {
    window.location.href = "katalogproduk.php";
});
