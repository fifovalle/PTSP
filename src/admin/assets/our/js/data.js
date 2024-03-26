$(document).ready(function () {
  $(".menu p").click(function () {
    $(".menu p").removeClass("active");
    $(this).addClass("active");
    let menuText = $(this).text();

    menuText === "Admin"
      ? ($(".adminTable").show(),
        $(
          ".userTable, .informationTable, .transactionTable, .servicesTable, .applymentTabl, .transactionTableHistory"
        ).hide())
      : menuText === "Pengguna"
      ? ($(
          ".adminTable, .informationTable, .transactionTable, .servicesTable, .applymentTable, .transactionTableHistory"
        ).hide(),
        $(".userTable").show())
      : menuText === "Informasi"
      ? ($(
          ".adminTable, .userTable, .transactionTable, .servicesTable, .applymentTable, .transactionTableHistory"
        ).hide(),
        $(".informationTable").show())
      : menuText === "Jasa"
      ? ($(
          ".adminTable, .userTable, .informationTable, .transactionTable, .applymentTable, transactionTableHistory"
        ).hide(),
        $(".servicesTable").show())
      : menuText === "Pengajuan"
      ? ($(
          ".adminTable, .userTable, .informationTable, .transactionTable, .servicesTable, .transactionTableHistory"
        ).hide(),
        $(".applymentTable").show())
      : menuText === "Transaksi"
      ? ($(
          ".adminTable, .userTable, .informationTable, .servicesTable, .applymentTable, .transactionTableHistory"
        ).hide(),
        $(".transactionTable").show())
      : ($(
          ".adminTable, .userTable, .informationTable, .servicesTable, .applymentTable, .transactionTable"
        ).hide(),
        $(".transactionTableHistory").show());
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

const checkBoxesAdmin = document.querySelectorAll(".checkBoxDataAdminData");
checkBoxesAdmin.forEach(function (checkbox) {
  checkbox.addEventListener("click", function () {
    const checkedCheckboxesAdmin = document.querySelectorAll(
      ".checkBoxDataAdminData:checked"
    );
    const actionsDiv = document.getElementById("actionsAdmin");
    if (checkedCheckboxesAdmin.length > 0) {
      actionsDiv.style.display = "block";
    } else {
      actionsDiv.style.display = "none";
    }
  });
});

const checkBoxesUser = document.querySelectorAll(".checkBoxDataUserData");
checkBoxesUser.forEach(function (checkbox) {
  checkbox.addEventListener("click", function () {
    const checkedCheckboxesUser = document.querySelectorAll(
      ".checkBoxDataUserData:checked"
    );
    const actionsDiv = document.getElementById("actionsUser");
    if (checkedCheckboxesUser.length > 0) {
      actionsDiv.style.display = "block";
    } else {
      actionsDiv.style.display = "none";
    }
  });
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

const checkBoxesProduct = document.querySelectorAll(".checkBoxDataProductData");
checkBoxesProduct.forEach(function (checkbox) {
  checkbox.addEventListener("click", function () {
    const checkedCheckboxesProduct = document.querySelectorAll(
      ".checkBoxDataProductData:checked"
    );
    const actionsDiv = document.getElementById("actionsProduct");
    if (checkedCheckboxesProduct.length > 0) {
      actionsDiv.style.display = "block";
    } else {
      actionsDiv.style.display = "none";
    }
  });
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

const checkBoxesTransaction = document.querySelectorAll(
  ".checkBoxDataTransactionData"
);
checkBoxesTransaction.forEach(function (checkbox) {
  checkbox.addEventListener("click", function () {
    const checkedCheckboxesTransaction = document.querySelectorAll(
      ".checkBoxDataTransactionData:checked"
    );
    const actionsDiv = document.getElementById("actionsTransaction");
    if (checkedCheckboxesTransaction.length > 0) {
      actionsDiv.style.display = "block";
    } else {
      actionsDiv.style.display = "none";
    }
  });
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
  let input = document.getElementById("filterInput");
  let dropdown = document.getElementById("dropdownFilter");

  input.addEventListener("click", function () {
    dropdown.classList.toggle("show");
  });
});
