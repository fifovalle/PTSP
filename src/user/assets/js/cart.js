function tambahNilai1() {
  let nilaiSpan = document.getElementById("nilai_jasa");
  let nilai = parseInt(nilaiSpan.innerHTML);
  nilai++;
  nilaiSpan.innerHTML = nilai;
}

function kurangiNilai1() {
  let nilaiSpan = document.getElementById("nilai_jasa");
  let nilai = parseInt(nilaiSpan.innerHTML);
  nilai--;
  if (nilai < 1) {
    nilai = 1;
  }
  nilaiSpan.innerHTML = nilai;
}

function toggleTable() {
  let table = document.getElementById("Informasi");
  if (table.style.display === "none") {
    table.style.display = "table";
  } else {
    table.style.display = "none";
  }
}

function toggleTable1() {
  let table = document.getElementById("Jasa");
  if (table.style.display === "none") {
    table.style.display = "table";
  } else {
    table.style.display = "none";
  }
}
