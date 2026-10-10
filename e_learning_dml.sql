CREATE DATABASE e_learning_sd;
USE e_learning_sd;

-- 1. Tabel User (Guru & Siswa)
CREATE TABLE users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100),
    no_induk VARCHAR(20) UNIQUE,
    password VARCHAR(255),
    role ENUM('guru', 'siswa'),
    kelas_id INT -- hanya diisi jika role adalah siswa
);

-- 2. Tabel Mata Pelajaran
CREATE TABLE mapel (
    id_mapel INT PRIMARY KEY AUTO_INCREMENT,
    nama_mapel VARCHAR(50)
);

-- 3. Tabel Materi
CREATE TABLE materi (
    id_materi INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(255),
    isi_materi TEXT,
    file_path VARCHAR(255), -- Link jika ada file PDF/Video
    id_mapel INT,
    id_guru INT,
    FOREIGN KEY (id_mapel) REFERENCES mapel(id_mapel),
    FOREIGN KEY (id_guru) REFERENCES users(id_user)
);

-- 4. Tabel Ujian/Ulangan (Header)
CREATE TABLE ujian (
    id_ujian INT PRIMARY KEY AUTO_INCREMENT,
    judul_ujian VARCHAR(100),
    jenis_ujian VARCHAR(4),
    id_mapel INT,
    tgl_pelaksanaan DATETIME,
    FOREIGN KEY (id_mapel) REFERENCES mapel(id_mapel)
);

-- 5. Tabel Bank Soal
CREATE TABLE bank_soal (
    id_soal INT PRIMARY KEY AUTO_INCREMENT,
    id_ujian INT,
    pertanyaan TEXT,
    opsi_a TEXT,
    opsi_b TEXT,
    opsi_c TEXT,
    opsi_d TEXT,
    jawaban_benar ENUM('A', 'B', 'C', 'D'),
    FOREIGN KEY (id_ujian) REFERENCES ujian(id_ujian)
);

-- 6. Tabel Nilai
CREATE TABLE nilai (
    id_nilai INT PRIMARY KEY AUTO_INCREMENT,
    id_siswa INT,
    id_ujian INT,
    skor DECIMAL(5,2),
    waktu_selesai TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_siswa) REFERENCES users(id_user),
    FOREIGN KEY (id_ujian) REFERENCES ujian(id_ujian)
);