<?php

class Makeup extends DB
{
    // Method untuk mengambil data makeup beserta informasi kategori dan brand yang di-join
    function getmakeupJoin()
    {
        // Query SQL untuk mengambil data makeup dengan informasi kategori dan brand yang di-join
        $query = "SELECT * FROM makeup JOIN kategori ON makeup.kategori_id=kategori.kategori_id JOIN brand ON makeup.brand_id=brand.brand_id ORDER BY makeup.makeup_id";

        // Eksekusi query dan kembalikan hasilnya
        return $this->execute($query);
    }

    // Method untuk mengambil data makeup dengan urutan ascending berdasarkan nama
    function getmakeupJoinAsc()
    {
        // Query SQL untuk mengambil data makeup dengan urutan ascending berdasarkan nama
        $query = "SELECT * FROM makeup 
              JOIN kategori ON makeup.kategori_id=kategori.kategori_id 
              JOIN brand ON makeup.brand_id=brand.brand_id 
              ORDER BY makeup.makeup_nama ASC"; // Urutkan berdasarkan nama makeup secara ascending
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->execute($query);
    }
    
    // Method untuk mengambil data makeup dengan urutan descending berdasarkan nama
    function getmakeupJoinDesc()
    {
        // Query SQL untuk mengambil data makeup dengan urutan descending berdasarkan nama
        $query = "SELECT * FROM makeup 
              JOIN kategori ON makeup.kategori_id=kategori.kategori_id 
              JOIN brand ON makeup.brand_id=brand.brand_id 
              ORDER BY makeup.makeup_nama DESC"; // Urutkan berdasarkan nama makeup secara descending
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->execute($query);
    }
    
    // Method untuk mengambil semua data makeup
    function getmakeup()
    {
        // Query SQL untuk mengambil semua data makeup
        $query = "SELECT * FROM makeup";
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->execute($query);
    }

    // Method untuk mengambil data makeup berdasarkan ID
    function getmakeupById($id)
    {
        // Query SQL untuk mengambil data makeup berdasarkan ID dengan informasi kategori dan brand yang di-join
        $query = "SELECT * FROM makeup JOIN kategori ON makeup.kategori_id=kategori.kategori_id JOIN brand ON makeup.brand_id=brand.brand_id WHERE makeup_id=$id";
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->execute($query);
    }

    // Method untuk melakukan pencarian data makeup berdasarkan kata kunci
    function searchmakeup($keyword)
    {
        // Escape karakter khusus dalam keyword untuk menghindari SQL injection
        $escaped_keyword = $this->getConnection()->real_escape_string($keyword);

        // Query SQL untuk melakukan pencarian data makeup berdasarkan nama menggunakan kata kunci
        $query = "SELECT * FROM makeup 
                  JOIN kategori ON makeup.kategori_id=kategori.kategori_id 
                  JOIN brand ON makeup.brand_id=brand.brand_id 
                  WHERE makeup.makeup_nama LIKE '%$escaped_keyword%'";

        // Eksekusi query dan kembalikan hasilnya
        return $this->execute($query);
    }

    // Method untuk menambahkan data makeup baru ke dalam database
    function addData($data, $file)
    {
        // Ambil nilai dari form
        $harga = $data['makeup_harga'];
        $nama = $data['makeup_nama'];
        $deskripsi = $data['makeup_deskripsi'];
        $kategori_id = $data['kategori_id'];
        $brand_id = $data['brand_id'];

        // Upload foto
        $foto = $file['makeup_foto']['name'];
        $photo_path = 'assets/images/' . basename($file['makeup_foto']['name']);
        move_uploaded_file($file['makeup_foto']['tmp_name'], $photo_path);

        // Query untuk menambahkan data makeup ke dalam database
        $query = "INSERT INTO makeup (makeup_harga, makeup_nama, makeup_deskripsi, kategori_id, brand_id, makeup_foto) 
              VALUES ('$harga', '$nama', '$deskripsi', '$kategori_id', '$brand_id', '$foto')";

        // Eksekusi query dan kembalikan hasilnya
        return $this->executeAffected($query);
    }

    // Method untuk mengupdate data makeup berdasarkan ID
    function updateData($id, $data, $file)
    {
        // Mendapatkan nilai dari array asosiatif $data
        $nama = $data['makeup_nama'];
        $harga = $data['makeup_harga'];
        $deskripsi = $data['makeup_deskripsi'];
        $kategori_id = $data['kategori_id']; // Mendapatkan ID kategori
        $brand_id = $data['brand_id']; // Mendapatkan ID brand

        $foto = $file['makeup_foto']['name']; // Mendapatkan nama file foto
        $photo_path = 'assets/images/' . basename($file['makeup_foto']['name']);
        // Jika file foto diunggah
        if ($file['makeup_foto']['size'] > 0) {
            // Menyimpan file foto ke direktori yang diinginkan
            move_uploaded_file($file['makeup_foto']['tmp_name'], $photo_path);

            // Query SQL untuk melakukan update data dengan foto baru
            $query = "UPDATE makeup SET makeup_foto='$foto', makeup_harga='$harga', makeup_nama='$nama', makeup_deskripsi='$deskripsi', kategori_id='$kategori_id', brand_id='$brand_id' WHERE makeup_id='$id'";
        } else {
            // Query SQL untuk melakukan update data tanpa mengubah foto
            $query = "UPDATE makeup SET makeup_harga='$harga', makeup_nama='$nama', makeup_deskripsi='$deskripsi', kategori_id='$kategori_id', brand_id='$brand_id' WHERE makeup_id='$id'";
        }

        // Eksekusi query dan kembalikan hasilnya
        return $this->executeAffected($query);
    }

    // Method untuk menghapus data makeup berdasarkan ID
    function deleteData($id)
    {
        // Query SQL untuk melakukan delete data
        $query = "DELETE FROM makeup WHERE makeup_id='$id'";

        // Eksekusi query dan kembalikan hasilnya
        return $this->executeAffected($query);
    }
}
