$(document).ready(function () {
  $(".buttonProduk").click(function (e) {
    e.preventDefault();
    let produkID = $(this).data("id");
    console.log(produkID);
    $.ajax({
      url: "../config/get-product-data.php",
      method: "GET",
      data: {
        produk_id: produkID,
      },
      success: function (data) {
        console.log(data);
        let produkData = JSON.parse(data);
        console.log(produkData);
        $("#editProdukID").val(produkData.ID_Produk);
        $("#nameEditProduct").val(produkData.Nama_Produk);
        $("#descriptionEditProduct").val(produkData.Deskripsi_Produk);
        $("#productEditPrice").val(produkData.Harga_Produk);
        $("#productEditStock").val(produkData.Stok_Produk);
        $("#ownerEdit").val(produkData.Pemilik_Produk);
        $("#productEditStatus").val(produkData.Status_Produk);
        $("#editProduct").modal("show");
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#tombolSimpanProduk").click(function (e) {
    e.preventDefault();

    let formData = new FormData($(this).closest("form")[0]);

    $.ajax({
      url: "../config/edit-product.php",
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
        $("#editProduct").modal("hide");
      },
    });
  });
});
