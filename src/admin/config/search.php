<?php
include 'databases.php';
$jasaModel = new Jasa($koneksi);
$informasiModel = new Informasi($koneksi);
if (isset($_POST["keyword"])) {
    $keyword = htmlspecialchars($_POST["keyword"]);
    $hasilInformasi = $informasiModel->cariDataInformasi($keyword);
    $hasilJasa = $jasaModel->cariDataJasa($keyword);
    $hasilPencarian = array_merge($hasilInformasi, $hasilJasa);
    $hasilPencaharian = '';
    if (!empty($hasilPencarian)) {
        foreach ($hasilPencarian as $item) {
            $hasilPencaharian .= '<div class="boxParent d-flex align-items-center justify-content-between list mb-3">';
            $hasilPencaharian .= '<img class="imageProduct" src="' . $akarUrl . 'src/admin/assets/image/uploads/' . (isset($item['Foto_Informasi']) ? $item['Foto_Informasi'] : $item['Foto_Jasa']) . '" alt="imageProduct">';
            $hasilPencaharian .= '<div class="box">';
            $hasilPencaharian .= '<p>' . (isset($item['Nama_Informasi']) ? $item['Nama_Informasi'] : $item['Nama_Jasa']) . '</p>';
            $hasilPencaharian .= '<p class="descriptionProduct">' . (isset($item['Deskripsi_Informasi']) ? $item['Deskripsi_Informasi'] : $item['Deskripsi_Jasa']) . '</p>';
            $hasilPencaharian .= '</div>';
            $hasilPencaharian .= '<div class="box date">';
            $hasilPencaharian .= '<p>' . (isset($item['Pemilik_Informasi']) ? $item['Pemilik_Informasi'] : $item['Pemilik_Jasa']) . '</p>';
            $hasilPencaharian .= '<p class="stok">' . (isset($item['Kategori_Informasi']) ? $item['Kategori_Informasi'] : $item['Kategori_Jasa']) . '</p>';
            $hasilPencaharian .= '<p class="fs-6 fw-bolder">' . (isset($item['Foto_Informasi']) ? 'Informasi' : 'Jasa') . '</p>';
            $hasilPencaharian .= '</div>';
            $hasilPencaharian .= '<a class="linkProduk ' . (isset($item['ID_Informasi']) ? 'buttonInformation' : 'buttonServices') . '" data-id="' . (isset($item['ID_Informasi']) ? $item['ID_Informasi'] : $item['ID_Jasa']) . '"><span class="edit-icon"><i class="fas fa-edit"></i> Sunting</span></a>';
            $hasilPencaharian .= '<a class="linkProduk" href="javascript:void(0);" onclick="' . (isset($item['ID_Informasi']) ? 'confirmDeleteInformation(' . $item['ID_Informasi'] . ')' : 'confirmDeleteServices(' . $item['ID_Jasa'] . ')') . '"><span class="delete-icon"><i class="fas fa-trash"></i> Hapus</span></a>';
            $hasilPencaharian .= '</div>';
        }
    } else {
        $hasilPencaharian = "<p class='text-center text-danger fw-bold pt-4 pb-2'>Tidak ada hasil yang ditemukan untuk pencarian ini.</p>";
    }
    echo $hasilPencaharian;
}
