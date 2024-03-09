document.querySelector(".button-up").addEventListener("click", function () {
  document.getElementById("main").scrollIntoView({ behavior: "smooth" });
});
document.querySelector(".button1").addEventListener("click", function () {
  document.getElementById("section1").scrollIntoView({ behavior: "smooth" });
});
document.querySelector(".moveStarted").addEventListener("click", function () {
  document.getElementById("Started").scrollIntoView({ behavior: "smooth" });
});

function pindahHalaman() {
  window.location.href = "../../src/user/pages/main.php";
}
