function showProfileSetting(id) {
  let contentSections = document.querySelectorAll(".col-md-10");
  contentSections.forEach(function (section) {
    section.style.display = "none";
  });

  document.getElementById(id).style.display = "block";

  let buttons = document.querySelectorAll("#opsi-profile .btn");
  buttons.forEach(function (button) {
    button.classList.remove("btn-success");
    button.classList.add("btn-outline-success");
    button.style.color = "green";
  });

  let clickedButton;
  if (id === "opsi-profilesetting") {
    clickedButton = document.getElementById("profile-setting");
  } else if (id === "opsi-profileinfo") {
    clickedButton = document.getElementById("profile-info");
  } else if (id === "opsi-alamatsetting") {
    clickedButton = document.getElementById("alamat-setting");
  }

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

document.getElementById("unggahFoto").addEventListener("change", function () {
  let file = this.files[0];
  let reader = new FileReader();

  reader.onload = function (e) {
    let imageSrc = e.target.result;
    let formUploadDiv = document.querySelector(".formUpload");

    formUploadDiv.classList.remove("formUpload");

    let label = document.querySelector(".upload-icon");
    label.innerHTML =
      '<img class="img-fluid" src="' + imageSrc + '" alt="Uploaded Image">';
  };

  reader.readAsDataURL(file);
});
