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

  $("#tombolSimpanPembuatan").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/edit-creation.php",
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function (xhr) {
        console.log("Mengirim data ke server:", formData);
      },
      success: function (response) {
        console.log("Respon dari server:", response);
        let responseData = JSON.parse(response);
        if (responseData.success) {
          Swal.fire({
            icon: "success",
            title: "Sukses!",
            text: responseData.message,
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          }).then((result) => {
            result.dismiss === Swal.DismissReason.timer
              ? (window.location.href = "../pages/data.php")
              : null;
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: responseData.message,
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 30000,
            timerProgressBar: true,
          });
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Terjadi kesalahan saat mengirim permintaan.",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 30000,
          timerProgressBar: true,
        });
      },
      complete: function () {
        $("#produkModalMeteo").modal("hide");
      },
    });
  });
});
