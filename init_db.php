<?php
/**
 * Database Migration & Seeder Script
 * Execute via CLI: php init_db.php
 */

$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbname = 'e_learn_db';

try {
    // 1. Connect without db to ensure database exists
    $pdo = new PDO("mysql:host={$host};charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `{$dbname}`");

    echo "[1/4] Database `{$dbname}` ready.\n";

    // 2. Create tables
    $schema = "
    CREATE TABLE IF NOT EXISTS `admin` (
        `id_admin` INT AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(50) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    CREATE TABLE IF NOT EXISTS `kelas` (
        `id_kelas` INT AUTO_INCREMENT PRIMARY KEY,
        `nama` VARCHAR(50) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    CREATE TABLE IF NOT EXISTS `guru` (
        `id_guru` INT AUTO_INCREMENT PRIMARY KEY,
        `nip` VARCHAR(50) NOT NULL UNIQUE,
        `nama` VARCHAR(100) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    CREATE TABLE IF NOT EXISTS `siswa` (
        `id_siswa` INT AUTO_INCREMENT PRIMARY KEY,
        `nis` VARCHAR(50) NOT NULL UNIQUE,
        `nama` VARCHAR(100) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `id_kelas` INT NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT `fk_siswa_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    CREATE TABLE IF NOT EXISTS `pelajaran` (
        `pelajaran_id` INT AUTO_INCREMENT PRIMARY KEY,
        `nama_pelajaran` VARCHAR(100) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    CREATE TABLE IF NOT EXISTS `jadwal` (
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

    CREATE TABLE IF NOT EXISTS `nilai` (
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
    ";

    $pdo->exec($schema);
    echo "[2/4] Tables created successfully.\n";

    // 3. Clear and re-seed clean sample data
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $pdo->exec("TRUNCATE TABLE `nilai`;");
    $pdo->exec("TRUNCATE TABLE `jadwal`;");
    $pdo->exec("TRUNCATE TABLE `siswa`;");
    $pdo->exec("TRUNCATE TABLE `pelajaran`;");
    $pdo->exec("TRUNCATE TABLE `guru`;");
    $pdo->exec("TRUNCATE TABLE `kelas`;");
    $pdo->exec("TRUNCATE TABLE `admin`;");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

    // Hashes
    $adminPass = password_hash('admin123', PASSWORD_BCRYPT);
    $guruPass  = password_hash('guru123', PASSWORD_BCRYPT);
    $siswaPass = password_hash('siswa123', PASSWORD_BCRYPT);

    // Seed Admin
    $stmtAdmin = $pdo->prepare("INSERT INTO `admin` (`username`, `password`) VALUES (?, ?)");
    $stmtAdmin->execute(['admin', $adminPass]);
    $stmtAdmin->execute(['superadmin', $adminPass]);

    // Seed Kelas
    $stmtKelas = $pdo->prepare("INSERT INTO `kelas` (`nama`) VALUES (?)");
    $classes = ['X RPL 1', 'X RPL 2', 'XI RPL 1', 'XI RPL 2', 'XII RPL 1'];
    $kelasIds = [];
    foreach ($classes as $c) {
        $stmtKelas->execute([$c]);
        $kelasIds[$c] = $pdo->lastInsertId();
    }

    // Seed Guru
    $stmtGuru = $pdo->prepare("INSERT INTO `guru` (`nip`, `nama`, `password`) VALUES (?, ?, ?)");
    $teachers = [
        ['198501152010011001', 'Drs. Budi Santoso, M.Pd', $guruPass],
        ['198803202012022002', 'Siti Aminah, S.Pd', $guruPass],
        ['199005122015031003', 'Ahmad Fauzi, M.Kom', $guruPass],
        ['199208242018042004', 'Dewi Lestari, S.Si', $guruPass],
        ['199402112020011005', 'Rian Hidayat, S.Kom', $guruPass],
    ];
    $guruIds = [];
    foreach ($teachers as $idx => $t) {
        $stmtGuru->execute($t);
        $guruIds[$idx] = $pdo->lastInsertId();
    }

    // Seed Pelajaran
    $stmtPel = $pdo->prepare("INSERT INTO `pelajaran` (`nama_pelajaran`) VALUES (?)");
    $subjects = [
        'Matematika',
        'Bahasa Indonesia',
        'Bahasa Inggris',
        'Pemrograman Web & Perangkat Bergerak',
        'Basis Data',
        'Pemodelan Perangkat Lunak',
        'Fisika Terapan'
    ];
    $pelajaranIds = [];
    foreach ($subjects as $s) {
        $stmtPel->execute([$s]);
        $pelajaranIds[$s] = $pdo->lastInsertId();
    }

    // Seed Siswa
    $stmtSiswa = $pdo->prepare("INSERT INTO `siswa` (`nis`, `nama`, `password`, `id_kelas`) VALUES (?, ?, ?, ?)");
    $students = [
        ['20241001', 'Muhammad Rizky Pratama', $siswaPass, $kelasIds['X RPL 1']],
        ['20241002', 'Nabila Putri Cahyani', $siswaPass, $kelasIds['X RPL 1']],
        ['20241003', 'Dimas Arya Pamungkas', $siswaPass, $kelasIds['X RPL 1']],
        ['20241004', 'Aulia Zahra Salsabila', $siswaPass, $kelasIds['X RPL 1']],
        ['20241005', 'Fajar Nur Hidayat', $siswaPass, $kelasIds['X RPL 2']],
        ['20241006', 'Kevin Sanjaya Sukamuljo', $siswaPass, $kelasIds['X RPL 2']],
        ['20241007', 'Tiara Andini Maharani', $siswaPass, $kelasIds['XI RPL 1']],
        ['20241008', 'Reza Rahardian Pratama', $siswaPass, $kelasIds['XI RPL 1']],
    ];
    $siswaIds = [];
    foreach ($students as $idx => $st) {
        $stmtSiswa->execute($st);
        $siswaIds[$idx] = $pdo->lastInsertId();
    }

    // Seed Jadwal
    $stmtJadwal = $pdo->prepare("INSERT INTO `jadwal` (`hari`, `jam`, `menit`, `id_kelas`, `pelajaran_id`, `id_guru`) VALUES (?, ?, ?, ?, ?, ?)");
    $schedules = [
        ['Senin', '07:30 - 09:00', '90 menit', $kelasIds['X RPL 1'], $pelajaranIds['Matematika'], $guruIds[0]],
        ['Senin', '09:15 - 11:30', '135 menit', $kelasIds['X RPL 1'], $pelajaranIds['Pemrograman Web & Perangkat Bergerak'], $guruIds[2]],
        ['Selasa', '07:30 - 09:00', '90 menit', $kelasIds['X RPL 1'], $pelajaranIds['Bahasa Indonesia'], $guruIds[1]],
        ['Selasa', '09:15 - 11:30', '135 menit', $kelasIds['X RPL 1'], $pelajaranIds['Basis Data'], $guruIds[4]],
        ['Rabu', '07:30 - 09:00', '90 menit', $kelasIds['X RPL 1'], $pelajaranIds['Bahasa Inggris'], $guruIds[1]],
        ['Rabu', '09:15 - 10:45', '90 menit', $kelasIds['X RPL 1'], $pelajaranIds['Fisika Terapan'], $guruIds[3]],
        ['Kamis', '08:00 - 10:15', '135 menit', $kelasIds['X RPL 1'], $pelajaranIds['Pemodelan Perangkat Lunak'], $guruIds[2]],
        ['Jumat', '07:30 - 09:00', '90 menit', $kelasIds['X RPL 1'], $pelajaranIds['Matematika'], $guruIds[0]],
        
        // Jadwal kelas lain
        ['Senin', '07:30 - 09:00', '90 menit', $kelasIds['X RPL 2'], $pelajaranIds['Bahasa Indonesia'], $guruIds[1]],
        ['Senin', '09:15 - 11:30', '135 menit', $kelasIds['X RPL 2'], $pelajaranIds['Matematika'], $guruIds[0]],
        ['Selasa', '07:30 - 09:00', '90 menit', $kelasIds['X RPL 2'], $pelajaranIds['Basis Data'], $guruIds[4]],
        ['Rabu', '07:30 - 09:00', '90 menit', $kelasIds['XI RPL 1'], $pelajaranIds['Pemrograman Web & Perangkat Bergerak'], $guruIds[2]],
    ];
    foreach ($schedules as $j) {
        $stmtJadwal->execute($j);
    }

    // Seed Nilai
    $stmtNilai = $pdo->prepare("INSERT INTO `nilai` (`nilai`, `id_siswa`, `pelajaran_id`, `id_guru`) VALUES (?, ?, ?, ?)");
    $grades = [
        [88.50, $siswaIds[0], $pelajaranIds['Matematika'], $guruIds[0]],
        [94.00, $siswaIds[0], $pelajaranIds['Pemrograman Web & Perangkat Bergerak'], $guruIds[2]],
        [85.00, $siswaIds[0], $pelajaranIds['Bahasa Indonesia'], $guruIds[1]],
        [90.00, $siswaIds[0], $pelajaranIds['Basis Data'], $guruIds[4]],
        [82.50, $siswaIds[0], $pelajaranIds['Bahasa Inggris'], $guruIds[1]],

        [92.00, $siswaIds[1], $pelajaranIds['Matematika'], $guruIds[0]],
        [91.50, $siswaIds[1], $pelajaranIds['Pemrograman Web & Perangkat Bergerak'], $guruIds[2]],
        [89.00, $siswaIds[1], $pelajaranIds['Bahasa Indonesia'], $guruIds[1]],
        [87.00, $siswaIds[1], $pelajaranIds['Basis Data'], $guruIds[4]],

        [78.00, $siswaIds[2], $pelajaranIds['Matematika'], $guruIds[0]],
        [84.50, $siswaIds[2], $pelajaranIds['Pemrograman Web & Perangkat Bergerak'], $guruIds[2]],
        [75.00, $siswaIds[2], $pelajaranIds['Bahasa Indonesia'], $guruIds[1]],

        [86.00, $siswaIds[3], $pelajaranIds['Matematika'], $guruIds[0]],
        [90.00, $siswaIds[3], $pelajaranIds['Pemrograman Web & Perangkat Bergerak'], $guruIds[2]],

        [80.00, $siswaIds[4], $pelajaranIds['Matematika'], $guruIds[0]],
        [85.00, $siswaIds[4], $pelajaranIds['Bahasa Indonesia'], $guruIds[1]],
    ];
    foreach ($grades as $g) {
        $stmtNilai->execute($g);
    }

    echo "[3/4] Seed data inserted successfully.\n";
    echo "[4/4] Done! Default login credentials:\n";
    echo "      Admin: admin / admin123\n";
    echo "      Guru: 198501152010011001 / guru123 (Drs. Budi Santoso, M.Pd)\n";
    echo "      Guru: 199005122015031003 / guru123 (Ahmad Fauzi, M.Kom)\n";
    echo "      Siswa: 20241001 / siswa123 (Muhammad Rizky Pratama)\n";

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage() . "\n");
}
