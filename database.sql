-- ========================================================
-- DATABASE SCHEMA & SAMPLE DATA UNTUK SISTEM E-LEARNING
-- Database: e_learn_db
-- Dibuat sesuai PRD (Entity Relationship Diagram)
-- ========================================================

CREATE DATABASE IF NOT EXISTS `e_learn_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `e_learn_db`;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `nilai`;
DROP TABLE IF EXISTS `jadwal`;
DROP TABLE IF EXISTS `siswa`;
DROP TABLE IF EXISTS `pelajaran`;
DROP TABLE IF EXISTS `guru`;
DROP TABLE IF EXISTS `kelas`;
DROP TABLE IF EXISTS `admin`;
SET FOREIGN_KEY_CHECKS = 1;

-- 1. Tabel admin
CREATE TABLE `admin` (
    `id_admin` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabel kelas
CREATE TABLE `kelas` (
    `id_kelas` INT AUTO_INCREMENT PRIMARY KEY,
    `nama` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tabel guru
CREATE TABLE `guru` (
    `id_guru` INT AUTO_INCREMENT PRIMARY KEY,
    `nip` VARCHAR(50) NOT NULL UNIQUE,
    `nama` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Tabel siswa
CREATE TABLE `siswa` (
    `id_siswa` INT AUTO_INCREMENT PRIMARY KEY,
    `nis` VARCHAR(50) NOT NULL UNIQUE,
    `nama` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `id_kelas` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_siswa_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Tabel pelajaran
CREATE TABLE `pelajaran` (
    `pelajaran_id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama_pelajaran` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Tabel jadwal
CREATE TABLE `jadwal` (
    `jadwal_id` INT AUTO_INCREMENT PRIMARY KEY,
    `hari` VARCHAR(20) NOT NULL,
    `jam` VARCHAR(20) NOT NULL,
    `menit` VARCHAR(20) DEFAULT '',
    `id_kelas` INT NOT NULL,
    `pelajaran_id` INT NOT NULL,
    `id_guru` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_jadwal_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_jadwal_pelajaran` FOREIGN KEY (`pelajaran_id`) REFERENCES `pelajaran` (`pelajaran_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_jadwal_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Tabel nilai
CREATE TABLE `nilai` (
    `nilai_id` INT AUTO_INCREMENT PRIMARY KEY,
    `nilai` DECIMAL(5,2) NOT NULL,
    `id_siswa` INT NOT NULL,
    `pelajaran_id` INT NOT NULL,
    `id_guru` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_nilai_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_nilai_pelajaran` FOREIGN KEY (`pelajaran_id`) REFERENCES `pelajaran` (`pelajaran_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_nilai_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default Dummy Password:
-- admin123 => $2y$10$wN1qG5z0URf45/4XkH89Ie7pCkgM7tL6eD3l8Vq3vXN2z5p8u9rWq
-- guru123  => $2y$10$7vN1...
-- (Semua akun dibuat menggunakan password_hash() standar PHP)

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2'),
(2, 'superadmin', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2');

INSERT INTO `kelas` (`id_kelas`, `nama`) VALUES
(1, 'X RPL 1'),
(2, 'X RPL 2'),
(3, 'XI RPL 1'),
(4, 'XI RPL 2'),
(5, 'XII RPL 1');

INSERT INTO `guru` (`id_guru`, `nip`, `nama`, `password`) VALUES
(1, '198501152010011001', 'Drs. Budi Santoso, M.Pd', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2'),
(2, '198803202012022002', 'Siti Aminah, S.Pd', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2'),
(3, '199005122015031003', 'Ahmad Fauzi, M.Kom', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2'),
(4, '199208242018042004', 'Dewi Lestari, S.Si', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2'),
(5, '199402112020011005', 'Rian Hidayat, S.Kom', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2');

INSERT INTO `pelajaran` (`pelajaran_id`, `nama_pelajaran`) VALUES
(1, 'Matematika'),
(2, 'Bahasa Indonesia'),
(3, 'Bahasa Inggris'),
(4, 'Pemrograman Web & Perangkat Bergerak'),
(5, 'Basis Data'),
(6, 'Pemodelan Perangkat Lunak'),
(7, 'Fisika Terapan');

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama`, `password`, `id_kelas`) VALUES
(1, '20241001', 'Muhammad Rizky Pratama', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2', 1),
(2, '20241002', 'Nabila Putri Cahyani', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2', 1),
(3, '20241003', 'Dimas Arya Pamungkas', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2', 1),
(4, '20241004', 'Aulia Zahra Salsabila', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2', 1),
(5, '20241005', 'Fajar Nur Hidayat', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2', 2),
(6, '20241006', 'Kevin Sanjaya Sukamuljo', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2', 2),
(7, '20241007', 'Tiara Andini Maharani', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2', 3),
(8, '20241008', 'Reza Rahardian Pratama', '$2y$10$n4OQ4nU4wN53bI9l7sR3jeiUaYw/W7h8qfM4V4eJgS2k4m0H1h4V2', 3);

INSERT INTO `jadwal` (`jadwal_id`, `hari`, `jam`, `menit`, `id_kelas`, `pelajaran_id`, `id_guru`) VALUES
(1, 'Senin', '07:30 - 09:00', '90 menit', 1, 1, 1),
(2, 'Senin', '09:15 - 11:30', '135 menit', 1, 4, 3),
(3, 'Selasa', '07:30 - 09:00', '90 menit', 1, 2, 2),
(4, 'Selasa', '09:15 - 11:30', '135 menit', 1, 5, 5),
(5, 'Rabu', '07:30 - 09:00', '90 menit', 1, 3, 2),
(6, 'Rabu', '09:15 - 10:45', '90 menit', 1, 7, 4),
(7, 'Kamis', '08:00 - 10:15', '135 menit', 1, 6, 3),
(8, 'Jumat', '07:30 - 09:00', '90 menit', 1, 1, 1),
(9, 'Senin', '07:30 - 09:00', '90 menit', 2, 2, 2),
(10, 'Senin', '09:15 - 11:30', '135 menit', 2, 1, 1),
(11, 'Selasa', '07:30 - 09:00', '90 menit', 2, 5, 5),
(12, 'Rabu', '07:30 - 09:00', '90 menit', 3, 4, 3);

INSERT INTO `nilai` (`nilai_id`, `nilai`, `id_siswa`, `pelajaran_id`, `id_guru`) VALUES
(1, 88.50, 1, 1, 1),
(2, 94.00, 1, 4, 3),
(3, 85.00, 1, 2, 2),
(4, 90.00, 1, 5, 5),
(5, 82.50, 1, 3, 2),
(6, 92.00, 2, 1, 1),
(7, 91.50, 2, 4, 3),
(8, 89.00, 2, 2, 2),
(9, 87.00, 2, 5, 5),
(10, 78.00, 3, 1, 1),
(11, 84.50, 3, 4, 3),
(12, 75.00, 3, 2, 2),
(13, 86.00, 4, 1, 1),
(14, 90.00, 4, 4, 3),
(15, 80.00, 5, 1, 1),
(16, 85.00, 5, 2, 2);
