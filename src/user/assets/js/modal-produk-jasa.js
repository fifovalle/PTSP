$(document).ready(function () {
  $(".info").click(function (e) {
    e.preventDefault();
    let jasaID = $(this).data("id");

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/get-detail-jasa-data.php",
      method: "GET",
      data: {
        jasa_id: jasaID,
      },
      success: function (data) {
        console.log("Data Pembuatan yang Diterima:", data);
        let dataJasa = JSON.parse(data);
        console.log(
          "Data Pembuatan yang Diterima (setelah parsing):",
          dataJasa
        );
        $("#namaJasa").text(dataJasa.Nama_Jasa);
        $("#deskripsiJasa").text(dataJasa.Deskripsi_Jasa);
        var harga = dataJasa.Harga_Jasa;
        var hargaRupiah = new Intl.NumberFormat("id-ID", {
          style: "currency",
          currency: "IDR",
        }).format(harga);
        $("#hargaJasa").text(hargaRupiah);
        if (dataJasa.Pemilik_Jasa === "Instansi A") {
          $("#pemilikJasa").text("Meteorologi");
        } else if (dataJasa.Pemilik_Jasa === "Instansi B") {
          $("#pemilikJasa").text("Klimatologi");
        } else if (dataJasa.Pemilik_Jasa === "Instansi C") {
          $("#pemilikJasa").text("Geofisika");
        }
        $("#rekeningJasa").text(dataJasa.No_Rekening_Jasa);
        $("#produkModalServices").modal("show");
      },
      error: function (xhr) {
        console.error("Error saat mengambil data pengajuan:", xhr.responseText);
      },
    });
  });
});
