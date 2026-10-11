Berikut adalah rancangan **Product Requirements Document (PRD)** berdasarkan diagram ERD (Entity Relationship Diagram) yang Anda berikan. PRD ini dirancang untuk pengembangan aplikasi berbasis web menggunakan teknologi **PHP Native**, **JavaScript (Vanilla JS)**, **Tailwind CSS**, dan **MySQL**.

---

# Product Requirements Document (PRD): Sistem Informasi Akademik & E-Learning Sekolah

## 1. Overview & Latar Belakang

Aplikasi ini adalah sistem manajemen sekolah terpadu yang dirancang untuk mengelola data akademik, jadwal pelajaran, penilaian siswa, dan interaksi antara **Admin**, **Guru**, dan **Siswa**. Sistem ini dibangun menggunakan teknologi ringan dan cepat tanpa framework berat (PHP Native, Tailwind CSS untuk styling modern, dan JavaScript untuk interaktivitas dinamis).

## 2. Tujuan (Objectives)

* Mendigitalkan proses pengelolaan data siswa, guru, kelas, dan mata pelajaran.
* Memudahkan guru dalam menginput nilai dan melihat jadwal mengajar.
* Memudahkan siswa dalam melihat jadwal pelajaran dan nilai akademik mereka.
* Menyediakan kontrol penuh bagi admin untuk mengelola seluruh data master sistem.

## 3. Tech Stack

* **Frontend:** HTML5, JavaScript (Vanilla JS), Tailwind CSS (via CDN / Tailwind CLI).
* **Backend:** PHP Native (Procedural/OOP ringan dengan PDO untuk keamanan database).
* **Database:** MySQL.
* **Server Lokal:** Apache / Nginx (XAMPP / Laragon).

---

## 4. Struktur Database (Berdasarkan ERD)

Berdasarkan ERD pada gambar, berikut adalah rancangan tabel database MySQL:

1. **`admin`**
* `id_admin` (Primary Key, INT, Auto Increment)
* `username` (VARCHAR)
* `password` (VARCHAR - Encrypted/hashed)


2. **`kelas`**
* `id_kelas` (Primary Key, INT, Auto Increment)
* `nama` (VARCHAR)


3. **`guru`**
* `id_guru` (Primary Key, INT, Auto Increment)
* `nip` (VARCHAR)
* `nama` (VARCHAR)
* `password` (VARCHAR)


4. **`siswa`**
* `id_siswa` (Primary Key, INT, Auto Increment)
* `nis` (VARCHAR)
* `nama` (VARCHAR)
* `password` (VARCHAR)
* `id_kelas` (Foreign Key ke tabel `kelas`)


5. **`pelajaran`**
* `pelajaran_id` (Primary Key, INT, Auto Increment)
* `nama_pelajaran` (VARCHAR)


6. **`jadwal`**
* `jadwal_id` (Primary Key, INT, Auto Increment)
* `pelajaran_id` (Foreign Key ke tabel `pelajaran`)
* `id_kelas` (Foreign Key ke tabel `kelas`)
* `id_guru` (Foreign Key ke tabel `guru`)
* `hari` (ENUM/VARCHAR: Senin, Selasa, dll.)
* `jam` (TIME)
* `menit` / Waktu detail (VARCHAR/INT)


7. **`nilai`**
* `nilai_id` (Primary Key, INT, Auto Increment)
* `id_siswa` (Foreign Key ke tabel `siswa`)
* `pelajaran_id` (Foreign Key ke tabel `pelajaran`)
* `nilai` (FLOAT/INT)



---

## 5. Hak Akses & Peran Pengguna (User Roles)

### A. Admin

* **Login/Logout** menggunakan tabel `admin`.
* **Manajemen Data Master:**
* CRUD Data Guru (`guru`).
* CRUD Data Siswa (`siswa`) serta penempatan kelas (`id_kelas`).
* CRUD Data Kelas (`kelas`).
* CRUD Mata Pelajaran (`pelajaran`).
* Pengaturan Jadwal Pelajaran (`jadwal`).



