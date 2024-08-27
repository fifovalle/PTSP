$(document).ready(function () {
  $(".buttonSeeApplyment").click(function (e) {
    e.preventDefault();
    let pengajuanID = $(this).data("id");

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/get-see-applyment-data.php",
      method: "GET",
      data: {
        pengajuan_id: pengajuanID,
      },
      success: function (data) {
        if (data != null) {
          let dataApplyment = JSON.parse(data);
          console.log("Data Pengajuan yang Diterima:", dataApplyment);
          $("#namaPembeli").text(
            dataApplyment.Nama_Pengguna ||
              dataApplyment.Nama_Depan_Anggota_Perusahaan ||
              "Data tidak ditemukan"
          );
          $("#emailPembeli").text(
            dataApplyment.Email_Pengguna ||
              dataApplyment.Email_Perusahaan ||
              "Data tidak ditemukan"
          );
          $("#noHPPembeli").text(
            dataApplyment.No_Telepon_Bencana || "Data tidak ditemukan"
          );

          if (dataApplyment.ID_Pusat_Daerah != null) {
            $("#kategoriAjukan").text("Pengajuan Pusat Daerah");
          } else if (dataApplyment.ID_Bencana != null) {
            $("#kategoriAjukan").text("Pengajuan Bencana");
          } else if (dataApplyment.ID_Keagamaan != null) {
            $("#kategoriAjukan").text("Pengajuan Keagamaan");
          } else if (dataApplyment.ID_Pertahanan != null) {
            $("#kategoriAjukan").text("Pengajuan Pertahanan");
          } else if (dataApplyment.ID_Sosial != null) {
            $("#kategoriAjukan").text("Pengajuan Sosial");
          } else if (dataApplyment.ID_Penelitian != null) {
            $("#kategoriAjukan").text("Pengajuan Penelitian");
          } else if (dataApplyment.ID_Tarif != null) {
            $("#kategoriAjukan").text("Pengajuan Tarif");
          } else {
            $("#kategoriAjukan").text("Data tidak ditemukan");
          }

          $("#informasiPembeli").text(
            dataApplyment.Nama_Informasi || "Data tidak ditemukan"
          );
          $("#jasaPembeli").text(
            dataApplyment.Nama_Jasa || "Data tidak ditemukan"
          );
          $("#deskripsiPembeli").text(
            dataApplyment.Tanggal_Pembelian || "Data tidak ditemukan"
          );

          if (dataApplyment.Perbaikan_Dokumen_1 != null) {
            $("#embed").attr(
              "src",
              "../assets/image/uploads/" + dataApplyment.Perbaikan_Dokumen_1
            );
            $("#surat1").text("Perbaikan Dokumen 1");
          } else if (dataApplyment.Perbaikan_Dokumen_2 != null) {
            $("#embed2").attr(
              "src",
              "../assets/image/uploads/" + dataApplyment.Perbaikan_Dokumen_2
            );
            $("#surat2").text("Perbaikan Dokumen 2");
          } else if (
            dataApplyment.Surat_Pengantar_Permintaan_Data_Bencana != null
          ) {
            $("#embed").attr(
              "src",
              "../assets/image/uploads/" +
                dataApplyment.Surat_Pengantar_Permintaan_Data_Bencana
            );
            $("#surat1").text("Surat Pengantar Permintaan Data");
          } else if (dataApplyment.Memiliki_Kerja_Sama_Dengan_BMKG != null) {
            $("#embed").attr(
              "src",
              "../assets/image/uploads/" +
                dataApplyment.Memiliki_Kerja_Sama_Dengan_BMKG
            );
            $("#surat1").text(
              "Mempunyai Perjanjian Kerjasama dengan BMKG tentang Kebutuhan Informasi MKKuG"
            );
          } else if (dataApplyment.Identitas_Diri != null) {
            $("#embed").attr(
              "src",
              "../assets/image/uploads/" + dataApplyment.Identitas_Diri
            );
            $("#surat1").text("Identitas Diri KTP / KTM / SIM / Paspor");
          } else if (dataApplyment.Surat_Yang_Ditandatangani_Sosial != null) {
            $("#embed").attr(
              "src",
              "../assets/image/uploads/" +
                dataApplyment.Surat_Yang_Ditandatangani_Sosial
            );
            $("#surat1").text(
              "Surat Permintaan Ditandatangani Camat atau Pejabat Setingkat"
            );
          } else if (
            dataApplyment.Surat_Yang_Ditandatangani_Keagamaan != null
          ) {
            $("#embed").attr(
              "src",
              "../assets/image/uploads/" +
                dataApplyment.Surat_Yang_Ditandatangani_Keagamaan
            );
            $("#surat1").text(
              "Surat Permintaan Ditandatangani Camat atau Pejabat Setingkat"
            );
          } else if (
            dataApplyment.Surat_Yang_Ditandatangani_Pertahanan != null
          ) {
            $("#embed").attr(
              "src",
              "../assets/image/uploads/" +
                dataApplyment.Surat_Yang_Ditandatangani_Pertahanan
            );
            $("#surat1").text(
              "Surat Permintaan Ditandatangani Camat atau Pejabat Setingkat"
            );
          } else {
            $("#embed").attr("src", "Data tidak ditemukan");
          }

          if (dataApplyment.Surat_Pengantar_Pusat_Daerah != null) {
            $("#embed2").attr(
              "src",
              "../assets/image/uploads/" +
                dataApplyment.Surat_Pengantar_Pusat_Daerah
            );
            $("#surat2").text("Surat Pengantar");
          } else if (
            dataApplyment.Surat_Pengantar_Kepsek_Rektor_Dekan != null
          ) {
            $("#embed2").attr(
              "src",
              "../assets/image/uploads/" +
                dataApplyment.Surat_Pengantar_Kepsek_Rektor_Dekan
            );
            $("#surat2").text(
              "Surat Pengantar dari Kepala Sekolah / Rektor / Dekan"
            );
          } else {
            $("#embed2").removeAttr("src");
          }

          if (
            dataApplyment.Pernyataan_Tidak_Digunakan_Kepentingan_Lain != null
          ) {
            $("#embed3").attr(
              "src",
              "../assets/image/uploads/" +
                dataApplyment.Pernyataan_Tidak_Digunakan_Kepentingan_Lain
            );
            $("#surat3").text(
              "Surat Pernyataan Tidak Digunakan Untuk Kepentingan Lain"
            );
          } else {
            $("#embed3").removeAttr("src");
          }

          if (dataApplyment.Proposal_Penelitian_Telah_Disetujui != null) {
            $("#embed3").attr(
              "src",
              "../assets/image/uploads/" +
                dataApplyment.Proposal_Penelitian_Telah_Disetujui
            );
            $("#surat4").text(
              "Proposal Penelitian Berisi Maksud dan Tujuan Penelitian yang Telah Disetujui"
            );
          } else {
            $("#embed3").removeAttr("src");
          }

          $("#seeApplyment").modal("show");
        } else {
          $(
            "#namaPembeli, #emailPembeli, #noHPPembeli, #informasiPembeli, #jasaPembeli"
          ).text("Data tidak ditemukan");
          $("#embed").removeAttr("src");
          $("#seeApplyment").modal("show");
        }
      },
      error: function (xhr) {
        console.error("Error saat mengambil data pengajuan:", xhr.responseText);
      },
    });
  });
});
