# 📚 Sistem Informasi Perpustakaan Sekolah Digital

Aplikasi berbasis web untuk mengelola data buku, peminjaman, dan pengembalian di perpustakaan sekolah secara digital menggunakan localhost.

---

## 📖 Deskripsi

Sistem Informasi Perpustakaan Sekolah Digital dibuat untuk membantu proses pengelolaan data perpustakaan agar lebih terstruktur, rapi, dan efisien. Aplikasi ini menggantikan pencatatan manual sehingga dapat mengurangi kesalahan data serta mempercepat proses peminjaman dan pengembalian buku.

Sistem ini memiliki dua jenis pengguna, yaitu **Admin** dan **Siswa (User)**, yang masing-masing memiliki hak akses berbeda sesuai kebutuhan.

---

## ✨ Fitur

### 🔐 Admin
* **Login Admin:** Akses penuh ke dashboard.
* **Manajemen Data Buku:** Tambah, edit, dan hapus data koleksi buku.
* **Manajemen Data Siswa:** Kelola data anggota perpustakaan.
* **Transaksi Peminjaman:** Mencatat buku yang dipinjam oleh siswa.
* **Proses Pengembalian:** Validasi pengembalian buku.
* **Pencarian & Filter:** Memudahkan pencarian data transaksi.
* **Dashboard:** Informasi ringkas statistik perpustakaan.

### 👨‍🎓 Siswa (User)
* **Registrasi Akun:** Daftar mandiri yang terintegrasi dengan data siswa.
* **Login User:** Akses ke halaman personal siswa.
* **Daftar Buku:** Melihat katalog buku yang tersedia.
* **Peminjaman Mandiri:** Melakukan pengajuan peminjaman.
* **Pengembalian:** Melakukan proses pengembalian buku melalui sistem.
* **Riwayat:** Melihat histori peminjaman pribadi.

---

## 🛠️ Tech Stack

* **Bahasa Pemrograman:** PHP (Native)
* **Database:** MySQL
* **Frontend:** HTML, CSS
* **Framework CSS:** Bootstrap 5
* **Web Server:** Apache (XAMPP)
* **Text Editor:** Visual Studio Code
* **Database Manager:** phpMyAdmin

---

## 🚀 Instalasi & Cara Menjalankan

1.  **Clone repository ini:**
    ```bash
    git clone [https://github.com/username/perpus_c2.git](https://github.com/username/perpus_c2.git)
    ```

2.  **Pindahkan folder project:**
    Pindahkan folder `perpus_c2` ke dalam direktori `htdocs` (jika menggunakan XAMPP).

3.  **Jalankan XAMPP Control Panel:**
    Aktifkan modul **Apache** dan **MySQL**.

4.  **Import Database:**
    * Buka browser dan akses `http://localhost/phpmyadmin`
    * Buat database baru dengan nama `perpus_c2`
    * Pilih tab **Import**, lalu pilih file `perpus_c2.sql` yang ada di dalam folder project.

5.  **Akses Aplikasi:**
    Buka browser dan ketik:
    ```
    http://localhost/perpus_c2
    ```

---

## 📌 Panduan Pengguna

1. Pilih mode login pada halaman utama (Admin atau Siswa).
2. **Admin** dapat mengelola master data buku, siswa, dan transaksi keseluruhan.
3. **Siswa** dapat mencari buku dan melihat status peminjaman mereka.
4. Pastikan melakukan **Logout** setelah selesai menggunakan aplikasi.

### 🔑 Akun Demo (Default)
| Role | Username | Password |
| :--- | :--- | :--- |
| **Admin** | `admin` | `123` |

---

## 📂 Struktur Folder

```text
perpus_c2/
├── assets/            # File CSS, JS, dan gambar pendukung
├── database/          # File koneksi database (PHP)
├── buku/              # Modul CRUD data buku
├── siswa/             # Modul CRUD data siswa
├── peminjaman/        # Logika transaksi pinjam & kembali
├── user/              # Halaman antarmuka siswa
├── index.php          # Halaman utama / Landing page
├── login.php          # Form login admin
├── login_user.php     # Form login siswa
├── register_user.php  # Form pendaftaran siswa
├── logout.php         # Menghapus session
└── perpus_c2.sql      # File database SQL

```

---

## 🖼️ Screenshot

| Halaman Login | Dashboard Admin |
| --- | --- |
|  |  |

---

## 🤝 Kontribusi

Project ini dibuat untuk keperluan **pembelajaran dan tugas sekolah**. Kontribusi sangat terbuka untuk pengembangan lebih lanjut.

Silakan lakukan **fork** repository ini, buat branch baru, dan ajukan **pull request**.

---

## 📄 Lisensi

Project ini digunakan untuk keperluan edukasi dan non-komersial.

## 👤 Developer

**Dimas Fahri Alfareza**