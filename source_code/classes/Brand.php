<?php

class Brand extends DB
{
    // Method untuk mengambil semua data brand
    function getbrand()
    {
        // Query SQL untuk mengambil semua data brand
        $query = "SELECT * FROM brand";
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->execute($query);
    }

    // Method untuk mengambil data brand berdasarkan ID
    function getbrandById($id)
    {
        // Query SQL untuk mengambil data brand berdasarkan ID
        $query = "SELECT * FROM brand WHERE brand_id=$id";
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->execute($query);
    }

    // Method untuk menambahkan data brand baru ke dalam database
    function addbrand($data)
    {
        // Ambil nilai nama brand dari data yang diterima
        $nama = $data['brand_nama'];

        // Query SQL untuk menambahkan data brand ke dalam database
        $query = "INSERT INTO brand VALUES('', '$nama')";
        
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->executeAffected($query);
    }

    // Method untuk mengupdate data kategori berdasarkan ID
    function updatebrand($id, $data)
    {
        // Mendapatkan nilai nama kategori dari array asosiatif $data
        $nama = $data['brand_nama'];

        // Query SQL untuk melakukan update data brand berdasarkan ID
        $query = "UPDATE brand SET brand_nama='$nama' WHERE brand_id='$id'";
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->executeAffected($query);
    }

    // Method untuk menghapus data brand berdasarkan ID
    function deletebrand($id)
    {
        // Query SQL untuk melakukan delete data kategori berdasarkan ID
        $query = "DELETE FROM brand WHERE brand_id='$id'";
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->executeAffected($query);
    }

    // Method untuk mendapatkan data brand dalam bentuk array asosiatif
    function getBrandArray()
    {
        // Query SQL untuk mengambil semua data kategori
        $query = "SELECT brand_id, brand_nama FROM brand";
        
        // Eksekusi query dan dapatkan hasilnya
        $result = $this->executeKhusus($query);

        // Inisialisasi array untuk menampung data brand
        $data = array();

        // Ambil setiap baris hasil query dan tambahkan ke dalam array $data
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        // Kembalikan data kategori dalam bentuk array asosiatif
        return $data;
    }
}
