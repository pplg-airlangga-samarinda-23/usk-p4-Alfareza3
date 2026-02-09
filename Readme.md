# 📚 Sistem Informasi Perpustakaan Sekolah Digital

Aplikasi berbasis web untuk mengelola data buku, peminjaman, dan pengembalian perpustakaan sekolah secara digital menggunakan **localhost**.

---

## 📖 Deskripsi

Sistem Informasi Perpustakaan Sekolah Digital adalah aplikasi berbasis web yang dirancang untuk membantu proses pengelolaan perpustakaan agar lebih **terstruktur, rapi, dan efisien**.

Aplikasi ini menggantikan sistem pencatatan manual sehingga dapat:
- Mengurangi kesalahan data
- Mempercepat proses peminjaman dan pengembalian buku
- Mempermudah pengelolaan data perpustakaan

Sistem memiliki dua jenis pengguna, yaitu **Admin** dan **Siswa (User)**, dengan hak akses yang berbeda sesuai perannya.

Aplikasi berjalan secara **offline (localhost)** dan cocok digunakan sebagai sistem internal sekolah.

---

## ✨ Fitur

### 🔐 Admin
- Login admin
- Dashboard statistik perpustakaan
- Manajemen data buku (tambah, edit, hapus)
- Manajemen data siswa
- Manajemen akun siswa  
  (reset password, edit username, hapus akun)
- Transaksi peminjaman buku
- Proses pengembalian buku
- Pencarian dan filter data  
  (buku, siswa, peminjaman)

### 👨‍🎓 Siswa (User)
- Registrasi akun siswa (terhubung dengan data siswa)
- Login user
- Melihat daftar buku
- Melakukan peminjaman buku
- Melakukan pengembalian buku
- Melihat riwayat peminjaman pribadi

---

## 🛠️ Tech Stack

- **Bahasa Pemrograman:** PHP (Native)
- **Database:** MySQL
- **Frontend:** HTML, CSS
- **Framework CSS:** Bootstrap 5
- **Web Server:** Apache (XAMPP / Laragon)
- **Text Editor:** Visual Studio Code
- **Database Manager:** phpMyAdmin

---

## 🚀 Instalasi & Cara Menjalankan

1. **Clone repository**
   ```bash
   git clone https://github.com/username/perpus_c2.git
   ```

2. **Pindahkan folder project**
   - XAMPP → `htdocs/`
   - Laragon → `www/`

3. **Jalankan Web Server**
   - Aktifkan **Apache** dan **MySQL**

4. **Import Database**
   - Buka `http://localhost/phpmyadmin`
   - Buat database dengan nama `perpus_c2`
   - Import file `perpus_c2.sql`

5. **Akses Aplikasi**
   ```
   http://localhost/perpus_c2
   ```

---

## 📌 Panduan Penggunaan

1. Buka aplikasi melalui browser.
2. Pilih jenis login (**Admin** atau **Siswa**).
3. **Admin** dapat:
   - Mengelola data buku, siswa, dan akun siswa
   - Mengelola transaksi peminjaman dan pengembalian
4. **Siswa** dapat:
   - Melihat daftar buku
   - Melakukan peminjaman dan pengembalian
   - Melihat riwayat peminjaman pribadi
5. Gunakan menu **Logout** setelah selesai.

---

## 🔑 Akun Demo

| Role  | Username | Password |
|------ |----------|----------|
| Admin | admin    | 123      |

---

## 📂 Struktur Folder

```text
perpus_c2/
├── assets/            # CSS, JavaScript, dan aset pendukung
├── database/          # Koneksi database
├── buku/              # CRUD data buku (admin)
├── siswa/             # CRUD data siswa & kelola akun
├── peminjaman/        # Transaksi peminjaman & pengembalian
├── user/              # Halaman siswa
├── index.php          # Landing page (pilih login)
├── login.php          # Login admin
├── login_user.php     # Login siswa
├── register_user.php  # Registrasi siswa
├── logout.php         # Logout
└── perpus_c2.sql      # Database
```

---

## 🖼️ Screenshot

| Halaman         | Preview                                   |
|-----------------|-------------------------------------------|
| Login           | ![Login](screenshots/login.png)           |
| Dashboard Admin | ![Dashboard](screenshots/dashboard.png)   |
| Data Buku       | ![Buku](screenshots/buku.png)             |
| Peminjaman      | ![Peminjaman](screenshots/peminjaman.png) |

> Screenshot disimpan di folder `screenshots/`

---

## 🤝 Kontribusi

Project ini dibuat untuk keperluan **pembelajaran dan tugas sekolah**.  
Pengembangan lanjutan terbuka untuk meningkatkan fitur dan kualitas sistem.

Silakan lakukan **fork**, buat branch baru, lalu ajukan **pull request**.

---

## 📄 Lisensi

Digunakan untuk keperluan **edukasi dan non-komersial**.

---

## 👤 Developer

**Dimas Fahri Alfareza**
