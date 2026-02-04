# 📚 Sistem Informasi Perpustakaan Sekolah Digital

Aplikasi berbasis web untuk mengelola data buku, peminjaman, dan pengembalian di perpustakaan sekolah secara digital menggunakan environment **Localhost**.

---

## 📖 Deskripsi Proyek

**Sistem Informasi Perpustakaan Sekolah Digital** dirancang untuk mendigitalisasi proses administrasi perpustakaan agar lebih terstruktur, rapi, dan efisien. Aplikasi ini menggantikan pencatatan manual guna meminimalisir risiko kehilangan data serta mempercepat layanan sirkulasi buku.

Sistem ini mendukung dua role utama:
* **Admin:** Memiliki kontrol penuh terhadap manajemen data dan transaksi.
* **Siswa (User):** Dapat mencari buku dan memantau riwayat peminjaman secara mandiri.

---

## ✨ Fitur Utama

### 🔐 Panel Admin
- **Dashboard:** Statistik jumlah buku, siswa, dan transaksi aktif.
- **Manajemen Data:** CRUD (Create, Read, Update, Delete) data buku dan siswa.
- **Manajemen Akun:** Kontrol keamanan akun siswa (Reset password & Edit profil).
- **Sirkulasi:** Transaksi peminjaman dan pengembalian buku secara real-time.
- **Filter & Search:** Pencarian data cepat untuk buku dan riwayat peminjaman.

### 👨‍🎓 Panel Siswa
- **Self-Registration:** Mendaftar akun yang terintegrasi dengan database siswa.
- **Katalog Digital:** Melihat daftar buku yang tersedia.
- **E-Peminjaman:** Melakukan request peminjaman dan pengembalian secara mandiri.
- **History:** Melihat riwayat peminjaman pribadi.

---

## 🛠️ Tech Stack

| Komponen | Teknologi |
| :--- | :--- |
| **Bahasa Pemrograman** | PHP (Native) |
| **Database** | MySQL |
| **Frontend** | HTML5, CSS3 |
| **Framework CSS** | Bootstrap 5 |
| **Web Server** | Apache (XAMPP / Laragon) |
| **Editor** | Visual Studio Code |

---

## 🚀 Instalasi & Persiapan

Ikuti langkah-langkah berikut untuk menjalankan project di perangkat lokal Anda:

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/username/perpus_c2.git](https://github.com/username/perpus_c2.git)
    ```

2.  **Pindahkan Folder Project**
    * Jika menggunakan **XAMPP**: Pindahkan ke folder `C:/xampp/htdocs/`
    * Jika menggunakan **Laragon**: Pindahkan ke folder `C:/laragon/www/`

3.  **Persiapkan Database**
    * Aktifkan **Apache** dan **MySQL** di Control Panel XAMPP/Laragon.
    * Buka browser dan akses [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
    * Buat database baru dengan nama `perpus_c2`.
    * Pilih menu **Import** dan pilih file `perpus_c2.sql` yang ada di folder project.

4.  **Akses Aplikasi**
    Buka browser dan ketik alamat:
    ```text
    http://localhost/perpus_c2
    ```

---

## 🔑 Akun Demo

Gunakan kredensial berikut untuk menguji sistem:

| Role | Username | Password |
| :--- | :--- | :--- |
| **Admin** | `admin` | `123` |
| **Siswa** | *(Silakan registrasi di halaman Register)* | `-` |

---

## 📂 Struktur Folder

```text
perpus_c2/
├── assets/            # File CSS, JS, dan Gambar
├── database/          # File koneksi database (config)
├── buku/              # Modul manajemen buku (Admin)
├── siswa/             # Modul manajemen siswa & akun
├── peminjaman/        # Logika transaksi & sirkulasi
├── user/              # Halaman khusus interface siswa
├── index.php          # Halaman utama / Landing page
├── login.php          # Form login admin
├── logout.php         # Proses destroy session
└── perpus_c2.sql      # Database dump

```

---

## 🤝 Kontribusi

Project ini dikembangkan untuk tujuan edukasi. Jika Anda ingin melakukan pengembangan lebih lanjut:

1. Fork repository ini.
2. Buat branch fitur baru (`git checkout -b fitur-baru`).
3. Commit perubahan Anda (`git commit -m 'Menambahkan fitur X'`).
4. Push ke branch (`git push origin fitur-baru`).
5. Buat Pull Request.

---

## 📄 Lisensi & Developer

* **Developer:** Dimas Fahri Alfareza
* **Lisensi:** Free for Educational Purpose (Non-komersial).