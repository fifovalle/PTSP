$(document).ready(function () {
  $(".buttonServices").click(function (e) {
    e.preventDefault();
    let jasaID = $(this).data("id");
    console.log(jasaID);
    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/get-services-data.php",
      method: "GET",
      data: {
        jasa_id: jasaID,
      },
      success: function (data) {
        console.log(data);
        let dataServices = JSON.parse(data);
        console.log(dataServices);
        $("#servicesIDEdit").val(dataServices.ID_Jasa);
        $("#servicesNameEdit").val(dataServices.Nama_Jasa);
        $("#servicesDescriptionEdit").val(dataServices.Deskripsi_Jasa);
        $("#servicesPriceEdit").val(dataServices.Harga_Jasa);
        $("#servicesOwnerEdit").val(dataServices.Pemilik_Jasa);
        $("#servicesCategoryEdit").val(dataServices.Kategori_Jasa);
        $("#servicesStatusEdit").val(dataServices.Status_Jasa);
        $("#editServices").modal("show");
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanServices").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/edit-services.php",
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
        $("#editServices").modal("hide");
      },
    });
  });
});
