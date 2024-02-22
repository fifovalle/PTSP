$(document).ready(function () {
  $(".menu p").click(function () {
    $(".menu p").removeClass("active");
    $(this).addClass("active");
    let menuText = $(this).text();

    menuText === "Admin"
      ? ($(".adminTable").show(),
        $(".userTable, .productTabel, .transactionTable").hide())
      : menuText === "Pengguna"
      ? ($(".adminTable, .productTabel, .transactionTable").hide(),
        $(".userTable").show())
      : menuText === "Produk"
      ? ($(".adminTable, .userTable, .transactionTable").hide(),
        $(".productTabel").show())
      : ($(".adminTable, .userTable, .productTabel").hide(),
        $(".transactionTable").show());
  });
});

const checkBoxHeaderAdmin = document.querySelector(".checkBoxDataAdmin");
checkBoxHeaderAdmin.addEventListener("click", function () {
  const checkBoxes = document.querySelectorAll(".checkBoxDataAdmin");
  checkBoxes.forEach(function (checkbox) {
    checkbox.checked = checkBoxHeaderAdmin.checked;
  });
  const actionsDiv = document.getElementById("actionsAdmin");
  if (checkBoxHeaderAdmin.checked) {
    actionsDiv.style.display = "block";
  } else {
    actionsDiv.style.display = "none";
  }
});

const checkBoxHeaderUser = document.querySelector(".checkBoxDataUser");
checkBoxHeaderUser.addEventListener("click", function () {
  const checkBoxes = document.querySelectorAll(".checkBoxDataUser");
  checkBoxes.forEach(function (checkbox) {
    checkbox.checked = checkBoxHeaderUser.checked;
  });
  const actionsDiv = document.getElementById("actionsUser");
  if (checkBoxHeaderUser.checked) {
    actionsDiv.style.display = "block";
  } else {
    actionsDiv.style.display = "none";
  }
});

const checkBoxHeaderProduct = document.querySelector(".checkBoxDataProduct");
checkBoxHeaderProduct.addEventListener("click", function () {
  const checkBoxes = document.querySelectorAll(".checkBoxDataProduct");
  checkBoxes.forEach(function (checkbox) {
    checkbox.checked = checkBoxHeaderProduct.checked;
  });
  const actionsDiv = document.getElementById("actionsProduct");
  if (checkBoxHeaderProduct.checked) {
    actionsDiv.style.display = "block";
  } else {
    actionsDiv.style.display = "none";
  }
});

const checkBoxHeaderTransaction = document.querySelector(
  ".checkBoxDataTransaction"
);
checkBoxHeaderTransaction.addEventListener("click", function () {
  const checkBoxes = document.querySelectorAll(".checkBoxDataTransaction");
  checkBoxes.forEach(function (checkbox) {
    checkbox.checked = checkBoxHeaderTransaction.checked;
  });
  const actionsDiv = document.getElementById("actionsTransaction");
  if (checkBoxHeaderTransaction.checked) {
    actionsDiv.style.display = "block";
  } else {
    actionsDiv.style.display = "none";
  }
});

document.addEventListener("DOMContentLoaded", function () {
  var input = document.getElementById("filterInput");
  var dropdown = document.getElementById("dropdownFilter");

  input.addEventListener("click", function () {
    dropdown.classList.toggle("show");
  });
});
