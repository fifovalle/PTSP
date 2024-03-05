// Get all dot elements
const dots = document.querySelectorAll('.dot');

// Loop through each dot element
dots.forEach(dot => {
    // Add click event listener
    dot.addEventListener('click', () => {
        // Remove active class from all dots
        dots.forEach(d => d.classList.remove('active'));
        // Add active class to the clicked dot
        dot.classList.add('active');
    });
});

function showProfileSetting(id) {
    // Semua konten disembunyikan
    let contentSections = document.querySelectorAll('.col-md-10');
    contentSections.forEach(function(section) {
        section.style.display = 'none';
    });
    
    // Tampilkan konten berdasarkan ID yang diberikan
    document.getElementById(id).style.display = 'block';

    // Ubah gaya tombol sesuai dengan ID yang diberikan
    let buttons = document.querySelectorAll('#opsi-profile .btn');
    buttons.forEach(function(button) {
        button.classList.remove('btn-success'); // Hapus kelas btn-success dari semua tombol
        button.classList.add('btn-outline-success'); // Tambahkan kelas btn-outline-success ke semua tombol
        button.style.color = 'green';
    });

    // Tentukan tombol yang diklik
    let clickedButton = document.getElementById(id === 'opsi-profilesetting' ? 'profile-setting' : 'alamat-setting');
    clickedButton.classList.add('btn-success');
    clickedButton.classList.remove('btn-outline-success');
    clickedButton.style.color = 'white';
}
