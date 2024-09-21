$(document).ready(function () {
  $(".infoRiwayatPayment").click(function (e) {
    e.preventDefault();
    let pembayaranID = $(this).data("id");

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/get-see-payment-data.php",
      method: "GET",
      data: {
        pembayaran_id: pembayaranID,
      },
      success: function (data) {
        if (data != null) {
          let dataPayment = JSON.parse(data);
          console.log("Data Pengajuan yang Diterima:", dataPayment);
          $("#namaPembayarHistory").text(
            dataPayment.Nama_Pengguna || "Data tidak ditemukan"
          );
          $("#emailPembayarHistory").text(
            dataPayment.Email_Pengguna || "Data tidak ditemukan"
          );
          $("#noHPPembayarHistory").text(
            dataPayment.No_Telepon_Bencana || "Data tidak ditemukan"
          );
          $("#informasiPembayarHistory").text(
            dataPayment.Nama_Informasi || "Data tidak ditemukan"
          );
          $("#jasaPembayarHistory").text(
            dataPayment.Nama_Jasa || "Data tidak ditemukan"
          );
          $("#deskripsiPembayarHistory").text(
            dataPayment.Tanggal_Pembelian || "Data tidak ditemukan"
          );
          $("#tanggalPenerimaan").text(
            dataPayment.Tanggal_Upload_File_Penerimaan || "Data tidak ditemukan"
          );
          if (dataPayment.Apakah_Gratis == 1) {
            $("#jenisPembayaran").text("Gratis");
          } else if (dataPayment.Apakah_Gratis == 0) {
            $("#jenisPembayaran").text("Bayar");
          }
          $("#buktiFilePenerimaan").attr(
            "src",
            "../assets/image/uploads/" + dataPayment.File_Penerimaan
          );
          if (dataPayment.Bukti_Pembayaran != null) {
            $("#buktiPembayaran").attr(
              "src",
              "../assets/image/uploads/" + dataPayment.Bukti_Pembayaran
            );
          } else {
            $("#buktiPembayaran").removeAttr("src");
            $("#buktiPembayaran").attr("src", "../assets/image/pages/404.png");
          }
          $("#seeHistoryPayment").modal("show");
        } else {
          $(
            "#namaPembayar, #namaPembayarHistory, #noHPPembayar, #informasiPembayar, #jasaPembayar"
          ).text("Data tidak ditemukan");
          $("#buktiPembayaran").removeAttr("src");
          $("#seeHistoryPayment").modal("show");
        }
      },
      error: function (xhr) {
        console.error("Error saat mengambil data pengajuan:", xhr.responseText);
      },
    });
  });
});
