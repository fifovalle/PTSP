function cariDataLangsung() {
  let input = document.getElementById("searchInput").value;

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "http://localhost/PTSP/src/admin/pages/data.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let response = xhr.responseText;
      document.getElementById("searchResult").innerHTML = response;
    }
  };

  xhr.send("keyword=" + input);
}
