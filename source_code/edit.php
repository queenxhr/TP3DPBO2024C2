<?php
include ('config/db.php');
include ('classes/DB.php');
include ('classes/Kategori.php');
include ('classes/Brand.php');
include ('classes/Makeup.php');
include ('classes/Template.php');

// Buat instance makeup
$listmakeup = new Makeup($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Buka koneksi
$listmakeup->open();

// Pengaturan untuk tampilan tabel
$mainTitle = 'Makeup'; // Judul utama
$operasiAdd = 'Edit';
// Variabel untuk menyimpan pesan kesalahan atau sukses
$message = '';

// Periksa apakah parameter id diberikan di URL
if (isset($_GET['id'])) {
    // Ambil id dari URL
    $id = $_GET['id'];

    // Periksa apakah id valid
    if ($id > 0) {
        // Ambil data makeup berdasarkan id
        $listmakeup->getmakeupById($id);
        $row = $listmakeup->getResult();

        // Periksa apakah data ditemukan
        if ($row) {
            // Ambil data kategori
            $kategoriInstance = new Kategori($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
            $kategoriInstance->open();
            $dataKategori = $kategoriInstance->getKategoriArray();

            // Bangun opsi dropdown untuk kategori
            $optionsKategori = '';
            foreach ($dataKategori as $kategori) {
                // Tentukan apakah kategori saat ini dipilih atau tidak
                $selected = ($kategori['kategori_id'] == $row['kategori_id']) ? 'selected' : '';
                $optionsKategori .= "<option value='{$kategori['kategori_id']}' $selected>{$kategori['kategori_nama']}</option>";
            }
            $kategoriInstance->close();

            // Ambil data brand
            $brandInstance = new Brand($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
            $brandInstance->open();
            $dataBrand = $brandInstance->getBrandArray();

            // Bangun opsi dropdown untuk brand
            $optionsBrand = '';
            foreach ($dataBrand as $brand) {
                // Tentukan apakah brand saat ini dipilih atau tidak
                $selected = ($brand['brand_id'] == $row['brand_id']) ? 'selected' : '';
                $optionsBrand .= "<option value='{$brand['brand_id']}' $selected>{$brand['brand_nama']}</option>";
            }
            $brandInstance->close();
            // Jika data ditemukan, tampilkan formulir untuk mengedit data
            $formMakeup = '<div class="card-header text-center">
                        <h3 class="my-0">Edit Makeup</h3>
                    </div>
                    <div class="card-body text-end">
                        <form action="edit.php?id=' . $id . '" method="POST" enctype="multipart/form-data">
                            <div class="row mb-5">
                                <div class="card px-3">
                                    <table border="0" class="text-start">
                                        <tr>
                                            <td><label for="makeup_nama">Nama</label></td>
                                            <td>:</td>
                                            <td><input type="text" id="makeup_nama" name="makeup_nama" value="' . $row['makeup_nama'] . '" style="width: 1050px;"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="makeup_harga">Harga</label></td>
                                            <td>:</td>
                                            <td><input type="text" id="makeup_harga" name="makeup_harga" value="' . $row['makeup_harga'] . '" style="width: 1050px;"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="makeup_deskripsi">Deskripsi</label></td>
                                            <td>:</td>
                                            <td><input type="text" id="makeup_deskripsi" name="makeup_deskripsi" value="' . $row['makeup_deskripsi'] . '" style="width: 1050px;"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="makeup_foto">Foto Lama</label></td>
                                            <td>:</td>
                                            <td><img src="assets/images/' . $row['makeup_foto'] . '" class="img-thumbnail" alt="' . $row['makeup_foto'] . '" width="100"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="makeup_foto">Foto Baru</label></td>
                                            <td>:</td>
                                            <td><input type="file" name="makeup_foto" accept="image/*"></td>
                                        </tr>
                                        <tr>
                                <td><label for="kategori_id">Kategori</label></td>
                                <td>:</td>
                                <td>
                                    <select class="form-control" id="kategori_id" name="kategori_id">
                                        ' . $optionsKategori . '
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="brand_id">Brand</label></td>
                                <td>:</td>
                                <td>
                                    <select class="form-control" id="brand_id" name="brand_id">
                                        ' . $optionsBrand . '
                                    </select>
                                </td>
                            </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary" name="submit">Edit Makeup</button>
                            </div>
                        </form>
                    </div>';
        } else {
            // Jika data tidak ditemukan, berikan pesan kesalahan
            $message = 'Data makeup tidak ditemukan.';
        }
    } else {
        // Jika id tidak valid, berikan pesan kesalahan
        $message = 'ID makeup tidak valid.';
    }
} else {
    // Jika id tidak diberikan di URL, berikan pesan kesalahan
    $message = 'ID makeup tidak diberikan.';
}
$formLabel = 'Makeup'; // Label untuk form

// Ubah makeup
if (isset($_POST['submit'])) {
    // Jika tombol submit diklik
    $data = $_POST; // Ambil data dari form
    $file = $_FILES; // Ambil data file yang diunggah

    // Panggil method addData dari objek $listmakeup
    $result = $listmakeup->updateData($id, $data, $file);

    if ($result) {
        // Jika data berhasil diedit, beri respon sesuai kebutuhan
        echo "<script>alert('Data makeup berhasil diubah');
        document.location.href = 'index.php';</script>";
    } else {
        // Jika terjadi kesalahan, beri respon sesuai kebutuhan
        echo "<script>alert('Gagal mengubah data makeup');
        document.location.href = 'index.php';</script>";
    }
}

// Tutup koneksi
$listmakeup->close();

// Buat instance template
$home = new Template('templates/skinform.html');

// Simpan data ke template
$home->replace('FORM', $formMakeup);
$home->replace('OPERASI', $operasiAdd);
$home->replace('DATA_MAIN_TITLE', $mainTitle);
$home->write();

