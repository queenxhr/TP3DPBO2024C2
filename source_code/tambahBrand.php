<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Brand.php');
include('classes/Template.php');

// Buat instance brand
$listbrand = new Brand($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Buka koneksi
$listbrand->open();

// Pengaturan untuk tampilan tabel
$mainTitle = 'Brand'; // Judul utama
$operasiAdd = 'Tambah';
$formBrand = '<div class="card-header text-center">
<h3 class="my-0">Tambah Brand</h3>
</div>

<div class="card-body text-end">
<form
  action="tambahBrand.php"
  method="POST"
  enctype="multipart/form-data"
>
  <div class="row mb-5">
    
    <div class="card px-3">
      <table border="0" class="text-start">
        <tr>
          <td><label for="brand_nama">Nama</label></td>
          <td>:</td>
          <td>
            <input
              type="text"
              id="brand_nama"
              name="brand_nama"
            />
          </td>
        </tr>
        
      </table>
    </div>
    <!-- </div> -->
  </div>
  <div class="card-footer text-end">
    <!-- <button type="submit" class="btn btn-primary">
      Tambah brand
    </button> -->
    <button type="submit" class="btn btn-primary" name="submit">Tambah brand</button>
  </div>
</form>
</div>'; // Header tabel
$data = null; // Inisialisasi data tabel
$no = 1; // Nomor urut
$formLabel = 'Kategori'; // Label untuk form

// Tambah brand
if (isset($_POST['submit'])) {
    // Jika tombol submit diklik
    $data = $_POST; // Ambil data dari form
    $file = $_FILES; // Ambil data file yang diunggah

    // Panggil method addData dari objek $listbrand
    $result = $listbrand->addbrand($data);

    if ($result) {
        // Jika data berhasil ditambahkan, beri respon sesuai kebutuhan
        echo "<script>alert('Data brand berhasil ditambahkan');
        document.location.href = 'brand.php';</script>";
    } else {
        // Jika terjadi kesalahan, beri respon sesuai kebutuhan
        echo "<script>alert('Gagal menambahkan data brand');
        document.location.href = 'brand.php';</script>";
    }
}

// Tutup koneksi
$listbrand->close();

// Buat instance template
$home = new Template('templates/skinform.html');

// Simpan data ke template
$home->replace('FORM', $formBrand);
$home->replace('OPERASI', $operasiAdd);
$home->replace('DATA_MAIN_TITLE', $mainTitle);
$home->write();

