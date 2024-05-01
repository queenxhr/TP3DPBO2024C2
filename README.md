# TP3DPBO2024C2

# Janji
Saya Ratu Syahirah Khairunnisa [2200978] 
mengerjakan Tugas Praktikum 3
dalam mata kuliah DPBO
untuk keberkahanNya maka saya tidak melakukan kecurangan 
seperti yang telah dispesifikasikan. 
Aamiin

# Desain Program
Buatlah program menggunakan bahasa pemrograman PHP dengan spesifikasi sebagai berikut:
- Tema program bebas, Namun tidak boleh mengadaptasi tema program ormawa seperti pada modul ini
  Tema yang saya gunakan pada TP kali ini adalah koleksi makeup.
  
- Menggunakan minimal 3 buah tabel (kelas)

  a. `makeup`: Kelas utama yang isi tabelnya terdapat id, nama, harga, deskripsi, brand, dan kategori.

  b. `brand`: Kelas yang isinya brand atau merek makeup.

  c. `kategori` : Kelas yang isinya kategori makeup seperti waterproof dll.

  Hubungan antar kelas nya adalah :
  `brand` dan `kategori` merupakan foreign key dari `makeup`.

- Terdapat proses Create, Read, Update, dan Delete data pada setiap tabel
  Pembuatan CRUD data pada setiap tabel saya lakukan dengan cara menambah file php di root folder yang dihubungkan dengan file pada folder kelas

  a. CRUD MAKEUP
     - CREATE : menghubungkan antara Makeup.php (fungsi addData) dengan tambah.php dan skinform.html
     - UPDATE : menghubungkan antara Makeup.php (fungsi updateData) dengan edit.php dan skinform.html
     - DELETE : menghubungkan antara Makeup.php (fungsi deleteData) dengan detail.php
  
  b. CRUD BRAND
     - CREATE : menghubungkan antara Brand.php (fungsi addbrand) dengan tambahBrand.php dan skinform.html
     - UPDATE : menghubungkan antara Brand.php (fungsi updatebrand) dengan editBrand.php dan skinform.html
     - DELETE : menghubungkan antara Brand.php (fungsi deletebrand) dengan brand.php
  
  c. CRUD KATEGORI
     - CREATE : menghubungkan antara Kategori.php (fungsi addkategori) dengan tambahKategori.php dan skinform.html
     - UPDATE : menghubungkan antara Kategori.php (fungsi updatekategori) dengan editKategori.php dan skinform.html
     - DELETE : menghubungkan antara Kategori.php (fungsi deletekategori) dengan kategori.php
     
  Keseluruhan proses CRUD yang saya rancang menggunakan executeAffected yang apabila diklik tombolnya (Submit/Delete) maka akan memunculkan alert berhasil atau gagalnya

- Minimal Memiliki fungsi pencarian dan pengurutan data (kata kunci bebas) pada salah satu tabel
  1. Fungsi pencarian : mencari nama makeup pada index dengan cara membuat fungsi searchmakeup pada Makeup.php
  2. Pengurutan data : pengurutan data tabel Makeup berdasarkan namanya dengan menampilkan tombol 'Urutkan' pada navbar di index yang menampilkan pilihan Ascending atau Descending dengan membuat fungsi getmakeupJoinAsc dan getmakeupJoinDesc

- Menggunakan template/skin form tambah data dan ubah data yang sama
  penambahan skinform.html yang saya gunakan sudah dinamis sesuai dengan penjelasan CRUD di atas

- 1 tabel pada database ditampilkan dalam bentuk bukan tabel, 2 tabel atau lebih sisanya ditampilkan dalam bentuk tabel (seperti contoh saat praktikum)

  a. Tabel `makeup` ditampilkan dalam bentuk bukan tabel

  b. Tabel `brand` ditampilkan dalam bentuk tabel

  c. Tabel `kategori` ditampilkan dalam bentuk tabel
  
- Menggunakan template/skin tabel yang sama untuk menampilkan tabel
  penggunakan skintabel.html yang saya gunakan sudah dinamis

