-- 1. PERSIAPAN DATABASE

USE e_learning_sd;


-- 3. INSERT DUMMY DATA (PASSWORD TER-HASH)
-- Asumsi password asli: 'password123'
INSERT INTO users (nama, no_induk, password, role, kelas_id) VALUES
('Budi Santoso, S.Pd', '2010641001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'guru', NULL),
('Siti Aminah, S.Pd', '2410651002', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'guru', NULL),
('Ahmad Fauzan', '2410651003', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', 4),
('Lani Cahyani', '2410651004', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', 4),
('Lani Cahyani', '2410651005', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', 4),
('Bambang Pamungkas', '2410651006', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', 5);
INSERT INTO users( nama, no_induk, password, role, kelas_id) VALUES
( 'Dian Wijaya', '2410651007', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
( 'Rizky Pratama', '2410651008', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
( 'Siti Nurhaliza', '2410651009', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
( 'Aditya Nugraha', '2410651010', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
( 'Amalia Putri', '2410651011', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
( 'Dimas Setiawan', '2410651012', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
( 'Fitri Handayani', '2410651013', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
( 'Gilang Permana', '2410651014', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
( 'Indah Lestari', '2410651015', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
( 'Kevin Sanjaya', '2410651016', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6);

-- Data Mata Pelajaran
INSERT INTO mapel (nama_mapel) VALUES 
('IPA'), ('Matematika'), ('Bahasa Indonesia'), ('PPKN'),("IPS"),("B Inggris"),("Agama"),("PJOK");

-- Data Materi
INSERT INTO materi (judul, isi_materi, file_path, id_mapel, id_guru) VALUES
('Siklus Kupu-kupu', 'Metamorfosis sempurna dimulai dari telur...', 'ipa_kupu.pdf', 1, 1),
('Penjumlahan Pecahan', 'Cara menjumlahkan penyebut berbeda...', 'mtk_pecahan.mp4', 2, 1),
('Puisi Rakyat', 'Mengenal pantun dan syair...', 'indo_puisi.pdf', 3, 2);
INSERT INTO materi ( judul, isi_materi, file_path, id_mapel, id_guru) VALUES
( 'Tata Surya', 'Mengenal planet-planet dalam sistem tata surya kita...', 'ipa_tatasurya.pdf', 1, 1),
( 'Volume Bangun Ruang', 'Rumus menghitung volume kubus, balok, dan tabung...', 'mtk_volume.mp4', 2, 1),
( 'Formulir Pendaftaran', 'Cara mengisi formulir teks pendaftaran dengan benar...', 'indo_formulir.pdf', 3, 2),
( 'Nilai-Nilai Pancasila', 'Penerapan sila Pancasila dalam kehidupan sehari-hari...', 'ppkn_pancasila.pdf', 4, 1),
( 'Peristiwa Proklamasi', 'Sejarah singkat seputar proklamasi kemerdekaan RI...', 'ips_proklamasi.pdf', 5, 2),
( 'Globalisasi', 'Dampak positif dan negatif globalisasi bagi Indonesia...', 'ips_globalisasi.mp4', 5, 2),
('Offering Help', 'Ungkapan menawarkan bantuan dalam bahasa Inggris...', 'bing_offering.pdf', 6, 1),
('Kisah Keteladanan Nabi', 'Meneladani sifat jujur dan amanah para Nabi...', 'agama_nabi.pdf', 7, 2),
('Kebugaran Jasmani', 'Latihan fisik untuk menjaga kelenturan dan kekuatan...', 'pjok_bugar.mp4', 8, 1);


-- Data Ujian
INSERT INTO ujian (judul_ujian, jenis_ujian, id_mapel, tgl_pelaksanaan) VALUES
('UH 1 IPA', 'UH', 1, '2023-11-01 08:00:00'),
('UTS Matematika', 'UTS', 2, '2023-11-15 09:00:00');

-- Data Soal (IPA)
INSERT INTO bank_soal (id_ujian, pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d, jawaban_benar) VALUES
(1, 'Tahap setelah ulat adalah...', 'Telur', 'Kepompong', 'Kupu-kupu', 'Jentik', 'B'),
(1, 'Hewan yang tidak metamorfosis...', 'Kucing', 'Katak', 'Nyamuk', 'Lalat', 'A'),
(1, 'Fungsi akar adalah...', 'Fotosintesis', 'Menghisap air', 'Berbuah', 'Bernapas', 'B');

-- Data Soal (Matematika)
INSERT INTO bank_soal (id_ujian, pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d, jawaban_benar) VALUES
(2, 'Hasil dari 1/2 + 1/2 adalah...', '1/4', '1', '2/4', '2', 'B'),
(2, 'Bilangan prima setelah 2 adalah...', '3', '4', '5', '6', 'A');

-- Data Nilai (Hasil Otomatis)
INSERT INTO nilai (id_siswa, id_ujian, skor, waktu_selesai) VALUES
(3, 1, 100.00, '2023-11-01 08:30:00'), -- Ahmad dapat 100 di IPA
(4, 1, 66.67, '2023-11-01 08:35:00'),  -- Lani dapat 66.67 di IPA
(3, 2, 50.00, '2023-11-15 09:45:00'),  -- Ahmad dapat 50 di UTS MTK
(5, 2, 100.00, '2023-11-15 09:50:00'); -- Bambang dapat 100 di UTS MTK






-- 2. Membuat tabel jadwal pelajaran dengan format TIME
CREATE TABLE jadwal_pelajaran (
    id_jadwal INT PRIMARY KEY AUTO_INCREMENT,
    no_sesi INT NOT NULL,
    jam_mulai TIME NOT NULL,     -- Format: HH:MM:SS
    jam_selesai TIME NOT NULL,   -- Format: HH:MM:SS
    id_hari INT NOT NULL,
    mata_pelajaran VARCHAR(50)

);


-- 3. Memasukkan data jadwal pelajaran (Format waktu HH:MM:SS)
-- 3. Memasukkan data jadwal pelajaran tanpa duplikasi sesi (Format waktu HH:MM:SS)
INSERT INTO jadwal_pelajaran (jam_mulai, jam_selesai, id_hari, mata_pelajaran) VALUES
-- HARI 1 (SENIN)
('07:30:00', '09:15:00', 1, 'PJOK'),
('09:15:00', '09:30:00', 1, 'Istirahat'),
('09:30:00', '10:40:00', 1, 'Mulok'),
('10:40:00', '10:55:00', 1, 'Istirahat'),
('10:55:00', '11:30:00', 1, 'PJOK'),

-- HARI 2 (SELASA)
('07:00:00', '07:30:00', 2, 'Apel Pagi'),
('07:30:00', '09:15:00', 2, 'B. Indonesia'),
('09:15:00', '09:30:00', 2, 'Istirahat'),
('09:30:00', '10:05:00', 2, 'B. Indonesia'),
('10:05:00', '10:40:00', 2, 'B. Inggris'), -- Penulisan diseragamkan
('10:40:00', '10:55:00', 2, 'Istirahat'),
('10:55:00', '11:30:00', 2, 'Agama'),

-- HARI 3 (RABU)
('07:00:00', '07:30:00', 3, 'Apel Pagi'),
('07:30:00', '09:15:00', 3, 'B. Indonesia'),
('09:15:00', '09:30:00', 3, 'Istirahat'),
('09:30:00', '11:30:00', 3, 'PPKN'), -- Sesi 6, 7, dan 9 digabung karena terjeda istirahat saja

-- HARI 4 (KAMIS)
('07:00:00', '07:30:00', 4, 'Apel/Senam Pagi'),
('07:30:00', '09:15:00', 4, 'Matematika'),
('09:15:00', '09:30:00', 4, 'Istirahat'),
('09:30:00', '10:40:00', 4, 'Matematika'),
('10:40:00', '10:55:00', 4, 'Istirahat'),
('10:55:00', '11:30:00', 4, NULL),

-- HARI 5 (JUMAT)
('07:00:00', '07:30:00', 5, 'Jumat Bersih'),
('07:30:00', '09:15:00', 5, 'B. Inggris'),
('09:15:00', '09:30:00', 5, 'Istirahat'),
('09:30:00', '10:05:00', 5, 'B. Inggris'),
('10:05:00', '10:40:00', 5, NULL),
('10:40:00', '10:55:00', 5, 'Istirahat'),
('10:55:00', '11:30:00', 5, NULL),

-- HARI 6 (SABTU)
('07:00:00', '07:30:00', 6, 'Apel/Senam Pagi'),
('07:30:00', '09:15:00', 6, 'Agama'),
('09:15:00', '09:30:00', 6, 'Istirahat'),
('09:30:00', '10:40:00', 6, 'PPKN'),
('10:40:00', '10:55:00', 6, 'Istirahat'),
('10:55:00', '11:30:00', 6, NULL);