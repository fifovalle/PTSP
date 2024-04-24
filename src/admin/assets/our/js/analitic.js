$(document).ready(function () {
  $(".menu p").click(function () {
    $(".menu p").removeClass("active");
    $(this).addClass("active");
    let menuText = $(this).text();

    menuText === "Semua"
      ? ($(".allData").show(),
        $(
          ".allDataInformation, .allDataIKM, .allDataTransaction, .allDataServices",
        ).hide())
      : menuText === "Informasi"
        ? ($(".allDataInformation").show(),
          $(
            ".allData, .allDataIKM, .allDataTransaction, .allDataServices",
          ).hide())
        : menuText === "IKM"
          ? ($(".allDataIKM").show(),
            $(
              ".allData, .allDataInformation, .allDataTransaction, .allDataServices",
            ).hide())
          : menuText === "Transaksi"
            ? ($(".allDataTransaction").show(),
              $(
                ".allData, .allDataInformation, .allDataIKM, .allDataServices",
              ).hide())
            : ($(".allDataServices").show(),
              $(
                ".allData, .allDataInformation, .allDataIKM, .allDataTransaction",
              ).hide());
  });
});

$(document).ready(function () {
  $(".boxData").click(function () {
    $(".boxData").removeClass("active");
    $(this).addClass("active");
    let menuText = $(this).find(".headerBoxData").text();

    menuText === "Informasi"
      ? ($(".productChart").show(),
        $(".ikmChart, .servicesChart, .transactionChart").hide())
      : menuText === "Jasa"
        ? ($(".servicesChart").show(),
          $(".ikmChart, .transactionChart, .productChart").hide())
        : menuText === "IKM"
          ? ($(".ikmChart").show(),
            $(".productChart, .servicesChart, .transactionChart").hide())
          : ($(".transactionChart").show(),
            $(".ikmChart, .servicesChart, .productChart").hide());
  });
});

document.addEventListener("DOMContentLoaded", function () {
  let dropdownToggle = document.querySelector(".dropdown-toggle-analitic");
  let dropdownMenu = document.querySelector(".dropdown-menu-analitic");

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
