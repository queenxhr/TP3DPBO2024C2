<?php

// Mengimpor file-file yang diperlukan
include ('config/db.php'); // File konfigurasi database
include ('classes/DB.php'); // Kelas untuk operasi database
include ('classes/Brand.php'); // Kelas brand
include ('classes/Template.php'); // Kelas untuk manajemen template

// Membuat objek brand dan melakukan koneksi ke database
$brand = new Brand($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$brand->open(); // Membuka koneksi

// Memanggil fungsi untuk mengambil data brand dari database
$brand->getbrand();


// Membuat objek template untuk tampilan
$view = new Template('templates/skintabel.html');

// Pengaturan untuk tampilan tabel
$mainTitle = 'Brand'; // Judul utama

$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Brand</th>
<th scope="row">Aksi</th>
</tr>'; // Header tabel
$data = null; // Inisialisasi data tabel
$no = 1; // Nomor urut
$formLabel = 'brand'; // Label untuk form
$footer = '<div class="card-footer text-end">
<a href="tambahBrand.php"><button type="button" class="btn btn-success text-white">Tambah Data</button></a>
</div>';
// Melakukan iterasi untuk menampilkan data brand dalam tabel
while ($div = $brand->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['brand_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="editBrand.php?id=' . $div['brand_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="brand.php?hapus=' . $div['brand_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

// Logika untuk menghapus data brand
if (isset($_GET['hapus'])) { // Jika terdapat parameter hapus pada URL
    $id = $_GET['hapus'];
    if ($id > 0) { // Jika id valid
        if ($brand->deletebrand($id) > 0) { // Jika data berhasil dihapus
            echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'brand.php';
            </script>";
        } else { // Jika data gagal dihapus
            echo "<script>
            alert('Data gagal dihapus!');
            document.location.href = 'brand.php';
            </script>";
        }
    }
}

$brand->close(); // Menutup koneksi database

// Mengganti placeholder pada template dengan data yang sudah diproses
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('TAMBAH_DATA', $footer);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write(); // Menampilkan tampilan yang sudah diproses
