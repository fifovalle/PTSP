$(document).ready(function () {
  $(".buttonCreation").click(function (e) {
    e.preventDefault();
    let creationID = $(this).data("id");

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/get-creation-data.php",
      method: "GET",
      data: {
        creation_id: creationID,
      },
      success: function (data) {
        console.log("Data Pembuatan yang Diterima:", data);
        let dataApplyment = JSON.parse(data);
        console.log(
          "Data Pembuatan yang Diterima (setelah parsing):",
          dataApplyment
        );
        $("#editCreation").val(dataApplyment.ID_Tranksaksi);
        $("#aproveFile").modal("show");
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
        $("#aproveFile").modal("hide");
      },
    });
  });
});
