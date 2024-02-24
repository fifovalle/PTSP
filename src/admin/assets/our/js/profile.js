$(document).ready(function () {
  $(".menu p").click(function () {
    $(".menu p").removeClass("active");
    $(this).addClass("active");
    let menuText = $(this).text();

    menuText === "Akun"
      ? ($(".dataAccount").show(), $(".dataEditAccount").hide())
      : ($(".dataEditAccount").show(), $(".dataAccount").hide());
  });
});
