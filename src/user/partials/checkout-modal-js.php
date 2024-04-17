<script>
    function updateTotalHarga(idUpdate) {
        let jumlahBarang = parseInt(document.getElementById("jumlah_barang_" + idUpdate).innerText);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let data = JSON.parse(xhr.responseText);
                let hargaPerProduk = parseFloat(data.Harga_Informasi || data.Harga_Jasa || 0);
                let totalHarga = jumlahBarang * hargaPerProduk;
                let formattedTotalHarga = formatRupiah(totalHarga);
                console.log('Data yang diterima:', data);
                console.log('Jumlah Barang:', jumlahBarang);
                console.log('Harga Per Produk:', hargaPerProduk);
                console.log('Total Harga:', totalHarga);
                document.getElementById('total_harga_' + idUpdate).innerText = formattedTotalHarga;
            }
        };
        xhr.open('GET', '../../admin/config/get-checkout-data.php?idUpdate=' + idUpdate, true);
        xhr.send();
    }

    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return 'Rp' + ribuan;
    }

    function tambahNilai(idTransaksi) {
        let nilaiSpan = document.getElementById("nilai_" + idTransaksi);
        let nilai = parseInt(nilaiSpan.innerHTML);
        let jumlahBarangSpan = document.getElementById("jumlah_barang_" + idTransaksi);
        let jumlahBarang = parseInt(jumlahBarangSpan.innerHTML);
        nilai++;
        jumlahBarang++;
        nilaiSpan.innerHTML = nilai;
        jumlahBarangSpan.innerHTML = jumlahBarang;
        updateTotalHarga(idTransaksi);
    }

    function tambahNilai1(idJasa) {
        let nilaiSpan = document.getElementById("nilai_" + idJasa);
        let nilai = parseInt(nilaiSpan.innerHTML);
        let jumlahBarangSpan = document.getElementById("jumlah_barang_" + idJasa);
        let jumlahBarang = parseInt(jumlahBarangSpan.innerHTML);
        nilai++;
        jumlahBarang++;
        nilaiSpan.innerHTML = nilai;
        jumlahBarangSpan.innerHTML = jumlahBarang;
        updateTotalHarga(idJasa);
    }

    function kurangiNilai(idTransaksi) {
        let nilaiSpan = document.getElementById("nilai_" + idTransaksi);
        let nilai = parseInt(nilaiSpan.innerHTML);
        let jumlahBarangSpan = document.getElementById("jumlah_barang_" + idTransaksi);
        let jumlahBarang = parseInt(jumlahBarangSpan.innerHTML);
        nilai--;
        if (nilai < 1) {
            nilai = 0;
        }
        if (jumlahBarang > 0) {
            jumlahBarang--;
        }
        nilaiSpan.innerHTML = nilai;
        jumlahBarangSpan.innerHTML = jumlahBarang;
        updateTotalHarga(idTransaksi);
    }

    function kurangiNilai1(idJasa) {
        let nilaiSpan = document.getElementById("nilai_" + idJasa);
        let nilai = parseInt(nilaiSpan.innerHTML);
        let jumlahBarangSpan = document.getElementById("jumlah_barang_" + idJasa);
        let jumlahBarang = parseInt(jumlahBarangSpan.innerHTML);
        nilai--;
        if (nilai < 1) {
            nilai = 0;
        }
        if (jumlahBarang > 0) {
            jumlahBarang--;
        }
        nilaiSpan.innerHTML = nilai;
        jumlahBarangSpan.innerHTML = jumlahBarang;
        updateTotalHarga(idJasa);
    }
</script>