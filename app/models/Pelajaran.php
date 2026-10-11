<?php
/**
 * Model Pelajaran
 * Table: pelajaran (pelajaran_id, nama_pelajaran)
 */

require_once __DIR__ . '/Database.php';

class Pelajaran {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        return $this->db->fetchAll("SELECT * FROM `pelajaran` ORDER BY `nama_pelajaran` ASC");
    }

    public function getAllWithStats(): array {
        $sql = "SELECT p.pelajaran_id, p.nama_pelajaran, p.created_at,
                       COUNT(DISTINCT j.id_guru) as total_guru,
                       COUNT(DISTINCT j.id_kelas) as total_kelas,
                       COUNT(DISTINCT n.nilai_id) as total_nilai
                FROM `pelajaran` p
                LEFT JOIN `jadwal` j ON p.pelajaran_id = j.pelajaran_id
                LEFT JOIN `nilai` n ON p.pelajaran_id = n.pelajaran_id
                GROUP BY p.pelajaran_id, p.nama_pelajaran, p.created_at
                ORDER BY p.nama_pelajaran ASC";
        return $this->db->fetchAll($sql);
    }

    public function getById(int $id): ?array {
        return $this->db->fetch("SELECT * FROM `pelajaran` WHERE `pelajaran_id` = ?", [$id]);
    }

    public function create(string $nama_pelajaran): bool {
        return $this->db->execute("INSERT INTO `pelajaran` (`nama_pelajaran`) VALUES (?)", [$nama_pelajaran]);
    }

    public function update(int $id, string $nama_pelajaran): bool {
        return $this->db->execute("UPDATE `pelajaran` SET `nama_pelajaran` = ? WHERE `pelajaran_id` = ?", [$nama_pelajaran, $id]);
    }

    public function delete(int $id): bool {
        return $this->db->execute("DELETE FROM `pelajaran` WHERE `pelajaran_id` = ?", [$id]);
    }

    public function count(): int {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM `pelajaran`");
        return (int)($res['total'] ?? 0);
    }
}
