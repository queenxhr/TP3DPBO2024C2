<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Kategori.php');
include('classes/Brand.php');
include('classes/Makeup.php');
include('classes/Template.php');

// buat instance makeup
$listmakeup = new Makeup($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listmakeup->open();
// tampilkan data makeup
$listmakeup->getmakeupJoinAsc();

// cari makeup
if (isset($_POST['btn-cari'])) {
    // methode mencari data makeup
    $listmakeup->searchmakeup($_POST['cari']);
} else {
    // method menampilkan data makeup
    $listmakeup->getmakeupJoinAsc();
}

$data = null;

// ambil data makeup
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listmakeup->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 makeup-thumbnail">
        <a href="detail.php?id=' . $row['makeup_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['makeup_foto'] . '" class="card-img-top" alt="' . $row['makeup_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text makeup-nama my-0">' . $row['makeup_nama'] . '</p>
                <p class="card-text kategori-nama">' . $row['kategori_nama'] . '</p>
                <p class="card-text brand-nama my-0">' . $row['brand_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listmakeup->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_MAKEUP', $data);
$home->write();
