function cariDataLangsung() {
  let keyword = document.getElementById("searchInput").value.trim();
  if (keyword !== "") {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        if (this.status == 200) {
          document.getElementById("boxParent").innerHTML = this.responseText;
          let boxParent2Elements = document.querySelectorAll("#boxParent2");
          boxParent2Elements.forEach((element) => {
            element.classList.add("d-none");
          });
        } else {
          let boxParent2Elements = document.querySelectorAll("#boxParent2");
          boxParent2Elements.forEach((element) => {
            element.classList.remove("d-none");
          });
        }
      }
    };
    xhttp.open(
      "POST",
      "http://localhost/PTSP/src/admin/config/search.php",
      true,
    );
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("keyword=" + keyword);
  }
}
