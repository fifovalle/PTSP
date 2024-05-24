$(document).ready(function () {
  $(".info-meteorologi").click(function (e) {
    e.preventDefault();
    let meteoID = $(this).data("id");

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/get-meteorologi-data.php",
      method: "GET",
      data: {
        meteo_id: meteoID,
      },
      success: function (data) {
        console.log("Data Pembuatan yang Diterima:", data);
        let dataInformasiMeteo = JSON.parse(data);
        console.log(
          "Data Pembuatan yang Diterima (setelah parsing):",
          dataInformasiMeteo
        );
        $("#namaInformasiMeteo").text(dataInformasiMeteo.Nama_Informasi);
        $("#deskripsiInformasiMeteo").text(
          dataInformasiMeteo.Deskripsi_Informasi
        );
        var harga = dataInformasiMeteo.Harga_Informasi;
        var hargaRupiah = new Intl.NumberFormat("id-ID", {
          style: "currency",
          currency: "IDR",
        }).format(harga);
        $("#hargaInformasiMeteo").text(hargaRupiah);
        if (dataInformasiMeteo.Pemilik_Informasi === "Instansi A") {
          $("#pemilikInformasiMeteo").text("Meteorologi");
        } else if (dataInformasiMeteo.Pemilik_Informasi === "Instansi B") {
          $("#pemilikInformasiMeteo").text("Klimatologi");
        } else if (dataInformasiMeteo.Pemilik_Informasi === "Instansi C") {
          $("#pemilikInformasiMeteo").text("Geofisika");
        }
        $("#rekeningInformasiMeteo").text(
          dataInformasiMeteo.No_Rekening_Informasi
        );
        $("#produkModalMeteo").modal("show");
      },
      error: function (xhr) {
        console.error("Error saat mengambil data pengajuan:", xhr.responseText);
      },
    });
  });
});
