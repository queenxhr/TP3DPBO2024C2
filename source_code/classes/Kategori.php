<?php

class Kategori extends DB
{
    // Method untuk mengambil semua data kategori
    function getkategori()
    {
        // Query SQL untuk mengambil semua data kategori
        $query = "SELECT * FROM kategori";
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->execute($query);
    }

    // Method untuk mengambil data kategori berdasarkan ID
    function getkategoriById($id)
    {
        // Query SQL untuk mengambil data kategori berdasarkan ID
        $query = "SELECT * FROM kategori WHERE kategori_id=$id";
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->execute($query);
    }

    // Method untuk menambahkan data kategori baru ke dalam database
    function addkategori($data)
    {
        // Ambil nilai nama kategori dari data yang diterima
        $nama = $data['kategori_nama'];
        
        // Query SQL untuk menambahkan data kategori ke dalam database
        $query = "INSERT INTO kategori VALUES('', '$nama')";
        
        // Eksekusi query dan kembalikan hasilnya
        return $this->executeAffected($query);
    }

    // Method untuk mengupdate data kategori berdasarkan ID
    function updatekategori($id, $data)
    {
        // Mendapatkan nilai nama kategori dari array asosiatif $data
        $nama = $data['kategori_nama'];

        // Query SQL untuk melakukan update data kategori berdasarkan ID
        $query = "UPDATE kategori SET kategori_nama='$nama' WHERE kategori_id='$id'";

        // Eksekusi query dan kembalikan hasilnya
        return $this->executeAffected($query);
    }

    // Method untuk menghapus data kategori berdasarkan ID
    function deletekategori($id)
    {
        // Query SQL untuk melakukan delete data kategori berdasarkan ID
        $query = "DELETE FROM kategori WHERE kategori_id='$id'";

        // Eksekusi query dan kembalikan hasilnya
        return $this->executeAffected($query);
    }

    // Method untuk mendapatkan data kategori dalam bentuk array asosiatif
    function getKategoriArray()
    {
        // Query SQL untuk mengambil semua data kategori
        $query = "SELECT kategori_id, kategori_nama FROM kategori";
        
        // Eksekusi query dan dapatkan hasilnya
        $result = $this->executeKhusus($query);
        
        // Inisialisasi array untuk menampung data kategori
        $data = array();
        
        // Ambil setiap baris hasil query dan tambahkan ke dalam array $data
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        
        // Kembalikan data kategori dalam bentuk array asosiatif
        return $data;
    }
}
