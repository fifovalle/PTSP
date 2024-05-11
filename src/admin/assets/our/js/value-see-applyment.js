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
            dataApplyment.Nama_Pengguna || "Data tidak ditemukan"
          );
          $("#emailPembeli").text(
            dataApplyment.Email_Pengguna || "Data tidak ditemukan"
          );
          $("#noHPPembeli").text(
            dataApplyment.No_Telepon_Bencana || "Data tidak ditemukan"
          );
          $("#informasiPembeli").text(
            dataApplyment.Nama_Informasi || "Data tidak ditemukan"
          );
          $("#jasaPembeli").text(
            dataApplyment.Nama_Jasa || "Data tidak ditemukan"
          );
          $("#deskripsiPembeli").text(
            dataApplyment.Tanggal_Pembelian || "Data tidak ditemukan"
          );
          if (dataApplyment.Surat_Pengantar_Permintaan_Data_Bencana != null) {
            $("embed").attr(
              "src",
              "../assets/image/uploads/" +
                dataApplyment.Surat_Pengantar_Permintaan_Data_Bencana
            );
          } else {
            $("embed").removeAttr("src");
          }
          if (dataApplyment.Surat_Pengantar_Permintaan_Data_Bencana != null) {
            $("#gambarPembeli").attr(
              "src",
              "../assets/image/uploads/" + dataApplyment.Foto_Informasi
            );
          } else {
            $("#gambarPembeli").removeAttr("src");
          }
          $("#seeApplyment").modal("show");
        } else {
          $(
            "#namaPembeli, #emailPembeli, #noHPPembeli, #informasiPembeli, #jasaPembeli"
          ).text("Data tidak ditemukan");
          $("embed").removeAttr("src");
          $("#seeApplyment").modal("show");
        }
      },
      error: function (xhr) {
        console.error("Error saat mengambil data pengajuan:", xhr.responseText);
      },
    });
  });
});
