function tampilkanPanduan(halamanTautan) {
  console.log("URL saat ini:", halamanTautan);
  const driver = window.driver.js.driver;
  console.log("Driver:", driver);

  let langkahLangkah;
  if (halamanTautan === "http://localhost/PTSP/src/admin/pages/login.php") {
    langkahLangkah = [
      {
        element: "#formulirLoginForDrive",
        popover: {
          title: "Formulir Masuk",
          description: "Silahkan Masuk Dengan Mengisi Formulir Ini.",
        },
      },
      {
        element: "#inputNamaPenggunaForDrive",
        popover: {
          title: "Nama Pengguna Atau Email",
          description:
            "Silahkan Masukkan Nama Pengguna Atau Email Anda Jika Terdaftar.",
        },
      },
      {
        element: "#inputKataSandiForDrive",
        popover: {
          title: "Kata Sandi",
          description: "Silahkan Masukkan Kata Sandi Anda Jika Terdaftar.",
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
        element: "#forgorPassForDrive",
        popover: {
          title: "Lupa Kata Sandi",
          description: "Jika Anda Lupa Kata Sandi Silahkan Klik Disini.",
        },
      },
      {
        element: "#btnLoginForDrive",
        popover: {
          title: "Tombol Masuk",
          description:
            "Jika Sudah Mengisi Semunya Silahkan Klik Tombol Disini Dan Mohon Menunggu Prosesnya.",
        },
      },
    ];
  } else if (
    halamanTautan === "http://localhost/PTSP/src/admin/pages/forgot-pass.php"
  ) {
    langkahLangkah = [
      {
        element: "#formForgotForDrive",
        popover: {
          title: "Formulir Lupa Kata Sandi",
          description:
            "Silahkan Isi Formulir Ini Untuk Mengatur Ulang Kata Sandi.",
        },
      },
      {
        element: "#emailForgotForDrive",
        popover: {
          title: "Email",
          description:
            "Silahkan Masukkan Email Untuk Mengatur Ulang Kata Sandi.",
        },
      },
      {
        element: "#btnForgotForDrive",
        popover: {
          title: "Tombol Kirim",
          description:
            "Jika Sudah Mengisi Semunya Silahkan Klik Tombol Disini Dan Mohon Menunggu Prosesnya.",
        },
      },
    ];
  } else if (halamanTautan === "http://localhost/PTSP/public/admin/") {
    langkahLangkah = [
      {
        element: "#formSearchForDrive",
        popover: {
          title: "Formulir Pencarian",
          description: "Silahkan Pencarian Disini.",
        },
      },
      {
        element: "#addDataAllFormForDrive",
        popover: {
          title: "Tambah Data",
          description: "Klik Disini Untuk Menambahkan Data Baru.",
        },
      },
      {
        element: "#fotoNavbarAdminSessionForDrive",
        popover: {
          title: "Foto Anda",
          description: "Klik Disini Untuk Melihat Profil Anda.",
        },
      },
      {
        element: "#fotoSidebarAdminSessionForDrive",
        popover: {
          title: "Foto Anda",
          description: "Klik Disini Untuk Melihat Profil Anda.",
        },
      },
      {
        element: "#menuSidebarForDrive",
        popover: {
          title: "Menu",
          description: "Klik Disini Untuk Melihat Halaman Yang Anda Inginkan.",
        },
      },
      {
        element: "#iconAllInstansiForDrive",
        popover: {
          title: "Filter",
          description:
            "Klik Disini Untuk Memfilter Sesuai Dengan Instansi Jika Anda Super Admin.",
        },
      },
      {
        element: "#caretIconForDrive",
        popover: {
          title: "Tombol Selengkapnya",
          description:
            "Klik Disini Untuk Melihat Selengkapnya Data Dari Performa Profil.",
        },
      },
      {
        element: "#seeAnaliticForDrive1",
        popover: {
          title: "Tombol Lihat",
          description: "Klik Disini Untuk Melihat Data Analitik.",
        },
      },
      {
        element: "#seeAnaliticForDrive2",
        popover: {
          title: "Tombol Lihat",
          description: "Klik Disini Untuk Melihat Data Analitik.",
        },
      },
      {
        element: "#seeAnaliticForDrive3",
        popover: {
          title: "Tombol Lihat",
          description: "Klik Disini Untuk Melihat Data Analitik.",
        },
      },
    ];
  } else if (
    halamanTautan === "http://localhost/PTSP/src/admin/pages/data.php"
  ) {
    langkahLangkah = [
      {
        element: "#formSearchForDrive",
        popover: {
          title: "Formulir Pencarian",
          description: "Silahkan Pencarian Disini.",
        },
      },
      {
        element: "#addDataAllFormForDrive",
        popover: {
          title: "Tambah Data",
          description: "Klik Disini Untuk Menambahkan Data Baru.",
        },
      },
      {
        element: "#fotoNavbarAdminSessionForDrive",
        popover: {
          title: "Foto Anda",
          description: "Klik Disini Untuk Melihat Profil Anda.",
        },
      },
      {
        element: "#fotoSidebarAdminSessionForDrive",
        popover: {
          title: "Foto Anda",
          description: "Klik Disini Untuk Melihat Profil Anda.",
        },
      },
      {
        element: "#menuSidebarForDrive",
        popover: {
          title: "Menu",
          description: "Klik Disini Untuk Melihat Halaman Yang Anda Inginkan.",
        },
      },
      {
        element: "#menuDataForDrive",
        popover: {
          title: "Menu",
          description: "Klik Disini Untuk Melihat Halaman Yang Anda Inginkan.",
        },
      },
      {
        element: "#filterDataForDrive",
        popover: {
          title: "Filter",
          description: "Klik Disini Untuk Memfilter Data Yang Anda Inginkan.",
        },
      },
      {
        element: "#checkBoxDataThForDrive",
        popover: {
          title: "Tombol",
          description: "Klik Disini Untuk Menghapus Semua Data.",
        },
      },
      {
        element: "#checkBoxDataTdForDrive",
        popover: {
          title: "Tombol",
          description: "Klik Disini Untuk Menghapus Data Terpilih.",
        },
      },
    ];
  } else if (
    halamanTautan === "http://localhost/PTSP/src/admin/pages/analitic.php"
  ) {
    langkahLangkah = [
      {
        element: "#formSearchForDrive",
        popover: {
          title: "Formulir Pencarian",
          description: "Silahkan Pencarian Disini.",
        },
      },
      {
        element: "#addDataAllFormForDrive",
        popover: {
          title: "Tambah Data",
          description: "Klik Disini Untuk Menambahkan Data Baru.",
        },
      },
      {
        element: "#fotoNavbarAdminSessionForDrive",
        popover: {
          title: "Foto Anda",
          description: "Klik Disini Untuk Melihat Profil Anda.",
        },
      },
      {
        element: "#fotoSidebarAdminSessionForDrive",
        popover: {
          title: "Foto Anda",
          description: "Klik Disini Untuk Melihat Profil Anda.",
        },
      },
      {
        element: "#menuSidebarForDrive",
        popover: {
          title: "Menu",
          description: "Klik Disini Untuk Melihat Halaman Yang Anda Inginkan.",
        },
      },
      {
        element: "#menuAnaliticForDrive",
        popover: {
          title: "Menu",
          description: "Klik Disini Untuk Melihat Halaman Yang Anda Inginkan.",
        },
      },
      {
        element: "#menuDropdownAnaliticForDrive",
        popover: {
          title: "Menu",
          description: "Klik Disini Untuk Memfilter Waktu Yang Anda Inginkan.",
        },
      },
      {
        element: "#menuAnaliticAllForDrive",
        popover: {
          title: "Tombol",
          description: "Klik Disini Untuk Melihat Laporan Yang Anda Inginkan.",
        },
      },
    ];
  } else if (
    halamanTautan === "http://localhost/PTSP/src/admin/pages/profile.php"
  ) {
    langkahLangkah = [
      {
        element: "#formSearchForDrive",
        popover: {
          title: "Formulir Pencarian",
          description: "Silahkan Pencarian Disini.",
        },
      },
      {
        element: "#addDataAllFormForDrive",
        popover: {
          title: "Tambah Data",
          description: "Klik Disini Untuk Menambahkan Data Baru.",
        },
      },
      {
        element: "#fotoNavbarAdminSessionForDrive",
        popover: {
          title: "Foto Anda",
          description: "Klik Disini Untuk Melihat Profil Anda.",
        },
      },
      {
        element: "#fotoSidebarAdminSessionForDrive",
        popover: {
          title: "Foto Anda",
          description: "Klik Disini Untuk Melihat Profil Anda.",
        },
      },
      {
        element: "#menuSidebarForDrive",
        popover: {
          title: "Menu",
          description: "Klik Disini Untuk Melihat Halaman Yang Anda Inginkan.",
        },
      },
      {
        element: "#avatarForDrive",
        popover: {
          title: "Foto Anda",
          description: "Klik Disini Untuk Mengubah Foto Anda.",
        },
      },
      {
        element: "#menuProfilForDrive",
        popover: {
          title: "Menu",
          description: "Klik Disini Untuk Melihat Halaman Yang Anda Inginkan.",
        },
      },
    ];
  } else {
    langkahLangkah = [];
  }
  console.log("Langkah-langkah:", langkahLangkah);

  if (langkahLangkah) {
    const objekDrive = driver({
      nextBtnText: "Selanjutnya",
      prevBtnText: "Sebelumnya",
      doneBtnText: "Selesai",
      showProgress: false,
      steps: langkahLangkah,
    });

    objekDrive.drive();
  }
}
const spanHelp = document.getElementById("spanHelp");
spanHelp.addEventListener("click", function () {
  tampilkanPanduan(window.location.href);
});
