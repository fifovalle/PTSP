document.getElementById("file").addEventListener("change", function (event) {
  var file = event.target.files[0];
  var reader = new FileReader();

  reader.onload = function (e) {
    var img = document.createElement("img");
    img.src = e.target.result;
    document.getElementById("imageContainer").innerHTML = "";
    document.getElementById("imageContainer").appendChild(img);
  };

  reader.readAsDataURL(file);
});
