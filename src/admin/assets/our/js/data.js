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

const checkBoxHeader = document.querySelector(".checkBoxData");
checkBoxHeader.addEventListener("click", function () {
  const checkBoxes = document.querySelectorAll(".checkBoxData");
  checkBoxes.forEach(function (checkbox) {
    checkbox.checked = checkBoxHeader.checked;
  });
  const actionsDiv = document.getElementById("actions");
  if (checkBoxHeader.checked) {
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
