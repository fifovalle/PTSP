$(document).ready(function () {
  $(".buttonInformation").click(function (e) {
    e.preventDefault();
    let informasiID = $(this).data("id");
    console.log(informasiID);
    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/get-information-data.php",
      method: "GET",
      data: {
        informasi_id: informasiID,
      },
      success: function (data) {
        console.log(data);
        let dataInformasi = JSON.parse(data);
        console.log(dataInformasi);
        $("#InformationIDEdit").val(dataInformasi.ID_Informasi);
        $("#informationNameEdit").val(dataInformasi.Nama_Informasi);
        $("#informationDescriptionEdit").val(dataInformasi.Deskripsi_Informasi);
        $("#informationPriceEdit").val(dataInformasi.Harga_Informasi);
        $("#informationOwnerEdit").val(dataInformasi.Pemilik_Informasi);
        $("#informationCategoryEdit").val(dataInformasi.Kategori_Informasi);
        $("#informationStatusEdit").val(dataInformasi.Status_Informasi);
        $("#editInformation").modal("show");
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanInformation").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/edit-information.php",
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
            timer: 3000,
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
          timer: 3000,
          timerProgressBar: true,
        });
      },
      complete: function () {
        $("#editInformation").modal("hide");
      },
    });
  });
});