### B. Guru

* **Login/Logout** menggunakan tabel `guru`.
* **Fitur Utama:**
* Melihat jadwal mengajar pribadi (`jadwal`).
* Menginput dan memperbarui nilai siswa (`nilai`) berdasarkan mata pelajaran yang diampu.
* Melihat daftar siswa di kelas yang diajar.



### C. Siswa

* **Login/Logout** menggunakan tabel `siswa`.
* **Fitur Utama:**
* Melihat profil pribadi dan kelas.
* Melihat jadwal pelajaran harian/mingguan.
* Melihat rekap nilai per mata pelajaran.



---

## 6. Alur Fungsional & Kebutuhan Fitur (User Stories)

### Modul Autentikasi

* Sebagai pengguna (Admin/Guru/Siswa), saya ingin bisa login ke sistem menggunakan kredensial yang sesuai agar dapat mengakses halaman dashboard masing-masing.
* Sistem harus memvalidasi session PHP berdasarkan role pengguna agar tidak terjadi kebocoran hak akses.

### Modul Admin (Dashboard & CRUD)

* Sebagai Admin, saya dapat melihat ringkasan jumlah siswa, guru, dan kelas pada halaman utama dashboard.
* Sebagai Admin, saya dapat menambahkan data siswa baru, menetapkan NIS, password, dan memilih kelas mereka.
* Sebagai Admin, saya dapat mengatur relasi jadwal dengan memilih Guru, Mata Pelajaran, Kelas, Hari, dan Jam.

### Modul Guru (Input Nilai & Jadwal)

* Sebagai Guru, saya dapat melihat jadwal mengajar saya sendiri.
* Sebagai Guru, saya dapat memilih kelas dan mata pelajaran lalu menginput nilai ujian/tugas siswa ke dalam tabel `nilai`.

### Modul Siswa (Portal Akademik)

* Sebagai Siswa, saya dapat melihat jadwal pelajaran kelas saya secara real-time.
* Sebagai Siswa, saya dapat memantau hasil nilai belajar saya untuk setiap mata pelajaran.

---

## 7. Desain UI/UX & Interaksi (Tailwind CSS & JavaScript)

* **Framework Styling:** Menggunakan **Tailwind CSS** untuk mempercepat pembuatan antarmuka yang bersih, responsif (mobile & desktop), dan modern.
* **Komponen UI:**
* Sidebar navigasi responsif.
* Tabel data interaktif dengan fitur pencarian sederhana menggunakan **Vanilla JavaScript**.
* Modal pop-up untuk form Tambah/Edit Data (menggunakan JavaScript DOM Manipulation agar halaman tidak perlu *reload* penuh, atau form submit standar PHP native dengan feedback alert).


* **Notifikasi:** Alert sederhana berbasis Tailwind untuk konfirmasi sukses/gagal pada aksi CRUD (Simpan, Update, Hapus).

---

## 8. Milestone Pengembangan (Timeline Singkat)

1. **Fase 1: Database Setup (1-2 Hari)**
* Pembuatan database MySQL sesuai ERD.
* Pembuatan relasi Foreign Key dan seeding akun default Admin.


2. **Fase 2: Backend Core & Auth (2-3 Hari)**
* Pembuatan koneksi database (`connection.php`).
* Pembuatan halaman Login dan sistem Session management untuk 3 role.


3. **Fase 3: Modul Admin & CRUD (3-4 Hari)**
* Pembuatan panel admin untuk manajemen Siswa, Guru, Kelas, dan Pelajaran.


4. **Fase 4: Modul Guru & Siswa (2-3 Hari)**
* Implementasi halaman input nilai oleh guru dan halaman lihat nilai/jadwal oleh siswa.


5. **Fase 5: Styling Tailwind & Finishing JS (2 Hari)**
* Penerapan desain Tailwind CSS secara menyeluruh dan penambahan interaksi JavaScript dinamis.


6. **Fase 6: Testing & Deployment (1 Hari)**
* Pengujian fungsionalitas (Black box testing) dan penyesuaian akhir.