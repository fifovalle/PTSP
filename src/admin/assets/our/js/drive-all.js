function tampilkanPanduan(halamanTautan) {
  const driver = window.driver.js.driver;

  let lastTourTime = localStorage.getItem(`${halamanTautan}_lastTourTime`);
  const currentTime = new Date().getTime();

  if (!lastTourTime || currentTime - lastTourTime > 60000) {
    const langkahLangkah =
      halamanTautan === "http://localhost/PTSP/src/admin/pages/login.php"
        ? [
            {
              element: "#formulirLogin",
              popover: {
                title: "Formulir Masuk",
                description: "Silahkan Masuk Dengan Mengisi Formulir Ini.",
              },
            },
            {
              element: "#inputNamaPengguna",
              popover: {
                title: "Nama Pengguna Atau Email",
                description:
                  "Silahkan Masukkan Nama Pengguna Atau Email Anda Jika Terdaftar.",
              },
            },
            {
              element: "#inputKataSandi",
              popover: {
                title: "Kata Sandi",
                description:
                  "Silahkan Masukkan Kata Sandi Anda Jika Terdaftar.",
              },
            },
            {
              element: "#togglePassword",
              popover: {
                title: "Ikon Mata",
                description: "Untuk Mengubah Kata Sandi Menjadi Teks.",
              },
            },
            {
              element: "#lupaKataSandi",
              popover: {
                title: "Lupa Kata Sandi",
                description: "Jika Anda Lupa Kata Sandi Silahkan Klik Disini.",
              },
            },
            {
              element: "#btnMasuk",
              popover: {
                title: "Tombol Masuk",
                description:
                  "Jika Sudah Mengisi Semunya Silahkan Klik Tombol Disini Dan Mohon Menunggu Prosesnya.",
              },
            },
          ]
        : halamanTautan ===
          "http://localhost/PTSP/src/admin/pages/forgot-pass.php"
        ? [
            {
              element: "#formulirForgot",
              popover: {
                title: "Formulir Lupa Kata Sandi",
                description:
                  "Silahkan Isi Formulir Ini Untuk Mengatur Ulang Kata Sandi.",
              },
            },
            {
              element: "#emailForgot",
              popover: {
                title: "Email",
                description:
                  "Silahkan Masukkan Email Untuk Mengatur Ulang Kata Sandi.",
              },
            },
            {
              element: "#btnForgot",
              popover: {
                title: "Tombol Kirim",
                description:
                  "Jika Sudah Mengisi Semunya Silahkan Klik Tombol Disini Dan Mohon Menunggu Prosesnya.",
              },
            },
          ]
        : [];

    const objekDrive = driver({
      nextBtnText: "Selanjutnya",
      prevBtnText: "Sebelumnya",
      doneBtnText: "Selesai",
      showProgress: false,
      steps: langkahLangkah,
    });

    Swal.fire({
      title: "Butuh Panduan?",
      text: "Apakah Anda ingin memulai panduan?",
      icon: "info",
      showCancelButton: true,
      confirmButtonText: "Ya, mulai!",
      cancelButtonText: "Tidak, terima kasih",
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        objekDrive.drive();
        localStorage.setItem(
          `${halamanTautan}_lastTourTime`,
          new Date().getTime()
        );
      } else {
        localStorage.setItem(
          `${halamanTautan}_lastTourTime`,
          new Date().getTime()
        );
      }
    });
  }
}

window.onload = function () {
  const currenthalamanTautan = window.location.href;
  tampilkanPanduan(currenthalamanTautan);
};
