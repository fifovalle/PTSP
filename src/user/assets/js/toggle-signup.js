$(document).ready(function () {
  $("#togglePassword1").click(function () {
    togglePassword("#Kata_Sandi");
  });

  $("#togglePassword2").click(function () {
    togglePassword("#Konfirmasi_Kata_Sandi");
  });

  function togglePassword(inputId) {
    const input = $(inputId);
    const icon = $(inputId).siblings("i");
    if (input.attr("type") === "password") {
      input.attr("type", "text");
      icon.removeClass("bi-eye-slash").addClass("bi-eye");
    } else {
      input.attr("type", "password");
      icon.removeClass("bi-eye").addClass("bi-eye-slash");
    }
  }
});
