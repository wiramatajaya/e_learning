<?php
/**
 * Model Siswa
 * Table: siswa (id_siswa, nis, nama, password, id_kelas)
 */

require_once __DIR__ . '/Database.php';

class Siswa {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $sql = "SELECT s.id_siswa, s.nis, s.nama, s.id_kelas, s.created_at, k.nama as nama_kelas
                FROM `siswa` s
                LEFT JOIN `kelas` k ON s.id_kelas = k.id_kelas
                ORDER BY k.nama ASC, s.nama ASC";
        return $this->db->fetchAll($sql);
    }

    public function getById(int $id): ?array {
        $sql = "SELECT s.id_siswa, s.nis, s.nama, s.id_kelas, s.created_at, k.nama as nama_kelas
                FROM `siswa` s
                LEFT JOIN `kelas` k ON s.id_kelas = k.id_kelas
                WHERE s.id_siswa = ?";
        return $this->db->fetch($sql, [$id]);
    }

    public function getByNis(string $nis): ?array {
        $sql = "SELECT s.*, k.nama as nama_kelas
                FROM `siswa` s
                LEFT JOIN `kelas` k ON s.id_kelas = k.id_kelas
                WHERE s.nis = ?";
        return $this->db->fetch($sql, [$nis]);
    }

    public function getByKelasId(int $id_kelas): array {
        $sql = "SELECT s.id_siswa, s.nis, s.nama, s.id_kelas, k.nama as nama_kelas
                FROM `siswa` s
                LEFT JOIN `kelas` k ON s.id_kelas = k.id_kelas
                WHERE s.id_kelas = ?
                ORDER BY s.nama ASC";
        return $this->db->fetchAll($sql, [$id_kelas]);
    }

    public function create(string $nis, string $nama, string $password, int $id_kelas): bool {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        return $this->db->execute(
            "INSERT INTO `siswa` (`nis`, `nama`, `password`, `id_kelas`) VALUES (?, ?, ?, ?)",
            [$nis, $nama, $hashed, $id_kelas]
        );
    }

    public function update(int $id, string $nis, string $nama, int $id_kelas, ?string $password = null): bool {
        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            return $this->db->execute(
                "UPDATE `siswa` SET `nis` = ?, `nama` = ?, `id_kelas` = ?, `password` = ? WHERE `id_siswa` = ?",
                [$nis, $nama, $id_kelas, $hashed, $id]
            );
        }
        return $this->db->execute(
            "UPDATE `siswa` SET `nis` = ?, `nama` = ?, `id_kelas` = ? WHERE `id_siswa` = ?",
            [$nis, $nama, $id_kelas, $id]
        );
    }

    public function delete(int $id): bool {
        return $this->db->execute("DELETE FROM `siswa` WHERE `id_siswa` = ?", [$id]);
    }

    public function count(): int {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM `siswa`");
        return (int)($res['total'] ?? 0);
    }
}
