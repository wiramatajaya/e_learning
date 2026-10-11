<?php
/**
 * Model Jadwal
 * Table: jadwal (jadwal_id, hari, jam, menit, id_kelas, pelajaran_id, id_guru)
 */

require_once __DIR__ . '/Database.php';

class Jadwal {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $sql = "SELECT j.*, 
                       k.nama as nama_kelas, 
                       p.nama_pelajaran, 
                       g.nama as nama_guru, 
                       g.nip as nip_guru
                FROM `jadwal` j
                JOIN `kelas` k ON j.id_kelas = k.id_kelas
                JOIN `pelajaran` p ON j.pelajaran_id = p.pelajaran_id
                JOIN `guru` g ON j.id_guru = g.id_guru
                ORDER BY FIELD(j.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), j.jam ASC";
        return $this->db->fetchAll($sql);
    }

    public function getById(int $id): ?array {
        $sql = "SELECT j.*, 
                       k.nama as nama_kelas, 
                       p.nama_pelajaran, 
                       g.nama as nama_guru, 
                       g.nip as nip_guru
                FROM `jadwal` j
                JOIN `kelas` k ON j.id_kelas = k.id_kelas
                JOIN `pelajaran` p ON j.pelajaran_id = p.pelajaran_id
                JOIN `guru` g ON j.id_guru = g.id_guru
                WHERE j.jadwal_id = ?";
        return $this->db->fetch($sql, [$id]);
    }

    public function getByKelasId(int $id_kelas): array {
        $sql = "SELECT j.*, 
                       k.nama as nama_kelas, 
                       p.nama_pelajaran, 
                       g.nama as nama_guru, 
                       g.nip as nip_guru
                FROM `jadwal` j
                JOIN `kelas` k ON j.id_kelas = k.id_kelas
                JOIN `pelajaran` p ON j.pelajaran_id = p.pelajaran_id
                JOIN `guru` g ON j.id_guru = g.id_guru
                WHERE j.id_kelas = ?
                ORDER BY FIELD(j.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), j.jam ASC";
        return $this->db->fetchAll($sql, [$id_kelas]);
    }

    public function getByGuruId(int $id_guru): array {
        $sql = "SELECT j.*, 
                       k.nama as nama_kelas, 
                       p.nama_pelajaran, 
                       g.nama as nama_guru, 
                       g.nip as nip_guru
                FROM `jadwal` j
                JOIN `kelas` k ON j.id_kelas = k.id_kelas
                JOIN `pelajaran` p ON j.pelajaran_id = p.pelajaran_id
                JOIN `guru` g ON j.id_guru = g.id_guru
                WHERE j.id_guru = ?
                ORDER BY FIELD(j.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), j.jam ASC";
        return $this->db->fetchAll($sql, [$id_guru]);
    }

    public function getTodayByGuru(int $id_guru, string $hari): array {
        $sql = "SELECT j.*, 
                       k.nama as nama_kelas, 
                       p.nama_pelajaran, 
                       g.nama as nama_guru
                FROM `jadwal` j
                JOIN `kelas` k ON j.id_kelas = k.id_kelas
                JOIN `pelajaran` p ON j.pelajaran_id = p.pelajaran_id
                JOIN `guru` g ON j.id_guru = g.id_guru
                WHERE j.id_guru = ? AND j.hari = ?
                ORDER BY j.jam ASC";
        return $this->db->fetchAll($sql, [$id_guru, $hari]);
    }

    public function getTodayByKelas(int $id_kelas, string $hari): array {
        $sql = "SELECT j.*, 
                       k.nama as nama_kelas, 
                       p.nama_pelajaran, 
                       g.nama as nama_guru
                FROM `jadwal` j
                JOIN `kelas` k ON j.id_kelas = k.id_kelas
                JOIN `pelajaran` p ON j.pelajaran_id = p.pelajaran_id
                JOIN `guru` g ON j.id_guru = g.id_guru
                WHERE j.id_kelas = ? AND j.hari = ?
                ORDER BY j.jam ASC";
        return $this->db->fetchAll($sql, [$id_kelas, $hari]);
    }

    public function getClassesByGuru(int $id_guru): array {
        $sql = "SELECT DISTINCT k.id_kelas, k.nama as nama_kelas
                FROM `jadwal` j
                JOIN `kelas` k ON j.id_kelas = k.id_kelas
                WHERE j.id_guru = ?
                ORDER BY k.nama ASC";
        return $this->db->fetchAll($sql, [$id_guru]);
    }

    public function getSubjectsByGuru(int $id_guru, ?int $id_kelas = null): array {
        if ($id_kelas) {
            $sql = "SELECT DISTINCT p.pelajaran_id, p.nama_pelajaran
                    FROM `jadwal` j
                    JOIN `pelajaran` p ON j.pelajaran_id = p.pelajaran_id
                    WHERE j.id_guru = ? AND j.id_kelas = ?
                    ORDER BY p.nama_pelajaran ASC";
            return $this->db->fetchAll($sql, [$id_guru, $id_kelas]);
        }
        $sql = "SELECT DISTINCT p.pelajaran_id, p.nama_pelajaran
                FROM `jadwal` j
                JOIN `pelajaran` p ON j.pelajaran_id = p.pelajaran_id
                WHERE j.id_guru = ?
                ORDER BY p.nama_pelajaran ASC";
        return $this->db->fetchAll($sql, [$id_guru]);
    }

    public function create(array $data): bool {
        $sql = "INSERT INTO `jadwal` (`hari`, `jam`, `menit`, `id_kelas`, `pelajaran_id`, `id_guru`) 
                VALUES (?, ?, ?, ?, ?, ?)";
        return $this->db->execute($sql, [
            $data['hari'],
            $data['jam'],
            $data['menit'] ?? '',
            $data['id_kelas'],
            $data['pelajaran_id'],
            $data['id_guru']
        ]);
    }

    public function update(int $id, array $data): bool {
        $sql = "UPDATE `jadwal` 
                SET `hari` = ?, `jam` = ?, `menit` = ?, `id_kelas` = ?, `pelajaran_id` = ?, `id_guru` = ? 
                WHERE `jadwal_id` = ?";
        return $this->db->execute($sql, [
            $data['hari'],
            $data['jam'],
            $data['menit'] ?? '',
            $data['id_kelas'],
            $data['pelajaran_id'],
            $data['id_guru'],
            $id
        ]);
    }

    public function delete(int $id): bool {
        return $this->db->execute("DELETE FROM `jadwal` WHERE `jadwal_id` = ?", [$id]);
    }

    public function count(): int {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM `jadwal`");
        return (int)($res['total'] ?? 0);
    }
}
