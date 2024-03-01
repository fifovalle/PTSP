const inputs = document.querySelectorAll(".input");
function addcl() {
  let parent = this.parentNode.parentNode;
  parent.classList.add("focus");
}
function remcl() {
  let parent = this.parentNode.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}
inputs.forEach((input) => {
  input.addEventListener("focus", addcl);
  input.addEventListener("blur", remcl);
});

const passwordInput = document.getElementById("passwordInput");
const togglePassword = document.getElementById("togglePassword");

togglePassword.addEventListener("click", function () {
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});

// DRIVE JS
const pengemudi = window.driver.js.driver;

let turTerakhir = localStorage.getItem("lastTourTime");
const waktuSekarang = new Date().getTime();

if (!turTerakhir || waktuSekarang - turTerakhir > 60000) {
  const objekPengemudi = pengemudi({
    showButtons: ["next", "previous", "close"],
    steps: [
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
          title: "Nama Pengguna",
          description: "Silahkan Masukkan Nama Pengguna.",
        },
      },
      {
        element: "#inputKataSandi",
        popover: {
          title: "Kata Sandi",
          description: "Silahkan Masukkan Kata Sandi.",
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
            "Jika Sudah Mengisi Semunya Silahkan Klik Tombol Disini.",
        },
      },
    ],
  });

  function startTour() {
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
        objekPengemudi.drive();
        localStorage.setItem("lastTourTime", new Date().getTime());
      }
    });
  }
  window.onload = startTour;
}
