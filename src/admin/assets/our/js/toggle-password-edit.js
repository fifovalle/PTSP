const togglePasswordAdminEdit = document.getElementById(
  "togglePasswordAdminEdit",
);
const passwordProfil = document.getElementById("passwordProfil");

togglePasswordAdminEdit.addEventListener("click", function () {
  const type =
    passwordProfil.getAttribute("type") === "password" ? "text" : "password";
  passwordProfil.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});

const toggleConfirmPasswordAdminEdit = document.getElementById(
  "toggleConfirmPasswordAdminEdit",
);
const confirmPasswordProfil = document.getElementById("confirmPasswordProfil");

toggleConfirmPasswordAdminEdit.addEventListener("click", function () {
  const type =
    confirmPasswordProfil.getAttribute("type") === "password"
      ? "text"
      : "password";
  confirmPasswordProfil.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});
