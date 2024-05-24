document.addEventListener("DOMContentLoaded", function () {
  const passwordField = document.querySelector('input[name="Kata_Sandi_Baru"]');
  const toggleButton = document.querySelector(".eye-toggle");

  toggleButton.addEventListener("click", function () {
    const type =
      passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);

    // Ubah ikon eye
    if (type === "password") {
      toggleButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
      toggleButton.innerHTML = '<i class="bi bi-eye"></i>';
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const passwordField = document.querySelector(
    'input[name="Konfirmasi_Kata_Sandi_Baru"]'
  );
  const toggleButton = document.querySelector(".eye-toggle2");

  toggleButton.addEventListener("click", function () {
    const type =
      passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);

    // Ubah ikon eye
    if (type === "password") {
      toggleButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
      toggleButton.innerHTML = '<i class="bi bi-eye"></i>';
    }
  });
});
