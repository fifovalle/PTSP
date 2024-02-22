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
