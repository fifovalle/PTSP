document.addEventListener('DOMContentLoaded', function() {
    var selanjutnyaBtn = document.getElementById('selanjutnya');

    // Menambahkan event listener untuk saat tombol "Selanjutnya" diklik
    selanjutnyaBtn.addEventListener('click', function() {
        document.getElementById('LayananInformasi').style.display = 'block';
        document.getElementById('DataDiri').style.display = 'none';
        document.getElementById('LayananGempaBumi').style.display = 'none';
        document.querySelector('.dot.step-two').classList.add('selected');
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var selanjutnya1Btn = document.getElementById('selanjutnya1');
    // Menambahkan event listener untuk saat tombol "Selanjutnya" diklik
    selanjutnya1Btn.addEventListener('click', function() {
        document.getElementById('LayananGempaBumi').style.display = 'block';
        document.getElementById('DataDiri').style.display = 'none';
        document.getElementById('LayananInformasi').style.display = 'none';
        document.querySelector('.dot.step-two').classList.add('selected');
        document.querySelector('.dot.step-three').classList.add('selected');
    });
});
