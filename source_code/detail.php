<?php

// Termasuk file yang diperlukan
include('config/db.php'); // File konfigurasi database
include('classes/DB.php'); // Kelas DB untuk koneksi dan eksekusi query
include('classes/Kategori.php'); // Kelas Kategori untuk operasi pada tabel kategori
include('classes/Brand.php'); // Kelas Brand untuk operasi pada tabel brand
include('classes/Makeup.php'); // Kelas Makeup untuk operasi pada tabel makeup
include('classes/Template.php'); // Kelas Template untuk pengelolaan template HTML

// Inisialisasi objek untuk koneksi ke database dan operasi pada tabel makeup
$makeup = new Makeup($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$makeup->open(); // Buka koneksi ke database

$data = null; // Variabel untuk menyimpan hasil query

// Cek apakah terdapat parameter 'id' pada URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) { // Jika id valid
        // Ambil data makeup berdasarkan ID
        $makeup->getmakeupById($id);
        // Looping untuk memproses setiap baris hasil query
        while ($row = $makeup->getResult()) {
            // Membuat tampilan detail makeup
            $data .= '<div class="card-header text-center">
                <h3 class="my-0">Detail ' . $row['makeup_nama'] . '</h3>
                </div>
                <div class="card-body text-end">
                    <div class="row mb-5">
                        <div class="col-3">
                            <div class="row justify-content-center">
                                <img src="assets/images/' . $row['makeup_foto'] . '" class="img-thumbnail" alt="' . $row['makeup_foto'] . '" width="60">
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card px-3">
                                    <table border="0" class="text-start">
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>' . $row['makeup_nama'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Harga</td>
                                            <td>:</td>
                                            <td>' . $row['makeup_harga'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi</td>
                                            <td>:</td>
                                            <td>' . $row['makeup_deskripsi'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td>:</td>
                                            <td>' . $row['kategori_nama'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Brand</td>
                                            <td>:</td>
                                            <td>' . $row['brand_nama'] . '</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="edit.php?id=' . $row['makeup_id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                        <a href="detail.php?hapus=' . $row['makeup_id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
                    </div>';
        };
    }
}

// Logika untuk menghapus data makeup
if (isset($_GET['hapus'])) { // Jika terdapat parameter hapus pada URL
    $id = $_GET['hapus'];
    if ($id > 0) { // Jika id valid
        // Hapus data makeup berdasarkan ID
        if ($makeup->deleteData($id) > 0) { // Jika data berhasil dihapus
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else { // Jika data gagal dihapus
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

// Tutup koneksi ke database
$makeup->close();

// Inisialisasi objek Template dengan file skindetail.html
$detail = new Template('templates/skindetail.html');

// Mengganti placeholder 'DATA_DETAIL_MAKEUP' dengan data detail makeup yang sudah dibuat sebelumnya
$detail->replace('DATA_DETAIL_MAKEUP', $data);

// Menampilkan hasil template
$detail->write();
