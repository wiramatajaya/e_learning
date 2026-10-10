
CREATE TABLE `bank_soal` (
  `id_soal` int(11) NOT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `pertanyaan` text DEFAULT NULL,
  `opsi_a` text DEFAULT NULL,
  `opsi_b` text DEFAULT NULL,
  `opsi_c` text DEFAULT NULL,
  `opsi_d` text DEFAULT NULL,
  `jawaban_benar` enum('A','B','C','D') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `bank_soal`
INSERT INTO `bank_soal` (`id_soal`, `id_ujian`, `pertanyaan`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `jawaban_benar`) VALUES
(7, 3, 'Saat kita menekuk lengan, otot bisep mengalami kontraksi sehingga memendek, sedangkan otot trisep mengalami relaksasi. Sifat kerja sepasang otot yang saling berlawanan ini disebut...', 'Sinergis', 'Antagonis', 'Otomatis', 'Asimetris', 'B'),
(8, 3, 'Kelainan tulang belakang di mana tulang melengkung ke arah samping sehingga membentuk huruf \"S\" disebut...', 'Lordosis', 'Kifosis', 'Skoliosis', 'Osteoporosis', 'C'),
(9, 4, 'Tokoh golongan muda yang mengusulkan agar teks Proklamasi Kemerdekaan Indonesia cukup ditandatangani oleh Ir. Soekarno dan Drs. Mohammad Hatta atas nama bangsa Indonesia adalah...', 'Sukarni', 'Sayuti Melik', 'Wikana', 'Ahmad Soebardjo', 'A'),
(10, 4, 'Apa latar belakang utama yang mendorong bangsa-bangsa Eropa seperti Portugis dan Belanda datang ke Nusantara pada abad ke-16?', 'Membantu kerajaan lokal berperang', 'Menyebarkan teknologi modern', 'Menguasai perdagangan rempah-rempah', 'Mengajarkan bahasa asing', 'C'),
(11, 5, 'Benua terkecil di dunia yang juga merupakan sebuah negara, serta terkenal dengan hewan endemik seperti kanguru dan koala adalah...', 'Benua Eropa', 'Benua Afrika', 'Benua Australia', 'Benua Asia', 'C'),
(12, 5, 'Penduduk di daerah Gurun Sahara (Afrika) cenderung mengenakan pakaian longgar dan penutup kepala yang rapat. Kondisi alam yang mendasari adaptasi budaya tersebut adalah...', 'Suhu udara dingin dan sering turun salju', 'Suhu sangat panas, gersang, dan sering terjadi badai pasir', 'Curah hujan tinggi dan lingkungan lembap', 'Wilayah subur yang dipenuhi hutan belantara', 'B'),
(13, 1, 'ASEAN didirikan pada tanggal 8 Agustus 1967 di Bangkok. Tokoh perwakilan dari Indonesia yang ikut menandatangani Deklarasi Bangkok adalah...', 'Tun Abdul Razak', 'Adam Malik', 'Narciso Ramos', 'S. Rajaratnam', 'B'),
(14, 1, 'Masuknya makanan cepat saji global (fast food) dan tren musik luar negeri ke Indonesia merupakan salah satu dampak dari fenomena globalisasi di bidang...', 'Ekonomi', 'Politik', 'Hankam', 'Budaya', 'D'),
(15, 1, 'Perputaran Bumi pada porosnya mengakibatkan terjadinya beberapa fenomena alam. Salah satu akibat dari rotasi Bumi adalah...', 'Pergantian musim di belahan Bumi utara dan selatan', 'Perubahan lamanya waktu siang dan malam dalam setahun', 'Terjadinya perbedaan waktu di berbagai wilayah Bumi', 'Terlihatnya rasi bintang yang berbeda setiap bulan', 'C'),
(16, 1, 'Ketika posisi Bulan berada di antara Matahari dan Bumi dalam satu garis lurus, sehingga cahaya Matahari ke Bumi terhalang oleh Bulan, maka terjadi fenomena...', 'Gerhana Matahari', 'Gerhana Bulan Total', 'Pasang surut air laut minimum', 'Meteor jatuh', 'A'),
(17, 1, 'Minyak bumi dan batu bara dikategorikan sebagai sumber energi yang tidak terbarukan karena...', 'Jumlahnya di alam sangat melimpah dan tidak pernah habis', 'Membutuhkan waktu jutaan tahun untuk terbentuk kembali jika habis', 'Proses pengolahannya tidak menghasilkan polusi udara sama sekali', 'Dapat dibuat secara instan di laboratorium modern', 'B'),
(18, 1, 'Pembangkit listrik yang memanfaatkan energi panas yang berasal dari dalam perut bumi untuk memutar turbin disebut Pembangkit Listrik Tenaga...', 'Surya (PLTS)', 'Bayu/Angin (PLTB)', 'Panas Bumi / Geothermal (PLTP)', 'Mikrohidro (PLTMH)', 'C'),
(19, 1, 'Gas-gas pencemar seperti karbon dioksida (CO2) yang menumpuk di atmosfer dapat memerangkap panas matahari di permukaan bumi. Fenomena ini memicu terjadinya...', 'Gempa tektonik', 'Pemanasan global (global warming)', 'Tsunami', 'Erosi tanah', 'B'),
(20, 1, 'Tindakan mengolah kembali barang bekas atau sampah plastik menjadi produk baru yang memiliki nilai guna disebut dengan prinsip...', 'Reduce', 'Reuse', 'Recycle', 'Reboisasi', 'C'),
(21, 1, 'Dalam melakukan penelitian sederhana mengenai masalah sampah di lingkungan sekolah, langkah pertama yang harus dilakukan oleh seorang siswa adalah...', 'Menulis laporan akhir penelitian', 'Merumuskan solusi dan melakukan presentasi', 'Menentukan topik atau masalah yang akan diamati', 'Mengumpulkan dana untuk membeli peralatan bazzar', 'C');


CREATE TABLE `jadwal_pelajaran` (
  `id_jadwal` int(11) NOT NULL,
  `no_sesi` int(11) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `id_hari` int(11) NOT NULL,
  `mata_pelajaran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `jadwal_pelajaran` (`id_jadwal`, `no_sesi`, `jam_mulai`, `jam_selesai`, `id_hari`, `mata_pelajaran`) VALUES
(197, 0, '07:30:00', '09:15:00', 1, 'PJOK'),
(198, 0, '09:30:00', '10:40:00', 1, 'Mulok'),
(199, 0, '10:55:00', '11:30:00', 1, 'PJOK'),
(200, 0, '07:30:00', '10:05:00', 2, 'B. Indonesia'),
(201, 0, '10:05:00', '10:40:00', 2, 'B. Inggris'),
(202, 0, '10:55:00', '11:30:00', 2, 'Agama'),
(203, 0, '07:30:00', '09:15:00', 3, 'B. Indonesia'),
(204, 0, '09:30:00', '11:30:00', 3, 'PPKN'),
(205, 0, '07:30:00', '10:40:00', 4, 'Matematika'),
(206, 0, '07:30:00', '10:05:00', 5, 'B. Inggris'),
(207, 0, '07:30:00', '09:15:00', 6, 'Agama'),
(208, 0, '09:30:00', '10:40:00', 6, 'PPKN');


CREATE TABLE `jawaban_siswa` (
  `id_jawaban` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `jawaban` char(1) DEFAULT NULL,
  `status` enum('benar','salah') DEFAULT NULL,
  `file_tugas` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`, `deskripsi`) VALUES
(1, 'IPA', 'Mata pelajaran yang mempelajari gejala alam, makhluk hidup, lingkungan, dan materi sains kelas 6.'),
(2, 'Matematika', 'Mata pelajaran yang mengasah logika lewat materi pecahan, lingkaran, bangun ruang, dan pengolahan data kelas 6.'),
(3, 'Bahasa Indonesia', 'Mata pelajaran yang fokus pada kemampuan berbahasa, membaca teks, membuat laporan, dan pidato kelas 6.'),
(4, 'PPKN', 'Mata pelajaran yang menanamkan nilai Pancasila, persatuan, hak, kewajiban, dan tanggung jawab warga negara.'),
(5, 'IPS', 'Mata pelajaran yang membahas sejarah kemerdekaan Indonesia, kondisi geografis ASEAN, dan kegiatan ekonomi.'),
(6, 'B Inggris', 'Mata pelajaran bahasa asing untuk menguasai kosakata dasar, percakapan sederhana, dan tata bahasa kelas 6.'),
(7, 'Agama', 'Mata pelajaran yang mendalami ajaran agama, akhlak mulia, bimbingan ibadah, dan toleransi antarumat.'),
(8, 'PJOK', 'Mata pelajaran yang melatih kebugaran jasmani, teknik dasar olahraga, dan pola hidup sehat kelas 6.');

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `materi` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `materi` (`id_materi`, `judul`, `materi`, `file_path`, `id_mapel`, `id_guru`, `gambar`) VALUES
(2, 'Penjumlahan Pecahan', 'Cara menjumlahkan penyebut berbeda...', 'mtk_pecahan.mp4', 2, 1, '0'),
(3, 'Puisi Rakyat', 'Mengenal pantun dan syair...', 'indo_puisi.pdf', 3, 2, '0'),
(5, 'Volume Bangun Ruang', 'Rumus menghitung volume kubus, balok, dan tabung...', 'mtk_volume.mp4', 2, 1, '0'),
(6, 'Formulir Pendaftaran', 'Cara mengisi formulir teks pendaftaran dengan benar...', 'indo_formulir.pdf', 3, 2, '0'),
(7, 'Nilai-Nilai Pancasila', 'Penerapan sila Pancasila dalam kehidupan sehari-hari...', 'ppkn_pancasila.pdf', 4, 1, '0'),
(8, 'Peristiwa Proklamasi', 'Sejarah singkat seputar proklamasi kemerdekaan RI...', 'ips_proklamasi.pdf', 5, 2, '0'),
(9, 'Globalisasi', 'Dampak positif dan negatif globalisasi bagi Indonesia...', 'ips_globalisasi.mp4', 5, 2, '0'),
(10, 'Offering Help', 'Ungkapan menawarkan bantuan dalam bahasa Inggris...', 'bing_offering.pdf', 6, 1, '0'),
(11, 'Kisah Keteladanan Nabi', 'Meneladani sifat jujur dan amanah para Nabi...', 'agama_nabi.pdf', 7, 2, '0'),
(12, 'Kebugaran Jasmani', 'Latihan fisik untuk menjaga kelenturan dan kekuatan...', 'pjok_bugar.mp4', 8, 1, '0'),
(19, 'BAB 1 : Pelesir Keliling Dunia', 'Sub-materi 1: Enam Benua di Dunia  Mengidentifikasi karakteristik utama, iklim, dan keunikan dari Benua Asia, Afrika, Amerika Utara, Amerika Selatan, Eropa, dan Australia.\r\nSub-materi 2: Kondisi Geografis dan Budaya  Mempelajari bagaimana bentang alam (seperti gunung, sungai, dan gurun) memengaruhi cara hidup, pakaian, makanan, dan budaya masyarakat di berbagai negara.', NULL, 1, NULL, '0'),
(20, 'BAB 2 :Indonesia dan Masyarakat Dunia', 'Sub-materi 1: Indonesia di Kawasan Asia Tenggara – Mempelajari peran penting Indonesia dalam mendirikan dan menjalankan organisasi ASEAN (Association of Southeast Asian Nations).\r\nSub-materi 2: Kerja Sama Internasional – Mengenal bentuk kerja sama bilateral (dua negara) dan multilateral (banyak negara), seperti PBB, dalam bidang ekonomi, pendidikan, dan budaya.\r\nSub-materi 3: Pengaruh Globalisasi – Memahami dampak positif dan negatif globalisasi terhadap budaya lokal, teknologi informasi, dan gaya hidup masyarakat.', 'bab4ipa.p', 1, NULL, '0'),
(21, 'BAB 3 :Menjelajahi Bumi dan Antariksa', 'Sub-materi 1: Rotasi dan Revolusi Bumi – Memahami dampak perputaran Bumi pada porosnya (terjadinya siang-malam) dan perputaran Bumi mengelilingi Matahari (perubahan musim).\r\nSub-materi 2: Sistem Tata Surya – Mengenal karakteristik Matahari sebagai pusat tata surya, 8 planet utama, asteroid, meteoroid, dan komet.\r\nSub-materi 3: Gerhana Bulan dan Matahari – Mempelajari posisi Bumi, Bulan, dan Matahari saat terjadi gerhana serta dampaknya seperti pasang surut air laut.', NULL, 1, NULL, '0'),
(22, 'BAB 4 : Gawat! Benarkah Energi di Bumi akan Habis?', 'Sub-materi 1: Energi Fosil dan Dampaknya – Memahami proses terbentuknya minyak bumi dan batu bara serta dampak negatif penggunaannya terhadap polusi udara.Sub-materi 2: Energi Terbarukan – Mengeksplorasi sumber energi alternatif yang ramah lingkungan, seperti energi surya (matahari), angin, air, dan panas bumi (geothermal).Sub-materi 3: Upaya Penghematan Energi – Mengidentifikasi tindakan nyata dalam kehidupan sehari-hari untuk mengurangi pemborosan listrik dan bahan bakar.', NULL, 1, NULL, '0'),
(23, 'BAB 5 : Bumi Kita Terancam Bahaya', 'Sub-materi 1: Kerusakan Lingkungan – Mempelajari penyebab banjir, tanah longsor, pencemaran air, dan penggundulan hutan akibat ulah manusia.Sub-materi 2: Pemanasan Global (Global Warming) – Memahami efek rumah kaca, mencairnya es di kutub, dan perubahan iklim ekstrem yang melanda bumi.Sub-materi 3: Aksi Menyelamatkan Bumi – Menerapkan konsep Reduce, Reuse, Recycle (3R), penanaman pohon (reboisasi), dan menjaga kebersihan lingkungan.', NULL, 1, NULL, '0'),
(24, 'Proyek Akhir IPAS', 'Sub-materi: Penelitian Sederhana – Siswa diajak untuk memilih satu masalah lingkungan atau sosial di sekitar sekolah/rumah, melakukan pengamatan, merancang solusi kreatif, dan mempresentasikannya di depan kelas.', NULL, 1, NULL, '0'),
(25, 'BAB 1 : Pelesir Keliling Dunia', 'Sub-materi 1: Enam Benua di Dunia  Mengidentifikasi karakteristik utama, iklim, dan keunikan dari Benua Asia, Afrika, Amerika Utara, Amerika Selatan, Eropa, dan Australia.\r\nSub-materi 2: Kondisi Geografis dan Budaya  Mempelajari bagaimana bentang alam (seperti gunung, sungai, dan gurun) memengaruhi cara hidup, pakaian, makanan, dan budaya masyarakat di berbagai negara.', NULL, 1, NULL, '0');

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `skor` decimal(5,2) DEFAULT NULL,
  `waktu_selesai` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_user`, `id_ujian`, `skor`, `waktu_selesai`) VALUES
(1, 3, 1, 100.00, '2023-11-01 01:30:00'),
(2, 4, 1, 66.67, '2023-11-01 01:35:00'),
(3, 3, 2, 50.00, '2023-11-15 02:45:00'),
(4, 5, 2, 100.00, '2023-11-15 02:50:00'),
(5, 4, 1, 25.00, '2026-05-27 11:49:20'),
(6, 38, 1, 75.00, '2026-05-27 11:50:00');


CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL,
  `judul_ujian` varchar(100) DEFAULT NULL,
  `jenis_ujian` varchar(4) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `tgl_pelaksanaan` datetime DEFAULT NULL,
  `tgl_pengumpulan` date NOT NULL DEFAULT current_timestamp(),
  `wktu_pengerjaan` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ujian` (`judul_ujian`, `jenis_ujian`, `id_mapel`, `tgl_pelaksanaan`, `tgl_pengumpulan`, `wktu_pengerjaan`) VALUES
( 'UH 1 Matematika', 'UH', 1, '2026-03-01 08:00:00', '2026-08-01', '01:00:00'),
( 'UTS Matematika', 'UTS', 2, '2023-11-15 09:00:00', '2026-010-01', '01:00:00'),
( 'LATIHAN BAB 1 Matematika', 'L', 1, '2026-05-30 15:18:38', '2026-09-08', '01:00:00'),
( 'LATIHAN BAB 2 Matematika', 'L', 1, '2026-05-30 15:18:38', '2026-11-02', '15:14:51'),
( 'LATIHAN BAB 3 Matematika', 'L', 1, '2026-05-30 15:18:38', '2026-12-20', '15:14:51'),
( 'tugas harian ', 'L', 1, '2026-07-20 17:30:28', '2026-07-28', '01:30:28');


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_induk` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('guru','siswa') DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
INSERT INTO `users` (`id_user`, `nama`, `no_induk`, `password`, `role`, `kelas_id`) VALUES
(1, 'Budi Santoso, S.Pd', '2010641001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'guru', NULL),
(2, 'Siti Aminah, S.Pd', '2410651002', '123', 'guru', NULL),
(3, 'Ahmad Fauzan', '321', '123', 'siswa', 4),
(4, 'Lani Cahyani', '2410651004', '123', 'siswa', 4),
(5, 'Lani Cahyani', '2410651005', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', 4),
(6, 'Bambang Pamungkas', '2410651006', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', 5),
(7, 'Dian Wijaya', '2410651007', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
(8, 'Rizky Pratama', '2410651008', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
(9, 'Siti Nurhaliza', '2410651009', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
(10, 'Aditya Nugraha', '2410651010', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
(11, 'Amalia Putri', '2410651011', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
(12, 'Dimas Setiawan', '2410651012', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
(13, 'Fitri Handayani', '2410651013', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
(14, 'Gilang Permana', '2410651014', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
(15, 'Indah Lestari', '2410651015', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
(16, 'Kevin Sanjaya', '2410651016', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4...', 'siswa', 6),
(35, 'admin', '123', '123', 'guru', NULL),
(37, 'admin', 'admin', '123', 'guru', NULL),
(38, 'siswa', 'siswa', '123', 'siswa', NULL);

-- Indexes for table `bank_soal`
ALTER TABLE `bank_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_ujian` (`id_ujian`);

-- Indexes for table `jadwal_pelajaran`
ALTER TABLE `jadwal_pelajaran`
  ADD PRIMARY KEY (`id_jadwal`);

-- Indexes for table `jawaban_siswa`
ALTER TABLE `jawaban_siswa`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_soal` (`id_soal`) USING BTREE;

-- Indexes for table `mapel`
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

-- Indexes for table `materi`
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_guru` (`id_guru`);

-- Indexes for table `nilai`
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_siswa` (`id_user`),
  ADD KEY `id_ujian` (`id_ujian`);

-- Indexes for table `ujian`
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `id_mapel` (`id_mapel`);

-- Indexes for table `users`
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `no_induk` (`no_induk`);

-- AUTO_INCREMENT for table `bank_soal`
ALTER TABLE `bank_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

-- AUTO_INCREMENT for table `jadwal_pelajaran`
ALTER TABLE `jadwal_pelajaran`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

-- AUTO_INCREMENT for table `jawaban_siswa`
ALTER TABLE `jawaban_siswa`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

-- AUTO_INCREMENT for table `mapel`
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

-- AUTO_INCREMENT for table `materi`
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

-- AUTO_INCREMENT for table `nilai`
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

-- AUTO_INCREMENT for table `ujian`
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

-- AUTO_INCREMENT for table `users`
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

-- Constraints for table `bank_soal`
ALTER TABLE `bank_soal`
  ADD CONSTRAINT `bank_soal_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`);

-- Constraints for table `jawaban_siswa`
ALTER TABLE `jawaban_siswa`
  ADD CONSTRAINT `jawaban_siswa_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `bank_soal` (`id_soal`),
  ADD CONSTRAINT `jawaban_siswa_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

-- Constraints for table `materi`
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  ADD CONSTRAINT `materi_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `users` (`id_user`);

-- Constraints for table `nilai`
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`);


-- Constraints for table `ujian`
ALTER TABLE `ujian`
  ADD CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`);
COMMIT;
