$(document).ready(function () {
  $(".buttonImproveApplyment").click(function (e) {
    e.preventDefault();
    let pengajuanID = $(this).data("id");

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/get-applyment-data.php",
      method: "GET",
      data: {
        pengajuan_id: pengajuanID,
      },
      success: function (data) {
        console.log("Data Pengajuan yang Diterima:", data);
        let dataApplyment = JSON.parse(data);
        console.log(
          "Data Pengajuan yang Diterima (setelah parsing):",
          dataApplyment
        );
        $("#improveIDPengajuan").val(dataApplyment.ID_Pengajuan);
        $("#perbaikanPesanan").modal("show");
      },
      error: function (xhr) {
        console.error("Error saat mengambil data pengajuan:", xhr.responseText);
      },
    });
  });

  $("#tombolSimpanImproveApplyment").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/improve-document-submition.php",
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
              ? (window.location.href = "../../user/pages/pesanan.php")
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
        $("#perbaikanPesanan").modal("hide");
      },
    });
  });
});
