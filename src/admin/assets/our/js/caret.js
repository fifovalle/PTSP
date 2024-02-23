document.addEventListener("DOMContentLoaded", function () {
  let caretIcon = document.querySelector(".caret-icon");
  let hiddenContent = document.querySelector(".hidden-content");
  caretIcon.addEventListener("click", function () {
    if (caretIcon.classList.contains("fa-caret-up")) {
      caretIcon.classList.remove("fa-caret-up");
      caretIcon.classList.add("fa-caret-down");
    } else {
      caretIcon.classList.remove("fa-caret-down");
      caretIcon.classList.add("fa-caret-up");
    }

    hiddenContent.classList.toggle("show");
  });
});
