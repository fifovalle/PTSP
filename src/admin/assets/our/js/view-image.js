let images = document.querySelectorAll(".imageModalDetail");

images.forEach(function (image) {
  image.addEventListener("click", function () {
    let largeImageUrl = this.getAttribute("src");
    window.open(largeImageUrl, "_blank");
  });
});
