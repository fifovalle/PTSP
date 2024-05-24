$(document).ready(function () {
  $(".info").click(function (e) {
    e.preventDefault();
    let informasiID = $(this).data("id");

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/get-detail-informasi-data.php",
      method: "GET",
      data: {
        informasi_id: informasiID,
      },
      success: function (data) {
        console.log("Data Pembuatan yang Diterima:", data);
        let dataInformasi = JSON.parse(data);
        console.log(
          "Data Pembuatan yang Diterima (setelah parsing):",
          dataInformasi
        );
        $("#namaInformasi").text(dataInformasi.Nama_Informasi);
        $("#deskripsiInformasi").text(dataInformasi.Deskripsi_Informasi);
        var harga = dataInformasi.Harga_Informasi;
        var hargaRupiah = new Intl.NumberFormat("id-ID", {
          style: "currency",
          currency: "IDR",
        }).format(harga);
        $("#hargaInformasi").text(hargaRupiah);
        if (dataInformasi.Pemilik_Informasi === "Instansi A") {
          $("#pemilikInformasi").text("Meteorologi");
        } else if (dataInformasi.Pemilik_Informasi === "Instansi B") {
          $("#pemilikInformasi").text("Klimatologi");
        } else if (dataInformasi.Pemilik_Informasi === "Instansi C") {
          $("#pemilikInformasi").text("Geofisika");
        }
        $("#rekeningInformasi").text(dataInformasi.No_Rekening_Informasi);
        $("#produkModalInformation").modal("show");
      },
      error: function (xhr) {
        console.error("Error saat mengambil data pengajuan:", xhr.responseText);
      },
    });
  });
});
