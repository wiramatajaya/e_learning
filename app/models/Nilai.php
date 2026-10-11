<?php
/**
 * Model Nilai
 * Table: nilai (nilai_id, nilai, id_siswa, pelajaran_id, id_guru)
 */

require_once __DIR__ . '/Database.php';

class Nilai {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $sql = "SELECT n.*, 
                       s.nama as nama_siswa, 
                       s.nis as nis_siswa, 
                       k.nama as nama_kelas,
                       p.nama_pelajaran, 
                       g.nama as nama_guru
                FROM `nilai` n
                JOIN `siswa` s ON n.id_siswa = s.id_siswa
                JOIN `kelas` k ON s.id_kelas = k.id_kelas
                JOIN `pelajaran` p ON n.pelajaran_id = p.pelajaran_id
                JOIN `guru` g ON n.id_guru = g.id_guru
                ORDER BY n.created_at DESC";
        return $this->db->fetchAll($sql);
    }

    public function getById(int $id): ?array {
        $sql = "SELECT n.*, 
                       s.nama as nama_siswa, 
                       s.nis as nis_siswa, 
                       k.nama as nama_kelas,
                       p.nama_pelajaran, 
                       g.nama as nama_guru
                FROM `nilai` n
                JOIN `siswa` s ON n.id_siswa = s.id_siswa
                JOIN `kelas` k ON s.id_kelas = k.id_kelas
                JOIN `pelajaran` p ON n.pelajaran_id = p.pelajaran_id
                JOIN `guru` g ON n.id_guru = g.id_guru
                WHERE n.nilai_id = ?";
        return $this->db->fetch($sql, [$id]);
    }

    public function getBySiswaId(int $id_siswa): array {
        $sql = "SELECT n.*, 
                       p.nama_pelajaran, 
                       g.nama as nama_guru,
                       g.nip as nip_guru
                FROM `nilai` n
                JOIN `pelajaran` p ON n.pelajaran_id = p.pelajaran_id
                JOIN `guru` g ON n.id_guru = g.id_guru
                WHERE n.id_siswa = ?
                ORDER BY p.nama_pelajaran ASC";
        return $this->db->fetchAll($sql, [$id_siswa]);
    }

    public function getByGuruId(int $id_guru): array {
        $sql = "SELECT n.*, 
                       s.nama as nama_siswa, 
                       s.nis as nis_siswa, 
                       k.nama as nama_kelas,
                       p.nama_pelajaran
                FROM `nilai` n
                JOIN `siswa` s ON n.id_siswa = s.id_siswa
                JOIN `kelas` k ON s.id_kelas = k.id_kelas
                JOIN `pelajaran` p ON n.pelajaran_id = p.pelajaran_id
                WHERE n.id_guru = ?
                ORDER BY n.created_at DESC";
        return $this->db->fetchAll($sql, [$id_guru]);
    }

    public function getByKelasAndPelajaran(int $id_kelas, int $pelajaran_id): array {
        // Returns all students in this class and their grade if available
        $sql = "SELECT s.id_siswa, s.nis, s.nama as nama_siswa,
                       k.nama as nama_kelas,
                       n.nilai_id, n.nilai, n.created_at as tanggal_nilai,
                       g.nama as nama_guru
                FROM `siswa` s
                JOIN `kelas` k ON s.id_kelas = k.id_kelas
                LEFT JOIN `nilai` n ON s.id_siswa = n.id_siswa AND n.pelajaran_id = ?
                LEFT JOIN `guru` g ON n.id_guru = g.id_guru
                WHERE s.id_kelas = ?
                ORDER BY s.nama ASC";
        return $this->db->fetchAll($sql, [$pelajaran_id, $id_kelas]);
    }

    public function getBySiswaAndPelajaran(int $id_siswa, int $pelajaran_id): ?array {
        $sql = "SELECT * FROM `nilai` WHERE `id_siswa` = ? AND `pelajaran_id` = ?";
        return $this->db->fetch($sql, [$id_siswa, $pelajaran_id]);
    }

    public function upsert(int $id_siswa, int $pelajaran_id, int $id_guru, float $nilai): bool {
        $existing = $this->getBySiswaAndPelajaran($id_siswa, $pelajaran_id);
        if ($existing) {
            $sql = "UPDATE `nilai` SET `nilai` = ?, `id_guru` = ? WHERE `nilai_id` = ?";
            return $this->db->execute($sql, [$nilai, $id_guru, $existing['nilai_id']]);
        } else {
            $sql = "INSERT INTO `nilai` (`nilai`, `id_siswa`, `pelajaran_id`, `id_guru`) VALUES (?, ?, ?, ?)";
            return $this->db->execute($sql, [$nilai, $id_siswa, $pelajaran_id, $id_guru]);
        }
    }

    public function create(array $data): bool {
        $sql = "INSERT INTO `nilai` (`nilai`, `id_siswa`, `pelajaran_id`, `id_guru`) VALUES (?, ?, ?, ?)";
        return $this->db->execute($sql, [
            $data['nilai'],
            $data['id_siswa'],
            $data['pelajaran_id'],
            $data['id_guru']
        ]);
    }

    public function update(int $id, float $nilai): bool {
        $sql = "UPDATE `nilai` SET `nilai` = ? WHERE `nilai_id` = ?";
        return $this->db->execute($sql, [$nilai, $id]);
    }

    public function delete(int $id): bool {
        return $this->db->execute("DELETE FROM `nilai` WHERE `nilai_id` = ?", [$id]);
    }

    public function getStatsBySiswa(int $id_siswa): array {
        $sql = "SELECT 
                    COUNT(*) as total_mapel,
                    COALESCE(AVG(nilai), 0) as rata_rata,
                    COALESCE(MAX(nilai), 0) as nilai_tertinggi,
                    COALESCE(MIN(nilai), 0) as nilai_terendah
                FROM `nilai` 
                WHERE `id_siswa` = ?";
        $res = $this->db->fetch($sql, [$id_siswa]);
        return [
            'total_mapel' => (int)($res['total_mapel'] ?? 0),
            'rata_rata' => round((float)($res['rata_rata'] ?? 0), 2),
            'nilai_tertinggi' => round((float)($res['nilai_tertinggi'] ?? 0), 2),
            'nilai_terendah' => round((float)($res['nilai_terendah'] ?? 0), 2),
        ];
    }

    public function count(): int {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM `nilai`");
        return (int)($res['total'] ?? 0);
    }
}
