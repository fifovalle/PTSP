function showProfileSetting(id) {
  // Semua konten disembunyikan
  let contentSections = document.querySelectorAll(".col-md-10");
  contentSections.forEach(function (section) {
    section.style.display = "none";
  });

  // Tampilkan konten berdasarkan ID yang diberikan
  document.getElementById(id).style.display = "block";

  // Ubah gaya tombol sesuai dengan ID yang diberikan
  let buttons = document.querySelectorAll("#opsi-profile .btn");
  buttons.forEach(function (button) {
    button.classList.remove("btn-success");
    button.classList.add("btn-outline-success");
    button.style.color = "green";
  });

  // Determine the clicked button
  let clickedButton;
  if (id === "opsi-profilesetting") {
    clickedButton = document.getElementById("profile-setting");
  } else if (id === "opsi-profileinfo") {
    clickedButton = document.getElementById("profile-info");
  } else if (id === "opsi-alamatsetting") {
    clickedButton = document.getElementById("alamat-setting");
  }

  // Modify the button's classes and style
  clickedButton.classList.add("btn-success");
  clickedButton.classList.remove("btn-outline-success");
  clickedButton.style.color = "white";
}

const card = document.querySelector(".card");
const box = card.querySelector(".box");
card.addEventListener("mouseenter", function () {
  box.style.display = "block";
});

card.addEventListener("mouseleave", function () {
  box.style.display = "none";
});
