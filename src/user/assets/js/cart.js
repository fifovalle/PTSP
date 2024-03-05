function tambahNilai() {
    var nilaiSpan = document.getElementById("nilai_informasi");
    var nilai = parseInt(nilaiSpan.innerHTML);
    nilai++;
    nilaiSpan.innerHTML = nilai;
}

function tambahNilai1() {
    var nilaiSpan = document.getElementById("nilai_jasa");
    var nilai = parseInt(nilaiSpan.innerHTML);
    nilai++;
    nilaiSpan.innerHTML = nilai;
}

function kurangiNilai() {
    var nilaiSpan = document.getElementById("nilai_informasi");
    var nilai = parseInt(nilaiSpan.innerHTML);
    nilai--;
    if (nilai < 1) {
        nilai = 1;
    }
    nilaiSpan.innerHTML = nilai;
}

function kurangiNilai1() {
    var nilaiSpan = document.getElementById("nilai_jasa");
    var nilai = parseInt(nilaiSpan.innerHTML);
    nilai--;
    if (nilai < 1) {
        nilai = 1;
    }
    nilaiSpan.innerHTML = nilai;
}

function toggleTable() {
    var table = document.getElementById("Informasi");
    if (table.style.display === "none") {
        table.style.display = "table";
    } else {
        table.style.display = "none";
    }
}

function toggleTable1() {
    var table = document.getElementById("Jasa");
    if (table.style.display === "none") {
        table.style.display = "table";
    } else {
        table.style.display = "none";
    }
}