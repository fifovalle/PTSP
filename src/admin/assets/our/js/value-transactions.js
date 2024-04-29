$(document).ready(function () {
  $(".buttonPayment").click(function (e) {
    e.preventDefault();
    let transaksiID = $(this).data("id");

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/get-transactions-data.php",
      method: "GET",
      data: {
        transaksi_id: transaksiID,
      },
      success: function (data) {
        console.log("Data Transaksi yang Diterima:", data);
        let dataTransaction = JSON.parse(data);
        console.log(
          "Data Transaksi yang Diterima (setelah parsing):",
          dataTransaction
        );
        $("#editPayment").val(dataTransaction.ID_Transaksi);
        $("#aproveFilePayment").modal("show");
      },
      error: function (xhr) {
        console.error("Error saat mengambil data transaksi:", xhr.responseText);
      },
    });
  });

  $("#tombolSimpanTransaksi").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "http://localhost/PTSP/src/admin/config/edit-transactions.php",
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
        $("#aproveFilePayment").modal("hide");
      },
    });
  });
});
