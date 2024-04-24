//// Script Carousel Main ////
document.addEventListener("DOMContentLoaded", function () {
  var carousel = document.getElementById("carouselCover");
  function startCarousel() {
    var carouselInstance = new bootstrap.Carousel(carousel, {
      interval: 3000, // Atur interval antara perpindahan slide (dalam milidetik)
    });
    carouselInstance.cycle(); // Mulai perpindahan slide
  }
  startCarousel();
  function restartInterval() {
    setInterval(startCarousel, 3000); // Memulai ulang setiap 1 detik
  }
  restartInterval();
});

const carousel = document.getElementById("carouselProduct");
const carouselItems = carousel.querySelectorAll(".carousel-item");
const totalItems = carouselItems.length;

let currentIndex = 0;
function showNextSlide() {
  // Menonaktifkan slide saat ini
  carouselItems[currentIndex].classList.remove("active");
  // Mengatur indeks slide berikutnya
  currentIndex = (currentIndex + 1) % totalItems;
  // Mengaktifkan slide berikutnya
  carouselItems[currentIndex].classList.add("active");
}
function startCarousel() {
  setInterval(showNextSlide, 3000); // Ganti slide setiap 3 detik
}
startCarousel();

document.getElementById("btnProduct").addEventListener("click", function () {
  window.location.href = "katalogproduk.php";
});
//// End Script Carousel Main ////

document
  .querySelector(".btn-maintutorial")
  .addEventListener("click", mainTutorial);
function mainTutorial() {
  const driver = window.driver.js.driver;
  const driverObj = driver({
    showProgress: true,
    steps: [
      {
        element: "#box-navbar",
        popover: {
          title: "Navbar Menu",
          description:
            "Disini adalah menu yang terdaftar pada PTSP BMKG Provinsi Bengkulu",
          side: "bottom",
          align: "center",
        },
      },
      {
        element: "#Beranda",
        popover: {
          title: "Beranda",
          description:
            "Ini adalah jendela utama pada website utama PTSP BMKG Provinsi Bengkulu",
          side: "bottom",
          align: "center",
        },
      },
      {
        element: "#Ajukan",
        popover: {
          title: "Ajukan",
          description:
            "Sebelum melakukan checkout diwajibkan untuk mengisi form untuk mengajukan kebutuhan PTSP BMKG Provinsi Bengkulu",
          side: "bottom",
          align: "center",
        },
      },
      {
        element: "#Regulasi",
        popover: {
          title: "Regulasi",
          description:
            "Pada bagian ini terdapat regulasi yang berlaku di PTSP BMKG Provinsi Bengkulu",
          side: "bottom",
          align: "center",
        },
      },
      {
        element: "#Pesanan",
        popover: {
          title: "Pesanan",
          description:
            "Bagian ini untuk mengecek pesanan yang sudah selesai dan yang sedang dalam proses",
          side: "right",
          align: "center",
        },
      },
      {
        element: "#btnCart",
        popover: {
          title: "Checkout Cart",
          description:
            "Bagian ini untuk mengecek pesanan apa saja sebelum melakukan checkout",
          side: "left",
          align: "center",
        },
      },
      {
        element: "#btnProduct",
        popover: {
          title: "Product Menu",
          description:
            "Bagian ini untuk melihat lebih detail menu atau katalog produk yang ada pada PTSP BMKG Provinsi Bengkulu",
          side: "top",
          align: "center",
        },
      },
      {
        popover: {
          title: "Welcome To PTSP BMKG Provinsi Bengkulu",
          description:
            "Selamat menikmati dan selamat menggunakan fitur dan fasilitas dari kami. Terima kasih",
          align: "center",
        },
      },
    ],
  });
  driverObj.drive();
}
