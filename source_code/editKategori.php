<?php
include ('config/db.php');
include ('classes/DB.php');
include ('classes/Kategori.php');
include ('classes/Template.php');

// Buat instance kategori
$listkategori = new Kategori($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Buka koneksi
$listkategori->open();

// Pengaturan untuk tampilan tabel
$mainTitle = 'Kategori'; // Judul utama
$operasiAdd = 'Edit';
// Variabel untuk menyimpan pesan kesalahan atau sukses
$message = '';

// Periksa apakah parameter id diberikan di URL
if (isset($_GET['id'])) {
    // Ambil id dari URL
    $id = $_GET['id'];

    // Periksa apakah id valid
    if ($id > 0) {
        // Ambil data kategori berdasarkan id
        $listkategori->getkategoriById($id);
        $row = $listkategori->getResult();

        // Periksa apakah data ditemukan
        if ($row) {
            
            // Jika data ditemukan, tampilkan formulir untuk mengedit data
            $formKategori = '<div class="card-header text-center">
                        <h3 class="my-0">Edit Kategori</h3>
                    </div>
                    <div class="card-body text-end">
                        <form action="editKategori.php?id=' . $id . '" method="POST" enctype="multipart/form-data">
                            <div class="row mb-5">
                                <div class="card px-3">
                                    <table border="0" class="text-start">
                                        <tr>
                                            <td><label for="kategori_nama">Nama</label></td>
                                            <td>:</td>
                                            <td><input type="text" id="kategori_nama" name="kategori_nama" value="' . $row['kategori_nama'] . '" style="width: 1050px;"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary" name="submit">Edit Kategori</button>
                            </div>
                        </form>
                    </div>';
        } else {
            // Jika data tidak ditemukan, berikan pesan kesalahan
            $message = 'Data kategori tidak ditemukan.';
        }
    } else {
        // Jika id tidak valid, berikan pesan kesalahan
        $message = 'ID kategori tidak valid.';
    }
} else {
    // Jika id tidak diberikan di URL, berikan pesan kesalahan
    $message = 'ID kategori tidak diberikan.';
}
$formLabel = 'Kategori'; // Label untuk form

// Ubah kategori
if (isset($_POST['submit'])) {
    // Jika tombol submit diklik
    $data = $_POST; // Ambil data dari form
    $file = $_FILES; // Ambil data file yang diunggah

    // Panggil method addData dari objek $listkategori
    $result = $listkategori->updatekategori($id, $data);

    if ($result) {
        // Jika data berhasil diedit, beri respon sesuai kebutuhan
        echo "<script>alert('Data kategori berhasil diubah');
        document.location.href = 'kategori.php';</script>";
    } else {
        // Jika terjadi kesalahan, beri respon sesuai kebutuhan
        echo "<script>alert('Gagal mengubah data kategori');
        document.location.href = 'kategori.php';</script>";
    }
}

// Tutup koneksi
$listkategori->close();

// Buat instance template
$home = new Template('templates/skinform.html');

// Simpan data ke template
$home->replace('FORM', $formKategori);
$home->replace('OPERASI', $operasiAdd);
$home->replace('DATA_MAIN_TITLE', $mainTitle);
$home->write();

