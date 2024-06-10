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
          $("#informasiDibutuhkanIKM").text(
            (dataIKM.Analisis_Cuaca || "") +
              " " +
              (dataIKM.Analisis_Iklim_Ekstrim || "") +
              " " +
              (dataIKM.Analisis_Prakiraan || "") +
              " " +
              (dataIKM.Informasi_Cuaca_Khusus || "") +
              " " +
              (dataIKM.Informasi_Cuaca_Publik || "") +
              " " +
              (dataIKM.Informasi_Gempabumi || "") +
              " " +
              (dataIKM.Informasi_Geofisika_Potensial || "") +
              " " +
              (dataIKM.Informasi_Iklim_Khusus || "") +
              " " +
              (dataIKM.Informasi_Iklim_Terapan || "") +
              " " +
              (dataIKM.Informasi_Kualitas_Udara || "") +
              " " +
              (dataIKM.Informasi_Perubahan_Iklim || "") +
              " " +
              (dataIKM.Informasi_Seismologi_Teknik || "") +
              " " +
              (dataIKM.Informasi_Tanda_Waktu || "") +
              " " +
              (dataIKM.Informasi_Tentang_Tingkat || "") +
              " " +
              (dataIKM.Informasi_Titik_Panas || "")
          );
          // Tambahkan data lainnya jika diperlukan
          $("#seeIkm").modal("show");
        }
      },
      error: function (xhr) {
        console.error("Error saat mengambil data pengajuan:", xhr.responseText);
      },
    });
  });
});
