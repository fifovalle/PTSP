<script>
    function updateTotalHarga(idTransaksi) {
        let jumlahBarang = parseInt(document.getElementById("jumlah_barang_" + idTransaksi).innerText);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let data = JSON.parse(xhr.responseText);
                let hargaPerProduk = parseFloat(data.Harga_Informasi || data.Harga_Jasa || 0);
                let totalHarga = jumlahBarang * hargaPerProduk;
                console.log('Data yang diterima:', data);
                console.log('Jumlah Barang:', jumlahBarang);
                console.log('Harga Per Produk:', hargaPerProduk);
                console.log('Total Harga:', totalHarga);
                document.getElementById('total_harga_' + idTransaksi).innerText = totalHarga;
            }
        };
        xhr.open('GET', '../../admin/config/get-checkout-data.php?idTransaksi=' + idTransaksi, true);
        xhr.send();
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

    function kurangiNilai(idTransaksi) {
        let nilaiSpan = document.getElementById("nilai_" + idTransaksi);
        let nilai = parseInt(nilaiSpan.innerHTML);
        let jumlahBarangSpan = document.getElementById("jumlah_barang_" + idTransaksi);
        let jumlahBarang = parseInt(jumlahBarangSpan.innerHTML);
        nilai--;
        if (nilai < 1) {
            nilai = 1;
        }
        if (jumlahBarang > 1) {
            jumlahBarang--;
        }
        nilaiSpan.innerHTML = nilai;
        jumlahBarangSpan.innerHTML = jumlahBarang;
        updateTotalHarga(idTransaksi);
    }
</script>