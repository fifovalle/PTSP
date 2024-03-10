function cariDataLangsung() {
  let keyword = document.getElementById('searchInput').value.trim();
  if (keyword !== '') {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log("Respons dari server diterima:", this.responseText);
        document.getElementsByClassName('boxParent')[0].innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "http://localhost/PTSP/src/admin/config/search.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("keyword=" + keyword);
  }
}
