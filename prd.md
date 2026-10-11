Berikut adalah **Product Requirement Document (PRD)** yang disusun berdasarkan ERD (Entity Relationship Diagram) yang Anda lampirkan untuk sistem E-Learning berbasis **PHP Native, JavaScript, Tailwind CSS, MySQL**, dengan arsitektur **MVC (Model-View-Controller) berorientasi objek (OOP)**.

---

# Product Requirement Document (PRD)

## Sistem Informasi E-Learning Sekolah

### 1. Gambaran Umum Proyek (Project Overview)

Aplikasi E-Learning ini dirancang untuk memudahkan proses manajemen sekolah, pengelolaan kelas, absensi/jadwal, penyampaian materi/pelajaran, hingga pengolahan nilai siswa. Sistem ini dikembangkan menggunakan **PHP Native dengan konsep OOP (Object-Oriented Programming)**, arsitektur **MVC**, antarmuka modern dengan **Tailwind CSS**, interaktivitas menggunakan **JavaScript**, dan database **MySQL**.

### 2. Tujuan (Objectives)

* Mendigitalkan proses manajemen data akademik (Siswa, Guru, Kelas, Pelajaran, dan Jadwal).
* Menyediakan wadah bagi guru untuk menginput nilai dan melihat jadwal mengajar.
* Menyediakan akses bagi siswa untuk melihat jadwal pelajaran dan nilai akademik mereka.
* Menerapkan struktur kode yang bersih, modular, dan mudah dikembangkan menggunakan arsitektur **MVC OOP**.

---

### 3. Arsitektur Sistem (MVC OOP Structure)

Sistem dirancang menggunakan struktur direktori MVC berbasis OOP:

```text
/
├── app/
│   ├── controllers/   # Berisi file Controller (AdminController, AuthController, GuruController, SiswaController, dll)
│   ├── models/        # Berisi file Model untuk interaksi database (Database.php, Admin.php, Siswa.php, Guru.php, Nilai.php, dll)
│   └── views/         # Berisi file Tampilan antarmuka berbasis Tailwind CSS (layouts, admin, guru, siswa, auth)
├── public/            # Public folder (assets: js, css/tailwind output, img, index.php sebagai entry point)
├── config/            # Konfigurasi database dan konstanta aplikasi
└── .htaccess          # URL Rewriting untuk clean URL MVC

```

---

### 4. Analisis Basis Data (Database Schema berdasarkan ERD)

Berdasarkan ERD yang terlampir, berikut adalah entitas dan relasinya:

1. **admin**: `id_admin` (PK), `username`, `password`
2. **Siswa**: `id_siswa` (PK), `nis`, `nama`, `password`, `id_kelas` (FK)
3. **guru**: `id_guru` (PK), `nip`, `nama`, `password`
4. **Kelas**: `id_kelas` (PK), `nama`
5. **Pelajaran**: `pelajaran_id` (PK), `nama_pelajaran`
6. **Nilai**: `nilai_id` (PK), `nilai`, `id_siswa` (FK), `pelajaran_id` (FK), `id_guru` (FK)
7. **Jadwal**: `jadwal_id` (PK), `hari`, `jam`, `menit`, `id_kelas` (FK), `pelajaran_id` (FK), `id_guru` (FK)

---

### 5. Hak Akses Pengguna (User Roles & Permissions)

Sistem memiliki 3 level pengguna utama:

1. **Admin**: Memiliki kontrol penuh untuk mengelola data master (Admin, Guru, Siswa, Kelas, Mata Pelajaran, dan Jadwal).
2. **Guru**: Mengelola nilai siswa dan melihat jadwal mengajar pribadi.
3. **Siswa**: Melihat informasi akademik pribadi, seperti nilai dan jadwal pelajaran kelas.

---

### 6. Rincian Fitur & Kebutuhan Fungsional (Functional Requirements)

#### A. Modul Otentikasi (Auth)

* **Login Multi-Role**: Halaman login tunggal atau terpisah untuk Admin, Guru, dan Siswa dengan validasi session PHP.
* **Logout**: Menghancurkan session dan mengarahkan kembali ke halaman login.

#### B. Modul Admin (Dashboard & CRUD Master Data)

* **Dashboard Admin**: Menampilkan statistik ringkas jumlah siswa, guru, kelas, dan mata pelajaran.
* **Manajemen Admin**: CRUD data akun admin.
* **Manajemen Guru**: CRUD data guru (NIP, Nama, Password).
* **Manajemen Siswa**: CRUD data siswa, termasuk relasi penempatan ke dalam tabel `Kelas`.
* **Manajemen Kelas**: CRUD data kelas (Contoh: Kelas 1A, 2B, dll).
* **Manajemen Pelajaran**: CRUD mata pelajaran (`pelajaran_id`, `nama_pelajaran`).
* **Manajemen Jadwal**: Mengatur jadwal pelajaran berdasarkan Hari, Jam, Menit, Kelas, Pelajaran, dan Guru pengampu.

#### C. Modul Guru

* **Dashboard Guru**: Menampilkan jadwal mengajar hari ini.
* **Input & Kelola Nilai**: Guru dapat memasukkan dan memperbarui nilai siswa berdasarkan mata pelajaran yang diampu.

#### D. Modul Siswa

* **Dashboard Siswa**: Menampilkan informasi profil siswa, kelas, dan ringkasan nilai.
* **Lihat Jadwal Pelajaran**: Siswa dapat melihat jadwal kegiatan belajar berdasarkan kelas mereka.
* **Lihat Nilai**: Siswa dapat melihat daftar nilai dari berbagai mata pelajaran.

---

### 7. Kebutuhan Non-Fungsional (Non-Functional Requirements)

* **Teknologi**:
* Backend: PHP Native (OOP Style, PDO untuk keamanan database dari SQL Injection).
* Frontend: HTML5, JavaScript (Vanilla JS untuk AJAX/DOM manipulation), Tailwind CSS (melalui CDN atau Compiled Build).
* Database: MySQL / MariaDB.


* **Keamanan**:
* Password Hashing (`password_hash` dan `password_verify`).
* Session Handling yang aman untuk mencegah akses halaman tanpa login.


* **Desain UI/UX**: Responsif (Mobile-friendly) menggunakan utility classes dari Tailwind CSS.

---

### 8. Alur Kerja Aplikasi (Workflow Singkat)

1. Pengguna mengakses aplikasi melalui `public/index.php` (Routing MVC).
2. Pengguna melakukan login pada halaman Auth.
3. Controller memvalidasi input, mencocokkan dengan Model database.
4. Jika valid, session dibuat dan pengguna diarahkan ke dashboard masing-masing (Admin/Guru/Siswa) dengan tampilan View yang dipercantik Tailwind CSS.