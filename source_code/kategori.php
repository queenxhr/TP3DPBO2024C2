<?php

// Mengimpor file-file yang diperlukan
include ('config/db.php'); // File konfigurasi database
include ('classes/DB.php'); // Kelas untuk operasi database
include ('classes/Kategori.php'); // Kelas kategori
include ('classes/Template.php'); // Kelas untuk manajemen template

// Membuat objek kategori dan melakukan koneksi ke database
$kategori = new Kategori($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kategori->open(); // Membuka koneksi

// Memanggil fungsi untuk mengambil data kategori dari database
$kategori->getkategori();


// Membuat objek template untuk tampilan
$view = new Template('templates/skintabel.html');

// Pengaturan untuk tampilan tabel
$mainTitle = 'Kategori'; // Judul utama
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Kategori</th>
<th scope="row">Aksi</th>
</tr>
'; // Header tabel
$data = null; // Inisialisasi data tabel
$no = 1; // Nomor urut
$formLabel = 'kategori'; // Label untuk form
$footer = '<div class="card-footer text-end">
<a href="tambahKategori.php"><button type="button" class="btn btn-success text-white">Tambah Data</button></a>
</div>';
// Melakukan iterasi untuk menampilkan data kategori dalam tabel
while ($div = $kategori->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['kategori_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="editKategori.php?id=' . $div['kategori_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="kategori.php?hapus=' . $div['kategori_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>  
    </tr>
    ';
    $no++;
}


// Logika untuk menghapus data kategori
if (isset($_GET['hapus'])) { // Jika terdapat parameter hapus pada URL
    $id = $_GET['hapus'];
    if ($id > 0) { // Jika id valid
        if ($kategori->deletekategori($id) > 0) { // Jika data berhasil dihapus
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'kategori.php';
            </script>";
        } else { // Jika data gagal dihapus
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'kategori.php';
            </script>";
        }
    }
}

$kategori->close(); // Menutup koneksi database

// Mengganti placeholder pada template dengan data yang sudah diproses
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('TAMBAH_DATA', $footer);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write(); // Menampilkan tampilan yang sudah diproses
