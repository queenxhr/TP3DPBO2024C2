<?php
include ('config/db.php');
include ('classes/DB.php');
include ('classes/Brand.php');
include ('classes/Template.php');

// Buat instance brand
$listbrand = new Brand($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Buka koneksi
$listbrand->open();

// Pengaturan untuk tampilan tabel
$mainTitle = 'Brand'; // Judul utama
$operasiAdd = 'Edit';
// Variabel untuk menyimpan pesan kesalahan atau sukses
$message = '';

// Periksa apakah parameter id diberikan di URL
if (isset($_GET['id'])) {
    // Ambil id dari URL
    $id = $_GET['id'];

    // Periksa apakah id valid
    if ($id > 0) {
        // Ambil data brand berdasarkan id
        $listbrand->getbrandById($id);
        $row = $listbrand->getResult();

        // Periksa apakah data ditemukan
        if ($row) {
            
            // Jika data ditemukan, tampilkan formulir untuk mengedit data
            $formKategori = '<div class="card-header text-center">
                        <h3 class="my-0">Edit Brand</h3>
                    </div>
                    <div class="card-body text-end">
                        <form action="editBrand.php?id=' . $id . '" method="POST" enctype="multipart/form-data">
                            <div class="row mb-5">
                                <div class="card px-3">
                                    <table border="0" class="text-start">
                                        <tr>
                                            <td><label for="brand_nama">Nama</label></td>
                                            <td>:</td>
                                            <td><input type="text" id="brand_nama" name="brand_nama" value="' . $row['brand_nama'] . '" style="width: 1050px;"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary" name="submit">Edit Brand</button>
                            </div>
                        </form>
                    </div>';
        } else {
            // Jika data tidak ditemukan, berikan pesan kesalahan
            $message = 'Data brand tidak ditemukan.';
        }
    } else {
        // Jika id tidak valid, berikan pesan kesalahan
        $message = 'ID brand tidak valid.';
    }
} else {
    // Jika id tidak diberikan di URL, berikan pesan kesalahan
    $message = 'ID brand tidak diberikan.';
}
$formLabel = 'Brand'; // Label untuk form

// Ubah brand
if (isset($_POST['submit'])) {
    // Jika tombol submit diklik
    $data = $_POST; // Ambil data dari form
    $file = $_FILES; // Ambil data file yang diunggah

    // Panggil method addData dari objek $listbrand
    $result = $listbrand->updatebrand($id, $data);

    if ($result) {
        // Jika data berhasil diedit, beri respon sesuai kebutuhan
        echo "<script>alert('Data brand berhasil diubah');
        document.location.href = 'brand.php';</script>";
    } else {
        // Jika terjadi kesalahan, beri respon sesuai kebutuhan
        echo "<script>alert('Gagal mengubah data brand');
        document.location.href = 'brand.php';</script>";
    }
}

// Tutup koneksi
$listbrand->close();

// Buat instance template
$home = new Template('templates/skinform.html');

// Simpan data ke template
$home->replace('FORM', $formKategori);
$home->replace('OPERASI', $operasiAdd);
$home->replace('DATA_MAIN_TITLE', $mainTitle);
$home->write();

