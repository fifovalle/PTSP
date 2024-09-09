$(document).ready(function () {
  $(".buttonSeeIKM").click(function (e) {
    e.preventDefault();
    let ikmID = $(this).data("id");

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/get-see-ikm-data.php",
      method: "GET",
      data: { ikm_id: ikmID },
      success: function (data) {
        if (data != null) {
          let dataIKM = JSON.parse(data);
          console.log("Data Pengajuan yang Diterima:", dataIKM);
          $("#namaIKM").text(dataIKM.Nama || "Data tidak ditemukan");
          $("#pekerjaanIKM").text(dataIKM.Pekerjaan || "Data tidak ditemukan");
          $("#umurIKM").text(dataIKM.Umur || "Data tidak ditemukan");
          $("#jenisKelaminIKM").text(
            dataIKM.Jenis_Kelamin || "Data tidak ditemukan"
          );
          $("#pendidikanIKM").text(
            dataIKM.Pendidikan_Terakhir || "Data tidak ditemukan"
          );
          $("#asalDaerahIKM").text(
            dataIKM.Asal_Daerah || "Data tidak ditemukan"
          );
          $("#jenisLayananIKM").text(
            dataIKM.Jenis_Layanan || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Terbuka").text(
            dataIKM.Kualitas_Pelayanan_Terbuka || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Terbuka").text(
            dataIKM.Harapan_Konsumen_Terbuka || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Kehidupan").text(
            dataIKM.Kualitas_Pelayanan_Kehidupan || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Kehidupan").text(
            dataIKM.Harapan_Konsumen_Kehidupan || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Dipahami").text(
            dataIKM.Kualitas_Pelayanan_Dipahami || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Dipahami").text(
            dataIKM.Harapan_Konsumen_Dipahami || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Persyaratan").text(
            dataIKM.Kualitas_Pelayanan_Persyaratan || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Persyaratan").text(
            dataIKM.Harapan_Konsumen_Persyaratan || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Diakses").text(
            dataIKM.Kualitas_Pelayanan_Diakses || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Diakses").text(
            dataIKM.Harapan_Konsumen_Diakses || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Akurat").text(
            dataIKM.Kualitas_Pelayanan_Akurat || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Akurat").text(
            dataIKM.Harapan_Konsumen_Akurat || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Data").text(
            dataIKM.Kualitas_Pelayanan_Data || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Data").text(
            dataIKM.Harapan_Konsumen_Data || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Sederhana").text(
            dataIKM.Kualitas_Pelayanan_Sederhana || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Waktu").text(
            dataIKM.Kualitas_Pelayanan_Waktu || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Waktu").text(
            dataIKM.Harapan_Konsumen_Waktu || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Biaya_Terbuka").text(
            dataIKM.Kualitas_Pelayanan_Biaya_Terbuka || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Biaya_Terbuka").text(
            dataIKM.Harapan_Konsumen_Biaya_Terbuka || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_KKN").text(
            dataIKM.Kualitas_Pelayanan_KKN || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Sesuai").text(
            dataIKM.Kualitas_Pelayanan_Sesuai || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Sesuai").text(
            dataIKM.Harapan_Konsumen_Sesuai || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Daftar").text(
            dataIKM.Kualitas_Pelayanan_Daftar || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Daftar").text(
            dataIKM.Harapan_Konsumen_Daftar || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Sarana").text(
            dataIKM.Kualitas_Pelayanan_Sarana || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Sarana").text(
            dataIKM.Harapan_Konsumen_Sarana || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Prosedur").text(
            dataIKM.Kualitas_Pelayanan_Prosedur || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Prosedur").text(
            dataIKM.Harapan_Konsumen_Prosedur || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Petugas").text(
            dataIKM.Kualitas_Pelayanan_Petugas || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Petugas").text(
            dataIKM.Harapan_Konsumen_Petugas || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Aman").text(
            dataIKM.Kualitas_Pelayanan_Aman || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Aman").text(
            dataIKM.Harapan_Konsumen_Aman || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Keberadaan").text(
            dataIKM.Kualitas_Pelayanan_Keberadaan || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Keberadaan").text(
            dataIKM.Harapan_Konsumen_Keberadaan || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Sikap").text(
            dataIKM.Kualitas_Pelayanan_Sikap || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Sikap").text(
            dataIKM.Harapan_Konsumen_Sikap || "Data tidak ditemukan"
          );
          $("#Kualitas_Pelayanan_Publik").text(
            dataIKM.Kualitas_Pelayanan_Publik || "Data tidak ditemukan"
          );
          $("#Harapan_Konsumen_Publik").text(
            dataIKM.Harapan_Konsumen_Publik || "Data tidak ditemukan"
          );
          $("#seeIkm").modal("show");
        }
      },
      error: function (xhr) {
        console.error("Error saat mengambil data pengajuan:", xhr.responseText);
      },
    });
  });
});

$("#downloadIkm").click(function (e) {
  e.preventDefault();
  let ikmID = $(".buttonSeeIKM").data("id");

  window.location.href =
    "http://localhost/PTSP/src/admin/config/download-ikm-data.php?ikm_id=" +
    ikmID;
});
