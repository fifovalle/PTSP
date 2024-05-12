$(document).ready(function () {
  $(".buttonSeePayment").click(function (e) {
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
          $("#namaPembayar").text(
            dataPayment.Nama_Pengguna || "Data tidak ditemukan"
          );
          $("#emailPembayar").text(
            dataPayment.Email_Pengguna || "Data tidak ditemukan"
          );
          $("#noHPPembayar").text(
            dataPayment.No_Telepon_Bencana || "Data tidak ditemukan"
          );
          $("#informasiPembayar").text(
            dataPayment.Nama_Informasi || "Data tidak ditemukan"
          );
          $("#jasaPembayar").text(
            dataPayment.Nama_Jasa || "Data tidak ditemukan"
          );
          $("#deskripsiPembayar").text(
            dataPayment.Tanggal_Pembelian || "Data tidak ditemukan"
          );
          if (dataPayment.Bukti_Pembayaran != null) {
            $("#buktiPembayar").attr(
              "src",
              "../assets/image/uploads/" + dataPayment.Bukti_Pembayaran
            );
          } else {
            $("#buktiPembayar").removeAttr("src");
          }
          if (dataPayment.Surat_Pengantar_Permintaan_Data_Bencana != null) {
            $("#gambarPembayar").attr(
              "src",
              "../assets/image/uploads/" + dataPayment.Foto_Informasi
            );
          } else {
            $("#gambarPembayar").removeAttr("src");
          }
          $("#seeTransaction").modal("show");
        } else {
          $(
            "#namaPembayar, #emailPembayar, #noHPPembayar, #informasiPembayar, #jasaPembayar"
          ).text("Data tidak ditemukan");
          $("#buktiPembayar").removeAttr("src");
          $("#seeTransaction").modal("show");
        }
      },
      error: function (xhr) {
        console.error("Error saat mengambil data pengajuan:", xhr.responseText);
      },
    });
  });
});
