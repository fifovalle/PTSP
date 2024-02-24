$(document).ready(function () {
  $(".buttonUser").click(function (e) {
    e.preventDefault();
    let penggunaID = $(this).data("id");
    console.log(penggunaID);
    $.ajax({
      url: "../config/get-user-data.php",
      method: "GET",
      data: {
        pengguna_id: penggunaID,
      },
      success: function (data) {
        console.log(data);
        let userData = JSON.parse(data);
        let noTelepon = userData.No_Telepon_Pengguna;
        noTelepon = noTelepon.replace("+62", "");
        console.log(userData);
        $("#editUserID").val(userData.ID_Pengguna);
        $("#frontNameEditUser").val(userData.Nama_Depan_Pengguna);
        $("#backNameEditUser").val(userData.Nama_Belakang_Pengguna);
        $("#userNameEditUser").val(userData.Nama_Pengguna);
        $("#emailEditUser").val(userData.Email_Pengguna);
        $("#numberEditUser").val(noTelepon);
        $("#ganderEditUser").val(userData.Jenis_Kelamin_Pengguna);
        $("#addressEditPengguna").val(userData.Alamat_Pengguna);
        $("#editUser").modal("show");
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  });

  $(document).ready(function () {
    $("#tombolSimpanPengguna").click(function (e) {
      e.preventDefault();

      let formData = new FormData($(this).closest("form")[0]);

      $.ajax({
        url: "../config/edit-user.php",
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
          $("#editUser").modal("hide");
        },
      });
    });
  });
});
