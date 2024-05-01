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
$operasiAdd = 'Tambah';
$formMakeup = '<div class="card-header text-center">
<h3 class="my-0">Tambah Makeup</h3>
</div>

<div class="card-body text-end">
<form
  action="tambah.php"
  method="POST"
  enctype="multipart/form-data"
>
  <div class="row mb-5">
    
    <div class="card px-3">
      <table border="0" class="text-start">
      <tr>
      <td><label for="makeup_nama">Nama</label></td>
      <td>:</td>
      <td>
        <input
          type="text"
          id="makeup_nama"
          name="makeup_nama"
          style="width: 1050px;" <!-- Atur lebar kotak input di sini -->
        
      </td>
    </tr>
    <tr>
      <td><label for="makeup_harga">Harga</label></td>
      <td>:</td>
      <td>
        <input
          type="text"
          id="makeup_harga"
          name="makeup_harga"
          style="width: 1050px;" <!-- Atur lebar kotak input di sini -->
        
      </td>
    </tr>
    <tr>
      <td><label for="makeup_deskripsi">Deskripsi</label></td>
      <td>:</td>
      <td>
        <input
          type="text"
          id="makeup_deskripsi"
          name="makeup_deskripsi"
          style="width: 1050px;" <!-- Atur lebar kotak input di sini -->
        
      </td>
    </tr>
    
        <tr>
          <td><label for="makeup_foto">Foto</label></td>
          <td>:</td>
          <td>
            <input
              type="file"
              name="makeup_foto"
              accept="image/*"
            />
          </td>
        </tr>
        <tr>
          <td><label for="kategori_id">Kategori</label></td>
          <td>:</td>
          <td>
            <select
              class="form-control my-2"
              id="kategori_id"
              name="kategori_id"
            >
              DATA_KATEGORI
            </select>
          </td>
        </tr>
        <tr>
          <td><label for="brand_id">Brand</label></td>
          <td>:</td>
          <td>
            <select
              class="form-control my-2"
              id="brand_id"
              name="brand_id"
            >
              DATA_BRAND
            </select>
          </td>
        </tr>
      </table>
    </div>
    <!-- </div> -->
  </div>
  <div class="card-footer text-end">
    <!-- <button type="submit" class="btn btn-primary">
      Tambah makeup
    </button> -->
    <button type="submit" class="btn btn-primary" name="submit">Tambah makeup</button>
  </div>
</form>
</div>'; // Header tabel
$data = null; // Inisialisasi data tabel
$no = 1; // Nomor urut
$formLabel = 'Makeup'; // Label untuk form

// Tambah makeup
if (isset($_POST['submit'])) {
  // Jika tombol submit diklik
  $data = $_POST; // Ambil data dari form
  $file = $_FILES; // Ambil data file yang diunggah

  // Panggil method addData dari objek $listmakeup
  $result = $listmakeup->addData($data, $file);

  if ($result) {
    // Jika data berhasil ditambahkan, beri respon sesuai kebutuhan
    echo "<script>alert('Data makeup berhasil ditambahkan');
        document.location.href = 'index.php';</script>";
  } else {
    // Jika terjadi kesalahan, beri respon sesuai kebutuhan
    echo "<script>alert('Gagal menambahkan data makeup');
        document.location.href = 'index.php';</script>";
  }
}

// Ambil data kategori
$kategoriInstance = new Kategori($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kategoriInstance->open();
$dataKategori = $kategoriInstance->getKategoriArray();

// Bangun opsi dropdown untuk kategori
$optionsKategori = '';
foreach ($dataKategori as $kategori) {
  $optionsKategori .= "<option value='{$kategori['kategori_id']}'>{$kategori['kategori_nama']}</option>";
}
$kategoriInstance->close();

// Ambil data brand
$brandInstance = new Brand($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$brandInstance->open();
$dataBrand = $brandInstance->getBrandArray();

// Bangun opsi dropdown untuk brand
$optionsBrand = '';
foreach ($dataBrand as $brand) {
  $optionsBrand .= "<option value='{$brand['brand_id']}'>{$brand['brand_nama']}</option>";
}
$brandInstance->close();

// Tutup koneksi
$listmakeup->close();

// Buat instance template
$home = new Template('templates/skinform.html');

// Simpan data ke template
$home->replace('FORM', $formMakeup);
$home->replace('DATA_MAIN_TITLE', $mainTitle);
$home->replace('OPERASI', $operasiAdd);
$home->replace('DATA_KATEGORI', $optionsKategori);
$home->replace('DATA_BRAND', $optionsBrand);
$home->write();

