document.addEventListener("DOMContentLoaded", function () {
  const passwordField = document.querySelector('input[name="password"]');
  const toggleButton = document.getElementById("toggle"); // Menggunakan id sebagai selektor

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
