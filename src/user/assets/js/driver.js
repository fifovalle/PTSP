const driver = window.driver.js.driver;
const driverObj = driver({
  animate: false,
  showProgress: false,
  showButtons: ["next", "previous", "close"],
  steps: [
    {
      element: "#main",
      popover: {
        title: "Welcome to PTSP BMKG BENGKULU",
        description:
          "Disini Kalian bisa menikmati pelayanan yang diberikan oleh BMKG Provinsi Bengkulu",
        side: "left",
        align: "start",
      },
    },
    {
      element: "#carouselCover",
      popover: {
        title: "Platform Berita",
        description:
          "Tampilan ini berisikan berita terbaru seputar BMKG Provinsi Bengkulu",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#carouselProduct",
      popover: {
        title: "Platform Produk",
        description:
          "Ini berisikan layanan apa saja yang terdapat dalam PTSP BMKG Provinsi Bengkulu",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#btnProduct",
      popover: {
        title: "Tombol Selengkapnya",
        description:
          "Klik Tombol ini jika anda ingin melihat produk yang tersedia",
        side: "left",
        align: "start",
      },
    },
    {
      element: "#Beranda",
      popover: {
        title: "Tombol Selengkapnya",
        description:
          "Klik Tombol ini jika anda ingin melihat produk yang tersedia",
        side: "left",
        align: "start",
      },
    },
    {
      popover: {
        title: "Happy Coding",
        description:
          "And that is all, go ahead and start adding tours to your applications.",
      },
    },
  ],
});
driverObj.drive();
