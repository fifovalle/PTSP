document.getElementById("button-berbayar").addEventListener("click", function () {
  document.getElementById("option-berbayar").style.display = "block";
  document.getElementById("option-gratis").style.display = "none";
  document.getElementById("button-berbayar").classList.add("selected");
  document.getElementById("button-gratis").classList.remove("selected1");
  hideAllFormContents(); 
});

document.getElementById("button-gratis").addEventListener("click", function () {
  document.getElementById("option-gratis").style.display = "block";
  document.getElementById("option-berbayar").style.display = "none";
  document.getElementById("button-gratis").classList.add("selected1");
  document.getElementById("button-berbayar").classList.remove("selected");
});

let dropdownItems = document.querySelectorAll(".dropdown-item");
dropdownItems.forEach(function (item) {
  item.addEventListener("click", function () {
      dropdownItems.forEach(function (item) {
          item.classList.remove("active");
      });
      item.classList.add("active");
  });
});

function showContent(id) {
  let contents = document.querySelectorAll(".form-content");
  contents.forEach(function (content) {
      content.style.display = "none";
  });
  document.getElementById(id).style.display = "block";
}

function hideAllFormContents() {
  let contents = document.querySelectorAll(".form-content");
  contents.forEach(function (content) {
      if (content.id !== "option-berbayar") {
          content.style.display = "none";
      }
  });
}

document
  .querySelector(".btn-ajukantutorial")
  .addEventListener("click", ajukanTutorial);
function ajukanTutorial() {
  const driver = window.driver.js.driver;
  const driverObj = driver({
    showProgress: true,
    steps: [
      {
        element: "#option",
        popover: {
          title: "Ajukan Menu",
          description:
            "Disini adalah menu ajukan yang terdapat pada PTSP BMKG Provinsi Bengkulu sebelum melakukan checkout",
          side: "top",
          align: "start",
        },
      },
      {
        element: "#ajukan1",
        popover: {
          title: "Kegiatan Penanggulangan Bencana",
          description:
            "Ini adalah form untuk mengajukan kebutuhan informasi/jasa kegiatan penanggulangan bencana kepada PTSP BMKG Provinsi Bengkulu",
          side: "bottom",
          align: "center",
        },
      },
      {
        element: "#ajukan2",
        popover: {
          title: "Kegiatan Sosial",
          description:
            "Ini adalah form untuk mengajukan kebutuhan informasi/jasa kegiatan sosial atau kegiatan kemanusiaan kepada PTSP BMKG Provinsi Bengkulu",
          side: "bottom",
          align: "center",
        },
      },
      {
        element: "#ajukan3",
        popover: {
          title: "Kegiatan Keagamaan",
          description:
            "Ini adalah form untuk mengajukan kebutuhan informasi/jasa kegiatan keagamaan kepada PTSP BMKG Provinsi Bengkulu",
          side: "bottom",
          align: "center",
        },
      },
      {
        element: "#ajukan4",
        popover: {
          title: "Kegiatan Pertahanan dan Keamanan",
          description:
            "Ini adalah form untuk mengajukan kebutuhan informasi/jasa kegiatan pertahanan dan keamanan yang melibatkan institusi keamanan kepada PTSP BMKG Provinsi Bengkulu",
          side: "right",
          align: "center",
        },
      },
      {
        element: "#ajukan5",
        popover: {
          title: "Kegiatan Pendidikan dan Penilitian non Komersil",
          description:
            "Ini adalah form untuk mengajukan kebutuhan informasi/jasa kegiatan penanggulangan bencana kepada PTSP BMKG Provinsi Bengkulu",
          side: "bottom",
          align: "center",
        },
      },
      {
        element: "#ajukan6",
        popover: {
          title: "Pemerintah Pusat atau Daerah",
          description:
            "Ini adalah form untuk mengajukan kebutuhan informasi/jasa kegiatan penanggulangan bencana kepada PTSP BMKG Provinsi Bengkulu",
          side: "bottom",
          align: "center",
        },
      },
      {
        element: "#ajukan7",
        popover: {
          title: "Pelayanan Informasi dengan Tarif PNBP",
          description:
            "Ini adalah form untuk mengajukan kebutuhan informasi/jasa kegiatan penanggulangan bencana kepada PTSP BMKG Provinsi Bengkulu",
          side: "bottom",
          align: "center",
        },
      },
      {
        element: "#form-ajukan",
        popover: {
          title: "Form Ajukan",
          description:
            "Ini adalah form ajukan kepada PTSP BMKG Provinsi Bengkulu",
          side: "top",
          align: "start",
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