# Penjelasan Alur
Manajemen Koleksi Makeup ini adalah web yang dirancang untuk membantu user mengelola koleksi makeup mereka. Ini memungkinkan pengguna untuk menambahkan, melihat, memperbarui, dan menghapus item makeup, merek, dan kategori. 
---
User dapat menggunakan fitur-fitur pada web ini diantaranya: 
## Fitur-fitur
1. **Makeup**
   - **Create:** Pengguna dapat menambahkan item makeup baru dengan menyediakan detail seperti nama, harga, deskripsi, merek, dan kategori.
   - **View:** Pengguna dapat melihat daftar semua item makeup dalam format yang menarik secara visual.
   - **Update:** Pengguna dapat mengedit detail item makeup yang ada.
   - **Delete:** Pengguna dapat menghapus item makeup dari koleksi mereka.

2. **Brand (Merek)**
   - **Create:** Pengguna dapat menambahkan merek makeup baru ke dalam basis data.
   - **View:** Pengguna dapat melihat daftar semua merek makeup.
   - **Update:** Pengguna dapat mengedit detail merek yang ada.
   - **Delete:** Pengguna dapat menghapus merek dari basis data.

3. **Kategori**
   - **Create:** Pengguna dapat menambahkan kategori makeup baru.
   - **View:** Pengguna dapat melihat daftar semua kategori makeup.
   - **Update:** Pengguna dapat mengedit detail kategori yang ada.
   - **Delete:** Pengguna dapat menghapus kategori dari basis data.

4. **Fungsi Pencarian**
   - Pengguna dapat mencari item makeup tertentu berdasarkan nama.

5. **Fungsi Pengurutan**
   - Pengguna dapat mengurutkan daftar item makeup secara alfabetis berdasarkan nama secara naik atau turun.

# Screenshots
1. **Index**
   <img width="959" alt="index" src="https://github.com/queenxhr/TP3DPBO2024C2/assets/135084798/77de2283-a80f-48fb-8079-27f7e7eb660b">
2. **Detail Makeup**
   <img width="959" alt="detail_makeup" src="https://github.com/queenxhr/TP3DPBO2024C2/assets/135084798/f395191b-9748-4809-b668-ef9ffabd468f">
3. **Tabel Daftar Kategori**
   <img width="959" alt="tabel_daftar_kategori" src="https://github.com/queenxhr/TP3DPBO2024C2/assets/135084798/9734d20a-bc31-4a20-9401-8aa848b62468">   
4. **Tabel Daftar Brand**
   <img width="959" alt="tabel_daftar_brand" src="https://github.com/queenxhr/TP3DPBO2024C2/assets/135084798/a029ac47-93e8-402a-bf28-93fcfc4b5a59">
5. **Contoh skinform**
   <img width="959" alt="tambah_makeup" src="https://github.com/queenxhr/TP3DPBO2024C2/assets/135084798/a089702d-175f-4780-b8ac-304973924535">
   <img width="959" alt="tambah_kategori" src="https://github.com/queenxhr/TP3DPBO2024C2/assets/135084798/592eaec5-478b-467a-ba4e-0df79ecc8d53">
   <img width="959" alt="tambah_brand" src="https://github.com/queenxhr/TP3DPBO2024C2/assets/135084798/10be872d-8092-4565-be10-af18557eb586">
   <img width="959" alt="edit_makeup" src="https://github.com/queenxhr/TP3DPBO2024C2/assets/135084798/6094067e-6f0b-4eb1-b1c9-9fbc05d18111">
   <img width="959" alt="edit_kategori" src="https://github.com/queenxhr/TP3DPBO2024C2/assets/135084798/7d3f22cd-afde-41b4-bb11-04527d4a10eb">
   <img width="959" alt="edit_brand" src="https://github.com/queenxhr/TP3DPBO2024C2/assets/135084798/51b3bbb7-39c4-4b78-a93d-e8391c30db43">
   
Lebih lengkapnya dapat diakses pada video_preview.mp4
