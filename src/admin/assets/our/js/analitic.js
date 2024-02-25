$(document).ready(function () {
  $(".menu p").click(function () {
    $(".menu p").removeClass("active");
    $(this).addClass("active");
    let menuText = $(this).text();

    menuText === "Semua"
      ? ($(".allData").show(),
        $(".allDataProduct, .allDataIKM, .allDataTransaction").hide())
      : menuText === "Produk"
      ? ($(".allDataProduct").show(),
        $(".allData, .allDataIKM, .allDataTransaction").hide())
      : menuText === "IKM"
      ? ($(".allDataIKM").show(),
        $(".allData, .allDataProduct, .allDataTransaction").hide())
      : ($(".allDataTransaction").show(),
        $(".allData, .allDataProduct, .allDataIKM").hide());
  });
});

$(document).ready(function () {
  $(".boxData").click(function () {
    $(".boxData").removeClass("active");
    $(this).addClass("active");
    let menuText = $(this).find(".headerBoxData").text();

    menuText === "Produk"
      ? ($(".productChart").show(), $(".ikmChart, .transactionChart").hide())
      : menuText === "IKM"
      ? ($(".ikmChart").show(), $(".productChart, .transactionChart").hide())
      : ($(".transactionChart").show(), $(".ikmChart, .productChart").hide());
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var dropdownToggle = document.querySelector(".dropdown-toggle-analitic");
  var dropdownMenu = document.querySelector(".dropdown-menu-analitic");

  dropdownToggle.addEventListener("click", function () {
    dropdownMenu.classList.toggle("show");
    dropdownToggle.querySelector(".caret").classList.toggle("rotate-up");
  });

  document.addEventListener("click", function (e) {
    if (
      !dropdownMenu.contains(e.target) &&
      !dropdownToggle.contains(e.target)
    ) {
      dropdownMenu.classList.remove("show");
      dropdownToggle.querySelector(".caret").classList.remove("rotate-up");
    }
  });
});
