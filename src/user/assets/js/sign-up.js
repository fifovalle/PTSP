// Menyembunyikan semua langkah kecuali langkah pertama saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
  var steps = document.querySelectorAll(".step");
  for (var i = 1; i < steps.length; i++) {
    steps[i].style.display = "none";
  }
});

var currentStep = 0;
var steps = document.getElementsByClassName("step");

function nextStep() {
  steps[currentStep].style.display = "none";
  currentStep++;
  steps[currentStep].style.display = "block";
}

function prevStep() {
  steps[currentStep].style.display = "none";
  currentStep--;
  steps[currentStep].style.display = "block";
}

document.addEventListener("DOMContentLoaded", function () {
  const checkbox = document.getElementById("flexCheckDefault");
  const button = document.querySelector("button[type='submit']");

  // Disable the button initially
  button.disabled = true;

  checkbox.addEventListener("change", function () {
    if (checkbox.checked) {
      button.disabled = false;
    } else {
      button.disabled = true;
    }
  });
});
