<?php
/**
 * Model Kelas
 * Table: kelas (id_kelas, nama)
 */

require_once __DIR__ . '/Database.php';

class Kelas {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        return $this->db->fetchAll("SELECT * FROM `kelas` ORDER BY nama ASC");
    }

    public function getAllWithStats(): array {
        $sql = "SELECT k.id_kelas, k.nama, k.created_at, 
                       COUNT(DISTINCT s.id_siswa) AS total_siswa,
                       COUNT(DISTINCT j.jadwal_id) AS total_jadwal
                FROM `kelas` k
                LEFT JOIN `siswa` s ON k.id_kelas = s.id_kelas
                LEFT JOIN `jadwal` j ON k.id_kelas = j.id_kelas
                GROUP BY k.id_kelas, k.nama, k.created_at
                ORDER BY k.nama ASC";
        return $this->db->fetchAll($sql);
    }

    public function getById(int $id): ?array {
        return $this->db->fetch("SELECT * FROM `kelas` WHERE id_kelas = ?", [$id]);
    }

    public function create(string $nama): bool {
        return $this->db->execute("INSERT INTO `kelas` (nama) VALUES (?)", [$nama]);
    }

    public function update(int $id, string $nama): bool {
        return $this->db->execute("UPDATE `kelas` SET nama = ? WHERE id_kelas = ?", [$nama, $id]);
    }

    public function delete(int $id): bool {
        return $this->db->execute("DELETE FROM `kelas` WHERE id_kelas = ?", [$id]);
    }

    public function count(): int {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM `kelas`");
        return (int)($res['total'] ?? 0);
    }
}
