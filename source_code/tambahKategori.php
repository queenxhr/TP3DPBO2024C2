<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Kategori.php');
include('classes/Template.php');

// Buat instance kategori
$listkategori = new Kategori($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Buka koneksi
$listkategori->open();

// Pengaturan untuk tampilan tabel
$mainTitle = 'Kategori'; // Judul utama
$operasiAdd = 'Tambah';
$formKategori = '<div class="card-header text-center">
<h3 class="my-0">Tambah Kategori</h3>
</div>

<div class="card-body text-end">
<form
  action="tambahKategori.php"
  method="POST"
  enctype="multipart/form-data"
>
  <div class="row mb-5">
    
    <div class="card px-3">
      <table border="0" class="text-start">
        <tr>
          <td><label for="kategori_nama">Nama</label></td>
          <td>:</td>
          <td>
            <input
              type="text"
              id="kategori_nama"
              name="kategori_nama"
            />
          </td>
        </tr>
        
      </table>
    </div>
    <!-- </div> -->
  </div>
  <div class="card-footer text-end">
    <!-- <button type="submit" class="btn btn-primary">
      Tambah kategori
    </button> -->
    <button type="submit" class="btn btn-primary" name="submit">Tambah kategori</button>
  </div>
</form>
</div>'; // Header tabel
$data = null; // Inisialisasi data tabel
$no = 1; // Nomor urut
$formLabel = 'Kategori'; // Label untuk form

// Tambah kategori
if (isset($_POST['submit'])) {
    // Jika tombol submit diklik
    $data = $_POST; // Ambil data dari form
    $file = $_FILES; // Ambil data file yang diunggah

    // Panggil method addData dari objek $listkategori
    $result = $listkategori->addkategori($data);

    if ($result) {
        // Jika data berhasil ditambahkan, beri respon sesuai kebutuhan
        echo "<script>alert('Data kategori berhasil ditambahkan');
        document.location.href = 'kategori.php';</script>";
    } else {
        // Jika terjadi kesalahan, beri respon sesuai kebutuhan
        echo "<script>alert('Gagal menambahkan data kategori');
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

