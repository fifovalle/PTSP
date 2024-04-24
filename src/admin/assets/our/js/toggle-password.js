const togglePasswordAdmin = document.getElementById("togglePasswordAdmin");
const passwordAdmin = document.getElementById("passwordAdmin");

togglePasswordAdmin.addEventListener("click", function () {
  const type =
    passwordAdmin.getAttribute("type") === "password" ? "text" : "password";
  passwordAdmin.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});

const toggleConfirmPasswordAdmin = document.getElementById(
  "toggleConfirmPasswordAdmin",
);
const confirmPasswordAdmin = document.getElementById("confirmPasswordAdmin");

toggleConfirmPasswordAdmin.addEventListener("click", function () {
  const type =
    confirmPasswordAdmin.getAttribute("type") === "password"
      ? "text"
      : "password";
  confirmPasswordAdmin.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});

const togglePasswordUser = document.getElementById("togglePasswordUser");
const passwordUser = document.getElementById("passwordUser");

togglePasswordUser.addEventListener("click", function () {
  const type =
    passwordUser.getAttribute("type") === "password" ? "text" : "password";
  passwordUser.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});

const toggleConfirmPasswordUser = document.getElementById(
  "toggleConfirmPasswordUser",
);
const confirmPasswordUser = document.getElementById("confirmPasswordUser");

toggleConfirmPasswordUser.addEventListener("click", function () {
  const type =
    confirmPasswordUser.getAttribute("type") === "password"
      ? "text"
      : "password";
  confirmPasswordUser.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});
