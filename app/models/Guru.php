<?php
/**
 * Model Guru
 * Table: guru (id_guru, nip, nama, password)
 */

require_once __DIR__ . '/Database.php';

class Guru {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        return $this->db->fetchAll("SELECT id_guru, nip, nama, created_at FROM `guru` ORDER BY nama ASC");
    }

    public function getAllWithStats(): array {
        $sql = "SELECT g.id_guru, g.nip, g.nama, g.created_at,
                       COUNT(DISTINCT j.id_kelas) as total_kelas,
                       COUNT(DISTINCT j.pelajaran_id) as total_mapel,
                       COUNT(DISTINCT n.nilai_id) as total_nilai_diinput
                FROM `guru` g
                LEFT JOIN `jadwal` j ON g.id_guru = j.id_guru
                LEFT JOIN `nilai` n ON g.id_guru = n.id_guru
                GROUP BY g.id_guru, g.nip, g.nama, g.created_at
                ORDER BY g.nama ASC";
        return $this->db->fetchAll($sql);
    }

    public function getById(int $id): ?array {
        return $this->db->fetch("SELECT id_guru, nip, nama, created_at FROM `guru` WHERE id_guru = ?", [$id]);
    }

    public function getByNip(string $nip): ?array {
        return $this->db->fetch("SELECT * FROM `guru` WHERE nip = ?", [$nip]);
    }

    public function create(string $nip, string $nama, string $password): bool {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        return $this->db->execute("INSERT INTO `guru` (`nip`, `nama`, `password`) VALUES (?, ?, ?)", [$nip, $nama, $hashed]);
    }

    public function update(int $id, string $nip, string $nama, ?string $password = null): bool {
        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            return $this->db->execute("UPDATE `guru` SET `nip` = ?, `nama` = ?, `password` = ? WHERE `id_guru` = ?", [$nip, $nama, $hashed, $id]);
        }
        return $this->db->execute("UPDATE `guru` SET `nip` = ?, `nama` = ? WHERE `id_guru` = ?", [$nip, $nama, $id]);
    }

    public function delete(int $id): bool {
        return $this->db->execute("DELETE FROM `guru` WHERE `id_guru` = ?", [$id]);
    }

    public function count(): int {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM `guru`");
        return (int)($res['total'] ?? 0);
    }
}
