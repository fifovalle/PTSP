function tampilkanModalPerbaikan() {
  var modalPerbaikan = new bootstrap.Modal(
    document.getElementById("modalPerbaikan"),
  ); // Buat instance modal
  modalPerbaikan.show(); // Tampilkan modal
}

// Mengubah fungsi onClick pada tombol
document.getElementById("btn-perbaikan").onclick = tampilkanModalPerbaikan;
