var xhrInformasi;
var timeoutInformasi;

function cariDataLiveInformasi() {
  var inputPencarianInformasi = document.getElementById(
    "inputPencarianInformasi",
  ).value;

  if (xhrInformasi && xhrInformasi.readyState !== XMLHttpRequest.DONE) {
    xhrInformasi.abort();
  }

  clearTimeout(timeoutInformasi);
  timeoutInformasi = setTimeout(function () {
    xhrInformasi = new XMLHttpRequest();

    xhrInformasi.onreadystatechange = function () {
      if (xhrInformasi.readyState == 4 && xhrInformasi.status == 200) {
        document.getElementById("tabelInformasi").innerHTML =
          xhrInformasi.responseText;
      }
    };

    xhrInformasi.open(
      "GET",
      "../config/search-live-information.php?q=" + inputPencarianInformasi,
      true,
    );

    xhrInformasi.send();
  }, 300);
}
